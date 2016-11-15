<?php foreach ($tasks as $task): ?>

    <input type="hidden" name="id_project" value="<?php echo $task->id_projet; ?>">

    <div id="task">
        
        <?php if($task->done):  ?>

            <h3><input class="main" id="<?php echo $task->id; ?>" type="checkbox" name="done[<?php echo $task->id; ?>]" value="1" checked disabled>
                &nbsp;<strong><?php echo $task->intitule; ?></strong></h3>

        <?php else: ?>

            <h3><input class="main" id="<?php echo $task->id; ?>" type="checkbox" name="done[<?php echo $task->id; ?>]" value="1">
                &nbsp;<strong><?php echo $task->intitule; ?></strong></h3>

        <?php endif; ?>


        <small><?php echo $task->dead_line; ?></small>
        <p><em><u>Detail :</u></em></p>
        <p><?php echo $task->commentaire; ?></p>
        <hr>

    </div>

    <h3>Les sous-tâches:</h3>

    <div id="miniTask">

        <?php foreach ($mini_tasks as $mini_task):?>

            <?php if ($task->id == $mini_task->sous_tache_id): ?>

                <?php if($mini_task->done): ?>

                    <h4><input class="second" type="checkbox" name="done[<?php echo $mini_task->id; ?>]" value="1" id="<?php echo $mini_task->sous_tache_id; ?>" checked disabled>
                        &nbsp;<strong><?php echo $mini_task->intitule; ?></strong></h4>

                <?php else: ?>

                    <h4><input class="second" type="checkbox" name="done[<?php echo $mini_task->id; ?>]" id="<?php echo $mini_task->sous_tache_id; ?>" value="1" >
                        &nbsp;<strong><?php echo $mini_task->intitule; ?></strong></h4>

                <?php endif; ?>

                <small><?php echo $mini_task->dead_line; ?></small>
                <p><em><u>Detail :</u></em></p>
                <p><?php echo $mini_task->commentaire; ?></p>
                <hr>
            <?php endif; ?>


        <?php endforeach; ?>

    </div>

<?php endforeach; ?>


<div class="form-group">

    <input type="hidden">
    <input class="btn btn-success" type="submit" name="confirm">

</div>
</form>