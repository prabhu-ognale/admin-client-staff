  <div class="container-fluid">
        
        <div class="row-fluid">
    <div class="dialog span4">
        <div class="block">
            <div class="block-heading">Sign In</div>
            <div class="block-body">
                <form id="user_login" action="javascript:void(0);" method="post">
                    <label>Username</label>
                    <input type="text" class="span12" name="username" id="username">
                    <label>Password</label>
                    <input type="password" class="span12" name="password" id="password">
					<input type="submit" class="btn btn-primary pull-right" value="Sign In" id="btn_login"/>
                    
                    <label class="remember-me"><input type="checkbox"> Remember me</label>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
        <p class="pull-right" style=""><a href="<?php echo SITE_URL.'/user/admin/signup'?>" target="blank">Sign Up</a></p>
        
        <p><a href="reset-password.html">Forgot your password?</a></p>
    </div>
</div>


    
