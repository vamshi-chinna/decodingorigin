<a style="display: none !important;" id="Messgae"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message"></a>

<script>
$(document).ready(function(e){
$("#Messgae").click();
});
</script>

<!-- Success Message-->
<div class="modal fade" id="Message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="max-width: 500px !important; margin: 1.75rem auto !important;">
      <div class="modal-header">
        <h3 class="modal-title" style="color: red !important;" id="MessageModalLabel"> <i class="fas fa-exclamation-circle"></i></i>&nbsp;&nbsp; Duplicate Term</h3>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        It seems you are trying to enter a term that already exists on our system! 
        Please contact Project Directors for approval if the status of your term is still "Pending". <br>
        Contact Admin if you still have questions or concerns.




       </div>
      <div class="modal-footer">
        <a href="chat.php"><button class="btn btn-success" type="button">Group Chat</button></a>
        <button class="btn btn-primary" type="button" data-dismiss="modal">Ok</button>

      </div>
    </div>
  </div>
</div>
