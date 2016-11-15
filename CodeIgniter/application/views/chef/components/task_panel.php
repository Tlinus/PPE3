<div id="tache" class="adjust-panel panel panel-default">

    <div class="panel-heading">

        <h1 class="text-center">Définition du Projet</h1>

    </div>

    <div class="panel-body">

        <div class="col-sm-12">

            <div class="row">

                <div class="col-sm-6 text-center">

                    <a href="" data-toggle="modal" data-target="#userList">
                        <span class="glyphicon glyphicon-book icon-def"></span>
                        <h3>Ajout User</h3>
                    </a>

                    <?php foreach ($users as $user): ?>

                        <hr>
                        <p><a id="<?php echo $user->id_utilisateur; ?>" class="banUser" onclick="banUser(this.id)" data-toggle="modal" data-target="#seeUser"  href="">
                                <?php echo $user->nom; ?>
                                &nbsp;
                                <?php echo $user->prenom ?>
                            </a></p>

                    <?php endforeach; ?>


                </div>

                <div class="col-sm-6 text-center">

                    <a class="reset" href="" data-toggle="modal" data-target="#addTask">
                        <span class="glyphicon glyphicon-plus-sign icon-def"></span>
                        <h3>Ajout Tâche</h3>
                    </a>

                    <?php foreach ($tasks as $task): ?>

                        <?php if($task->done == 0): ?>

                            <hr>
                            <p><a id="<?php echo $task->id; ?>" onclick="getTask(this.id)" class="taskEdit" data-toggle="modal" data-target="#seeTask" value="" href=""><?php echo $task->intitule; ?></a></p>

                        <?php endif; ?>

                    <?php endforeach; ?>


                </div>

            </div>

        </div>

    </div>

</div>