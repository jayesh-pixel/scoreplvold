<?php /* Smarty version Smarty-3.1.13, created on 2024-06-14 17:50:08
         compiled from "/home/u293792719/domains/mtadmin.online/public_html/scorepl/templates/denied.tpl" */ ?>
<?php /*%%SmartyHeaderCode:970805530666c3578540f45-49038914%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92b4bb54c11d990f4988a759a9079ed06517c04a' => 
    array (
      0 => '/home/u293792719/domains/mtadmin.online/public_html/scorepl/templates/denied.tpl',
      1 => 1714819969,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '970805530666c3578540f45-49038914',
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
  'unifunc' => 'content_666c3578546433_64414277',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_666c3578546433_64414277')) {function content_666c3578546433_64414277($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['header']->value;?>

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
                <div class="card-body">
                	<div class="row">
                    	<div class="col-sm-12 col-md-4">
                        	<h3 class="card-title text-danger">Access Denied</h3>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
                <div class="card-body">
            		<div class="row alert alert-danger">
						You are not allowed access to the page (<?php echo $_SERVER['REQUEST_URI'];?>
).
						<p>
							You are either logged off or do not have enough access rights to view this page.
							<br />
							Please look for the links on our <a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
">home page</a>. You can also send an email to <a href="mailto:<?php echo $_smarty_tpl->getConfigVariable('from');?>
"><?php echo $_smarty_tpl->getConfigVariable('from');?>
</a>.
						</p>
						<a href="<?php if ($_SERVER['HTTP_REFERER']){?><?php echo $_SERVER['HTTP_REFERER'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php }?>">Go Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $_smarty_tpl->tpl_vars['footer']->value;?>
<?php }} ?>