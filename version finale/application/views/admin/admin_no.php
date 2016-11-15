<?php include 'components/project_bar.php'; ?>

<div class="col-sm-9">
    <div id="app" class="row">

        <div class="login-adjust" id="welcome">

            <h1 class="text-center">Welcome</h1>
            <h2 class="text-center">You have no projects</h2>

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
