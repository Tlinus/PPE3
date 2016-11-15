<div class="modal fade" id="createProject" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h3 class="text-center">Nouveau Projet</h3>

            </div>

            <?php echo validation_errors() ?>

            <?php if ($this->session->flashdata('error')): ?>

                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                </div>

            <?php endif; ?>

            <?php echo form_open_multipart('chef/create') ?>

            <?php include APPPATH . 'views/forms/create_project.php'; ?>

            <div class="modal-footer">

                <input class="btn btn-success" type="submit" value="Create">
                <a class="btn btn-danger" data-dismiss="modal">Close</a>

            </div>

        </form>

        </div>
    </div>
</div>