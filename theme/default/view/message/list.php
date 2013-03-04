<div class="span9">
            <h1 class="page-title">Messages </h1>
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-plus"></i> New Message</button>
 
  <div class="btn-group">
  </div>
</div>
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th style="width: 25px;">#</th>
          <th style="width: 200px;">From</th>
          <th style="width: 500px;">Content</th>
          <th style="width: 200px;">Date</th>
          <th style="width: 125px;">Action</th>
        </tr>
      </thead>
      <tbody>
      <?=$this->message->list_message();?>
      </tbody>
    </table>
</div>
<div class="pagination">
    <ul>
        <li><a href="#">Prev</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">Next</a></li>
    </ul>
</div>
 <div class="clearfix"></div>   
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal small hide fade">
    <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
    </div>
    <div class="modal-footer">
        <button aria-hidden="true" data-dismiss="modal" class="btn">Cancel</button>
        <button data-dismiss="modal" class="btn btn-danger">Delete</button>
    </div>
 <div class="clearfix"></div>  
        </div>


 <div class="clearfix"></div>    
</div>

</div>