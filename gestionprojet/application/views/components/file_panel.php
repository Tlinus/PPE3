<?php
require_once(APPPATH.'models/DatabaseFactory.php');
require_once(APPPATH.'interfaces/SystemObjectInterface.php');
require_once(APPPATH.'abstracts/SystemObject.php');
require_once(APPPATH.'models/SystemDirectory.php');
require_once(APPPATH.'abstracts/File.php');
require_once(APPPATH.'models/Crypter.php');
require_once(APPPATH.'models/Displayer.php');
require_once(APPPATH.'models/Downloader.php');
require_once(APPPATH.'models/FileAudio.php');
require_once(APPPATH.'models/FileCode.php');
require_once(APPPATH.'models/FileImage.php');
require_once(APPPATH.'models/FileVideo.php');
require_once(APPPATH.'models/SystemTree.php');
require_once(APPPATH.'models/SystemFacade.php');
$Facade = new SystemFacade($this->session->userdata('id_project'));
?>
<div class="row">

    <div class="col-sm-12">

        <div id="file" class="adjust-panel panel panel-default">

            <div class="panel-heading">

                <h1 class="text-center">Fichier</h1>

            </div>

            <div class="panel-body">

                <section class="FileInterface">
                    <div class="interfaceButtons" id="<?php echo $this->session->userdata('id_project');?>">
                        
                        <ul class="fileButtons">
                            <li class="addDirectory" onclick="$('#modal-adddirectory').modal();"><img src="<?php echo base_url('/assets/img/folder_new.gif');?>" title="Create new folder"/></li>
                            <li class ="addFile" onclick="prepareUploadForm();"><img src="<?php echo base_url('/assets/img/page_new.gif');?>" title="Upload file"/></li>
                            <li class="moveTo" onclick="openMoveSelection();"><img src="<?php echo base_url('/assets/img/page_left.gif');?>" title="Move selection"/></li>
                            <li class="deleteContent" onclick="openDeleteSelection()"><img src="<?php echo base_url('/assets/img/page_cross.gif');?>" title="Delete Selection"/></li>
                            <li class="downloadProject" onclick="downloadProject()"><img src="<?php echo base_url('/assets/img/icon_download.gif');?>" title="Download project"/></li>
                        </ul>
                    </div>
                    <div class="FileContent col-md-12 ">
                        <?php echo $Facade->makeFileList(); ?>
                    </div>
                </section>

            </div>

        </div>

    </div>

