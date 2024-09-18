<?php /* Smarty version Smarty-3.1.13, created on 2023-11-10 12:24:43
         compiled from "/home/u293792719/domains/mtadmin.online/public_html/star11/templates/manager/edit_contest.tpl" */ ?>
<?php /*%%SmartyHeaderCode:652753848654dd3b3cd1450-05971139%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bcabaa03cf4b0e4cb81d979e622dd93d82b62f5b' => 
    array (
      0 => '/home/u293792719/domains/mtadmin.online/public_html/star11/templates/manager/edit_contest.tpl',
      1 => 1699599103,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '652753848654dd3b3cd1450-05971139',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'meta_data' => 0,
    'object_row' => 0,
    'object_fields' => 0,
    'myId' => 0,
    'i' => 0,
    'ok' => 0,
    'selected_csv' => 0,
    'ov' => 0,
    'rules' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_654dd3b3d22079_18173030',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_654dd3b3d22079_18173030')) {function content_654dd3b3d22079_18173030($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['meta_data']->value['fullpage']){?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
                <div class="card-body">
                	<div class="row">
<?php }?>
					<div class="col-12 border-bottom mb-3">
						<h3 class="card-title text-danger"><?php if ($_smarty_tpl->tpl_vars['object_row']->value['id']){?>Edit<?php }else{ ?>Add New<?php }?> <?php echo $_smarty_tpl->tpl_vars['meta_data']->value['singular'];?>
</h3>
					</div>
					<div class="col-md-8">
						<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['prefix']){?><?php echo $_smarty_tpl->tpl_vars['meta_data']->value['prefix'];?>
<?php }?>
						<form class="form-horizontal" name="form" id="frmEdit_<?php echo $_REQUEST['object_type'];?>
" action="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/<?php echo $_REQUEST['object_type'];?>
?mode=edit" method="post" enctype="multipart/form-data"<?php if (!$_REQUEST['ajax']){?> onsubmit="javascript: return validateForm(this);"<?php }?>>
							<input type="hidden" name="ajax" value="<?php if ($_REQUEST['ajax']){?>true<?php }?>" />
							<input type="hidden" name="popup" value="<?php if ($_REQUEST['popup']){?>true<?php }?>" />
							<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>
" />
							<input type="hidden" name="ts" value="<?php echo time();?>
" />
							<?php if ($_REQUEST['custom']){?><input type="hidden" name="custom" value="<?php echo $_REQUEST['custom'];?>
" /><?php }?>
							<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['object_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
							<?php if ($_REQUEST['object_type']=='templates'&&$_smarty_tpl->tpl_vars['myId']->value=='tags'){?>
								<div class="form-group row">
									<label class="col-sm-3 control-label col-form-label">Global Tags</label>
									<div class="col-sm-9">site_name, site_tagline, site_url, site_email, site_logo</div>
								</div>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['i']->value['edit']){?>
								<div class="form-group row">
									<label class="col-sm-3 control-label col-form-label <?php if (strstr($_smarty_tpl->tpl_vars['i']->value['validation'],'required')){?>required<?php }?>"><?php echo $_smarty_tpl->tpl_vars['i']->value['displayname'];?>
</label>
									<div class="col-sm-9">
									<?php echo $_smarty_tpl->tpl_vars['i']->value['prefix'];?>

									<?php if ($_smarty_tpl->tpl_vars['i']->value['input']=='file'||$_smarty_tpl->tpl_vars['i']->value['input']=='image'){?>
                                            <input type="file" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" validation="<?php if (!$_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value]){?><?php echo $_smarty_tpl->tpl_vars['i']->value['validation'];?>
<?php }?>" <?php if ($_smarty_tpl->tpl_vars['i']->value['title']){?>title="<?php echo $_smarty_tpl->tpl_vars['i']->value['title'];?>
"<?php }?> value="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>
">
                                        <script>
											$(document).ready(function() {
												$("#<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
").fileinput({
											        theme: 'fas',
											        allowedFileExtensions: ['mp4', 'wav', 'mp3'],
											        overwriteInitial: true,
											        maxFilesNum: 10,
											        showUploadStats: false,
									        		uploadIcon: false,
									        		showUpload: false,
											        //allowedFileTypes: ['image', 'video', 'flash'],
											        slugCallback: function (filename) {
											            return filename.replace('(', '_').replace(']', '_');
											        },
		        									initialPreviewAsData: true,
											        initialPreview: ('<?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>
'?["<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>
"]:new Array()),
											        initialPreviewConfig: ('<?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>
'?[{type: "<?php if ($_smarty_tpl->tpl_vars['i']->value['filetype']=='video'){?>video<?php }else{ ?>image<?php }?>" ,caption: "<?php echo basename($_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value]);?>
", filetype: "<?php if ($_smarty_tpl->tpl_vars['i']->value['filetype']=='video'){?>video/mp4<?php }?>", width: "120px", key: 1}]:new Array()),
											    });
											});
										</script>
										<?php if (!$_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value]){?><?php if (strstr($_smarty_tpl->tpl_vars['i']->value['validation'],'required')){?><div id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
_err">You must upload a file</div><?php }?><?php }?>
									<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='textarea'||$_smarty_tpl->tpl_vars['i']->value['input']=='cms'){?>
										<textarea class="form-control" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" validation="<?php echo $_smarty_tpl->tpl_vars['i']->value['validation'];?>
" <?php if ($_smarty_tpl->tpl_vars['i']->value['rows']){?>rows="<?php echo $_smarty_tpl->tpl_vars['i']->value['rows'];?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['i']->value['cols']){?>cols="<?php echo $_smarty_tpl->tpl_vars['i']->value['cols'];?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['i']->value['title']){?>title="<?php echo $_smarty_tpl->tpl_vars['i']->value['title'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>
</textarea>
										<div class="info" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
_length"></div>
										<?php if ($_smarty_tpl->tpl_vars['i']->value['input']=='cms'){?>
										<input type="hidden" name="tagged[]" value="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" />
											<?php $_smarty_tpl->tpl_vars["cmsfound"] = new Smarty_variable("{".((string)$_smarty_tpl->tpl_vars['cmsfound']->value)."},{".((string)$_smarty_tpl->tpl_vars['myId']->value)."}", null, 0);?>
										<?php }?>
									<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='checkbox'&&$_smarty_tpl->tpl_vars['i']->value['type']=='csv'){?>
										<?php if ($_smarty_tpl->tpl_vars['i']->value['resize_array']==1){?>
										<div class="custom-control custom-checkbox mr-sm-2">
											<input type="checkbox" class="custom-control-input" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" click="javascript:return test1();">
                                            <label class="custom-control-label" for="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
"></label>
                                        </div>
										<?php }?>
										<?php $_smarty_tpl->tpl_vars["selected_csv"] = new Smarty_variable(explode(",",$_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value]), null, 0);?>
										<?php  $_smarty_tpl->tpl_vars['ov'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ov']->_loop = false;
 $_smarty_tpl->tpl_vars['ok'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['i']->value['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ov']->key => $_smarty_tpl->tpl_vars['ov']->value){
$_smarty_tpl->tpl_vars['ov']->_loop = true;
 $_smarty_tpl->tpl_vars['ok']->value = $_smarty_tpl->tpl_vars['ov']->key;
?>
										<div class="custom-control custom-checkbox mr-sm-2">
											<input type="checkbox" class="custom-control-input" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
[]" id="cb_<?php echo $_smarty_tpl->tpl_vars['ok']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['ok']->value;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['ok']->value,$_smarty_tpl->tpl_vars['selected_csv']->value)){?>checked<?php }?> validation="<?php echo $_smarty_tpl->tpl_vars['i']->value['validation'];?>
">
                                            <label class="custom-control-label" for="cb_<?php echo $_smarty_tpl->tpl_vars['ok']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['ov']->value;?>
</label>
                                        </div>
										<?php }
if (!$_smarty_tpl->tpl_vars['ov']->_loop) {
?>
										<div class="custom-control custom-checkbox mr-sm-2">
											<input type="checkbox" class="custom-control-input" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value]){?>checked<?php }?>>
                                            <label class="custom-control-label" for="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['label'];?>
</label>
                                        </div>
										<?php } ?>
									<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='checkbox'){?>
									<?php if ($_smarty_tpl->tpl_vars['i']->value['resize_array']==1){?>
										<div class="custom-control custom-checkbox mr-sm-2">
											<input type="checkbox" class="custom-control-input" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" click="javascript:return test1();">
                                            <label class="custom-control-label" for="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
"></label>
                                        </div>
										<?php }?>
										<?php  $_smarty_tpl->tpl_vars['ov'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ov']->_loop = false;
 $_smarty_tpl->tpl_vars['ok'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['i']->value['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ov']->key => $_smarty_tpl->tpl_vars['ov']->value){
$_smarty_tpl->tpl_vars['ov']->_loop = true;
 $_smarty_tpl->tpl_vars['ok']->value = $_smarty_tpl->tpl_vars['ov']->key;
?>
										<div class="custom-control custom-checkbox mr-sm-2">
											<input type="checkbox" class="custom-control-input" name="<?php echo $_smarty_tpl->tpl_vars['ok']->value;?>
" id="cb_<?php echo $_smarty_tpl->tpl_vars['ok']->value;?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['ok']->value]){?>checked<?php }?>>
                                            <label class="custom-control-label" for="cb_<?php echo $_smarty_tpl->tpl_vars['ok']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['ov']->value;?>
</label>
                                        </div>
										<?php }
if (!$_smarty_tpl->tpl_vars['ov']->_loop) {
?>
										<div class="custom-control custom-checkbox mr-sm-2">
											<input type="checkbox" class="custom-control-input" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value]){?>checked<?php }?>>
                                            <label class="custom-control-label" for="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['label'];?>
</label>
                                        </div>
										<?php } ?>
									<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='radio'){?>
										<?php  $_smarty_tpl->tpl_vars['ov'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ov']->_loop = false;
 $_smarty_tpl->tpl_vars['ok'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['i']->value['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ov']->key => $_smarty_tpl->tpl_vars['ov']->value){
$_smarty_tpl->tpl_vars['ov']->_loop = true;
 $_smarty_tpl->tpl_vars['ok']->value = $_smarty_tpl->tpl_vars['ov']->key;
?>
										<div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="rb_<?php echo $_smarty_tpl->tpl_vars['ok']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['ok']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value]==$_smarty_tpl->tpl_vars['ok']->value){?>checked<?php }?>>
                                            <label class="custom-control-label" for="rb_<?php echo $_smarty_tpl->tpl_vars['ok']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['ov']->value;?>
</label>
                                        </div>
										<?php } ?>
									<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='month'){?>
										<select name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" class="form-control">
											<option value="">Choose <?php echo $_smarty_tpl->tpl_vars['i']->value['displayname'];?>
</option>
											<?php echo $_smarty_tpl->getSubTemplate ("include/months.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

										</select>
										<script type="text/javascript">selectValue("<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
", "<?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>
");</script>
									<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='select'){?>
										<?php if ($_smarty_tpl->tpl_vars['i']->value['set_autocomplete']=='1'){?>
											<input type="text" class="form-control" spellcheck="false" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" maxlength="128" />
			<script type="text/javascript">
				var object_id=0;
				$("#<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
").autocomplete(base + "manager?mode=auto&table=<?php echo $_smarty_tpl->tpl_vars['i']->value['fr_table'];?>
&field=<?php echo $_smarty_tpl->tpl_vars['i']->value['fr_field'];?>
",
					{
						minChars:0,
						formatItem: function(row)
						{
							return row[0];
						},
						scroll: false,
				    	scrollHeight: 335,
					}
					)
					.result(function(data, value)
					{
						$('#<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
').val(value[0]);
						 object_id = value[1];
				//		_loadFields(value[1]);
					}
					);
			</script>
										<?php }else{ ?>
											<select class="form-control" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" validation="<?php echo $_smarty_tpl->tpl_vars['i']->value['validation'];?>
" <?php if ($_smarty_tpl->tpl_vars['myId']->value=='fr_table'){?>onclick="javascript:_loadFields(this.value);"<?php }?> <?php if ($_smarty_tpl->tpl_vars['i']->value['title']){?>title="<?php echo $_smarty_tpl->tpl_vars['i']->value['title'];?>
"<?php }?>>
												<option value="">Choose <?php echo $_smarty_tpl->tpl_vars['i']->value['displayname'];?>
</option>
											<?php  $_smarty_tpl->tpl_vars['ov'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ov']->_loop = false;
 $_smarty_tpl->tpl_vars['ok'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['i']->value['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['ov']->key => $_smarty_tpl->tpl_vars['ov']->value){
$_smarty_tpl->tpl_vars['ov']->_loop = true;
 $_smarty_tpl->tpl_vars['ok']->value = $_smarty_tpl->tpl_vars['ov']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
												<option value="<?php if ($_smarty_tpl->tpl_vars['ok']->value!=$_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['index']||$_smarty_tpl->tpl_vars['i']->value['assoc']){?><?php echo $_smarty_tpl->tpl_vars['ok']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['ov']->value;?>
<?php }?>"><?php echo $_smarty_tpl->tpl_vars['ov']->value;?>
</option>
											<?php } ?>
											</select>
											<script type="text/javascript">selectValue("<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
", "<?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>
");</script>
										<?php }?>
									<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='password'){?>
										<input type="password" class="form-control" spellcheck="false" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" value="" validation="<?php if (!$_REQUEST['id']){?><?php echo $_smarty_tpl->tpl_vars['i']->value['validation'];?>
<?php }?>" />
									<?php }else{ ?>
										<input type="text" class="form-control" maxlength="<?php if ($_smarty_tpl->tpl_vars['i']->value['maxlength']){?><?php echo $_smarty_tpl->tpl_vars['i']->value['maxlength'];?>
<?php }else{ ?>128<?php }?>" spellcheck="false" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>
" validation="<?php echo $_smarty_tpl->tpl_vars['i']->value['validation'];?>
" <?php if ($_smarty_tpl->tpl_vars['i']->value['title']){?>title="<?php echo $_smarty_tpl->tpl_vars['i']->value['title'];?>
"<?php }?> />
										<?php if ($_smarty_tpl->tpl_vars['i']->value['input']=='date'){?>
			<script type="text/javascript">
				$(document).ready(function(){
					$("#<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
").css('width', '100px').datepicker({
						<?php if ($_smarty_tpl->tpl_vars['i']->value['range']=='past'){?>
						minDate:'-20Y',
						maxDate:'+0d'
						<?php }elseif($_smarty_tpl->tpl_vars['i']->value['range']=='future'){?>
						minDate:'+0d',
						maxDate:'+20Y'
						<?php }?>
					});
				});
			</script>
									<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='time'){?>
			<script type="text/javascript">
				$(document).ready(function(){
					$("#<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
").css('width', '100px').timepicker({
						showSecond: false,
						ampm: false,
						timeFormat:'hh:mm'
					});
				});
			</script>
									<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='datetime'){?>
			<script type="text/javascript">
				$(document).ready(function(){
					$("#<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
").css('width', '100px').datepicker({
						<?php if ($_smarty_tpl->tpl_vars['i']->value['range']=='past'){?>
						minDate:'-20Y',
						maxDate:'+0d',
						<?php }elseif($_smarty_tpl->tpl_vars['i']->value['range']=='future'){?>
						minDate:'+0d',
						maxDate:'+20Y',
						<?php }?>
						showSecond: false,
						ampm: false,
						timeFormat:'hh:mm'
					});
				});
			</script>
										<?php }?>
									<?php }?>
									<?php echo $_smarty_tpl->tpl_vars['i']->value['suffix'];?>

									<?php if ($_smarty_tpl->tpl_vars['i']->value['help']){?><div class="alert-info"><?php echo $_smarty_tpl->tpl_vars['i']->value['help'];?>
</div><?php }?>
									</div>
								</div>
							<?php }elseif($_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value]){?>
								<div class="form-group row">
									<label class="col-sm-3 text-right control-label col-form-label"><?php echo $_smarty_tpl->tpl_vars['i']->value['displayname'];?>
</label>
									<div class="col-sm-9">
										<?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>

									</div>
									<?php if ($_smarty_tpl->tpl_vars['i']->value['help']){?><td><?php echo $_smarty_tpl->tpl_vars['i']->value['help'];?>
</td><?php }?>
								</div>
							<?php }?>
						<?php } ?>
							<div class="form-group row">
								<div class="col-sm-12 col-md-6">
									<h3 class="text-danger">Price Distribution
									<a href="javascript:void(0)" onclick="addRules()" class="btn btn-primary float-right">Add Rule</a>	
									</h3>
									<h5 class="text-success">Remaining Amount: <span id="remainingAmt"></span></h5>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-12">
									<table class="table table-striped table-bordered" id="tblRules">
										<tr>
											<th>Min Rank</th>
											<th>Max Rank</th>
											<th>Amount</th>
										</tr>
										<input type="hidden" class="form-control" name="rid[]" value="" />
										<tr class="d-none firstTr">
											<td><input type="number" class="form-control" name="min_rank[]" value="" style="width: 100px;" /></td>
											<td><input type="number" class="form-control" name="max_rank[]" value="" style="width: 100px;" /></td>
											<td><input type="number" class="form-control" name="rank_amount[]" value="" style="width: 100px;" /></td>
											<td><a href="javascript: void(0);" onclick="deleteRule($(this))"><i class="fa fa-trash"></i></a></td>
										</tr>
										<?php if (count($_smarty_tpl->tpl_vars['rules']->value)){?>
											<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
											<input type="hidden" class="form-control" name="rid[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" />
											<tr>
												<td><input type="number" class="form-control" name="min_rank[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['min_rank'];?>
" style="width: 100px;" /></td>
												<td><input type="number" class="form-control" name="max_rank[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['max_rank'];?>
" style="width: 100px;" /></td>
												<td><input type="number" class="form-control" name="rank_amount[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['amount'];?>
" style="width: 100px;" /></td>
												<td><a href="javascript: void(0);" onclick="deleteRule($(this))"><i class="fa fa-trash"></i></a></td>
											</tr>
											<?php } ?>
										<?php }else{ ?>
										<?php }?>
									</table>
								</div>
							</div>
							<div class="border-top">
								<div class="card-body">
									<input type="submit" class="icons save btn btn-primary" name="mysubmit" value="Save" />
									<input type="button" class="icons discard btn btn-danger" name="discard" value="Go Back" onclick="javascript:<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['fullpage']){?>window.location = '<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/<?php echo $_REQUEST['object_type'];?>
';<?php }elseif($_REQUEST['ajax']){?>toggleEdit('<?php echo $_REQUEST['object_type'];?>
', 0, true);<?php }else{ ?>window.parent.Shadowbox.close();<?php }?>" />
								</div>
							</div>
						</form>
						<script>
							function calculateRemainingAmount(){
								$('table#tblRules input[name*="amount"]').unbind('change').bind('change', function(){
									var remainingAmt = getRuleAmount();
									$('#remainingAmt').text(remainingAmt);
								}).trigger('change');
							}
							
							calculateRemainingAmount();
							
							$('form#frmEdit_contests').submit(function(){
							    var price = parseInt($('input#price').val());
							    if(price <= 0)
								{
									alert("Price should be greater than 0");
									return false;
								}
								
								var remainingAmt = parseInt(getRuleAmount());
								if(remainingAmt == 0)
									return true;
								else{
									alert("Distribution amount should not be greather or less than price pool");
									return false;
								}
							});
							
						/*	function getRuleAmount(){
								var total = 0;
								var price = parseInt($('input#price').val());
								
								$('table#tblRules input[name*="amount"]:visible').each(function(){
								    var minR = parseInt($(this).parents('tr:eq(0)').find('input[name*="min_rank"]').val());
								    var maxR = parseInt($(this).parents('tr:eq(0)').find('input[name*="max_rank"]').val());
								    
								    if(minR <= maxR)
								    {
								        var amount = (minR > 0?((maxR+1) - minR):maxR) * parseInt($(this).val());
								        if(amount)
										    total += amount;
								    }
								});
								var remainingAmt = price - total;
								
								return remainingAmt;
							}*/
							  function getRuleAmount() {
                            var total = 0;
                            var price = parseInt($('input#price').val());
                        
                            $('table#tblRules input[name*="rank_amount"]').each(function () {
                                var amount = parseInt($(this).val());
                                if (amount > 0) {
                                    var minR = parseInt($(this).parents('tr:eq(0)').find('input[name*="min_rank"]').val());
								    var maxR = parseInt($(this).parents('tr:eq(0)').find('input[name*="max_rank"]').val());
                        
                                    if (minR > 0 && maxR > minR) {
                                        // If maxRank is greater than minRank and not zero
                                        var rank = maxR - (minR - 1);
                                    } else {
                                        // If maxRank is zero or not greater than minRank
                                        var rank = 1;
                                    }
                        
                                    // Adjusted the calculation of amount based on rank
                                    var amount = rank * parseInt($(this).val());
                        
                                    if (amount > 0) {
                                        total += amount;
                                    }
                                }
                            });
                        
                            var remainingAmt = price - total;
                            return remainingAmt;
                        }

							
							function addRules(){
								var item = $('table#tblRules tr.firstTr:eq(0)').clone().removeClass('d-none').removeClass('firstTr');
								$('table#tblRules tr:last').after(item);
								calculateRemainingAmount();
							}
							
							function deleteRule($this){
								$this.parents('tr:eq(0)').remove();
							}
						</script>
						<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['suffix']){?><?php echo $_smarty_tpl->tpl_vars['meta_data']->value['suffix'];?>
<?php }?>
					</div>
<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['fullpage']){?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php }?><?php }} ?>