
<div id="modal-upload" class="modal" role="dialog">
  <div class="modal-admin col-md-4 col-md-offset-4">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Choose your file</h4>
      </div>
      <center><div class="modal-body">
            <form id="uploadForm" enctype="multipart/form-data">

                
                <input type="file" name="file[]" id="file" multiple/>
                <p class="help-block">Allowed files extension: jpg,mpeg,jpeg,gif,png,php,txt,html,js,css,sql,mp4,mp3,ogg,wav</p>

        <input type="hidden" id="uploadCurrentFile" name="parent" value=""/>
        <input type="hidden" id="uploadProject" name="project" value=""/>
    
          </center>
          <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Send</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
          </form>
        </div></center>
      
      </div>
      
    </div>

  </div>


