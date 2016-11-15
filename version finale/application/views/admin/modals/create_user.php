<div class="modal fade" id="createUser" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Create User</h3>
            </div>

            <?php echo validation_errors() ?>

            <?php if ($this->session->flashdata('error')): ?>

                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                </div>

            <?php endif; ?>

            <?php echo form_open('admin/create', 'id="userForm"') ?>

            <?php include APPPATH . 'views/forms/user.php'; ?>

            <div class="modal-footer">
                <input class="btn btn-success" type="submit" value="Create">
                <a class="btn btn-danger" data-dismiss="modal">Close</a>
            </div>

            </form>

        </div>
    </div>
</div>