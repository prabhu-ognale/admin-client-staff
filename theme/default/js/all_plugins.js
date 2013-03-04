(function(h){var m=h.scrollTo=function(b,c,g){h(window).scrollTo(b,c,g)};m.defaults={axis:'y',duration:1};m.window=function(b){return h(window).scrollable()};h.fn.scrollable=function(){return this.map(function(){var b=this.parentWindow||this.defaultView,c=this.nodeName=='#document'?b.frameElement||b:this,g=c.contentDocument||(c.contentWindow||c).document,i=c.setInterval;return c.nodeName=='IFRAME'||i&&h.browser.safari?g.body:i?g.documentElement:this})};h.fn.scrollTo=function(r,j,a){if(typeof j=='object'){a=j;j=0}if(typeof a=='function')a={onAfter:a};a=h.extend({},m.defaults,a);j=j||a.speed||a.duration;a.queue=a.queue&&a.axis.length>1;if(a.queue)j/=2;a.offset=n(a.offset);a.over=n(a.over);return this.scrollable().each(function(){var k=this,o=h(k),d=r,l,e={},p=o.is('html,body');switch(typeof d){case'number':case'string':if(/^([+-]=)?\d+(px)?$/.test(d)){d=n(d);break}d=h(d,this);case'object':if(d.is||d.style)l=(d=h(d)).offset()}h.each(a.axis.split(''),function(b,c){var g=c=='x'?'Left':'Top',i=g.toLowerCase(),f='scroll'+g,s=k[f],t=c=='x'?'Width':'Height',v=t.toLowerCase();if(l){e[f]=l[i]+(p?0:s-o.offset()[i]);if(a.margin){e[f]-=parseInt(d.css('margin'+g))||0;e[f]-=parseInt(d.css('border'+g+'Width'))||0}e[f]+=a.offset[i]||0;if(a.over[i])e[f]+=d[v]()*a.over[i]}else e[f]=d[i];if(/^\d+$/.test(e[f]))e[f]=e[f]<=0?0:Math.min(e[f],u(t));if(!b&&a.queue){if(s!=e[f])q(a.onAfterFirst);delete e[f]}});q(a.onAfter);function q(b){o.animate(e,j,a.easing,b&&function(){b.call(this,r,a)})};function u(b){var c='scroll'+b,g=k.ownerDocument;return p?Math.max(g.documentElement[c],g.body[c]):k[c]}}).end()};function n(b){return typeof b=='object'?b:{top:b,left:b}}})(jQuery);

