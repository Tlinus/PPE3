<div id="chat" class="adjust-panel panel panel-default">

    <div class="panel-heading">

        <h1 class="text-center">Chat</h1>

    </div>

    <div class="panel-body" style="height: 70vh;overflow-y: auto;">
        <ul>
        <?php
            $messages = $this->conversation->getMessages($this->conversation->getConversation($this->session->userdata('id_project'))->id);
            foreach($messages->result() as $message){
                echo '<li class="'.(($message->id_utilisateur == $this->session->userdata('logged_in')['id'])? 'fromMe' : 'fromOther').'">'.(($message->id_utilisateur == $this->session->userdata('logged_in')['id'])? 'moi :' : $message->nom.' :').' '.$message->message.'</li>';
            }
        ?>
        </ul>
    </div>

    <div class="panel-footer">
        <div class=" container-fluid">
            <form id="projectMessage" data-id="<?= $this->session->userdata('id_project') ?>" class="container-fluid">
                <input id="btn-input" type="text" class="form-control input-lg container" placeholder="Type your message here..." autocomplete="off"/>
                <span class="input-group-btn"><button class="btn btn-primary btn-sm" id="btn-chat">Send</button></span>
            </form>
        </div>
        
    </div>

</div>