var mysql = require('mysql');
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

var sqlConnection = mysql.createConnection({
    host : '172.17.10.101',
    user :'redon2',
    password : 'slam2016',
    database : 'redon2'
});

/**
 *
 * @param userId
 * @constructor
 */
var ConversationManager = function(userId){
    var userId = userId;

    /**
     *
     * @param {array} userIdList
     * @returns {string}
     */
    this.makeListId = function(userIdList){
        return   "& "+userIdList.sort().join(' & ')+" &";
    };


    this.parseIdList = function(userString){
        console.log(userString);
        return userString.replace(/(& )|( &)/g,'').split(' ');
    };
    /**
     * appel existeOneConv avec un nom plus explicite
     * @param {array} userIds
     */
    this.openRoom = function(userIds){
        this.existeOneConv(userIds);
    };

    /**
     * verifie que l'utilisateur a au moins une conversation avant d'en créer une
     * @param userIds
     */
    this.existeOneConv = function(userIds){
        console.log('exist one');
        sqlConnection.query('SELECT id FROM conversation WHERE participant = "'+this.makeListId(userIds)+'"',
            function(error, results) {
                if (error) {
                    console.log(error);
                    return;
                }
                if (results.length > 0) {
                    users[userId].socket.conversationManager.getConversation(results[0].id,0)
                } else {
                    users[userId].socket.conversationManager.createConversation(userIds);
                }
            });
    };

    /**
     * ajoute dans la base de données une entrée correspondant a la nouvelle conversation
     * @param {array}conversationUsers
     */
    this.createConversation = function(conversationUsers){
        console.log('create conversation');

        var userList = this.makeListId(conversationUsers);

        sqlConnection.query('INSERT INTO conversation (participant) VALUES ("'+userList+'")',
            function select(error, result) {
                if (error) {
                    console.log(error);
                    return;
                }

                users[userId].socket.conversationManager.newRoom(result.insertId,conversationUsers);
                return;
            });
    };
    /**
     * ouvre une nouvelle room, et envois le signal 'new room' a tout ses participant
     * @param idConverse
     * @param {array}usersId
     */
    this.newRoom = function(idConverse, usersId){
        console.log('new room');
        console.log(usersId);
        usersId = typeof (usersId) == 'object' ? usersId : this.parseIdList(usersId);
        users[userId].socket.conversationManager.openRooms[idConverse] = usersId;
        usersId.forEach(function(element){
            if(!users[element] == undefined)
                users[element].socket.join(idConverse);
        });
        users[userId].socket.emit('newRoom',idConverse,usersId.join());
    }

    /**
     * retourne la conversation correspondant a l'id en focntion de l'offset
     * @param {int}idConversation
     * @param {int}offset
     */
    this.getConversation = function (idConversation, offset) { //recupere les messages d'une conversation par tranche de 25
        console.log('getConverse');
        if (offset > 0)
            offset = 25 * offset;
        console.log('idConversation : '+idConversation+'; offset :'+offset);
        sqlConnection.query('SELECT * FROM message JOIN utilisateur ON utilisateur.id = message.id_utilisateur WHERE id_conversation='+idConversation+' ORDER BY date_message DESC LIMIT 25 OFFSET ' + offset,
            function (error, results) {
                if (error) {
                    console.log(error);
                    return;
                }
                console.log('getConverse.length: '+results.length);
                if (results.length > 0) {
                    var messages = [];
                    results.forEach(function (element) {
                        messages.push({
                            id: element.id_utilisateur,
                            from: element.nom,
                            message: element.message
                        });
                    });
                    console.log(messages);
                    users[userId].socket.conversationManager.returnConversation(idConversation,messages);
                    return;
                }else{
                    sqlConnection.query('SELECT participant FROM conversation WHERE id = '+idConversation,
                        function(error,result){
                            if(error){
                                console.log(error);
                                return;
                            }

                            users[userId].socket.conversationManager.newRoom(idConversation, result[0].participant);
                        })
                }
            });
    };
    /**
     *
     * @param {int} idConversation
     * @param {array(object)} messages
     */
    this.returnConversation = function(idConversation, messages){
        console.log('return conversaion');
        console.log('isOpen '+this.openRooms[idConversation]);
        if(this.openRooms[idConversation] == undefined){
            sqlConnection.query('SELECT participant FROM conversation WHERE id = '+idConversation,
                function(error, results){
                    if(error){
                        console.log(error);
                        return;
                    }
                    users[userId].socket.conversationManager.newRoom(idConversation, results[0].participant);
                    users[userId].socket.emit('fill conversation',idConversation, messages);
                })
        }
        users[userId].socket.emit('fill conversation',idConversation, messages);
    }

    this.getConverseNotif = function (){ //recuperer les conversations dont le dernier message date de quand l'utilisateur etait deco
        console.log('getConverseNotif');
        console.log(userId);
        sqlConnection.query('SELECT last_connection FROM utilisateur WHERE id = '+userId,
            function(error, result){
                if(error){
                    console.log(error);
                    return;
                }


                var date = new Date(result[0].last_connection);
                sqlConnection.query('SELECT * FROM ( SELECT DISTINCT id_conversation, date_message FROM message AS M JOIN conversation AS C ON M.id_conversation=C.id WHERE participant LIKE "%& '+ userId +' &%" && id_projet = NULL ORDER BY id_conversation, date_message DESC ) AS T GROUP BY T.id_conversation',
                    function(error, results){
                        if(error){
                            console.log(error);
                            return;
                        }
                        console.log('getConverseNotif.length: '+results.length);
                        if(results.length > 0){
                            results.forEach(function (element) {
                                console.log(element);
                                if(date < new Date(element.date_message)){
                                    console.log(element);
                                    users[userId].socket.conversationManager.getConversation(element.id_conversation,0);
                                }
                            });
                        }else{
                            return false;
                        }
                    })

            })
    };

    /**
     * contient la liste des conversations ouverte par l'utlisateur, et les participant a cette conversation
     * @type {Array}
     */
    this.openRooms = [];
}