</div>
<script type="text/javascript">
    /* 
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    var files;

    $(document).ready(function () {
        // gere l'upload des fichier dans la popup
        $("#uploadForm").submit(function () {

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "<?php echo base_url(); ?>" + 'index.php/uploadFile/upload',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (data, textStatus, jqXHR)
                {
                    if (typeof data.error === 'undefined')
                    {

                        $('#file').val('');
                        $('.FileContent').html(data);
                        $('#modal-upload').modal('hide');
                        

                    }
                    else
                    {
                        // Handle errors here
                        console.log('ERRORS: ' + data.error);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    // Handle errors here
                    console.log('ERRORS: ' + textStatus);
                    // STOP LOADING SPINNER
                }
            });
            return false;
        });

        //selection de fichiers pour la cible du fichier à déplacer
        $('#moveFileList').on('click', '.SystemDirectory', function () {
            if (!$(this).hasClass('selected'))
                $(this).addClass('selected');
        });

        $('#moveFileList').on('click', '.SystemDirectory.selected', function () {
            var id = $(this).attr('id');
            var idProj = $('.interfaceButtons').attr('id');
            if ($(this).hasClass('file')) {
                $('#currentMovedFileType').val('file');
            }
            else {
                $('#currentMovedFileType').val('SystemDirectory');
            }
            $.post(
                    "<?php echo base_url(); ?>" + 'index.php/getDirMoveFile/getmovingdirlist',
                    {id: id, idProj: idProj},
            function (data) {
                $('#moveFileList').html(data);
            }
            );
        });


        // On click de téléchargement des fichiers pour l'icone DL
        $('.FileContent').on('click', '.file .dlImage', function () {

            var id = $(this).parent().attr('id');
            var idProject = $('.interfaceButtons').attr('id');
            window.location.href = "<?php echo base_url(); ?>" + 'index.php/downloadFile/download?file=' + id + "&project=" + idProject + "&name=" + name;

        });
        // téléchargement des dossiers avec l'icone DL
        $('.FileContent').on('click', '.SystemDirectory .dlImage', function () {
            var id = $(this).parent().attr('id');
            var idProject = $('.interfaceButtons').attr('id');
            window.location.href = "<?php echo base_url(); ?>" + 'index.php/downloaDdir/download?file=' + id + "&project=" + idProject;
        });


        // affiche le contenu d'un dossier
        $('.FileContent').on('click', '.SystemDirectory', function () {
            if ($(this).hasClass('selected') || $(this).hasClass('return')) {
                var id = $(this).attr('id');
                var idProject = $('.interfaceButtons').attr('id');
                $.post(
                        "<?php echo base_url(); ?>" + 'index.php/getFiles/sendDirContent',
                        {id: id, project: idProject},
                function (data) {
                    $('.FileContent').html(data);
                }
                );
            }
        });
        //selectionne un element avec la class selected
        $('.FileContent').on('click', 'li', function () {
            $('.fileList li').each(function (index) {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
            });
            $(this).addClass('selected');
        });

        // AJAX displayer 
        $('.FileContent').on('click', '.file.selected', function () {
            var id = $(this).attr('id');
            var project = $('.interfaceButtons').attr('id');
            $.post(
                    "<?php echo base_url(); ?>" + 'index.php/fileDisplayer/display',
                    {id: id, project: project},
            function (data) {

                $("#myModal").find('.modal-body').html(data);
                $("#myModal").modal();
                //$('#popupDisplayer').html(); 
            }
            );
        });
    });
    // ouvre la fenetre popup delete selection et mets le nom du fichier courant
    function openDeleteSelection() {
        var selectedFile = $('.fileList li.selected .fileName').html();
        if (selectedFile) {
            $('#modal-deleteselection h5').html();
            $('#modal-deleteselection h5').html('Are you sure to delete ' + selectedFile + ' and its content?');
            $('#modal-deleteselection').modal();

        }
        else {
            alert('No file selected for deletion.');
        }
    }
    ;
    //upload : prépraration du formulaire
    function prepareUploadForm() {
        var parent = $('.currentFile').attr('id');
        var project = $('.interfaceButtons').attr('id');
        $('#popupUploadFile caption').html('Upload file to ' + $('.currentFile').html());
        $('#uploadCurrentFile').attr('value', parent);
        $('#uploadProject').attr('value', project);
        $('#modal-upload').modal();
    }

    // ouvre la fenetre avec la liste des fichier cibles pour déplacer un fichier.
    // charge les valeurs du fichier sélectionné dans les input hiddens du formulaire
    function openMoveSelection() {
        if ($('.selected').length > 0) {
            $('#currentMovedFile').val($('.selected').attr('id'));
            if ($('.selected').hasClass('file')) {
                $('#currentMovedFileType').val('file');
            }
            else {
                $('#currentMovedFileType').val('systemDirectory');
            }

            var id = $('.interfaceButtons').attr('id');
            $.post(
                    "<?php echo base_url(); ?>" + 'index.php/getDir/getdirlist',
                    {id: id},
            function (data) {
                $('#modal-movefile').find('#moveFileList').html(data);
                $('#modal-movefile').modal();
            }
            );
        }
        else {
            alert('Select a file to move first.');
        }
    }
    function sendMovingFile() {
        var id = $('#currentMovedFile').val();
        var direction = $('#moveFileList .selected').attr('id');
        var type = $('#currentMovedFileType').val();
        var idProject = $('.interfaceButtons').attr('id');
        $.post(
                "<?php echo base_url(); ?>" + 'index.php/saveMoveFile/savingMoveFile',
                {id: id, direction: direction, type: type},
        function (data) {
            alert(data);
            $('#modal-movefile').modal('hide')
            $.post(
                    "<?php echo base_url(); ?>" + 'index.php/getFiles/sendDirContent',
                    {id: direction, project: idProject},
            function (data) {
                $('.FileContent').html(data);
            }
            );
        }
        );
    }
    function downloadProject() {
        var idProject = $('.interfaceButtons').attr('id');
        window.location.href = "<?php echo base_url(); ?>" + 'index.php/downloadProject/download?idProject=' + idProject;
    }




    // gère la création de fichier.
    // est appellée lorsque le bouton de l'interface est clické
    function CreateDirectory() {
        var parent = $('.currentFile').attr('id');
        var project = $('.interfaceButtons').attr('id');
        var name = $('#AddDirectoryName').val();
        var fileNames = $('.fileName');
        var nameFound = "";
        fileNames.each(function (index) {
            if (fileNames[index].innerHTML.toLowerCase() === name.toLowerCase()) {
                nameFound = name;
            }
        });
        if (nameFound === "") {
            if (name.match("^[a-zA-Z0-9_]*$")) {
                if (name.length >= 3) {

                    $.post(
                            "<?php echo base_url(); ?>" + 'index.php/addDirectory/create_directory',
                            {parent: parent, project: project, name: name},
                    function (data) {
                        $('#blackScreen').hide();
                        $('#modal-adddirectory').modal('hide');
                        $('.FileContent').html(data);
                    });

                }
                else {
                    alert('Name must be at least 3 character long');
                }
            }
            else {
                alert('Name contains illegal characters');
            }
        }
        else {
            alert('Directory "' + name + '"already exists.');
        }

    }
    // supprime un fichier/dossier
    // appellé par l'interface du file system
    function deleteSelection() {
        var selected = $('.fileList li.selected');
        var id = selected.attr('id');
        var classes = selected.attr('class');
        var type = classes.split(' ')[0];
        var project = $('.interfaceButtons').attr('id');
        $.post(
                "<?php echo base_url(); ?>" + 'index.php/deleteContent/delete_content',
                {id: id, type: type, project: project},
        function (data) {
            $('#modal-deleteselection').modal('hide');
            $('.FileContent').html(data);
        }
        );
    }
</script>