// JavaScript Document

$(document).ready(function() {


	$('input#username').focus(function(){
		$(this).css('border', '1px dotted #A5ACB2');		
		form_tip('username','Username must be 5 characters lang Alpha Numeric dot');
	}).focusout(function(){$(this).removeAttr('style');$('p#vtip').remove();});	
	
	$('input#password').focus(function(){
		$(this).css('border', '1px dotted #A5ACB2');		
		form_tip('password','Password must be between 6 to 20 characters long');
	}).focusout(function(){$(this).removeAttr('style');$('p#vtip').remove();});	
	
	$('input#email').focus(function(){
		$(this).css('border', '1px dotted #A5ACB2');
		form_tip('email','Enter your new valid email address.');
	}).focusout(function(){$(this).removeAttr('style');$('p#vtip').remove();});
	
	$('input#firstname').focus(function(){
		$(this).css('border', '1px dotted #A5ACB2');		
		form_tip('firstname','First Name must be 5 characters lang Alpha Numeric dot');
	}).focusout(function(){$(this).removeAttr('style');$('p#vtip').remove();});	
	
	$('input#lastname').focus(function(){
		$(this).css('border', '1px dotted #A5ACB2');		
		form_tip('lastname','Last Name must be 5 characters lang Alpha Numeric dot');
	}).focusout(function(){$(this).removeAttr('style');$('p#vtip').remove();});	
	
	$('input#user_name').change(function(){		
		$('input#user_name').removeClass('border_red');
		name = $.trim($('input#user_name').val());
		if(this.timer) clearTimeout();
		$('input#username').next().html(loading);
		this.timer = setTimeout(function(){
			$.ajax({
				url:postUrl + '?page=user&action=signup&fn=check_username&name='+name+'&rand='+rand,
				/*dataType:'json',*/
				success: function(j)
				{
					if(j==true)
					{
						jAlert('User Name Already exits','Alert Box');	
					}
					else
					{
						jAlert('User Name Already not in use','Alert Box');	
					}
				}
			});
		},40);
		
	});
	
	//$('input#username').bind('change',check_username);
	
	/*$('input#username').live('keyup',function(){		
		$(this).forceNoSpecial();
	});
	*/
	
	/*------------------------LOGIN Form-------------*/
	$('form#user_login').bind('submit',function(){
	
		var t = $(this);
		var sval = $(this).serialize();
		var btn_sub = $('form#user_login input#btn_login');
		
		if($('input[name="username"]').val()=='')
		{
			jAlert('User Name is Empty','Alert Box',function(r){
				if(r==true) $('input[name="username"]').focus(); return false;
			});
			return false;
		}
		
		if($('input[name="password"]').val()=='')
		{
			jAlert('Password is Empty','Alert Box',function(r){
				if(r==true) $('input[name="password"]').focus(); return false;
			});
			return false;
		}
		
		btn_sub.next().css('padding-left','10px').html(loading);
		if(this.timer)clearTimeout();
		this.timer = setTimeout(function(){

			$.ajax({
				url:postUrl +'?page=user&action=login&fn=login&rand='+rand,
				data: sval,
				dataType: 'json',
				type: 'post',
				cache: false,
				success : function(j){
					if(j.ok == true)
					{
						jAlert(j.msg, 'Alert Box');
						window.location.replace(j.location);
					}
					else if(j.ok == false)
					{
						jAlert(j.msg, 'Alert Box');
						return false;
					}
					btn_sub.next().remove();
					return false;
				}
			});
		},60);
		
		
	});
	
	/*------------------------LOGIN Form  End-------------*/
	
	/*------------------------Forgetpassword Form-------------*/
	$('form#forgetpassword').bind('submit',function(){
	
		var t = $(this);
		var sval = $(this).serialize();
		var btn_sub = $('form#forgetpassword input#btn_send');
		
		if($('input[name="username"]').val()=='')
		{
			jAlert('User Name is Empty','Alert Box',function(r){
				if(r==true) $('input[name="username"]').focus(); return false;
			});
			return false;
		}
		
		if($('input[name="email"]').val()=='')
		{
			jAlert('Email is Empty','Alert Box',function(r){
				if(r==true) $('input[name="email"]').focus(); return false;
			});
			return false;
		}
		
		btn_sub.next().css('padding-left','10px').html(loading);
		if(this.timer)clearTimeout();
		this.timer = setTimeout(function(){

			$.ajax({
				url:postUrl +'?page=user&action=login&fn=forgetpassword&rand='+rand,
				data: sval,
				dataType: 'json',
				type: 'post',
				cache: false,
				success : function(j){
					if(j.ok == true)
					{
						jAlert(j.msg, 'Alert Box');
					}
					else if(j.ok == false)
					{
						jAlert(j.msg, 'Alert Box');
						return false;
					}
					btn_sub.next().remove();
					return false;
				}
			});
		},60);
		
		
	});
	
	/*------------------------Forgetpassword Form  End-------------*/
	/*------------------------Signup Form  Start-------------*/
	
	$('form#signup').bind('submit',function(){
	
		var t = $(this);
		var sval = $(this).serialize();
		var btn_sub = $('form#signup input#btn_signup');
		
		if($('input[name="username"]').val()=='')
		{
			jAlert('User Name is Empty','Alert Box',function(r){
				if(r==true) $('input[name="username"]').focus(); return false;
			});
			return false;
		}
		
		if($('input[name="password"]').val()=='')
		{
			jAlert('Password is Empty','Alert Box',function(r){
				if(r==true) $('input[name="password"]').focus(); return false;
			});
			return false;
		}
		
		if($('input[name="repassword"]').val()=='')
		{
			jAlert('ConfirmPassword is Empty','Alert Box',function(r){
				if(r==true) $('input[name="repassword"]').focus(); return false;
			});
			return false;
		}
		
		
		if($('input[name="email"]').val()=='')
		{
			jAlert('Email is Empty','Alert Box',function(r){
				if(r==true) $('input[name="email"]').focus(); return false;
			});
			return false;
		}
		
	
		btn_sub.next().css('padding-left','10px').html(loading);
		if(this.timer)clearTimeout();
		this.timer = setTimeout(function(){

			$.ajax({
				url:postUrl +'?page=user&action=signup&fn=add_user&rand='+rand,
				data: sval,
				dataType: 'json',
				type: 'post',
				cache: false,
				success : function(j){
					if(j.ok == true)
					{
						jAlert(j.msg, 'Alert Box');
						window.location.replace(j.location);
					}
					else if(j.ok == false)
					{
						jAlert(j.msg, 'Alert Box');
						return false;
					}
					btn_sub.next().remove();
					return false;
				}
			});
		},60);
		
	});

});

