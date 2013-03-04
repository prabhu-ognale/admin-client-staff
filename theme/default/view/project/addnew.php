 <div class="span9">
  <div class="stats">
    <p class="stat"><span class="number">53</span>tickets</p>
    <p class="stat"><span class="number">27</span>tasks</p>
    <p class="stat"><span class="number">15</span>waiting</p>
</div>
<h1 class="page-title">Dashboard</h1>     
 <div class="row-fluid">
    <div class="block">
            <div class="block-heading">Create New Project</div>
            <div class="block-body">
               <form id='add-project' action="javascript:void(0);" method="post">
                    <label>Project Name</label>
                    <input type="text" class="span8" id="project_name" name="project_name">
                    
                    <label>Client Name</label>
                    <input type="text" class="span8" id="client_name" name="client_name">
                    
                    <label>Project Details</label>
                    <textarea class="span8" id="description" name="description" style="height:150px;"> </textarea>
                    
                    <label>Domain Name </label>
                    <input type="text" class="span8" id="domain_name" name="domain_name">
                    
                    <label>Domain Details</label>
                    <textarea class="span8" id="domain_details" name="domain_details" style="height:150px;"> </textarea>
                    
                    <div class="clearfix"></div>
                    <input type="submit" class="btn btn-primary pull-right" id="btn_project" name="submit" value="Add New!" style="float:left"/>
            
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
       
    </div>
</div>
  <div class="clearfix"></div>
</div>