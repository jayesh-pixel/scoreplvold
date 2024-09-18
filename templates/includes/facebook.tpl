<div id="fb-root"></div>
<form method="post" id="frmFBLogin" action="{{#server_url#}}inc/fblogin.php">
	<input type="hidden" name="fbuserid" />
	<input type="hidden" name="fbusername" />
	<input type="hidden" name="fbemail" />
</form>
<script>
	function fblogin()
	{
		FB.login(function(response) {
			login(response);
			return true;
		}, {scope: "email"});
	}

	function login(response){
		FB.api('/me?fields=email,name', function(response) {
			if(response.name)
			{
				var fbuserid = response.id;
				var fbusername = response.name;
				var fbemail = response.email;

				$('#frmFBLogin input[name=fbuserid]').val(fbuserid);
				$('#frmFBLogin input[name=fbusername]').val(fbusername);
				$('#frmFBLogin input[name=fbemail]').val(fbemail);
				$('#frmFBLogin').submit();
			}
		});
	}

	function fbLogout()
	{
		FB.logout(function(response) {
			window.location.href = base + 'logout';
		});
	}

	function logout(response)
	{
		window.location.href = base + 'logout';
	}

	window.fbAsyncInit = function() {
		FB.init({appId: '{{#fb_app_id#}}', status: true, cookie: true, xfbml: true, oauth : true});
		{{if !$userid and !$smarty.session.$session.fblogin_attempt}}
		FB.Event.subscribe('auth.login', function(response) {
			if(!userid)
	        	login();
	    });

		FB.getLoginStatus(function(response) {
	    	if (response.status == 'connected') {
	    		fblogin();
	        }
		});
	    {{/if}}
    	FB.Event.subscribe('auth.logout', function(response) {
	        fbLogout(response);
    	});
  	};

  	(function() {
		var e = document.createElement('script');
		e.type = 'text/javascript';
		e.src = '//connect.facebook.net/en_US/all.js';
		e.async = true;
		document.getElementById('fb-root').appendChild(e);
	}());
</script>
