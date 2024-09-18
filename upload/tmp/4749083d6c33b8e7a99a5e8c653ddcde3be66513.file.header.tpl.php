<?php /* Smarty version Smarty-3.1.13, created on 2024-07-10 10:42:57
         compiled from "/home/u293792719/domains/mtadmin.online/public_html/scorepl/templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1067395681668e1859d9fba0-14544995%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4749083d6c33b8e7a99a5e8c653ddcde3be66513' => 
    array (
      0 => '/home/u293792719/domains/mtadmin.online/public_html/scorepl/templates/header.tpl',
      1 => 1714819969,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1067395681668e1859d9fba0-14544995',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'meta' => 0,
    'settings' => 0,
    'cssfile' => 0,
    'jsfile' => 0,
    'session' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_668e1859db6857_11476488',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_668e1859db6857_11476488')) {function content_668e1859db6857_11476488($_smarty_tpl) {?><!DOCTYPE html>
<html dir="ltr" lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['meta']->value['description'];?>
" />
		<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['meta']->value['keywords'];?>
" />
		<link rel="icon" type="image/png" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['settings']->value['favicon'];?>
">
		<title><?php if ($_smarty_tpl->tpl_vars['settings']->value['title']){?><?php echo $_smarty_tpl->tpl_vars['settings']->value['title'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getConfigVariable('sitename_caps');?>
<?php }?></title>
		<?php if ($_smarty_tpl->tpl_vars['cssfile']->value){?>
		<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['cssfile']->value;?>
" type="text/css" charset="utf-8" />
		<?php }else{ ?>
		<link rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
assets/min.php/css?v=1&update=1" type="text/css" charset="utf-8" />
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['jsfile']->value){?>
		<script language="javascript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['jsfile']->value;?>
"></script>
		<?php }else{ ?>
		<script language="javascript" type="text/javascript" src="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
assets/min.php/js?v=2&update=1"></script>
		<?php }?>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
		<script type="text/javascript">
			//	jQuery.noConflict();
			var base = '<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
';
			var currency = '$';
			var base_scripts = '<?php echo $_smarty_tpl->getConfigVariable('scripts_url');?>
';
			var userid = '<?php echo $_SESSION[$_smarty_tpl->tpl_vars['session']->value]['userid'];?>
';
		</script>
		<style>
		    input.form-control, select.form-control, textarea.form-control, input.form-control:focus, select.form-control:focus, textarea.form-control:focus{
                color: #fff;
            }
		</style>
	</head>
	<body>
		<?php if ($_SESSION[$_smarty_tpl->tpl_vars['session']->value]['userid']&&!strstr($_SERVER['REQUEST_URI'],'terms')&&!strstr($_SERVER['REQUEST_URI'],'privacy')){?>
		<div class="container-scroller">
			<nav class="sidebar sidebar-offcanvas" id="sidebar">
				<div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
					<a class="sidebar-brand brand-logo" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
">
						<img src="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['settings']->value['logo_imgpath'];?>
" alt="logo" />
					</a>
					<a class="sidebar-brand brand-logo-mini" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
">
						<img src="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['settings']->value['logo_imgpath'];?>
" alt="logo" />
					</a>
				</div>
				<ul class="nav">
					<li class="nav-item profile">
						<div class="profile-desc">
							<h3 class="page-title" style="margin: 0 auto;"><?php echo $_smarty_tpl->tpl_vars['settings']->value['title'];?>
</h3>
						</div>
					</li>
					<li class="nav-item nav-category">
						<span class="nav-link">Navigation</span>
					</li>
					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
"> <span class="menu-icon"> <i class="mdi mdi-speedometer"></i> </span> <span class="menu-title">Dashboard</span> </a>
					</li>
					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/banners"> <span class="menu-icon"> <i class="mdi mdi-image-area"></i> </span> <span class="menu-title">Banners</span> </a>
					</li>
					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/contests"> <span class="menu-icon"> <i class="mdi mdi-trophy"></i> </span> <span class="menu-title">Contests</span></a>
					</li>
					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/ccategories"> <span class="menu-icon"> <i class="mdi mdi-trophy"></i> </span> <span class="menu-title">Contest Categories</span></a>
					</li>
					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/matches"> <span class="menu-icon"> <i class="mdi mdi-cricket"></i> </span> <span class="menu-title">Matches</span></a>
					</li>
					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/players"> <span class="menu-icon"> <i class="mdi mdi-account-multiple"></i> </span> <span class="menu-title">Players</span></a>
					</li>
					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/points"> <span class="menu-icon"> <i class="mdi mdi-file-document"></i> </span> <span class="menu-title">Points</span></a>
					</li>
					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/kyc"> <span class="menu-icon"> <i class="mdi mdi-file-document"></i> </span> <span class="menu-title">KYC</span></a>
					</li>
					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/wrequests"> <span class="menu-icon"> <i class="mdi mdi-currency-inr"></i> </span> <span class="menu-title">Withdraw Request</span></a>
					</li>
					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/notifications"> <span class="menu-icon"> <i class="mdi mdi-bell"></i> </span> <span class="menu-title">Notifications</span></a>
					</li>
					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/customers"> <span class="menu-icon"> <i class="mdi mdi-account-multiple"></i> </span> <span class="menu-title">Users</span></a>
					</li>
					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/opinions"> <span class="menu-icon"> <i class="mdi mdi-account-multiple"></i> </span> <span class="menu-title">Opinions</span></a>
					</li>
					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/settings"> <span class="menu-icon"> <i class="mdi mdi-settings-box"></i> </span> <span class="menu-title">Settings</span></a>
					</li>
				</ul>
			</nav>
			<div class="container-fluid page-body-wrapper">
				<nav class="navbar p-0 fixed-top d-flex flex-row">
					<div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
						<a class="navbar-brand brand-logo-mini" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
"><img src="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['settings']->value['logo_imgpath'];?>
" alt="logo" /></a>
					</div>
					<div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
						<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
							<span class="mdi mdi-menu"></span>
						</button>
						<ul class="navbar-nav w-100">
							<li class="nav-item w-100">
								
							</li>
						</ul>
						<ul class="navbar-nav navbar-nav-right">
							<li class="nav-item nav-settings d-none d-lg-block">
								<a class="nav-link" href="javascript:void(0);"> <i class="mdi mdi-view-grid"></i> </a>
							</li>
							<li class="nav-item dropdown border-left">
								<a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false"> <i class="mdi mdi-email"></i> <span class="count bg-success"></span> </a>
								<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
									<p class="p-3 mb-0 text-center">
										No New Messages
									</p>
								</div>
							</li>
							<li class="nav-item dropdown border-left">
								<a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown"> <i class="mdi mdi-bell"></i> <span class="count bg-danger"></span> </a>
								<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
									
									<p class="p-3 mb-0 text-center">
										No Notifications
									</p>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
								<div class="navbar-profile">
									<img class="img-xs rounded-circle" src="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_SESSION[$_smarty_tpl->tpl_vars['session']->value]['imgpath'];?>
" alt="">
									<p class="mb-0 d-none d-sm-block navbar-profile-name">
										<?php echo $_SESSION[$_smarty_tpl->tpl_vars['session']->value]['name'];?>

									</p>
									<i class="mdi mdi-menu-down d-none d-sm-block"></i>
								</div> </a>
								<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
									<h6 class="p-3 mb-0">Profile</h6>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item preview-item" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
users/account">
										<div class="preview-thumbnail">
											<div class="preview-icon bg-dark rounded-circle">
												<i class="mdi mdi-settings text-success"></i>
											</div>
										</div>
										<div class="preview-item-content">
											<p class="preview-subject mb-1">
												Settings
											</p>
										</div> 
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item preview-item" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
logout">
										<div class="preview-thumbnail">
											<div class="preview-icon bg-dark rounded-circle">
												<i class="mdi mdi-logout text-danger"></i>
											</div>
										</div>
										<div class="preview-item-content">
											<p class="preview-subject mb-1">
												Log out
											</p>
										</div> 
									</a>
								</div>
							</li>
						</ul>
						<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
							<span class="mdi mdi-format-line-spacing"></span>
						</button>
					</div>
				</nav>
				<!-- partial -->
				<div class="main-panel">
					<div class="content-wrapper">

			<?php }?><?php }} ?>