<?php /* Smarty version Smarty-3.1.13, created on 2023-10-17 07:06:59
         compiled from "/home/u233274077/domains/adminapp.tech/public_html/crickapp/templates/users/dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:583220592652de53b63bad8-64962159%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ac76fdc0e8855ea81ada01065dc3b8bd81b23f6' => 
    array (
      0 => '/home/u233274077/domains/adminapp.tech/public_html/crickapp/templates/users/dashboard.tpl',
      1 => 1687182921,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '583220592652de53b63bad8-64962159',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'header' => 0,
    'customers' => 0,
    'wrequest' => 0,
    'kyc' => 0,
    'contests' => 0,
    'banners' => 0,
    'upcomings' => 0,
    'footer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_652de53b643123_83091049',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_652de53b643123_83091049')) {function content_652de53b643123_83091049($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['header']->value;?>

<div class="row">
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-4" style="opacity: 0.5;">
						<i class="fa fa-users fa-5x"></i>
					</div>
					<div class="col-5">
						<div class="d-flex align-items-center align-self-start" style="justify-content: center;">
							<h1 class="mb-0"><?php echo $_smarty_tpl->tpl_vars['customers']->value;?>
</h1>
						</div>
					</div>
					<div class="col-3">
						<div class="icon icon-box-success">
							<a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/customers"><span class="mdi mdi-arrow-top-right icon-item"></span></a>
						</div>
					</div>
				</div>
				<h6 class="text-muted font-weight-normal text-center">Total Customers</h6>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-4" style="opacity: 0.5;">
						<i class="fa fa-rupee-sign fa-5x"></i>
					</div>
					<div class="col-5">
						<div class="d-flex align-items-center align-self-start" style="justify-content: center;">
							<h1 class="mb-0"><?php echo $_smarty_tpl->tpl_vars['wrequest']->value;?>
</h1>
						</div>
					</div>
					<div class="col-3">
						<div class="icon icon-box-success">
							<a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/wrequests"><span class="mdi mdi-arrow-top-right icon-item"></span></a>
						</div>
					</div>
				</div>
				<h6 class="text-muted font-weight-normal text-center">Withdraw Requests</h6>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-4" style="opacity: 0.5;">
						<i class="fa fa-id-card fa-5x"></i>
					</div>
					<div class="col-5">
						<div class="d-flex align-items-center align-self-start" style="justify-content: center;">
							<h1 class="mb-0"><?php echo $_smarty_tpl->tpl_vars['kyc']->value;?>
</h1>
						</div>
					</div>
					<div class="col-3">
						<div class="icon icon-box-success">
							<a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/kyc"><span class="mdi mdi-arrow-top-right icon-item"></span></a>
						</div>
					</div>
				</div>
				<h6 class="text-muted font-weight-normal text-center">Pending KYC</h6>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-4" style="opacity: 0.5;">
						<i class="fa fa-trophy fa-5x"></i>
					</div>
					<div class="col-5">
						<div class="d-flex align-items-center align-self-start" style="justify-content: center;">
							<h1 class="mb-0"><?php echo $_smarty_tpl->tpl_vars['contests']->value;?>
</h1>
						</div>
					</div>
					<div class="col-3">
						<div class="icon icon-box-success">
							<a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/contests"><span class="mdi mdi-arrow-top-right icon-item"></span></a>
						</div>
					</div>
				</div>
				<h6 class="text-muted font-weight-normal text-center">Total Contests</h6>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-4" style="opacity: 0.5;">
						<i class="fa fa-images fa-5x"></i>
					</div>
					<div class="col-5">
						<div class="d-flex align-items-center align-self-start" style="justify-content: center;">
							<h1 class="mb-0"><?php echo $_smarty_tpl->tpl_vars['banners']->value;?>
</h1>
						</div>
					</div>
					<div class="col-3">
						<div class="icon icon-box-success">
							<a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/banners"><span class="mdi mdi-arrow-top-right icon-item"></span></a>
						</div>
					</div>
				</div>
				<h6 class="text-muted font-weight-normal text-center">Total Banners</h6>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-4" style="opacity: 0.5;">
						<i class="fa fa-bars fa-5x"></i>
					</div>
					<div class="col-5">
						<div class="d-flex align-items-center align-self-start" style="justify-content: center;">
							<h1 class="mb-0"><?php echo $_smarty_tpl->tpl_vars['upcomings']->value;?>
</h1>
						</div>
					</div>
					<div class="col-3">
						<div class="icon icon-box-success">
							<a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/matches"><span class="mdi mdi-arrow-top-right icon-item"></span></a>
						</div>
					</div>
				</div>
				<h6 class="text-muted font-weight-normal text-center">Upcoming Matches</h6>
			</div>
		</div>
	</div>
</div>
<?php echo $_smarty_tpl->tpl_vars['footer']->value;?>
<?php }} ?>