<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=gdp', 'root', '');
$connection = $bdd->prepare('SELECT * FROM utilisateur WHERE nom=:pseudo');
$connection->bindParam(':pseudo',$_POST['name']);
if(!$connection->execute()){
    var_dump($connection->errorInfo());
}else{
    $userInfos = $connection->fetch();
    //var_dump($userInfos);
    if($userInfos > 0){
        $_SESSION['id']=$userInfos['id'];
        $_SESSION['nom']=$userInfos['nom'];
    }else{
        header('Location: ../connection.php');
    }
}
?>
<!doctype html>
<html>
<head>
    <title>chat</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font: 13px Helvetica, Arial;
        }
        form {
            background: steelblue;
            padding: 2px;
            position: relative;
            width: 100%;
            height: 15%;
        }
        .converse{
            height: 32vh;
            width: 20vw;
            position: relative;
            float: right;
            bottom: 0;
            top: 68vh;
            border: 2px solid steelblue;
            border-radius: 3px 4px 0 0;
        }
        form input {
            border: 0;
            width: 90%;
            height: 90%;
            margin-right: .5%;
        }
        form button {
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
    <link href="../ressource/style.css" rel="stylesheet" type="text/css">
    <script src="../node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
    <script type="text/javascript">
        var socket = io('127.0.0.1:3000');

        var User = function(id,name) {
            this.id = id;
            this.name = name;
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
                $('body').append('<div class="converse" data-part="'+part+'"><div class="top"><span class="close">X</span><span class="participant"></div><ul id="'+converse.id+'messages" class="message" ></ul>'+
                    '<form id="'+converse.id+'">'+
                    '<input class="m" autocomplete="off" /><button>Send</button>'+
                    '</form></div>');
                $.each(converse.messages,function(index, message){
                    $('#'+converse.id+'messages').prepend('<li class="'+((message.id==user.id)? 'fromMe' : 'fromOther' )+'">'+((message.id!=user.id)? message.from+' : ' :'')+message.message+'</li>');
                });
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
        };

        var user = new User(<?php echo "'".$_SESSION['id']."'" ?>,<?php echo"'".$_SESSION['nom']."'" ?>); // /!\ definition par php

        $(document).ready(function(){
            $(document).on('submit','form',function(e){
                e.preventDefault();
                user.sendMessage($(this).children('.m').val(),$(this).attr('id'));
                $(this).children('.m').val('');
                return false;
            });

            $(document).on('click','#users li',function(){
                if($(".converse[data-part='"+user.id+','+$(this).attr('id')+"']").length==0){
                    socket.emit('newRoom',$(this).attr('id'));
                }
            });

            $(document).on('click','.close',function(){
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
                $('body').append('<div class="converse" data-part="'+part+'" data-id="'+nameRoom+'"><div class="top"><span class="close">X</span><span class="participant">'+nameUsers.join(',')+'</span></div><ul id="'+nameRoom+'messages" class="message"></ul>'+
                    '<form id="'+nameRoom+'">'+
                    '<input class="m" autocomplete="off" /><button>Send</button>'+
                    '</form></div>');
            });


            socket.on('disconnect',function(userId){
                $('#users ul #'+userId).removeClass('Connected');
            });

            socket.on('isWriting', function(idConverse, user){
                if($('#'+idConverse+' .isWriting') == undefined)
                    //$
            });

            socket.on('stopWriting', function(idConverse, user){

            });
        });
    </script>
</head>
<body>
<div id="users">
    <ul>
    </ul>
</div>
</body>
</html>
