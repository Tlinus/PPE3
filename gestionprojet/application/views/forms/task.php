<div class="modal-body">

        <div class="form-group">
            <h4>Titre</h4>
            <input class="form-control" type="text" name="title[main]" placeholder="Titre de la tâche" value="">
        </div>

        <div class="form-group">
            <h4>Deadline</h4>
            <input class="form-control deadline" type="text" name="deadline[main]" value="">
        </div>

        <div class="form-group">
            <h4>Commentaire</h4>
            <textarea class="form-control" name="comment[main]" placeholder="Plus d'information sur la tâche"></textarea>
        </div>

        <hr>

        <div class="form-group">
            <h3>Sous-Tâche</h3>
        </div>

        <button class="btn btn-primary addMiniTask" id="addMiniTask">Ajout Sous-Tâche</button>

        <div class="form-group">
            <h4>Titre</h4>
            <input class="form-control title" type="text" name="title[mini][0]" placeholder="Titre de la tâche" value="">
        </div>

        <div class="form-group">
            <h4>Deadline</h4>
            <input class="form-control deadline"  type="text" name="deadline[mini][0]" value="">
        </div>

        <div class="form-group">
            <h4>Commentaire</h4>
            <textarea class="form-control"  name="comment[mini][0]" placeholder="Plus d'information sur la tâche""></textarea>
        </div>

        <div class="mini-task">
        </div>

    </div>
