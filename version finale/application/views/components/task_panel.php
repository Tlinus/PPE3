<div id="tache" class="adjust-panel panel panel-default">
    
    <div class="panel-heading">
        
        <h1 class="text-center">Tâches</h1>
        
    </div>
    
    <div class="panel-body">
        
        <div class="progress">

            <div id="progress-bar" class="progress-bar progress-bar-success" role="progressbar"
                 aria-valuenow="" aria-valuemin="0" aria-valuemax="100"
                 style="width: <?php echo $percent."%"; ?>">
            </div>
            
        </div>

        <?php echo form_open('done'); ?>
        <?php include APPPATH . 'views/forms/done_task.php'; ?>

    </div>
</div>