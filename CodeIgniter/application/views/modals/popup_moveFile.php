

<div id="modal-movefile" class="modal" role="dialog">
  <div class="modal-admin col-md-4 col-md-offset-4">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select target file</h4>
      </div>
      <center><div class="modal-body">
            <div id="moveFileList">
        
            </div>
          </center>
            <input type="hidden" value="" id="currentMovedFile"/>
            <input type="hidden" value="" id="currentMovedFileType"/>
          <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="sendMovingFile()">Valider</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
        </div></center>
      
      </div>
      
    </div>

  </div>
</div>