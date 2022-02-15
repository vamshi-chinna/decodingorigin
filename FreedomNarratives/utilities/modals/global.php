
<!-- Publish Confirmation Message-->
<div class="modal fade" id="publish_confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" style="color: #ff6b6b !important;" id="publish_confirm"> <i class="fas fa-signal"></i></i> Do you really want to publish this folder? </h3>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Please make sure that all data in this folder is up-to-date. By clicking on "Publish" below,
          this folder and data within will be available for search and view on the public website. <br>
          You will be able to unpublish this folder at any time in future by clicking "Unpublish" under folder menu options.
        </p>
       </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-success" href="utilities/commands_external/person_online.php?ID=<?php echo $personID;?>&value=1">Publish</a>

      </div>
    </div>
  </div>
</div>

<!-- UNPublish Confirmation Message-->
<div class="modal fade" id="unpublish_confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" style="color: #ff6b6b !important;" id="publish_confirm"> <i class="fas fa-signal"></i></i> Do you really want to unpublish this folder? </h3>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>By clicking on "unpublish" below,
          this folder and data within will be no longer be available for search and view on the public website. <br>
          You will be able to publish this folder at any time in future by clicking "Publish" under folder menu options.
        </p>
       </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-success" href="utilities/commands_external/person_online.php?ID=<?php echo $personID;?>&value=0">Unpublish</a>

      </div>
    </div>
  </div>
</div>

<!-- UNPublish Confirmation Message for FN ONLY-->
<div class="modal fade" id="summary_generator_FN" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" style="color: #ff6b6b !important;" id="summary_generator"> <i class="far fa-edit"></i> Generate Summary </h3>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
          You will be able to use this to generate automated summaries!<br>
          This feature is currently inactive until the project directors finalize the format for summaries.
        </p>
       </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <button class="btn btn-success" type="button" data-dismiss="modal" disabled>Generate Summary</button>
        <!--<a  class="btn btn-success" href="utilities/commands_external/person_online.php?ID=<?php //echo $personID;?>&value=0">Generate Summary</a>-->

      </div>
    </div>
  </div>
</div>
