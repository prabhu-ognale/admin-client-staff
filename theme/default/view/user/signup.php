 <?php $data = $this->user_reg->user_form(0);?>
 <div class="span9">
  <div class="stats">
    <p class="stat"><span class="number">53</span>tickets</p>
    <p class="stat"><span class="number">27</span>tasks</p>
    <p class="stat"><span class="number">15</span>waiting</p>
</div>
<h1 class="page-title">Dashboard</h1>     
 <div class="row-fluid">
    <div class="block">
            <div class="block-heading">Create New User</div>
            <div class="block-body">
                <form name="signup" action="javascript:void(0);" id="signup" method="post">
                    <label>First Name</label>
                    <input type="text" class="span6" name="firstname" id="firstname" value="<?=$dta['firstname'];?>">
                    <label>Last Name</label>
                    <input type="text" class="span6" name="lastname" id="lastname" value="<?=$data['lastname'];?>">
                    <label>Email Address</label>
                    <input type="text" class="span6" name="email" id="email" value="<?=$data['email'];?>">
                    <label>Username</label>
                    <input type="text" class="span6" name="user_name" id="user_name" value="<?=$data['username'];?>">
                    <label>Password</label>
                    <input type="password" class="span6" name="password" id="password" value="">
                    <label>User Type</label>
                    <?=$this->user_reg->get_type_list(0);?>
                    <label>Retype Password</label>
                    <input type="password" class="span6" name="repassword" id="repassword" value="">
                    <input type="hidden" name="user_id" id="user_id" value="<?=$data['id'];?>" /> 
					<br />
                    <input type="submit" class="btn btn-primary pull-right" id="btn_signup" name="submit" value="Sign Up!"/>
                    <!--<a href="index.html" class="btn btn-primary pull-right">Sign Up!</a>-->
                    <label class="remember-me"><input type="checkbox"> I agree with the <a href="terms-and-conditions.html">Terms and Conditions</a></label>
                  
                </form>
            </div>
        </div>
       
    </div>
</div>
  <div class="clearfix"></div>
</div>