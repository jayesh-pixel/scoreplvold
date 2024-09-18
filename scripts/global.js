	var debug = 0;

	function $e(id)
	{
		if(id)
			return document.getElementById(id);
		else
			return null;
	}

	function $v(id)
	{
		if(id && document.getElementById(id))
		{
//			if(document.getElementById(id).tagName.toLowerCase() == 'textarea' && !document.getElementById(id).value)
//				return document.getElementById(id).innerHTML;
//			else
				return document.getElementById(id).value;
		}
		else
			return null;
	}

	function getradiovalue(radioname)
	{
		if(!document.getElementsByName(radioname))
			return;
		var ids = document.getElementsByName(radioname);
		for(i=0;i<ids.length;i++)
			if(ids[i].checked)
				return ids[i].value;
		return 0;
	}

	function setradiovalue(radioname, value)
	{
		if(!document.getElementsByName(radioname))
			return;
		var ids = document.getElementsByName(radioname);
		for(i=0;i<ids.length;i++)
			if(ids[i].value == value || (i == 0 && !value))
				ids[i].checked = true;
			else
				ids[i].checked = null;
	}

	function selectValue(id, value)
	{
		if(!$e(id))
			return;

		var select = $e(id).getElementsByTagName('option');
		for(i=0;i<select.length;i++)
		{
			if(select[i].value == value)
			{
				select[i].setAttribute('selected', 'selected');
			}
			else
				select[i].removeAttribute('selected');
		}
	}

	function trim(str, chars) {
		if(str)
			return ltrim(rtrim(str, chars), chars);
	}

	function ltrim(str, chars) {
		chars = chars || "\\s";
		if(str)
			return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
	}

	function rtrim(str, chars) {
		chars = chars || "\\s";
		if(str)
			return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
	}

	function tExecuteScripts(obj)
	{
		if(typeof DHTMLSuite != 'undefined')
			obj = DHTMLSuite.getEl(obj);
		else
			obj = $e(obj);

		var scriptTags = obj.getElementsByTagName('script');
		var string = '';
		var jsCode = '';
		for(var no=0;no<scriptTags.length;no++){
			if(scriptTags[no].src){
		        var head = document.getElementsByTagName("head")[0];
		        var scriptObj = document.createElement("script");

		        scriptObj.setAttribute("type", "text/javascript");
		        scriptObj.setAttribute("src", scriptTags[no].src);
			}else{
				if(typeof DHTMLSuite != 'undefined' && DHTMLSuite.clientInfoObj && DHTMLSuite.clientInfoObj.isOpera){
					jsCode = jsCode + scriptTags[no].text + '\n';
				}
				else
					jsCode = jsCode + scriptTags[no].innerHTML;
			}
		}
		if(jsCode)
		{
			try{
			    if (!jsCode)
			        return;
		        if (window.execScript){
		        	window.execScript(jsCode)
		        }else if(window.jQuery && jQuery.browser.safari){ // safari detection in jQuery
		            window.setTimeout(jsCode, 0);
		        }else{
		            window.setTimeout(jsCode, 0);
		        }
			}catch(e){

			}
		}
	}

	function isEmail(add){
		if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,5})+$/.test(trim(add)))
			return true;
		else
			return false;
	}
	function isValidEmail(str){
		if(!((str.indexOf('.') > 2) && (str.indexOf('@') > 0 && str.length > 4)))
		{
			failField(''+ str +'');
		}
 	}
	function show(id)
	{
		if($e(id))
			$e(id).style.display = '';
	}
	function hide(id)
	{
		if($e(id))
			$e(id).style.display = 'none';
	}

	function hasClass(ele,cls)
	{
		if(ele && cls && ele.className)
			return ele.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
		else
			return false;
	}

	function addClass(ele,cls)
	{
		if(ele)
		{
			if(!ele.className)
				ele.className = cls;
			if (!hasClass(ele,cls)) ele.className += " " + cls;
		}
	}

	function removeClass(ele,cls)
	{
		if(ele)
		{
			var reg;
			if (hasClass(ele,cls))
			{
				reg = new RegExp('(\\s|^)'+cls+'(\\s|$)');
				ele.className=ele.className.replace(reg,' ');
			}
		}
	}

	function passField(id)
	{
		if($e(id))
			removeClass($e(id),'error');
		if($e(id + '_err'))
		{
			removeClass($e(id + '_err'),'error');
			if(hasClass($e(id + '_err'),'hide_disabled'))
			{
				removeClass($e(id + '_err'),'hide_disabled');
				addClass($e(id + '_err'),'hide');
			}
		}
		if(hasClass($e(id), 'rounded'))
		{
			removeClass($e(id).parentNode, 'error');
			removeClass($e(id).parentNode.parentNode, 'error');
		}
	}

	function failField(id)
	{
		if($e(id))
			addClass($e(id),'error');
		if($e(id + '_err'))
		{
			addClass($e(id + '_err'),'error');
			if(hasClass($e(id + '_err'),'hide'))
			{
				removeClass($e(id + '_err'),'hide');
				addClass($e(id + '_err'),'hide_disabled');
			}
		}
		if(hasClass($e(id), 'rounded'))
		{
			addClass($e(id).parentNode, 'error');
			addClass($e(id).parentNode.parentNode, 'error');
		}
	}

	function validateObject(fields)
	{
		var incomplete = false;
		for(var i=0;i<fields.length;i++)
		{
			if($e(fields[i]))
			{
				if(!$v(fields[i]) || trim($v(fields[i])) == '' || trim($v(fields[i])) == trim($e(fields[i]).getAttribute('title')))
				{
					failField(fields[i]);
					// if(incomplete == false)
						// $e(fields[i]).focus();
					incomplete = true;
				}
				else
					passField(fields[i]);
			}
		}
		return !incomplete;
	}

	function validateTextArea(fields)
	{
		var incomplete = false;
		for(var i=0;i<fields.length;i++)
		{
			if($e(fields[i]) && typeof('$') != 'undefined')
			{
				if(!$('#' + fields[i]).val() || trim($('#' + fields[i]).val()) == '')
				{
					failField(fields[i]);
					// if(incomplete == false)
						// $e(fields[i]).focus();
					incomplete = true;
				}
				else
					passField(fields[i]);
			}
		}
		return !incomplete;
	}

	function validateTitle(fields)
	{
		var incomplete = false;
		for(var i=0;i<fields.length;i++)
		{
			if($e(fields[i]))
			{
				if($v(fields[i]) == $e(fields[i]).getAttribute('title'))
				{
					failField(fields[i]);
					// if(incomplete == false)
						// $e(fields[i]).focus();
					incomplete = true;
				}
				else
					passField(fields[i]);
			}
		}
		return !incomplete;
	}

	function regIsNumber(fData)
	{
	    var reg = new RegExp("^[-]?[0-9]+[\.]?[0-9]*$");
	    return reg.test(fData);
	}

	function validateNumeric(fields)
	{
		var incomplete = false;
		for(var i=0;i<fields.length;i++)
		{
			if($e(fields[i]))
			{
				var value = null;
				if($v(fields[i]) && !regIsNumber($v(fields[i])))
				{
					failField(fields[i]);
					// if(incomplete == false)
						// $e(fields[i]).focus();
					incomplete = true;
				}
				else
					passField(fields[i]);
			}
		}
		return !incomplete;
	}

	function validateEmail(id)
	{
		if(isEmail($v(id)))
			return true;
		else
		{
			failField(id);
			return false;
		}
	}

	function validateChecked(id)
	{
		if($e(id).checked)
		{
			passField(id);
			return true;
		}
		else
		{
			failField(id);
			return false;
		}
	}

	function validateRegEx(id, type)
	{
		var regex = '';
		switch(type)
		{
			case 'phone':
			case 'mobile':
//				regex = /^(\+\d)*\s*(\(\d{3}\)\s*)*\d{3}(-{0,1}|\s{0,1})\d{2}(-{0,1}|\s{0,1})\d{2}$/;
				regex = /^(\+)?\s*([\d\s\-\(\)])*$/;
				break;
			case 'url':
				regex = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\w\.)(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
				break;
			case 'domain':
				regex = /([ftp|http|https]:\/\/){0,1}(\w+:{0,1}\w*@)?(\w\.)(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
				break;
			default:
				break;
		}
		if(regex)
		{
			if($v(id).match(regex))
			{
				passField(id);
				return true;
			}
			else
			{
				failField(id);
				return false;
			}
		}
	}

	function validatePassword(p1, p2)
	{
		var pass = true;
		var p = $v(p1);
		if(!p || p.length < 6 || p.length > 16)
		{
			failField(p1);
			pass = false;
		}
		else
			passField(p1);

		if(p2)
		{
			if(!$v(p2) || $v(p2) != p)
			{
				if(p2.indexOf('2') == -1)
					failField(p1);
				else
					failField(p2);
				pass = false;
			}
			else
			{
				if(p2.indexOf('2') == -1)
					passField(p1);
				else
					passField(p2);
			}
		}
		return pass;
	}
	function validateEqual(id1, id2)
	{
		if($e(id1) && $e(id2))
		{
			passField(id1);
			passField(id2);
			if($v(id1) != $v(id2))
			{
				failField(id2);
				return false;
			}
			else
			{
				if(!$v(id1))
				{
					failField(id1);
					return false;
				}
				else
					return true;
			}
		}
		else
			return false;
	}
	function validatePair(id, id2)
	{
		if( (!$v(id)) != (!$v(id2)) )
		{
			if(!$v(id))
				failField(id);
			else
				failField(id2);
			return false;
		}
		else
		{
			passField(id);
			passField(id2);
			return true;
		}
	}
	function validateLength(id, min, max)
	{
		var len = $v(id).length;
		if((!max || len <= max) && len >= min)
		{
			passField(id);
			return true;
		}
		else
		{
			failField(id);
			return false;
		}
	}
	function isSingleWord(add){
		if(/^\w+$/.test(add))
			return true;
		else
			return false;
	}

	function enableCtrl(id,enable)
	{
		if(enable)
		{
			$e(id).disabled = false;
			$e(id).focus();
		}
		else
			$e(id).disabled = true;
	}

	function toggleCheckBoxes(node,name)
	{
		var value = null;
		if(node.checked)
			value = true;
		var list = document.getElementsByName(name);
		for(var i=0;i<list.length;i++)
			if(!list[i].disabled)
				list[i].checked = value;
	}

	function salt(firstChar)
	{
		return firstChar + 'salt=' + new Date().getTime();
	}

	function na()
	{
		if(typeof(translations) != 'undefined')
			alert(translations['Not Implemented Yet']);
		else
			alert('Not Implemented Yet');
		return false;
	}

	function hasClass(ele,cls)
	{
		return ele.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
	}

	function addClass(ele,cls)
	{
		if (!hasClass(ele,cls)) ele.className += " " + cls;
	}

	function removeClass(ele,cls)
	{
		var reg;
		if (hasClass(ele,cls))
		{
			reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
			ele.className=ele.className.replace(reg,' ');
		}
	}

	function attachTAlimits()
	{
		var list = document.getElementsByTagName('textarea');
		for(var i=0;i<list.length;i++)
		{
			if(list[i].getAttribute('maxlength'))
			{
				list[i].onblur = validateTA;
				list[i].onkeypress = validateTA;
			}
		}
	}

	function validateTA()
	{
		var max = parseInt(this.getAttribute('maxlength'));
		if(max)
		{
			var cur = this.value.length;
			if(cur > max)
			{
				this.value = this.value.substr(0, max);
				if($e(this.id + '_chars'))
				{
					cur = this.value.length;
					$e(this.id + '_chars').innerHTML = (max - cur) + ' chracters left.';
				}
			}
		}
	}

	function validateFile(id, extn)
	{
		passField(id);
		if($e(id + '_ext'))
			passField(id + '_ext');
		if($v(id))
		{
			var pos = $v(id).lastIndexOf('.');
			var ext = $v(id).substring(pos + 1);
			ext = ext.toLowerCase();
			for(var i=0;i<extn.length;i++)
				if(extn[i] == ext)
					return true;
		}
		failField(id);
		if($e(id + '_ext'))
			failField(id + '_ext');
		return false;
	}

	function redirect(url)
	{
		window.location = url;
	}

	function setLabelField(id)
	{
		var node;
		if(this && $(this) && $(this).attr('id'))
			node = $e($(this).attr('id'));
		else
			node = $e(id);

		if(node)
		{
			// onfocus="javascript:labelField(this, 0);" onblur="labelField(this, 1);"
			node.onfocus = function() { labelField(node, 0); };
			node.onblur = function() { labelField(node, 1); };
			labelField(node, 1);
		}
	}

	function labelField(node, state)
	{
		if(state)
		{
			if(node.value == '' || node.value == node.getAttribute('title'))
			{
				node.value = node.getAttribute('title');
				node.style.color = '#CCCCCC';
			}
			else
			{
				passField(node.id);
				node.style.color = '';
			}
		}
		else
		{
			node.value = '';
			node.style.color = '';
		}
	}

	function _goto(url)
	{
		window.location = url;
	}

	function forceReload()
	{
		var url = window.location.href;
		window.location = url + ((url.indexOf("?")!=-1)?"&":"?") + 'ts=' + new Date().getTime();
	}

   	function textBoxTitleON()
   	{
   		if(!$(this).val())
   		{
   			$(this).val($(this).attr('title'));
   			$(this).css('color', 'Gray');
   		}
   	}

   	function textBoxTitleOFF()
   	{
   		if($(this).val() == $(this).attr('title'))
   		{
   			$(this).val('');
   			$(this).css('color', '');
   		}
   	}

   	function textBoxTitles()
   	{
		$('input.AutoInput').each(function() {
			var tmp = $e($(this).attr('id'));
			if(tmp.getAttribute('title'))
			{
				if(tmp.value == '' || tmp.value == tmp.getAttribute('title'))
				{
					tmp.value = tmp.getAttribute('title');
					tmp.style.color = 'Gray';
				}
				$(tmp).focus(textBoxTitleOFF);
				$(tmp).blur(textBoxTitleON);
			}
		});
   	}

	function showWait()
	{
		var curscreen;
		var list = document.getElementsByClassName('DHTMLSuite_formCoverDiv');
		if(list.length)
		{
			if(!list[0].id)
				list[0].id = 'divwait';
			list[0].display = 'block';
		}
		else
		{
			var e1 = document.createElement('div');
			e1.id = 'divwait';
			e1.style.overflow = 'hidden';
			e1.style.zIndex = 1000;
			e1.style.position = 'absolute';
			e1.className = 'DHTMLSuite_formCoverDiv';

			document.body.appendChild(e1);

			var innerDiv = document.createElement('div');
			innerDiv.style.width='105%';
			innerDiv.style.height='105%';
			innerDiv.className = 'DHTMLSuite_formCoverDivInner';
			innerDiv.style.opacity = '0.2';
			innerDiv.style.filter = 'alpha(opacity=20)';
			e1.appendChild(innerDiv);

			var ajaxLoad = document.createElement('div');
			ajaxLoad.className = 'DHTMLSuite_formCoverDiv_ajaxLoader';
			e1.appendChild(ajaxLoad);
		}
		curscreen = 'divwait';
	}

	function tajax(url, params, callbackFunction, divid)
	{
		showWait();
		var anticache;
  		var page_request = false;
   		if (window.XMLHttpRequest)     // if Mozilla, Safari etc
			page_request = new XMLHttpRequest();
  		else if (window.ActiveXObject) // if IE
  		{
    		try
			{
				page_request = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e)
			{
				try
				{
					page_request = new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e){}
			}
		}
		else
			return false;

		page_request.onreadystatechange = function() {
	  		if (page_request.readyState == 4 && (page_request.status == 200 || window.location.href.indexOf("http") == -1))
				if(typeof hidescreen != 'undefined')
					hidescreen();
//			if (page_request.readyState == 4)
			{
				if(divid)
					if(page_request.responseText)
					{
						$e(divid).innerHTML = page_request.responseText;
						tExecuteScripts(divid);
						roundAll();
						updateThickBox();
					}

				if (callbackFunction)
					callbackFunction(page_request);
			}
		}

		anticache = (url.indexOf("?")!=-1) ? "&"+new Date().getTime() : "?"+new Date().getTime();

		page_request.open('POST', url+anticache, true);
		if(params)
			page_request.send(params);
		else
			page_request.send(null);
	}

	function deleteNode(id)
	{
		var tmp = $e(id);
		if(tmp)
			tmp.parentNode.removeChild(tmp);
	}

	function charLength(node)
	{
		if(!node)
			return;

		var max = parseInt(node.getAttribute('max'));
		if(!max)
			return;
		var cur = parseInt(("" + node.value).length);

		if (cur > max) {
			node.value = node.value.substring(0, max);
			cur = max;
		}

		if($e(node.id + '_length'))
			$e(node.id + '_length').innerHTML = (max - cur) + " characters left";

		if(!node.getAttribute('onkeyup'))
			node.setAttribute('onkeyup', 'javascript:charLength(this);');
	}
	function toggle(id)
	{
		if($e(id))
			$e(id).style.display = ($e(id).style.display == 'none'?'':'none');
	}

    // the div element used for debug output.  created in enableDebug.
    var debugDiv;

    // call this function from a script within the document for which to enable debug output
    function enableDebug(){
        document.write("<div id='debugContent' style='display:block; position:absolute; top:7px; right:7px; padding:10px; width:300px; background:#ccc; color:white; border:solid 1px black;'></div>");
        debugDiv = document.getElementById("debugContent");
        writeClearLink();
    }

    // writes the string passed to it to the page
    function writeDebug(message){
        if (debugDiv)
            debugDiv.innerHTML += message + "<br\/>";
    }

    // writes the value of some code expression.
    // eg: writeEval("document.location"); // writes "document.location = http://drewnoakes.com"
    function writeEval(code){
        writeDebug(code + " = " + eval(code));
    }

    // writes all of the properties of the object passed to it
    function writeDebugObject(object){
        for (property in object)
            writeDebug(property + " = " + object.property);
    }

    // clears the debug output.  called either manually or by the user clicking the 'clear' link in the debug div.
    function clearDebug(){
        if (debugDiv) {
            debugDiv.innerHTML = "";
            writeClearLink();
        }
    }

    // writes a link in the debug div that clears debug output
    function writeClearLink(){
        writeDebug("<a href='#' onclick='clearDebug(); return false;'>clear</a>");
    }

	function updateMsgBox(response)
	{
		if (response.responseText)
		{
			showMsgBox(response.responseText, 'success');
			tExecuteScripts('msgBox');
			//setTimeout("$e('msgBox').innerHTML = '';", 5000);
		}
	}

	function hidemsgBox()
	{
		$e('msgBox').innerHTML = '';
		hide('msgBox');
	}

	function showMsgBox(msg, type)
	{
  		if(msg)
		{
			$e('msgBox').innerHTML = msg;
			$e('msgBox').style.display = 'block';
			addClass($e('msgBox'), type + ' ' + type + '_msg');
		}
		setTimeout("hide('msgBox');", 5000);
	}

	// http://www.tonyamoyal.com/2009/06/23/text-inputs-with-rounded-corners-using-jquery-without-image/
	function roundInput(input_id, container_class, border_class)
	{
		var input = $('#'+input_id+'');
		var input_width = input.css("width"); //get the width of input
		var wrap_width = parseInt(input_width) + 10; //add 10 for padding
		wrapper = input.wrap("<div class='"+container_class+"'></div>").parent();
		wrapper.wrap("<div class='"+border_class+"' style='width: "+wrap_width+"px;'></div>"); //apply border
		wrapper.corner("round 8px").parent().css('padding', '1px').corner("round 9px"); //round box and border
	}

    function roundNow()
    {
    	if(!hasClass(this, 'rounded'))
    	{
			$(this).addClass('rounded');
			if($(this).hasClass('fl'))
				roundInput($(this).attr('id'),'rounded_container2','rounded_border');
			else
				roundInput($(this).attr('id'),'rounded_container','rounded_border');
    	}
    }

    function roundAll()
    {
		$(function()
		{
			$('input[type="text"], input[type="password"], select, textarea').each(roundNow);
		});
    }

    function updateThickBox()
    {
    	if(typeof(tb_init) != 'undefined')
	    	setTimeout("tb_init('a.thickbox, area.thickbox, input.thickbox');", 500);
    }

    function toggleSearch(type)
    {
    	if($('#divEdit_' + type + ':visible').length)
    		if(confirm('You can not search while the Add/Edit form is open. Would you like to close the Add/Edit Form?'))
    			toggleEdit(type, 0, true);
    		else
    			return;

//    	$('#divSearch_' + type).css('left', $('#anchorSearch_' + type).position().left + $('#anchorSearch_' + type).width() - $('#divSearch_' + type).width());
//    	$('#divSearch_' + type).css('top', $('#anchorSearch_' + type).position().top + $('#anchorSearch_' + type).height());
//    	$('#divSearch_' + type).toggle('slow');
    	$('#divSearch_' + type).slideToggle('slow');
    }


    function validateField()
    {
		var element = $(this).get(0);
 		var tval = element.getAttribute('validation');
		var status = validateElement(element, tval);
	}

    function validateCheckbox(fields){
		var incomplete = false;
		console.debug('in validateCheckbox');
		for(var i=0;i<fields.length;i++)
		{
			console.debug($('#frmEdit_vendors input[type="checkbox"][name*="' + fields[i] + '"]'));
			
			if($('#frmEdit_vendors input[type="checkbox"][name*="' + fields[i] + '"]') && typeof($('#frmEdit_vendors input[type="checkbox"][name*="' + fields[i] + '"]')) != 'undefined')
			{
				if($('#frmEdit_vendors input[type="checkbox"][name*="' + fields[i] + '"]:checked').length <=0)
				{
					console.debug('in if');
					console.debug($('#frmEdit_vendors input[type="checkbox"][name*="' + fields[i] + '"]'));
					$('#frmEdit_vendors input[type="checkbox"][name*="' + fields[i] + '"]').addClass('error');
					incomplete = true;
				}
				else
					$('#frmEdit_vendors input[type="checkbox"][name*="' + fields[i] + '"]').removeClass('error');
			}
		}
		return !incomplete;
	}
	
    function validateElement(element, tval)
    {
		var j, validations, type, id, value, status = true;

		type = element.type;
		id = element.id;
		name = element.name;
		value = element.value;

		if(debug > 3)
			alert("validating " + id);

		validations = tval.split(',');
		for(j=0; j<validations.length; j++)
		{
			if(validations[j] && (validations[j] == 'required' || value))
			{
				var valid = false;
				switch (validations[j])
				{
					case 'required':
						if(element.tagName.toLowerCase() == 'textarea')
							valid = validateTextArea(new Array(id));
						else if(type == 'checkbox')
							valid = validateCheckbox(new Array(name));
						else
							valid = validateObject(new Array(id));
						break;
					case 'title':
						if($e(id))
							$e(id).value = trim($e(id).value);
						valid = validateNameTitle(id);
						break;
					case 'email':
						if($e(id) && $v(id))
							$e(id).value = trim($e(id).value);
						valid = validateEmail(id);
						break;
					case 'checked':
						valid = validateChecked(id);
						break;
					case 'terms':
						if(!validateChecked(id))
							alert('Please read and tick terms and conditions.');
						break;
					case 'float':
					case 'int':
						valid = validateNumeric(new Array(id));
						break;
					case 'phone':
					case 'mobile':
						valid = validateRegEx(id, 'mobile');
						break;
					case 'url':
						valid = validateRegEx(id, 'url');
						break;
					case 'domain':
						valid = validateRegEx(id, 'domain');
						break;
					case 'password':
						if($e(id.replace('2', '')))
							valid = validatePassword(id, id.replace('2',''));
						else
							valid = validatePassword(id, ($e(id + '2')?id + '2':null));
						break;
					case 'alpha':
						valid = validateAlpha(new Array(id));
						break;
					case 'alphanum':
						valid = validateAlphaNumeric(new Array(id));
						break;
					case 'file':
						if(element.getAttribute('extn'))
							valid = validateFile(id, element.getAttribute('extn').split(','));
						break;
					default:
						valid = true;
						break;
				}
				status = status & valid;
			}
		}
		return status;
    }

    function validateForm(form)
    {
    	return true;
    	/*
    	(function() {
			'use strict';
			window.addEventListener('load', function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
			form.addEventListener('submit', function(event) {
			if (form.checkValidity() === false) {
			event.preventDefault();
			event.stopPropagation();
			}
			form.classList.add('was-validated');
			}, false);
			});
			}, false);
		})();
		return;
		*/
    	try {
			var i, element, valid, tval, status = true, elements = form.length, attach = true;
			if(hasClass(form, 'attached'))
				attach = false;
			for (i=0; i<elements; i++)
			{
				element = form.elements[i];

				if(element.name == 'bypass_validation' && element.value && element.value != 0)
					return true;

				tval = element.getAttribute('validation');
				if(!tval)
					continue;
				else
					$(element).blur(validateField);

				valid = validateElement(element, tval);
				if(status && !valid)
					element.focus();
				status = status & valid;

				if(debug > 3)
					alert("validation result for " + element.id + " is " + valid);
			}
			return (status?true:false);
    	} catch(e) { alert(e); console.debug(e); return false;}
	}

	function validateAlpha(fields)
	{
		var alpha = false;
		for(var i=0;i<fields.length;i++)
		{
			if($e(fields[i]))
			{
				if (!/^[a-zA-Z]+$/.test($v(fields[i])))
				{
					failField(fields[i]);
					// if(alpha == false)
						// $e(fields[i]).focus();
					alpha = true;
				}
				else
					passField(fields[i]);
			}
		  }
		return !alpha;
	}

	function validateNameTitle(id)
	{
		if(/^([a-zA-Z\ \'\.]+)$/.test($v(id)))
		{
			passField(id);
			return true;
		}
		else
		{
			failField(id, 'Speciale tekens niet toegestaan');
			return false;
		}
	}

	function validateAlphaNumeric(fields)
	{
		var alphanum = false;
		for (var i = 0; i < fields.length; i++)
		{
			if ($e(fields[i]))
			{
				if (!/^[a-zA-Z0-9]+$/.test($v(fields[i])))
				{
					failField(fields[i]);
					// if (alphanum == false)
						// $e(fields[i]).focus();
					alphanum = true;
				}
				else
				{
					passField(fields[i]);
				}
			}
		}
		return !alphanum;
	}

    function deleteRecord(type, url, id)
    {
    	if(confirm("Are you sure you wish to delete this entry?\n\nThis change can not be undone."))
    	{
    		if($('#divEdit_' + type + ':visible').length)
    			$('#divEdit_' + type + ':visible').html('<div class="loading"></div>');
			$.ajax({
				type: 'GET',
				url: (url?url:base + 'inc/delete.php?type=' + type + '&id=' + id),
				data: {ajax: 'true'},
				success: function(data) {
					data = data.toString();
					if(data)
					{
						var row = $e(type + id);
						if(row)
							row.parentNode.removeChild(row);

						if($('#divEdit_' + type + ':visible').length)
							toggleEdit(type, 0, true);

						// $('#msgBox').html(data.toString());
						pagingRecordDeleted(type);
//						pagingReload(type);
					}
				}
			});
		}
		return false;
    }

    function remove(id)
    {
    	if($e(id))
    		$e(id).parentNode.removeChild($e(id));
    }

    function enable(id)
    {
    	if($e(id))
    		$e(id).disabled = null;
    }

    function empty(id)
    {
    	if($e(id))
    		$e(id).innerHTML = '';
    }

    if(typeof(getCookie) == 'undefined')
	function getCookie(c_name)
	{
		if (document.cookie.length>0)
		{
			c_start = document.cookie.indexOf(c_name + "=");
			if (c_start!=-1)
			{
				c_start=c_start + c_name.length+1;
				c_end=document.cookie.indexOf(";",c_start);
				if (c_end==-1)
					c_end=document.cookie.length;
				return unescape(document.cookie.substring(c_start,c_end));
			}
		}
		return "";
	}

    if(typeof(setCookie) == 'undefined')
	function setCookie(c_name, value, expiredays)
	{
		var exdate = new Date();
		exdate.setDate(exdate.getDate() + expiredays);
		document.cookie = c_name + "=" + escape(value) + ((expiredays==null)?"":"; expires=" + exdate.toUTCString())+"; path=/";
	}

	function checkStartEndDates(dd, picker)
	{
		var bidenddate = $('.hasDatepicker:eq(0)').datepicker('getDate');
		var reviewbydate = $('.hasDatepicker:eq(1)').datepicker('getDate');
		if(reviewbydate && bidenddate && reviewbydate < bidenddate)
		{
			if(picker.id == 'bidenddate')
				$('.hasDatepicker:eq(0)').datepicker('setDate', null);
			else
				$('.hasDatepicker:eq(1)').datepicker('setDate', null);
		}
	}

	function number_format(number, decimals, dec_point, thousands_sep) {
	    // http://kevin.vanzonneveld.net
	    number = (number+'').replace(',', '').replace(' ', '');
	    var n = !isFinite(+number) ? 0 : +number,
	        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
	        s = '',
	        toFixedFix = function (n, prec) {
	            var k = Math.pow(10, prec);
	            return '' + Math.round(n * k) / k;
	        };
	    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
	    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	    if (s[0].length > 3) {
	        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	    }
	    if ((s[1] || '').length < prec) {
	        s[1] = s[1] || '';
	        s[1] += new Array(prec - s[1].length + 1).join('0');
	    }
	    return s.join(dec);
	}

	function inArray(needle, haystack) {
	    var length = haystack.length;
	    for(var i = 0; i < length; i++)
	        if(haystack[i] == needle)
	        	return true;
	    return false;
	}

	function parseAmount(amount)
	{
		amount = amount.toString().trim().replace(/,/g, '').replace('$ ', '');
		if(amount.indexOf('(') != -1)
			amount = -1 * parseFloat(amount.replace('(', '').replace(')', ''));
		return amount;
	}

	var summaryLimit, summary;
	function renderSummaryRow()
	{
		if($('#tblObjects tr').length > 1 && $('#tblObjects tr:eq(1) td:eq(0)').html().indexOf('found') == -1)
		{
			var amount;
			var totals = [], summaryColumns = [], columns = $('#tblObjects tr:eq(0) th');
			for(i in summary)
			{
				for(j=0;j<columns.length;j++)
					if($(columns[j]).attr('index') == i)
					{
						totals[summaryColumns.length] = 0;
						summaryColumns[summaryColumns.length] = j;
					}
			}
			
			$('#tblObjects tr:gt(0)').each(function() {
				for(i=0;i<summaryColumns.length;i++)
				{
					amount = $(this).children('td:eq(' + summaryColumns[i] + ')');
					if(!amount)
						continue;

					amount = parseAmount(amount.html());

					if(amount && isNaN(parseFloat(amount)))
					{
						amount = trim(amount);
						if(typeof(totals[i]) == 'number')
							totals[i] = {};
						if(typeof(totals[i][amount]) == 'undefined')
							totals[i][amount] = 0;
						totals[i][amount]++;
						continue;
					}
					amount = parseFloat(amount);
					if(amount)
						totals[i] += amount;
				}
			});

			var k, html, row = $('#tblObjects').find('tr:last').clone().attr('class', 'summary').attr('id', '').attr('valign', 'middle');
			row.children('td').html('');
			for(i=0;i<summaryColumns.length;i++)
			{
				if(typeof(totals[i]) == 'object')
				{
					html = '';
					k = 0;
					for(j in totals[i])
					{
						html += j + ": " + totals[i][j] + "<br />";
						k++;
					}
					if(k <= summaryLimit)
						row.children('td:eq(' + summaryColumns[i] + ')').html(html);
				}
				else
				{
					html = $('#tblObjects').find('tr:last').children('td:eq(' + summaryColumns[i] + ')').html().toString();
					if(html.indexOf('$') != -1)
					{
						html = parseFloat(totals[i]);
						if(html >= 0)
							html = number_format(html, 2);
						else
							html = "(" + number_format(Math.abs(html), 2) + ")";
						row.children('td:eq(' + summaryColumns[i] + ')').html(currency + ' ' + html);
					}
					else
						row.children('td:eq(' + summaryColumns[i] + ')').html(totals[i]);
				}
			}
			$('#tblObjects').find('tr:last').parent().append(row);

			amount = summary = summaryColumns = columns = totals = html = row = null;
		}
	}

	function loadEditForm(type, id, close, url)
	{
		$('#divEdit_' + type).html('<div class="loading_big"></div>').load(url, {
			mode: 'edit',
			ajax: true,
			id: parseInt(id)
		}, function() {
			$('#frmEdit_' + type).ajaxForm({
				type: 'post',
				beforeSerialize: function($form, options) {
					try {
						if(!validateForm($e('frmEdit_' + type)))
							return false;
					} catch(e) {alert(e);}
				},
				beforeSubmit: function(arr, $form, options) {
					$('#frmEdit_' + type).hide();
					$('#divEdit_' + type).prepend('Submitting...');
				},
    	    	success: function(data) {
    	    		$('#divEdit_' + type).html(data).hide();
			    	if(hideListingWhileEditing)
			    		$('#items_' + type + ', div.admin').show();
				},
    	    	error: function(e) {
    	    		$('#msgBox').html('<div class="fail">There was a problem updating this record.</div>').show();
    	    		$('#divEdit_' + type).html(data).hide();
			    	if(hideListingWhileEditing)
			    		$('#items_' + type + ', div.admin').show();
	    	    }
    		});
		});
	}

	var hideListingWhileEditing = true;
	var objects_meta = {};
	var win_w = 0, win_h = 0;
	function toggleEdit(type, id, close, url)
	{
		if(typeof(objects_meta[type]) != 'undefined' && objects_meta[type].fullpage == 'popup')
			hideListingWhileEditing = false;
		else
			hideListingWhileEditing = true;

		if(!$('#divEdit_' + type).length)
			if(hideListingWhileEditing)
				$('#divSearch_' + type + ', #items_' + type + '').eq(0).before('<div id="divEdit_' + type + '" class="hide popup_div"></div>');
			else
				$('#divEdit').append('<div id="divEdit_' + type + '" class="hide popup_div"></div>');

		if(close)
		{
	    	$('#divEdit, #screen, #divEdit_' + type).hide();
	    	if(hideListingWhileEditing)
	    		$('#items_' + type + ', div.admin').show();
	    }
	    else
		{
	    	$('#divSearch_' + type).hide();
	    	if(hideListingWhileEditing)
	    		$('#divSearch_' + type + ', #items_' + type + ', div.admin').hide();
	    	else
	    	{
	    		$('#divEdit, #screen').show();
	    		$('#divEdit').css('left', parseInt((win_w - $('#divEdit').width()) / 2) + 'px');
	    	}

	    	if(!url)
		    	url = base + 'manager/' + type;

			$('#divEdit_' + type).show();
			$('#divEdit_' + type).html('<div class="loading_big"></div>').load(url, {
				mode: 'edit',
				ajax: true,
				id: parseInt(id)
			}, function() {
				if(!hideListingWhileEditing)
				{
					if(!win_w)
					{
						win_w = $(window).width();
						win_h = $(window).height();
					}
					// $('#frmEdit_' + type + ', #divEdit_' + type).css('width', ($('#frmEdit_' + type + ' table').width() + 20) + 'px');
					var w = $('#divEdit_' + type).width(), h = $('#divEdit_' + type).height();
					// console.debug(w + "/" + win_w);
					$('#divEdit').css({
						// 'top': parseInt((win_h - h) / 2 - 150) + 'px',
						'left': parseInt((win_w - w) / 2) + 'px'
					});
				}

				if($('#frmEdit_' + type).find('input[type=text], input[type=password], textarea').length)
					$('#frmEdit_' + type).find('input[type=text], input[type=password], textarea')[0].focus();

				$('#frmEdit_' + type).ajaxForm({
					type: 'POST',
					beforeSerialize: function($form, options) {
						try {
							
							if(!$('#frmEdit_' + type).valid())
								return false;
						} catch(e) {alert(e);}
					},
					beforeSubmit: function(arr, $form, options) {
						$('#frmEdit_' + type).hide();
						$('#divEdit_' + type).children().hide();
						$('#divEdit_' + type).append('<div class="loading"></div>');
					},
					success: function(data, textStatus, jqXHR) {
	    	    		$('#divEdit_' + type).html(data).hide();
	    	    		if(!data)
	    	    			pagingRecordAdded(type);
				    	if(hideListingWhileEditing)
				    		$('#items_' + type + ', div.admin').show();
					},
	    	    	error: function(e) {
	    	    		$('#msgBox').html('<div class="alert alert-danger fail">There was a problem updating this record.</div>').show();
	    	    		$('#divEdit_' + type).html(data).hide();
				    	if(hideListingWhileEditing)
				    		$('#items_' + type + ', div.admin').show();
		    	    }
	    		});
	    	});
	    }
		return false;
	}

	function editRow()
	{
		var id = $(this).parents('tr:eq(0)').attr('id');
		if(!id)
			return;

		var tmp = id.match(/([a-z\_]+)([0-9]+)/);
		if(tmp && tmp.length == 3)
		{
			id = tmp[2];
			tmp = tmp[1];
			if(objects_meta[tmp].fullpage && objects_meta[tmp].fullpage != 'popup')
				window.location = base + 'manager/' + tmp + '?mode=edit&id=' + id;
			else
				toggleEdit(tmp, id);
		}
	}

	function bindEditRow(type, edit, fullpage)
	{
		if(!fullpage)
			fullpage = false;
		objects_meta[type] = {'fullpage': fullpage, 'edit': edit};

		if(edit)
			$('table.list_' + type + ' tr:not(.summary):gt(0) td').each(function() {
				if($(this).hasClass('fail'))
					return;
				else
					$(this).parent().addClass('onhover');

				if($(this).find('a,input').length)
					return;
				else
					$(this).css('cursor', 'pointer').click(editRow);
			});
	}

	function getJSDate(dd)
	{
		var dd = dd.split("-");
		if(dd.length == 3)
		{
			var dd1 = new Date(dd[0], dd[1] - 1, dd[2]);
			return dd1;
		}
		else
			return null;
	}
