<div class="span9">
            <h1 class="page-title">Users</h1>
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-plus icon-white"></i> New User</button>
  <div class="btn-group">
  </div>
</div>
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th style="width:10%">#</th>
          <th style="width:30%">User Name</th>
          <th style="width:30%">E mail</th>
          <th style="width:20%">Type</th>
          <th style="width:10%;"></th>
        </tr>
      </thead>
      <tbody>
      <?=$this->user_reg->list_user(); ?>
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

<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-danger" data-dismiss="modal">Delete</button>
    </div>
</div>
 <div class="clearfix"></div>  
        </div>


 <div class="clearfix"></div>    
</div>