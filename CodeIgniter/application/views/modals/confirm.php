<div class="modal fade" id="confirm" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header text-center">

                <h1>Confirmation</h1>

            </div>

            <div class="modal-body">

                <h3 class="text-center">Are you sure ?</h3>

            </div>

            <div class="modal-footer">

                <?php $sessiondata = $this->session->userdata('logged_in'); ?>

                <?php if($sessiondata['type'] == 2): ?>

                    <a class="btn btn-success delete" href="">Yes</a>
                    
                <?php endif; ?>

                <?php if($sessiondata['type'] == 1): ?>

                    <a class="btn btn-success ban add delete" href="">Yes</a>

                <?php endif; ?>
                
                <a class="btn btn-danger" data-dismiss="modal">No</a>

            </div>

        </div>

    </div>

</div><?php
