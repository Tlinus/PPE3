<div class="container-fluid">

    <div class="row">

        <div id="menu" class="col-sm-2 screen-adjust text-center">

            <div class="col-sm-12">

                <?php if($user->avatar == "none" OR empty($user->avatar)): ?>

                    <a href="" data-toggle="modal" data-target="#avatar" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span></a>
                    
                    <?php else: ?>

                    <a href="" data-toggle="modal" data-target="#avatar" class="btn btn-primary"><img style="width:100px;height:100px"  src="<?php echo $user->avatar ?>"></a>
                    
                <?php endif; ?>


                <h5><?php echo $user->nom; ?></h5>
                <h4><?php echo $user->prenom; ?></h4>

            </div>

            <div class="col-sm-12">

                <a id="logout" href="<?php echo base_url('index.php/logout'); ?>"><span class="glyphicon glyphicon-share"></span>Logout</a>
                <div class="line"></div>
                <button data-toggle="modal" data-target="#createUser" class="btn btn-success reset" type="submit">Create User</button>
                <hr>
                <button data-toggle="modal" data-target="#userList" class="btn btn-primary" type="submit">See Users</button>

            </div>

            <div class="line col-sm-12"></div>

            <div class="col-sm-12">

                <?php if(! empty($projects)): ?>

                <?php foreach ($projects as  $project): ?>

                    <a class="project-link" href="<?php echo base_url('index.php/admin/project/'.$project->id); ?>"><h4><?php echo $project->titre; ?></h4></a>
                    <hr>

                <?php endforeach; ?>

                <?php endif; ?>

            </div>

        </div>