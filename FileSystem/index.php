<?php
    $_GRUNT_PATH=0;
    require_once 'GruntFileSystem.php';
    $idProject = 1;
    $currentFile = 1;
    
    $Facade = new SystemFacade($idProject);
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="fileSystem.css"/>
        <script src="js/jQuery/jQuery1.12.3min.js"></script>
    </head>
    <body>
        <div id="blackScreen"></div>
        <section class="FileInterface">
            <div class="interfaceButtons" id="<?php echo $idProject;?>">
                <ul class="fileButtons">
                    <li class="addDirectory" onclick="$('#popupAddDirectory').show();$('#blackScreen').show();"><img src="img/folder_new.gif" title="Create new folder"/></li>
                    <li class ="addFile" onclick="prepareUploadForm();"><img src="img/page_new.gif" title="Upload file"/></li>
                    <li class="moveTo" onclick="openMoveSelection();"><img src="img/page_left.gif" title="Move selection"/></li>
                    <li class="deleteContent" onclick="openDeleteSelection()"><img src="img/page_cross.gif" title="Delete Selection"/></li>
                    <li class="downloadProject" onclick="downloadProject()"><img src="img/icon_download.gif" title="Download project"/></li>
                </ul>
            </div>
            <div class="FileContent">
                <?php echo $Facade->makeFileList(); ?>
            </div>
        </section>
        <?php require_once 'HTMLpopup/popup_addDirectory.html';?>
        <?php require_once 'HTMLpopup/popup_deleteSelection.html';?>
        <?php require_once 'HTMLpopup/popup_uploadFile.html';?>
        <?php require_once 'HTMLpopup/popup_moveFile.html';?>
        <?php require_once 'HTMLpopup/popup_displayFile.html';?>
        
        <script src="js/jQueryFileUpload/js/vendor/jquery.ui.widget.js"></script>
        <script src="js/jQueryFileUpload/js/jquery.iframe-transport.js"></script>
        <script src="js/jQueryFileUpload/js/jquery.fileupload.js"></script>
        <script>
            $( document ).ready(function() {
                
                //selection de fichiers pour le déplacer
                $('#moveFileList').on('click','.SystemDirectory',function(){
                    if(!$(this).hasClass('selected'))
                        $(this).addClass('selected');
                });
                
                $('#moveFileList').on('click','.SystemDirectory.selected',function(){
                    var id = $(this).attr('id');
                    var idProj=$('.interfaceButtons').attr('id');
                    if($(this).hasClass('file')){
                        $('#currentMovedFileType').val('file');
                    }
                    else{
                        $('#currentMovedFileType').val('SystemDirectory');
                    }
                    $.post(
                        'PHPscripts/AJAX_loadFileContentMove.php',
                        { id:id,idProj:idProj },
                        function(data){
                            $('#moveFileList').html(data);
                        }
                    );
                });
                //permet de fermer les popup en cliquant sur le black screen
                $('#blackScreen').click(function(){
                    $('.popup').hide();
                    $(this).hide(); 
                });
                
                // On click de téléchargement des fichiers pour l'icone DL
                $('.FileContent').on('click','.file .dlImage',function(){
                     
                    var id=$(this).parent().attr('id');         
                    var idProject=$('.interfaceButtons').attr('id');
                    window.location.href="PHPscripts/GET_download.php?file="+id+"&project="+idProject+"&name="+name;
                     
                });
                // téléchargement des dossiers avec l'icone DL
                $('.FileContent').on('click','.SystemDirectory .dlImage',function(){
                    var id=$(this).parent().attr('id');         
                    var idProject=$('.interfaceButtons').attr('id');
                    window.location.href="PHPscripts/getFileDownload.php?file="+id+"&project="+idProject;
                });
                
                
                // affiche le contenu d'un dossier
                $('.FileContent').on('click', '.SystemDirectory', function (){
                    if($(this).hasClass('selected') || $(this).hasClass('return')){
                        var id = $(this).attr('id');
                        var idProject=$('.interfaceButtons').attr('id');
                        $.post(
                            'PHPscripts/AJAX_getFiles.php',
                            {id:id,project:idProject},
                            function(data){
                                $('.FileContent').html(data); 
                            }   
                        );
                    }
                });
                //selectionne un element avec la class selected
                $('.FileContent').on('click', 'li', function (){
                    $('.fileList li').each(function(index){
                        if($(this).hasClass('selected')){
                            $(this).removeClass('selected');
                        }
                    });
                    $(this).addClass('selected');
                });
                
                // AJAX displayer 
                $('.FileContent').on('click','.file.selected',function(){
                    var id = $(this).attr('id');
                    var project=$('.interfaceButtons').attr('id');
                    $.post(
                        'PHPscripts/AJAX_displayFile.php',
                        {id:id,project:project},
                        function(data){
                            $('#blackScreen').show();
                            $('#popupDisplayer').show();
                            $('#popupDisplayer').html(data); 
                        }   
                    );
                });
            });
            // ouvre la fenetre popup delete selection et mets le nom du fichier courant
                function openDeleteSelection(){
                    var selectedFile=$('.fileList li.selected').html();
                    if(selectedFile){
                        $('#popupDeleteSelection caption').html('Are you sure to delete ' + selectedFile +' and its content?');
                        $('#blackScreen').show();
                        $('#popupDeleteSelection').show();
                    }
                    else{
                        alert('No file selected for deletion.');
                    }
                };
                //upload
                function prepareUploadForm(){
                    var parent = $('.currentFile').attr('id');
                    var project = $('.interfaceButtons').attr('id');
                    $('#popupUploadFile caption').html('Upload file to '+$('.currentFile').html());
                    $('#uploadCurrentFile').attr('value',parent);
                    $('#uploadProject').attr('value',project);
                    $('#blackScreen').show();
                    $('#popupUploadFile').show();
                }
                
                function openMoveSelection(){
                    if($('.selected').length > 0){
                        $('#currentMovedFile').val($('.selected').attr('id'));
                        if($('.selected').hasClass('file')){
                            $('#currentMovedFileType').val('file');
                        }
                        else{
                            $('#currentMovedFileType').val('systemDirectory');
                        }
                        
                        var id = $('.interfaceButtons').attr('id');
                        $.post(
                            'PHPscripts/AJAX_loadFileList.php',
                            {id:id},
                            function(data){
                                $('#moveFileList').html(data);
                                $('#blackScreen').show();
                                $('#popupMoveFile').show();
                            }     
                        );
                    }
                }
                function sendMovingFile(){
                    var id=$('#currentMovedFile').val();
                    var direction=$('#moveFileList .selected').attr('id');
                    var type=$('#currentMovedFileType').val();
                    var idProject=$('.interfaceButtons').attr('id');
                    $.post(
                        'PHPscripts/AJAX_saveMovedFile.php',
                        {id:id,direction:direction,type:type},
                        function(data){
                             alert(data);
                             $('#blackScreen').hide();
                             $('#popupMoveFile').hide();
                             $.post(
                                'PHPscripts/AJAX_getFiles.php',
                                {id:direction,project:idProject},
                                function(data){
                                    $('.FileContent').html(data); 
                                }   
                            );
                        }
                    );
                }
                function downloadProject(){
                    var idProject=$('.interfaceButtons').attr('id');
                    window.location.href="PHPscripts/GET_downloadProject.php?idProject="+idProject;
                }
        </script>
    </body>
</html>