(function($) {	
	$.alerts = {
		
		// These properties can be read/written by accessing $.alerts.propertyName from your scripts at any time
		
		verticalOffset: -75,                // vertical offset of the dialog from center screen, in pixels
		horizontalOffset: 0,                // horizontal offset of the dialog from center screen, in pixels/
		repositionOnResize: true,           // re-centers the dialog on window resize
		overlayOpacity: 0.04,                // transparency level of overlay
		overlayColor: '#000',               // base color of overlay
		draggable: true,                    // make the dialogs draggable (requires UI Draggables plugin)
		yesButton: '&nbsp;Yes&nbsp;',         // text for the OK button
		okButton: '&nbsp;OK&nbsp;',  
		cancelButton: '&nbsp;Cancel&nbsp;', // text for the Cancel button
		dialogClass: null,                  // if specified, this class will be applied to all dialogs
		
		// Public methods
		
		alert: function(message, title, callback) {
			if( title == null ) title = 'Alert';
			$.alerts._show(title, message, null, 'alert', function(result) {
				if( callback ) callback(result);
			});
		},
		
		confirm: function(message, title, callback) {
			if( title == null ) title = 'Confirm';
			$.alerts._show(title, message, null, 'confirm', function(result) {
				if( callback ) callback(result);
			});
		},
			
		prompt: function(message, value, title, callback) {
			if( title == null ) title = 'Prompt';
			$.alerts._show(title, message, value, 'prompt', function(result) {
				if( callback ) callback(result);
			});
		},
		
		// Private methods
		
		_show: function(title, msg, value, type, callback) {
			
			$.alerts._hide();
			$.alerts._overlay('show');
			
			$("BODY").append(
			  '<div id="popup_container">' +
			    '<h1 id="popup_title"></h1>' +
			    '<div id="popup_content">' +
			      '<div id="popup_message"></div>' +
				'</div>' +
			  '</div>');
			
			if( $.alerts.dialogClass ) $("#popup_container").addClass($.alerts.dialogClass);
			
			// IE6 Fix
			//var pos = ($.browser.msie && parseInt($.browser.version) <= 6 ) ? 'absolute' : 'fixed'; 
			var pos = (navigator.userAgent.match(/msie/i) && navigator.userAgent.match(/6/)) ? 'absolute' : 'fixed'; 
			
			$("#popup_container").css({
				position: pos,
				zIndex: 99999,
				padding: 0,
				margin: 0
			});
			
			$("#popup_title").text(title);
			$("#popup_content").addClass(type);
			$("#popup_message").text(msg);
			$("#popup_message").html( $("#popup_message").text().replace(/\n/g, '<br />') );
			
			$("#popup_container").css({
				minWidth: $("#popup_container").outerWidth(),
				maxWidth: $("#popup_container").outerWidth()
			});
			
			$.alerts._reposition();
			$.alerts._maintainPosition(true);
			
			switch( type ) {
				case 'alert':
					$("#popup_message").after('<div id="popup_panel"><input type="button" value="' + $.alerts.okButton + '" id="popup_ok" class="btn_button"/></div>');
					$("#popup_ok").click( function() {
						$.alerts._hide();
						callback(true);
					});
					$("#popup_ok").focus().keypress( function(e) {
						if( e.keyCode == 13 || e.keyCode == 27 ) $("#popup_ok").trigger('click');
					});
				break;
				case 'confirm':
					$("#popup_message").after('<div id="popup_panel"><input type="button" value="' + $.alerts.yesButton + '" id="popup_ok" class="btn_button"/> <input type="button" value="' + $.alerts.cancelButton + '" id="popup_cancel"  class="btn_button"/></div>');
					$("#popup_ok").click( function() {
						$.alerts._hide();
						if( callback ) callback(true);
					});
					$("#popup_cancel").click( function() {
						$.alerts._hide();
						if( callback ) callback(false);
					});
					$("#popup_ok").focus();
					$("#popup_ok, #popup_cancel").keypress( function(e) {
						if( e.keyCode == 13 ) $("#popup_ok").trigger('click');
						if( e.keyCode == 27 ) $("#popup_cancel").trigger('click');
					});
				break;
				case 'prompt':
					$("#popup_message").append('<br /><input type="text" size="30" id="popup_prompt" />').after('<div id="popup_panel"><input type="button" value="' + $.alerts.okButton + '" id="popup_ok" class="btn_button"/> <input type="button" value="' + $.alerts.cancelButton + '" id="popup_cancel" class="btn_button"/></div>');
					$("#popup_prompt").width( $("#popup_message").width() );
					$("#popup_ok").click( function() {
						var val = $("#popup_prompt").val();
						$.alerts._hide();
						if( callback ) callback( val );
					});
					$("#popup_cancel").click( function() {
						$.alerts._hide();
						if( callback ) callback( null );
					});
					$("#popup_prompt, #popup_ok, #popup_cancel").keypress( function(e) {
						if( e.keyCode == 13 ) $("#popup_ok").trigger('click');
						if( e.keyCode == 27 ) $("#popup_cancel").trigger('click');
					});
					if( value ) $("#popup_prompt").val(value);
					$("#popup_prompt").focus().select();
				break;
			}
			
			// Make draggable
			if( $.alerts.draggable ) {
				try {
					$("#popup_container").draggable({ handle: $("#popup_title") });
					$("#popup_title").css({ cursor: 'move' });
				} catch(e) { /* requires jQuery UI draggables */ }
			}
		},
		
		_hide: function() {
			$("#popup_container").remove();
			$.alerts._overlay('hide');
			$.alerts._maintainPosition(false);
		},
		
		_overlay: function(status) {
			switch( status ) {
				case 'show':
					$.alerts._overlay('hide');
					$("BODY").append('<div id="popup_overlay"></div>');
					$("#popup_overlay").css({
						position: 'absolute',
						zIndex: 99998,
						top: '0px',
						left: '0px',
						width: '100%',
						height: $(document).height(),
						background: $.alerts.overlayColor,
						opacity: $.alerts.overlayOpacity
					});
				break;
				case 'hide':
					$("#popup_overlay").remove();
				break;
			}
		},
		
		_reposition: function() {
			var top = (($(window).height() / 2) - ($("#popup_container").outerHeight() / 2)) + $.alerts.verticalOffset;
			var left = (($(window).width() / 2) - ($("#popup_container").outerWidth() / 2)) + $.alerts.horizontalOffset;
			if( top < 0 ) top = 0;
			if( left < 0 ) left = 0;
			
			// IE6 fix
			//if( $.browser.msie && parseInt($.browser.version) <= 6 ) top = top + $(window).scrollTop();
			if( navigator.userAgent.match(/msie/i) && navigator.userAgent.match(/6/) ) top = top + $(window).scrollTop();
			$("#popup_container").css({
				top: top + 'px',
				left: left + 'px'
			});
			$("#popup_overlay").height( $(document).height() );
		},
		
		_maintainPosition: function(status) {
			if( $.alerts.repositionOnResize ) {
				switch(status) {
					case true:
						$(window).bind('resize', $.alerts._reposition);
					break;
					case false:
						$(window).unbind('resize', $.alerts._reposition);
					break;
				}
			}
		}
		
	}
	
	// Shortuct functions
	jAlert = function(message, title, callback) {
		$.alerts.alert(message, title, callback);
	}
	
	jConfirm = function(message, title, callback) {
		$.alerts.confirm(message, title, callback);
	};
		
	jPrompt = function(message, value, title, callback) {
		$.alerts.prompt(message, value, title, callback);
	};
	
})(jQuery);

