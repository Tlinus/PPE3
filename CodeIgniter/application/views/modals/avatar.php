<div class="modal fade" id="avatar" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h4 style="text-align:center;">Changer d'avatar</h4>

            </div>

            <div class="modal-body form-group">
                
                <?php echo form_open('avatar'); ?>

                <?php include APPPATH . 'views/forms/avatar.php'; ?>

                <hr>
                <a class="btn btn-danger" data-dismiss="modal">Close</a>
            </div>

        </div>

    </div>
    
</div>
