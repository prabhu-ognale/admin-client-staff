// JavaScript Document

	$(document).ready(function(){
	
		
		
		$('form#add-project').bind('submit',function(){
		
			var t = $(this);
			var sval = $(this).serialize();
			var btn_sub = $('form#user_login input#btn_project');
			
				if($('input[name="project_name"]').val()=='')
				{
					jAlert('Project Name is Empty','Alert Box',function(r){
						if(r==true) $('input[name="project_name"]').focus(); return false;
					});
					return false;
				}
		
			if($('input[name="client_name"]').val()=='')
			{
				jAlert('Client Name is Empty','Alert Box',function(r){
					if(r==true) $('input[name="client_name"]').focus(); return false;
				});
				return false;
			}
			
			if($('input[name="domain_name"]').val()=='')
			{
				jAlert('Domain Name is Empty','Alert Box',function(r){
					if(r==true) $('input[name="domain_name"]').focus(); return false;
				});
				return false;
			}
			
			if($('textarea[name="description"]').val() == '')
			{
				jAlert('Project Description is Empty','Alert Box',function(r){
					if(r==true) $('textarea[name="description"]').focus(); return false;
				});
				return false;
			}
				
			btn_sub.next().css('padding-left','10px').html(loading);
			if(this.timer)clearTimeout();
			this.timer = setTimeout(function(){
	
				$.ajax({
					url:postUrl +'?page=project&action=add_edit_project&rand='+rand,
					data: sval,
					dataType: 'json',
					type: 'post',
					cache: false,
					success : function(j){
						if(j.ok == true)
						{
							jAlert(j.msg, 'Alert Box');
							//window.location.replace(j.location);
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