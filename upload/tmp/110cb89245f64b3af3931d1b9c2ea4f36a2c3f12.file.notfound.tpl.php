<?php /* Smarty version Smarty-3.1.13, created on 2023-11-02 07:29:51
         compiled from "/home/u931950211/domains/win11.live/public_html/templates/notfound.tpl" */ ?>
<?php /*%%SmartyHeaderCode:126878682765430297179ed3-70898696%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '110cb89245f64b3af3931d1b9c2ea4f36a2c3f12' => 
    array (
      0 => '/home/u931950211/domains/win11.live/public_html/templates/notfound.tpl',
      1 => 1697894170,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126878682765430297179ed3-70898696',
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
  'unifunc' => 'content_65430297180d35_76496114',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65430297180d35_76496114')) {function content_65430297180d35_76496114($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['header']->value;?>

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
                <div class="card-body">
                	<div class="row">
                    	<div class="col-sm-12 col-md-4">
                        	<h3 class="card-title text-danger">Page Not Found</h3>
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
						The page URL "<?php if (strstr($_SERVER['REQUEST_URI'],'notfound')){?><?php if ($_SERVER['HTTP_REFERER']){?><?php echo $_SERVER['HTTP_REFERER'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php }?><?php }else{ ?><?php echo $_SERVER['REQUEST_URI'];?>
<?php }?>" not found at <?php echo $_smarty_tpl->getConfigVariable('sitename_caps');?>

						<p>
							This page does not exist or the URL is invalid.
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