users=[];

app.get('/', function(req, res){
    res.sendFile(__dirname + '/index.html');
});

io.on('connection',function(socket){

    socket.on('getUser',function(){ // recuperer la liste de tout les autres utilisateur
        sqlConnection.query('SELECT * FROM utilisateur ORDER BY nom',
            function select(error, results, fields) {
                if (error) {
                    console.log(error);
                    return;
                }

                if ( results.length > 0 )  {
                    var users=[];
                    results.forEach(function (element) {
                        if (element.id != socket.userId) {
                            users.push({"id": element.id, "nom": element.nom});
                        }
                    });
                    socket.emit('setUsers', users);
                } else {
                    console.log("Pas de données");
                }
            });
    });

    socket.on('addUser',function(user){ //enregistre le nouvel utilisateur dans le tableau users, création de l'instance de ConversationManager
        socket.username=user.name;
        socket.userId  = user.id;
        users.forEach(function (element) {
            element.socket.emit('isConnected', user);
        });
        users[socket.userId]={'socket' : socket, 'user' : user};
        socket.conversationManager = new ConversationManager(user.id);
        //!\ recuperer les converses ouvertes lors de l'absence du client
        console.log(socket.username+' connected');

        //ouvrir une room pour le projet
        if(user.idProject !== undefined && user.idProject!== null){
            socket.join('project'+user.idProject);
        }
    });

    socket.on('getConnected',function(){ //renvoie le nom des utilisateurs connecté
        var isCo = [];
        for(var indexUsers in users){
            if(users[indexUsers].user.name !== socket.username)
                isCo.push(users[indexUsers].user);
        }
        socket.emit('isConnected',isCo);
    });

    socket.on('newRoom',function(usersId){
        var newRoomUsers = [];
        if(typeof(usersId)==='object'){
            for(var usersIdIndex in usersId){
                newRoomUsers.push(usersId[usersIdIndex]);
            }
        }else{
            newRoomUsers.push(usersId);
        }

        newRoomUsers.push(socket.userId);
        socket.conversationManager.openRoom(newRoomUsers);
        return;
    });

    socket.on('send message', function(msg,to){
        socket.conversationManager.openRooms[to].forEach(function(element){
            if(users[element]!= undefined){
                if(users[element].socket.conversationManager.openRooms[to] == undefined){
                    users[element].socket.conversationManager.openRoom(socket.conversationManager.openRooms[to]);
                }
            }
        })
        socket.broadcast.emit('chat message', msg , to, socket.username);
        socket.emit('my message', msg, to);
        sqlConnection.query('INSERT INTO message (id_utilisateur,id_conversation,message,date_message) VALUES ('+socket.userId+','+to+',"'+msg.substring(0,msg.length).replace(/(')/g,"\'")+'",NOW())',
            function(error){
                if(error){
                    console.log(error);
                }
            });
    });

    socket.on('sendProjectMessage', function (msg,idProject) {
        socket.broadcast.to('project'+idProject).emit('receiveProjectMessage',msg,socket.username);
        sqlConnection.query('SELECT id FROM conversation WHERE id_projet='+idProject,
            function (error,result) {
                if(error){
                    console.log('error1 :'+error);
                    return;
                }
                console.log(result[0].id);
                sqlConnection.query('INSERT INTO message (id_utilisateur,id_conversation,message,date_message) VALUES ('+socket.userId+','+result[0].id+',"'+msg.substring(0,msg.length).replace(/(')/g,"\'")+'",NOW())',
                    function(error){
                        if(error){
                            console.log('error2 :',error,result[0].id,socket.userId);
                        }
                    });
            }
        );
    });

    socket.on('getConverse',function(){
        console.log('getConverseEvent');
        socket.conversationManager.getConverseNotif();
    });

    socket.on('closeConverse',function(idConverse){
        socket.conversationManager.openRooms.splice(idConverse,1);
        console.log(socket.conversationManager.openRooms);
    });

    socket.on('disconnect',function(){
        io.emit('disconnect',socket.userId);
        sqlConnection.query('UPDATE utilisateur SET last_connection=NOW() WHERE id='+socket.userId,
            function(error, results, fields){
                if(error){
                    console.log(error);
                }
            });
        console.log(socket.username +' is now disconnected');
    });

    socket.on('get project converse id',function(idProject){
        console.log('zbraaa');
        sqlConnection.query('SELECT id FROM conversation WHERE id_projet='+idProject,
            function(error, results){
                if(error){
                    console.log(error);
                }

                socket.emit('set project converse id', results[0].id);
            });
    });
});

http.listen(3000, function(){
    console.log('listening on *:3000');
});