(function($)
{
	$.fn.extend(
	{
		forceDecimal: function()
		{
			return this.each(function()
			{
				if (!/^[0-9.]+$/.test($(this).val())) 
				{
					$(this).val($(this).val().replace(/[^0-9.]/g,''));
				}
			});
		},
		forceNumber: function()
		{
			return this.each(function()
			{
				if (!/^[0-9]+$/.test($(this).val())) 
				{
					$(this).val($(this).val().replace(/[^0-9]/g,''));
				}
			});
		},
		forceAlpha: function()
		{
			return this.each(function()
			{
				if (!/^[a-zA-Z\s]+$/.test($(this).val())) 
				{
					$(this).val($(this).val().replace(/[^a-zA-Z\s]/g,''));
				}
			});
		},
		forceNoSpecial: function()
		{
			return this.each(function()
			{
				if (!/^[a-zA-Z\s0-9_\-\.]+$/.test($(this).val())) 
				{
					$(this).val($(this).val().replace(/[^a-zA-Z\s0-9_\-\.]/g,''));
				}
			});
		},
		
		errorMsg: function(options)
		{
			var defaults = {msg: 'Error-Msg', classsName: 'error', timeout: 3000}
			var options = $.extend(defaults, options);
			return this.each(function(){
				var o = options;
				$(this).html('<span class="'+o.className+'">'+o.msg+'</span>')
				       .slideDown('slow').prependTo('body'); 
					   $('div#note').delay(o.timeout).slideUp(1000,function(){
						   $(this).remove();
						});
			});
		}
	});
})(jQuery);

