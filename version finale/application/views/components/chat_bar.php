<script src="<?php echo base_url("assets/js/node_modules/socket.io/node_modules/socket.io-client/socket.io.js"); ?>"></script>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font: 13px Helvetica, Arial;
    }
    .chat-bar {
        background: steelblue;
        padding: 2px;
        position: relative;
        width: 100.5%;
        height: 15%;
    }
    .converse{
        height: 32vh;
        width: 20vw;
        position: absolute;
        bottom: 0;
        top: 65vh;
        background-color: white;
        border: 2px solid steelblue;
        border-radius: 3px 4px 0 0;
    }
    .chat-bar input {
        border: 0;
        width: 90%;
        height: 90%;
        margin-right: .5%;
    }
    .chat-bar button {
        height: 90%;
        width: 9%;
        background: rgb(130, 224, 255);
        border: none;
    }
    .messages { width: 100%; margin: 0; padding: 0; }
    .messages li { padding: 5px 10px; }
    .messages li:nth-child(odd) { background: #eee; }
    .message{
        position: relative;
        height: 80%;
        overflow: auto;
    }
    .message .fromOther{
        width: 100%;
        display: block;
        text-align: left;
    }
    .message .fromMe{
        width: 100%;
        display: block;
        text-align: right;
    }

    .close{
        cursor: pointer;
        position: relative;
        top: 0;
        left: 0;
        width: 20vw;
    }

    .top{
        position: relative;
        top: 0;
        left: 0;
        background: steelblue;
    }

    .participant{
        display: inline-block;
        width: 90%;
        text-align: center;
    }
</style>
<script type="text/javascript">
    var socket = io('172.17.10.101:3000');

    var User = function(id,name,idProject) {
        this.idProject = idProject;
        this.id = id;
        this.name = name;
        this.nbConverse = 0;
        socket.emit('addUser',this);
        socket.emit('getUser');
        socket.on('setUsers',function(users){
            $.each(users,function(index,user){
                $('#users ul').append('<li id="'+user.id+'">'+user.nom+'</li>');
            });
            socket.emit('getConnected');
        });
        socket.emit('getConverse');
        socket.on('setConverse',function(converse,part){
            var nameUsers =[];
            $.each(part.split(','),function(index,idUser){
                if(idUser !== user.id)
                    nameUsers.push($('#'+idUser).html());
            })
            $('body').append('<div class="converse" data-part="'+part+'" style="left: '+(user.nbConverse+(user.nbConverse*20))+'vw"><div class="top"><span class="close">X</span><span class="participant"></div><ul id="'+converse.id+'messages" class="message" ></ul>'+
                '<form class="chat-bar" id="'+converse.id+'">'+
                '<input class="m" autocomplete="off" /><button>Send</button>'+
                '</form></div>');
            $.each(converse.messages,function(index, message){
                $('#'+converse.id+'messages').prepend('<li class="'+((message.id==user.id)? 'fromMe' : 'fromOther' )+'">'+((message.id!=user.id)? message.from+' : ' :'')+message.message+'</li>');
            });
            this.nbConverse ++;
            if(this.nbConverse > 4){
                $('.converse')[0].remove();
            }
        });
        this.sendMessage = function (message,to){
            socket.emit('send message',message,to);
        };
        socket.on('fill conversation', function(idConverse, messages){
            $.each(messages,function(index, message){
                $('#'+idConverse+'messages').prepend('<li class="'+((message.id==user.id)? 'fromMe' : 'fromOther' )+'">'+((message.id!=user.id)? message.from+' : ' :'')+message.message+'</li>');
            });
            $('#'+idConverse+'messages').scrollTop($('#'+idConverse+'messages').height());
        })

        if(this.idProject !== undefined){
            socket.emit('get project converse id',this.idProject);
        }
        socket.on('set project converse id',function(idConverse){
            $('#chat .panel-body').attr('id',idConverse+'messages');
            $('#chat .chat-bar').attr('id',idConverse);
        });

        this.sendProjectMessage = function(msg, idProject){
            $('#chat ul').append('<li class="fromMe">moi : '+msg+'</li>');
            socket.emit('sendProjectMessage',msg,idProject);
        };

        socket.on('receiveProjectMessage', function(msg,from){
            $('#chat ul').append('<li class="fromOther">'+from+' : '+msg+'</li>');
        });
    };
    var user = new User(<?php echo "'".$_SESSION['logged_in']['id']."'" ?>,<?php echo"'".$_SESSION['logged_in']['name']."'" ?><?= ((!empty($this->session->userdata('id_project')))?','.$this->session->userdata('id_project') : '' )?>); // /!\ definition par php

    $(document).on('submit','.chat-bar',function(e){
        e.preventDefault();
        user.sendMessage($(this).children('.m').val(),$(this).attr('id'));
        $(this).children('.m').val('');
        return false;
    });

    $(document).on('click','#btn-chat',function(e){
        e.preventDefault();
        var val = $('#btn-input').val();
        if(val.search(/([a-zA-Z0-9ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ_-])+/g)>=0){
            user.sendProjectMessage(val,$('#projectMessage').attr('data-id'));
            $('#btn-input').val('');
        }
    });

    $(document).on('click','#users li',function(){
        if($(".converse[data-part='"+user.id+','+$(this).attr('id')+"']").length==0){
            socket.emit('newRoom',$(this).attr('id'));
        }
    });

    $(document).on('click','.close',function(){
        user.nbConverse--;
        $(this).parent().parent('.converse')[0].remove();
        socket.emit('closeConverse', $(this).parent('div.converse').attr('data-id'))
    });

    $(document).on('change','.m',function(){
        console.log($(this).parent().attr('id'));
        if($(this).val() == '')
            socket.emit('stopWriting', $(this).parent().attr('id'));
        else
            socket.emit('writing', $(this).parent().attr('id'));
    });

    socket.on('isConnected', function(listUser){
        $.each(listUser,function(index, user){
            if(typeof (user)=='object')
                $('#users ul #'+user.id).addClass('Connected');
            else{
                if(index == 'id'){
                    $('#users ul #'+user).addClass('Connected');
                }
            }
        });
    });

    socket.on('chat message', function(msg,to,from){
        $('#'+to+'messages').append($('<li class="fromOther">').text(from+' : '+msg));
        $('#'+to+'messages').scrollTop($('#'+to+'messages').height());
    });

    socket.on('my message', function(msg,to){
        $('#'+to+'messages').append($('<li class="fromMe">').text(msg));
        $('#'+to+'messages').scrollTop($('#'+to+'messages').height());
    });

    socket.on('newRoom', function(nameRoom, part){
        var nameUsers =[];
        $.each(part.split(','),function(index,idUser){
            if(idUser !== user.id)
                nameUsers.push($('#'+idUser).html());
        })
        $('body').append('<div class="converse" data-part="'+part+'" data-id="'+nameRoom+'" style="left: '+(user.nbConverse+(user.nbConverse*20))+'vw"><div class="top"><span class="close">X</span><span class="participant">'+nameUsers.join(',')+'</span></div><ul id="'+nameRoom+'messages" class="message"></ul>'+
            '<form class="chat-bar" id="'+nameRoom+'">'+
            '<input class="m" autocomplete="off" /><button>Send</button>'+
            '</form></div>');
        user.nbConverse ++;
        if(this.nbConverse > 4){
            $('.converse')[0].remove();
        }
    });

    socket.on('disconnect',function(userId){
        $('#users ul #'+userId).removeClass('Connected');
    });

    /*socket.on('isWriting', function(idConverse, user){
        if($('#'+idConverse+' .isWriting') == undefined)
            $('#'+idConverse).append('test');
    });

    socket.on('stopWriting', function(idConverse, user){

    });*/
</script>
<div id="users" class="col-sm-1 screen-adjust text-center">
    <ul>
    </ul>
</div>
