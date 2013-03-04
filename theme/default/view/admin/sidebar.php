 <div class="container-fluid">
        
        <div class="row-fluid">
            <div class="span3">
                <div class="sidebar-nav">
                  
				  <div class="nav-header" data-toggle="collapse" data-target="#dashboard-menu"><i class="icon-dashboard"></i>Dashboard</div>
                    <ul id="dashboard-menu" class="nav nav-list collapse in">
                        <li><a href="<?=SITE_URL.'/admin/home/index.php';?>">Home</a></li>
						<li><a href="<?=SITE_URL.'/admin/profile/view.php';?>">Profile</a></li>
                    </ul>
					
                <div class="nav-header" data-toggle="collapse" data-target="#user-menu"><i class="icon-briefcase"></i>User Management <span class="label label-info">+10</span></div>
                <ul id="user-menu" class="nav nav-list collapse in">
                  <li ><a href="<?=SITE_URL.'/admin/user/addnew.php';?>">Create New User</a></li>
				  <li ><a href="<?=SITE_URL.'/admin/user/list.php';?>">User List</a></li>
                  <li ><a href="<?=SITE_URL.'/admin/message/list.php';?>">List Message</a></li>
                  <li ><a href="<?=SITE_URL.'/admin/message/send.php';?>">Send Message</a></li>
                </ul>

                <div class="nav-header" data-toggle="collapse" data-target="#client-menu"><i class="icon-exclamation-sign"></i>Client Managent</div>
                <ul id="client-menu" class="nav nav-list collapse in">
                   <li ><a href="<?=SITE_URL.'/admin/client/addnew.php';?>">Create Client</a></li>
				   <li ><a href="<?=SITE_URL.'/admin/client/list.php';?>">List Client</a></li>
                </ul>
				
				<div class="nav-header" data-toggle="collapse" data-target="#project-menu"><i class="icon-exclamation-sign"></i>Project Management</div>
                <ul id="project-menu" class="nav nav-list collapse in">
                  <li ><a href="<?=SITE_URL.'/admin/project/addnew.php';?>">Create New Project</a></li>
                  <li ><a href="<?=SITE_URL.'/admin/project/list.php';?>">List Project</a></li>
                </ul>

                <div class="nav-header" data-toggle="collapse" data-target="#legal-menu"><i class="icon-legal"></i>Legal</div>
                <ul id="legal-menu" class="nav nav-list collapse in">
                  <li ><a href="privacy-policy.html">Privacy Policy</a></li>
                  <li ><a href="terms-and-conditions.html">Terms and Conditions</a></li>
                </ul>
            </div>
        </div>