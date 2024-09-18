<?php /* Smarty version Smarty-3.1.13, created on 2024-03-04 16:08:17
         compiled from "/home/u293792719/domains/mtadmin.online/public_html/rajasthandeams/templates/users/account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:155410129165e5a49970d056-70564933%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a192fff9ec753d48283198e4d3ff23104750baac' => 
    array (
      0 => '/home/u293792719/domains/mtadmin.online/public_html/rajasthandeams/templates/users/account.tpl',
      1 => 1706010871,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '155410129165e5a49970d056-70564933',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'header' => 0,
    'user' => 0,
    'footer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_65e5a49971cdb6_07615439',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65e5a49971cdb6_07615439')) {function content_65e5a49971cdb6_07615439($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['header']->value;?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
                <div class="card-body">
                	<div class="row">
                    	<div class="col-sm-12 col-md-4">
                        	<h3 class="card-title text-danger">Account Settings</h3>
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
                	<div class="row">
                		<div class="col-md-8">
							<form method="post" action="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
inc/users/account.php" class="form-horizontal" enctype="multipart/form-data" id="frmAccount" name="frmAccount">
								<div class="form-group row">
									<label class="col-sm-3 control-label col-form-label required">Usertype</label>
									<div class="col-sm-9"><?php echo $_smarty_tpl->tpl_vars['user']->value['usertype'];?>
</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 control-label col-form-label required">Name</label>
									<div class="col-sm-9">
										<input type="text" validation="required" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
" id="name" name="name" spellcheck="false" maxlength="128" class="form-control" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 control-label col-form-label required">E-mail</label>
									<div class="col-sm-9">
										<input type="text" id="email" name="email" spellcheck="false" maxlength="128" class="form-control required email" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 control-label col-form-label">New Password</label>
									<div class="col-sm-9">
										<input type="text" validation="" value="" id="newpass" name="newpass" spellcheck="false" maxlength="128" class="form-control" />
										<div class="alert-info">Leave blank to keep the same password</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 control-label col-form-label required">Profile Pic</label>
									<div class="col-sm-9">
										<div class="file-loading">
										    <input id="input-700" name="imgpath" type="file" multiple>
										</div>
									</div>
								</div>
								<div class="border-top">
									<div class="card-body">
										<input type="submit" class="icons save btn btn-primary" value="Update" name="mysubmit">
										<input type="button" class="icons discard btn btn-danger" name="discard" value="Go Back" onclick="javascript:redirect(base);">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#frmAccount').validate();
	var initialPreviewVideo = new Array();
	var initialPreviewConfigVideo = new Array();
	initialPreviewVideo.push("<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['user']->value['imgpath'];?>
");
	initialPreviewConfigVideo.push({caption: "<?php echo $_smarty_tpl->tpl_vars['user']->value['imgpath'];?>
", size: 329892, width: "120px", key: 1});

	$(document).ready(function() {
		$("#input-700").fileinput({
	        theme: 'fas',
	        allowedFileExtensions: ['jpeg', 'jpg', 'png', 'gif'],
	        overwriteInitial: true,
	        maxFileSize: 1000,
	        maxFilesNum: 10,
	        showUploadStats: false,
    		uploadIcon: false,
    		showUpload: false,
	        slugCallback: function (filename) {
	            return filename.replace('(', '_').replace(']', '_');
	        },
			initialPreviewAsData: true,
	        initialPreview: initialPreviewVideo,
	        initialPreviewConfig: initialPreviewConfigVideo,
	    });
	});
</script>
<?php echo $_smarty_tpl->tpl_vars['footer']->value;?>
<?php }} ?>