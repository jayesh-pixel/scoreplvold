{{$header}}
<div class="container-scroller">
	<div class="container-fluid page-body-wrapper full-page-wrapper">
		<div class="row w-100 m-0">
			<div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
				<div class="card col-lg-4 mx-auto">
					<div class="card-body px-5 py-5">
						<h3 class="card-title text-left mb-3">Login</h3>
						{{if $smarty.request.reason eq 'inactive'}}
						<div class="card">
							<div class="card-body">
								<div class="card-body border-top">
									<div class="alert alert-danger">
										<h4 class="alert-heading">Account Suspended</h4>
										This account login has been disabled by the Site Administrator.<br />
										Please email <a href="mailto:{{#from#}}">{{#from#}}</a> to reactivate your account.<br />
										<br />
										<a href="{{#server_url#}}login">Retry</a>
									</div>
								</div>
							</div>
						</div>
						{{elseif $smarty.request.reason eq 'password'}}
						<div class="card">
							<div class="card-body">
								<div class="card-body border-top">
									<div class="alert alert-danger">
										<h4 class="alert-heading">Wrong Password</h4>
										Provided information doesn't match our records.<br /><br />
										If you do not remember your password, please visit our <a href="{{#server_url#}}forgot-password">forgot password</a> page. The link to reset your password will be sent to the e-mail address associated with your account.<br />
										<br />
										<a href="{{#server_url#}}login">Retry</a>
									</div>
								</div>
							</div>
						</div>
						{{elseif $smarty.request.reason eq 'nonexistent'}}
						<div class="card">
							<div class="card-body">
								<div class="card-body border-top">
									<div class="alert alert-danger">
										<h4 class="alert-heading">Invalid Credentials</h4>
										We don't have account with provided email and password.<br />
										Please double check your email and password and try again.<br />
										<br />
										<a href="{{#server_url#}}login">Retry</a>
									</div>
								</div>
							</div>
						</div>
						{{elseif $smarty.request.reason eq 'FB_Invalid_User' or $smarty.request.reason eq 'FB_Fatal_Error' or $smarty.request.reason eq 'Google_Invalid_User'}}
						<div class="card">
							<div class="card-body">
								<div class="card-body border-top">
									<div class="alert alert-danger">
										<h4 class="alert-heading">Invalid Credentials</h4>
										{{if $smarty.request.reason eq 'FB_Invalid_User'}}
										We don't have account with provided facebook credentials.<br />
										To authorize, your email on your existing account must match exactly.<br />
										Else, you can login using your credentials here, and then map your Facebook account from the account settings page.<br />
										{{elseif $smarty.request.reason eq 'Google_Invalid_User'}}
										We don't have account with provided google account credentials.<br />
										To authorize, your email on your existing account must match exactly.<br />
										Else, you can login using your credentials here, and then map your Google account from the account settings page.<br />
										{{else}}
										Could not get your profile information from Facebook.<br />
										{{/if}}
										<br />
										<a href="{{#server_url#}}login">Retry</a>
									</div>
								</div>
							</div>
						</div>
						{{else}}
						<form method="post" action="{{#server_url#}}inc/login.php" id="frmLogin" name="frmLogin">
							<div class="form-group">
								<label>Email *</label>
								<input type="text" spellcheck="false" value="{{$smarty.request.email}}" id="email" name="email" autocomplete="off" class="form-control p_input email" placeholder="Email" required />
							</div>
							<div class="form-group">
								<label>Password *</label>
								<div class="input-group mb-3">
									<input type="password" value="" id="pass" name="pass" validation="required" autocomplete="off" class="form-control p_input" placeholder="Password" required />
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fas fa-eye-slash" id="eye"></i></div>
									</div>
								</div>
							</div>
							
							<div class="form-group d-flex align-items-center justify-content-between">
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input">
										Remember me </label>
								</div>
								<a href="#" class="forgot-pass">Forgot password</a>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-primary btn-block enter-btn">
									Login
								</button>
							</div>
							{{*
							<div class="d-flex">
								<button class="btn btn-facebook mr-2 col">
									<i class="mdi mdi-facebook"></i> Facebook
								</button>
								<button class="btn btn-google col">
									<i class="mdi mdi-google-plus"></i> Google plus
								</button>
							</div>
							<p class="sign-up">
								Don't have an Account?<a href="#"> Sign Up</a>
							</p>
							*}}
						</form>
						{{/if}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#frmLogin').validate();
	$('#eye').click(function(){
       
        if($(this).hasClass('fa-eye-slash')){
           
          $(this).removeClass('fa-eye-slash');
          
          $(this).addClass('fa-eye');
          
          $('#pass').attr('type','text');
            
        }else{
         
          $(this).removeClass('fa-eye');
          
          $(this).addClass('fa-eye-slash');  
          
          $('#pass').attr('type','password');
        }
    });
</script>
{{$footer}}