<?php /* Smarty version Smarty-3.1.13, created on 2024-04-17 16:15:33
         compiled from "/home/u293792719/domains/mtadmin.online/public_html/rajasthandeams/templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204247395661fa84db14f96-92313179%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'deb8eddc30c7ca93018111870ab8ffe4fcaffcfb' => 
    array (
      0 => '/home/u293792719/domains/mtadmin.online/public_html/rajasthandeams/templates/login.tpl',
      1 => 1706010871,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204247395661fa84db14f96-92313179',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'header' => 0,
    'footer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_661fa84db1ec40_59981842',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_661fa84db1ec40_59981842')) {function content_661fa84db1ec40_59981842($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['header']->value;?>

<div class="container-scroller">
	<div class="container-fluid page-body-wrapper full-page-wrapper">
		<div class="row w-100 m-0">
			<div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
				<div class="card col-lg-4 mx-auto">
					<div class="card-body px-5 py-5">
						<h3 class="card-title text-left mb-3">Login</h3>
						<?php if ($_REQUEST['reason']=='inactive'){?>
						<div class="card">
							<div class="card-body">
								<div class="card-body border-top">
									<div class="alert alert-danger">
										<h4 class="alert-heading">Account Suspended</h4>
										This account login has been disabled by the Site Administrator.<br />
										Please email <a href="mailto:<?php echo $_smarty_tpl->getConfigVariable('from');?>
"><?php echo $_smarty_tpl->getConfigVariable('from');?>
</a> to reactivate your account.<br />
										<br />
										<a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
login">Retry</a>
									</div>
								</div>
							</div>
						</div>
						<?php }elseif($_REQUEST['reason']=='password'){?>
						<div class="card">
							<div class="card-body">
								<div class="card-body border-top">
									<div class="alert alert-danger">
										<h4 class="alert-heading">Wrong Password</h4>
										Provided information doesn't match our records.<br /><br />
										If you do not remember your password, please visit our <a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
forgot-password">forgot password</a> page. The link to reset your password will be sent to the e-mail address associated with your account.<br />
										<br />
										<a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
login">Retry</a>
									</div>
								</div>
							</div>
						</div>
						<?php }elseif($_REQUEST['reason']=='nonexistent'){?>
						<div class="card">
							<div class="card-body">
								<div class="card-body border-top">
									<div class="alert alert-danger">
										<h4 class="alert-heading">Invalid Credentials</h4>
										We don't have account with provided email and password.<br />
										Please double check your email and password and try again.<br />
										<br />
										<a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
login">Retry</a>
									</div>
								</div>
							</div>
						</div>
						<?php }elseif($_REQUEST['reason']=='FB_Invalid_User'||$_REQUEST['reason']=='FB_Fatal_Error'||$_REQUEST['reason']=='Google_Invalid_User'){?>
						<div class="card">
							<div class="card-body">
								<div class="card-body border-top">
									<div class="alert alert-danger">
										<h4 class="alert-heading">Invalid Credentials</h4>
										<?php if ($_REQUEST['reason']=='FB_Invalid_User'){?>
										We don't have account with provided facebook credentials.<br />
										To authorize, your email on your existing account must match exactly.<br />
										Else, you can login using your credentials here, and then map your Facebook account from the account settings page.<br />
										<?php }elseif($_REQUEST['reason']=='Google_Invalid_User'){?>
										We don't have account with provided google account credentials.<br />
										To authorize, your email on your existing account must match exactly.<br />
										Else, you can login using your credentials here, and then map your Google account from the account settings page.<br />
										<?php }else{ ?>
										Could not get your profile information from Facebook.<br />
										<?php }?>
										<br />
										<a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
login">Retry</a>
									</div>
								</div>
							</div>
						</div>
						<?php }else{ ?>
						<form method="post" action="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
inc/login.php" id="frmLogin" name="frmLogin">
							<div class="form-group">
								<label>Email *</label>
								<input type="text" spellcheck="false" value="<?php echo $_REQUEST['email'];?>
" id="email" name="email" autocomplete="off" class="form-control p_input email" placeholder="Email" required />
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
							
						</form>
						<?php }?>
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
<?php echo $_smarty_tpl->tpl_vars['footer']->value;?>
<?php }} ?>