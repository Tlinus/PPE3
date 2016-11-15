<?php include 'components/project_bar.php'; ?>

<div class="col-sm-9">

    <div id="app" class="row">

        <?php validation_errors(); ?>

        <?php if ($this->session->flashdata('success')): ?>

            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
            </div>

        <?php endif ?>

        <?php if ($this->session->flashdata('primary')): ?>

            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Heads up!</strong> <?php echo $this->session->flashdata('primary'); ?>
            </div>

        <?php endif ?>
        

        <div class="col-sm-12">

            <div class="row">

                    <div class="col-sm-5">

                        <h1>
                            <input type="hidden" name="deleteProjectAdmin" value="">
                            <button id="delete" data-toggle="modal" data-target="#confirm" class="btn btn-danger" >Delete Projet</button>
                        </h1>

                    </div>

                <div class="col-sm-6">

                    <h1><?php echo $current_project->titre; ?></h1>

                </div>

            </div>

        </div>

        <div class="col-sm-6 adjust">

            <div class="row">

                <div class="col-sm-12">

                    <?php include APPPATH . 'views/components/file_panel.php'; ?>

                </div>

            </div>

            <div class="row">

                <div class="col-sm-12">

                    <?php include 'components/task_panel.php';  ?>

                </div>

            </div>

        </div>

        <div class="col-sm-6">

            <div class="row">

                <div class="col-sm-12">

                    <?php include APPPATH . 'views/components/chat_panel.php'; ?>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include APPPATH . 'views/components/chat_bar.php'; ?>

<!-- Modals -->

<?php include APPPATH . 'views/modals/avatar.php'; ?>
<?php include APPPATH . 'views/modals/search_user.php'; ?>
<?php include 'modals/user_profile.php'; ?>
<?php include 'modals/add_task.php'; ?>
<?php include 'modals/edit_task.php'; ?>
<?php include 'modals/create_project.php'; ?>
<?php include APPPATH . 'views/modals/confirm.php'; ?>