(function($){
$.unserialise = function(Data){
    var Data = Data.split("&");
    var Serialised = new Array();
    $.each(Data, function(){
        var Properties = this.split("=");
        Serialised[Properties[0]] = Properties[1];
    	});
        return Serialised;
    };
})(jQuery);


var postUrl   = baseUrl+'/a.php';
var imgPath   = baseUrl+'/images';
var themePath = baseUrl+'/theme/default';
var rand = Math.random();
var loading = $('<img />').attr({src:imgPath + '/ajax-loader.gif',id:'loading',alt:'Loading...'});
$(document).ready(function()
{
	
	/*ajax-logout*/
	$('a#logout').bind('click',ajax_logout);	

	
});

function ajax_logout()
{
	if(this.timer)clearTimeout();
	this.timer = setTimeout(function()
	{
		$.ajax(
		{
			url:postUrl + '?page=user&action=login&fn=logout&rand='+rand,
			dataType:'json',
			success: function(j)
			{
				if(j.ok==true)
				{
					window.location.replace(j.location);
				}
			}
		});
	},40);
}


function check_username()
{
	$('input#adm-username').removeClass('border_red');
	name = $.trim($('input#adm-username').val());
	if(this.timer) clearTimeout();
	$('input#adm-username').next().html(loading);
	this.timer = setTimeout(function(){
		$.ajax({
			url:postUrl + '?page=admin&action=addnew&fn=check_username&name='+name+'&rand='+rand,
			dataType:'json',
			success: function(j)
			{
				if(j.ok==true)
				{
					$('<div id="note"></div>').html('<span class="success">'+j.msg+'</span>').slideDown('slow').prependTo('body'); 
					$('div#note').delay(3000).slideUp(1000,function(){$(this).remove()});
					$('input#adm-username').removeClass('border_red');					
				}
				else
				{
					$('<div id="note"></div>').html('<span class="error">'+j.msg+'</span>').slideDown('slow').prependTo('body'); 
					$('div#note').delay(3000).slideUp(1000,function(){$(this).remove()});
					$('input#adm-username').addClass('border_red');
				}
				$('input#adm-username').next().html($('<img/>').attr({src:j.img, alt:j.code}));
			}
		});
	},40);
}

function check_password()
{
	$('input#adm-pwd').removeClass('border_red');
	name = $.trim($('input#adm-pwd').val());
	if(this.timer) clearTimeout();
	$('input#adm-pwd').next().html(loading);
	this.timer = setTimeout(function(){
		$.ajax({
			url:postUrl + '?page=admin&action=addnew&fn=check_password&pwd='+name+'&rand='+rand,
			dataType:'json',
			success: function(j)
			{
				if(j.ok==true)
				{
					$('<div id="note"></div>').html('<span class="success">'+j.msg+'</span>').slideDown('slow').prependTo('body'); 
					$('div#note').delay(3000).slideUp(1000,function(){$(this).remove()});
					$('input#adm-pwd').removeClass('border_red');					
				}
				else
				{
					$('<div id="note"></div>').html('<span class="error">'+j.msg+'</span>').slideDown('slow').prependTo('body'); 
					$('div#note').delay(3000).slideUp(1000,function(){$(this).remove()});
					$('input#adm-pwd').addClass('border_red');
				}
				$('input#adm-pwd').next().html($('<img/>').attr({src:j.img, alt:j.code}));
			}
		});
	},40);
}

function check_name()
{
	$('input#adm-name').removeClass('border_red');
	name = $.trim($('input#adm-name').val());
	if(this.timer) clearTimeout();
	$('input#adm-name').next().html(loading);
	this.timer = setTimeout(function(){
		$.ajax({
			url:postUrl + '?page=admin&action=addnew&fn=check_name&name='+name+'&rand='+rand,
			dataType:'json',
			success: function(j)
			{
				if(j.ok==true)
				{
					$('<div id="note"></div>').html('<span class="success">'+j.msg+'</span>').slideDown('slow').prependTo('body'); 
					$('div#note').delay(3000).slideUp(1000,function(){$(this).remove()});
					$('input#adm-name').removeClass('border_red');					
				}
				else
				{
					$('<div id="note"></div>').html('<span class="error">'+j.msg+'</span>').slideDown('slow').prependTo('body'); 
					$('div#note').delay(3000).slideUp(1000,function(){$(this).remove()});
					$('input#adm-name').addClass('border_red');
				}
				$('input#adm-name').next().html($('<img/>').attr({src:j.img, alt:j.code}));
			}
		});
	},40);
}

