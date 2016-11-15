<div class="container-fluid login">

    <div class="col-sm-offset-3 col-sm-6 login-adjust">

        <h1 class="text-center">Gestion de Projet</h1>

        <?php validation_errors(); ?>

        <?php if ($this->session->flashdata('success')): ?>

            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
            </div>

        <?php endif ?>

        <?php if ($this->session->flashdata('error')): ?>

        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
        </div>

        <?php endif; ?>

        <?php echo form_open('auth/login'); ?>

            <div class="form-group">
                <h3>Email:</h3>
                <input class="form-control" type="email" name="email" placeholder="Entrer Email">
            </div>

            <div class="form-group">
                <h3>Password:</h3>
                <input class="form-control" type="password" name="password" placeholder="Entrer Mot de Passe">
            </div>

            <input class="btn btn-success float-right" type="submit" value="Connexion">
            <div class="break"></div>

        </form>

    </div>
</div>