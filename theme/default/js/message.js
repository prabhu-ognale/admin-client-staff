// JavaScript Document
	
	$(document).ready(function() {
        
			$('form#send-message').bind('submit',function(){
				
				var t = $(this);
				var sval = $(this).serialize();
				var btn_sub = $('form#send-message input#btn_message');
				
				if($('input[name="reciver_name"]').val()=='')
				{
					jAlert('Name is Empty','Alert Box',function(r){
						if(r==true) $('input[name="reciver_name"]').focus(); return false;
					});
					return false;
				}
				
				btn_sub.next().css('padding-left','10px').html(loading);
				if(this.timer)clearTimeout();
				this.timer = setTimeout(function(){
		
					$.ajax({
						url:postUrl +'?page=message&action=send&rand='+rand,
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