function check_email()
{
	$('input#adm-email').removeClass('border_red');
	name = $.trim($('input#adm-email').val());
	if(this.timer) clearTimeout();
	$('input#adm-email').next().html(loading);
	this.timer = setTimeout(function(){
		$.ajax({
			url:postUrl + '?page=admin&action=addnew&fn=check_email&email='+name+'&rand='+rand,
			dataType:'json',
			success: function(j)
			{
				if(j.ok==true)
				{
					$('<div id="note"></div>').html('<span class="success">'+j.msg+'</span>').slideDown('slow').prependTo('body'); 
					$('div#note').delay(3000).slideUp(1000,function(){$(this).remove()});
					$('input#adm-email').removeClass('border_red');					
				}
				else
				{
					$('<div id="note"></div>').html('<span class="error">'+j.msg+'</span>').slideDown('slow').prependTo('body'); 
					$('div#note').delay(3000).slideUp(1000,function(){$(this).remove()});
					$('input#adm-email').addClass('border_red');
				}
				$('input#adm-email').next().html($('<img/>').attr({src:j.img, alt:j.code}));
			}
		});
	},40);
}

function gen_code()
{
	if(this.timer) clearTimeout();
	this.timer = setTimeout(
		function(){
			$.ajax({
				url:postUrl + '?page=admin&action=addnew&fn=gen_code&rand='+rand,
				dataType:'json',
				success: function(j)
				{
					if(j.ok==true)
					{
						$('input#auth-code').val(j.msg);
					}
					else
					{
						return false;
					}
				}
			});
		},40
	);
}

function form_tip(id,title)
{
	this.objWidth = parseInt($('#' + id).width());
	w = Math.round(this.objWidth * 75 / 100);
	this.xleft = getAbsoluteLeft(id) + w;
    this.xtop  = getAbsoluteTop(id)  - 42;
	$('body').append('<p id="vtip"><img id="vtipArrow" />' + title + '</p>' );
	$('p#vtip #vtipArrow').attr("src", imgPath + '/vtip_arrow.png');
	$('p#vtip').css("top", this.xtop+"px").css("left", this.xleft+"px").fadeIn("slow",function(){
		$(this).delay(3000).queue(function(){
			$(this).remove()
			});
		});
}

function getAbsoluteTop(objectId) 
{
	o = document.getElementById(objectId)
	oTop = o.offsetTop;
	while(o.offsetParent!=null) 
	{
		oParent = o.offsetParent 
		oTop += oParent.offsetTop;
		o = oParent;
	}
	return oTop;
}

function getAbsoluteLeft(objectId) 
{
	o = document.getElementById(objectId)
	oLeft = o.offsetLeft;            
	while(o.offsetParent!=null) {   
		oParent = o.offsetParent;    
		oLeft += oParent.offsetLeft;
		o = oParent;
	}
	return oLeft;
}

function clear_form_elements(ele) 
{
	$(ele).find(':input').each(function() 
	{
		switch(this.type) 
		{
			case 'password':
	        case 'select-multiple':
	        case 'select-one':
	        case 'text':
	        case 'textarea':
	        $(this).val('');
	        break;
	        case 'checkbox':
	        case 'radio':
	        this.checked = false;
	    }
	});
}
function get_parents(id,key)
{
	var parentEls = $(id).parents().map(function () 
	{ 
        return this.id; 
    }).get();
	return parentEls[key];
}

