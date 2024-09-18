    function approveKyc(id){
        if(id){
            $.ajax({
    			url: base + 'inc/ajax.php?mode=kyc',
    			type: 'post',
    			data: {id: id, ajax: true},
    			success: function(response){ 
    				resetSearchPaging('kyc');
    			}
    		});
        }
        
        return false;
    }
    
    function markPaid(id){
        if(id){
            $.ajax({
    			url: base + 'inc/ajax.php?mode=paid_withdraw',
    			type: 'post',
    			data: {id: id, ajax: true},
    			success: function(response){ 
    				resetSearchPaging('wrequests');
    			}
    		});
        }
        
        return false;
    }
    
	function initsettingsEditor()
	{
		$('input[type="checkbox"]#vendor_reward').bind('change', function(){
			$('#vendor_reward_price').parents('div.form-group:eq(0)').addClass('hide');
			$('#vendor_reward_redeem_minprice').parents('div.form-group:eq(0)').addClass('hide');
			if($(this).is(':checked'))
			{
				$('#vendor_reward_price').parents('div.form-group:eq(0)').removeClass('hide');
				$('#vendor_reward_redeem_minprice').parents('div.form-group:eq(0)').removeClass('hide');
			}
				
		}).trigger('change');
	}
	
	function bpopup(url, id, fullpage){
		if(!fullpage)
			fullpage = false;
			
		$.ajax({
			url: url,
			type: 'post',
			data: {id: id, ajax: true},
			success: function(response){ 
				$('#Modal1 .modal-content').html(response);
				$('#Modal1').modal('show'); 
			}
		});
	}
	
	function callInputMask(){
		$(function(e) {
		    "use strict";
		    $(".date-inputmask").inputmask("dd/mm/yyyy"), 
		    $(".time-inputmask").inputmask("hh:mm"),
		    $(".phone-inputmask").inputmask("(999) 999-9999"), 
		    $(".international-inputmask").inputmask("+9(999)999-9999"), 
		    $(".xphone-inputmask").inputmask("(999) 999-9999 / x999999"), 
		    $(".purchase-inputmask").inputmask("aaaa 9999-****"), 
		    $(".cc-inputmask").inputmask("9999 9999 9999 9999"), 
		    $(".ssn-inputmask").inputmask("999-99-9999"), 
		    $(".isbn-inputmask").inputmask("999-99-999-9999-9"), 
		    $(".currency-inputmask").inputmask("$9999"), 
		    $(".percentage-inputmask").inputmask("99%"), 
		    $(".decimal-inputmask").inputmask({
		        alias: "decimal"
		        , radixPoint: "."
		    }), 
		    $(".email-inputmask").inputmask({
		    mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[*{2,6}][*{1,2}].*{1,}[.*{2,6}][.*{1,2}]"
		    , greedy: !1
		    , onBeforePaste: function (n, a) {
		        return (e = e.toLowerCase()).replace("mailto:", "");
		    }
		    , definitions: {
		        "*": {
		            validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~/-]"
		            , cardinality: 1
		            , casing: "lower"
		        }
		    }
		    });
		});
	}
	
	var sessionRefreshInterval = null, unlockAttempts = 0, idleTime = 0, refreshIn = 10;

	function pageLoaded()
	{
		var href = window.location.href.toString();
		$('#menu a').each(function() {
			if(href.indexOf($(this).attr('href')) != -1)
			{
				$('#menu a').removeClass('active');
				$(this).addClass('active');
				if($(this).parents('ul').parents('li').length)
					$(this).parents('ul').parents('li').children('a:eq(0)').addClass('active');
			}
		});

		if(typeof(Shadowbox) != 'undefined')
			Shadowbox.init();

		if(userid)
		{
			if(!$('#lockscreen:visible').length)
			sessionRefreshInterval = setInterval("refreshSession();", 60000 * refreshIn);

			setInterval("idleTimeIncrement()", 60000); // 1 minute

			$(document).mousemove(function (e) {
				idleTime = 0;
			});
			$(document).keypress(function (e) {
				idleTime = 0;
			});
		}
	}

	function idleTimeIncrement()
	{
		idleTime = idleTime + 1;
	}

	function refreshSession()
	{
		if(userid)
			$.ajax({
				'type': 'post',
				'url': base + 'inc/ajax.php?mode=session',
				'success': function(response) {
					// if(!$('#lockscreen:visible').length && idleTime >= (refreshIn/2))
						// showLockScreen();
				}
			});
	}

	function showLockScreen(opacity)
	{
		if(!userid)
			return;

		$('#screen').unbind('click').click(function() { return false; }).css({
			'width': $(document).width(),
			'height': $(document).height()
		}).show().fadeTo('fast', (opacity?1:0.7));

		$('body').append('<div id="lockscreen"><h2>You have been locked out!!</h2><div class="info">because you were inactive for more than ' + refreshIn + ' minutes</div><br /><form onsubmit="javascript: return unlockScreen();"><table><tr><td class="label">Password:</td><td><input type="password" id="lockpass" /></td><td><input type="submit" class="icons save" value="Unlock" /></td></tr></table></form><div class="fail"></div></div>');

		$('#lockscreen').css({
			'top': $(window).scrollTop() + parseInt(($(window).height() - $('#lockscreen').outerHeight()) / 2.0),
			'left': parseInt(($(window).width() - $('#lockscreen').outerWidth()) / 2.0)
		}).show();

		$('#lockpass').focus();
	}

	function unlockScreen()
	{
		if(!$('#lockpass').val())
		{
			$('#lockscreen .fail').html('Please tell us your password.').show();
		}
		else
		{
			$.ajax({
				'type': 'post',
				'url': base + 'inc/ajax.php?mode=unlock&pass=' + $('#lockpass').val(),
				'success': function(response) {
					var status = response.toString();
					if(status == 'unlock')
					{
						$('#lockscreen').remove();
						$('#screen').hide();
						clearInterval(sessionRefreshInterval);
						sessionRefreshInterval = setInterval("refreshSession();", 60000 * refreshIn);
					}
					else
					{
						unlockAttempts++;
						$('#lockscreen .fail').html('Wrong password!<br />You have ' + (3 - unlockAttempts) + ' attempts left!').show();
						if(unlockAttempts >= 3)
							redirect(base + 'logout?referer=' + escape(window.location.href));
					}
				}
			});
		}

		return false;
	}

	function myEditor(selector, width, height)
	{
		if(!selector || !$(selector).length)
			return;

		if(!width)
			width = "730";
		if(!height)
			height = "300";
			
		$(selector).cleditor();
		return;
		if(width.indexOf('%') != -1 || parseInt(width) < 720)
		{
			var theme_advanced_buttons1 = "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect";
			var theme_advanced_buttons2 = "bullist,numlist,|,outdent,indent,|,link,|,forecolor,backcolor,|,inlinesourceeditor,jbimages";
		}
		else
		{
			var theme_advanced_buttons1 = "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect,|,bullist,numlist,|,outdent,indent,|,link,|,forecolor,backcolor,|,inlinesourceeditor,jbimages";
			var theme_advanced_buttons2 = "";
		}
	/*
		function loadEditor()
		{
			// http://www.tinymce.com/wiki.php/Configuration
			// http://www.tinymce.com/tryit/imagemanager/upload_files.php

			$(selector).tinymce({
				script_url : base_scripts + 'jquery/tiny_mce/tiny_mce.js',
				// content_css : base + 'styles/post.css',
				theme: 'advanced',
				relative_urls: false,
				plugins : "style,table,advhr,advimage,advlink,iespell,media,contextmenu,paste,noneditable,visualchars,nonbreaking,xhtmlxtras,jbimages,inlinesourceeditor",
				theme_advanced_buttons1: theme_advanced_buttons1,
				theme_advanced_buttons2: theme_advanced_buttons2,
				theme_advanced_blockformats: "p,div,h1,h2,h3,h4,blockquote",
				invalid_elements: "span",
				extended_valid_elements: "span[!class]",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,
				width: width,
				height: height,
				theme_advanced_resizing_min_width: width,
				theme_advanced_resizing_min_height: height,
				theme_advanced_resizing_max_width: width
			});

			resizeEditor(true);
		}

		if(typeof($.fn.tinymce) == 'undefined')
			$.getScript(base_scripts + 'jquery/tiny_mce/jquery.tinymce.js', loadEditor);
		else
			loadEditor();
	*/
	}

	function resizeEditor(delay)
	{
		if(delay)
			setTimeout("_resizeEditor();", 1000);
		else
			_resizeEditor();
	}

	function _resizeEditor()
	{
		try {
			if(typeof($.fn.tinymce) != 'undefined' && typeof(tinyMCE) && tinyMCE.editors.length)
			{
				var editor = $('#' + tinyMCE.editors[0].id + '_ifr');
				if(editor)
				{
					var newHeight = editor.height() + ($('#leftmenu').height() - $('#rightside').height() - 10);
					editor.height(newHeight);
					editor.next('textarea').height(newHeight - 1);
				}
			}
		} catch(e) {}
	}
