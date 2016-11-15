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

        <?php if ($this->session->flashdata('error')): ?>

            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
            </div>

        <?php endif; ?>

        <h1 class="text-center"><?php echo $current_project->titre; ?></h1>

        <div class="col-sm-6 adjust">

            <?php include APPPATH . 'views/components/file_panel.php'; ?>

            <div class="row">

                <div class="col-sm-12">

                    <?php include APPPATH . 'views/components/task_panel.php'; ?>

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

<?php include "modals/create_user.php"; ?>
<?php include APPPATH . 'views/modals/avatar.php'; ?>
<?php include APPPATH . 'views/modals/search_user.php'; ?>
<?php include "modals/edit_user.php"; ?>
<?php include APPPATH . 'views/modals/confirm.php'; ?>







