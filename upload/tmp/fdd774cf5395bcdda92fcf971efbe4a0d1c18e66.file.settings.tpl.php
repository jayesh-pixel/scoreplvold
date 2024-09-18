<?php /* Smarty version Smarty-3.1.13, created on 2024-04-18 10:56:50
         compiled from "/home/u293792719/domains/mtadmin.online/public_html/bhagyalaxmi11/templates/manager/settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4409943666620af1a1fc4e7-73380290%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fdd774cf5395bcdda92fcf971efbe4a0d1c18e66' => 
    array (
      0 => '/home/u293792719/domains/mtadmin.online/public_html/bhagyalaxmi11/templates/manager/settings.tpl',
      1 => 1713417483,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4409943666620af1a1fc4e7-73380290',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'meta_data' => 0,
    'object_fields' => 0,
    'i' => 0,
    'validationArr' => 0,
    'myId' => 0,
    'object_row' => 0,
    'validationClass' => 0,
    'ok' => 0,
    'selected_csv' => 0,
    'ov' => 0,
    'cmsfound' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_6620af1a25e543_07486554',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6620af1a25e543_07486554')) {function content_6620af1a25e543_07486554($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['meta_data']->value['fullpage']){?>
	<?php }?>
						<div class="col-md-8">
							<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['prefix']){?><?php echo $_smarty_tpl->tpl_vars['meta_data']->value['prefix'];?>
<?php }?>
							<form class="form-horizontal" name="form" id="frmEdit_<?php echo $_REQUEST['object_type'];?>
" action="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/<?php echo $_REQUEST['object_type'];?>
?mode=edit" method="post" enctype="multipart/form-data"<?php if (!$_REQUEST['ajax']){?> <?php }?>>
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
									<?php $_smarty_tpl->tpl_vars["validationArr"] = new Smarty_variable(explode(",",$_smarty_tpl->tpl_vars['i']->value['validation']), null, 0);?>
									<?php $_smarty_tpl->tpl_vars["validationClass"] = new Smarty_variable(implode(" ",$_smarty_tpl->tpl_vars['validationArr']->value), null, 0);?>
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
											<div class="file-loading">
											    <input id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" type="file" <?php if (!$_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value]&&$_smarty_tpl->tpl_vars['i']->value['validation']){?>class="required"<?php }?>>
											</div>
		                                        <script>
													$(document).ready(function() {
														$("#<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
").fileinput({
													        theme: 'fas',
													        allowedFileExtensions: ('<?php echo $_smarty_tpl->tpl_vars['i']->value['exts'];?>
'?'<?php echo $_smarty_tpl->tpl_vars['i']->value['exts'];?>
'.split(','):['jpeg', 'jpg', 'png', 'gif']),
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
												<?php if (!$_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value]){?><?php if (strstr($_smarty_tpl->tpl_vars['i']->value['validation'],'required')){?>
												<div id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
_err">You must upload a file</div>
												<?php }?>
											<?php }?>
											<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='textarea'||$_smarty_tpl->tpl_vars['i']->value['input']=='cms'){?>
												<textarea class="form-control <?php echo $_smarty_tpl->tpl_vars['validationClass']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" validation="<?php if (strstr($_smarty_tpl->tpl_vars['i']->value['validation'],'required')){?>required<?php }?>" <?php if ($_smarty_tpl->tpl_vars['i']->value['rows']){?>rows="<?php echo $_smarty_tpl->tpl_vars['i']->value['rows'];?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['i']->value['cols']){?>cols="<?php echo $_smarty_tpl->tpl_vars['i']->value['cols'];?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['i']->value['title']){?>title="<?php echo $_smarty_tpl->tpl_vars['i']->value['title'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>
</textarea>
												<div class="info" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
_length"></div>
												<?php if ($_smarty_tpl->tpl_vars['i']->value['input']=='cms'){?>
												<input type="hidden" name="tagged[]" value="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" />
													<?php $_smarty_tpl->tpl_vars["cmsfound"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['cmsfound']->value).",".((string)$_smarty_tpl->tpl_vars['myId']->value), null, 0);?>
												<?php }?>
											<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='checkbox'&&$_smarty_tpl->tpl_vars['i']->value['type']=='csv'){?>
												<?php if ($_smarty_tpl->tpl_vars['i']->value['resize_array']==1){?>
												<div class="custom-control custom-checkbox mr-sm-2">
													<input type="checkbox" class="custom-control-input <?php echo $_smarty_tpl->tpl_vars['validationClass']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
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
													<input type="checkbox" class="custom-control-input <?php echo $_smarty_tpl->tpl_vars['validationClass']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
[]" id="cb_<?php echo $_smarty_tpl->tpl_vars['ok']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['ok']->value;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['ok']->value,$_smarty_tpl->tpl_vars['selected_csv']->value)){?>checked<?php }?>>
		                                            <label class="custom-control-label" for="cb_<?php echo $_smarty_tpl->tpl_vars['ok']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['ov']->value;?>
</label>
		                                        </div>
												<?php }
if (!$_smarty_tpl->tpl_vars['ov']->_loop) {
?>
												<div class="custom-control custom-checkbox mr-sm-2">
													<input type="checkbox" class="custom-control-input <?php echo $_smarty_tpl->tpl_vars['validationClass']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
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
													<input type="checkbox" class="custom-control-input <?php echo $_smarty_tpl->tpl_vars['validationClass']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
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
													<input type="checkbox" class="custom-control-input <?php echo $_smarty_tpl->tpl_vars['validationClass']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['ok']->value;?>
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
													<input type="checkbox" class="custom-control-input <?php echo $_smarty_tpl->tpl_vars['validationClass']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
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
		                                            <input type="radio" class="custom-control-input <?php echo $_smarty_tpl->tpl_vars['validationClass']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
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
" class="form-control <?php echo $_smarty_tpl->tpl_vars['validationClass']->value;?>
">
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
													<select class="form-control <?php echo $_smarty_tpl->tpl_vars['validationClass']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
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
											<input type="password" class="form-control <?php echo $_smarty_tpl->tpl_vars['validationClass']->value;?>
" spellcheck="false" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" value="" validation="<?php if (!$_REQUEST['id']){?><?php echo $_smarty_tpl->tpl_vars['i']->value['validation'];?>
<?php }?>" />
											<?php }else{ ?>
												<input type="text" class="form-control <?php echo $_smarty_tpl->tpl_vars['validationClass']->value;?>
" maxlength="<?php if ($_smarty_tpl->tpl_vars['i']->value['maxlength']){?><?php echo $_smarty_tpl->tpl_vars['i']->value['maxlength'];?>
<?php }else{ ?>128<?php }?>" <?php if ($_smarty_tpl->tpl_vars['i']->value['max']){?>max="<?php echo $_smarty_tpl->tpl_vars['i']->value['max'];?>
"<?php }?> spellcheck="false" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>
" validation="<?php if (strstr($_smarty_tpl->tpl_vars['i']->value['validation'],'required')){?>required<?php }?>" <?php if ($_smarty_tpl->tpl_vars['i']->value['title']){?>title="<?php echo $_smarty_tpl->tpl_vars['i']->value['title'];?>
"<?php }?> />
												<?php if ($_smarty_tpl->tpl_vars['i']->value['input']=='date'){?>
					<script type="text/javascript">
						$(document).ready(function(){
							<?php if ($_smarty_tpl->tpl_vars['i']->value['todate']&&$_smarty_tpl->tpl_vars['i']->value['range']=='future'){?>
							$("#<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
").datepicker({
							  startDate: new Date(),
							  format: 'yyyy-mm-dd',
							}).on('changeDate',function(e){
								var newDate=new Date();
							  newDate.setDate(e.date.getDate()+1);
							  $("#<?php echo $_smarty_tpl->tpl_vars['i']->value['todate'];?>
").datepicker('setDate',newDate);
							  $("#<?php echo $_smarty_tpl->tpl_vars['i']->value['todate'];?>
").datepicker('setStartDate',e.date);
							});
							<?php }else{ ?>
							$("#<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
").css('width', '200px').datepicker({
								format: 'yyyy-mm-dd',
								<?php if ($_smarty_tpl->tpl_vars['i']->value['range']=='past'){?>
								minDate:'-20Y',
								maxDate:'+0d'
								<?php }elseif($_smarty_tpl->tpl_vars['i']->value['range']=='future'){?>
								startDate: new Date(),
								minDate:'+0d',
								maxDate:'+20Y'
								<?php }?>
							});
							<?php }?>
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
<?php if ($_smarty_tpl->tpl_vars['i']->value['readonly']){?>
<script type="text/javascript">
	$("#<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
").attr('readonly', 'readonly');
</script>
<?php }?>
								<?php } ?>
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
							<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['suffix']){?><?php echo $_smarty_tpl->tpl_vars['meta_data']->value['suffix'];?>
<?php }?>
						</div>
<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['fullpage']){?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['cmsfound']->value){?>
<script type="text/javascript">
var cms = '<?php echo $_smarty_tpl->tpl_vars['cmsfound']->value;?>
';
cms = cms.split(',');
for(i=0;i<cms.length;i++)
	if(cms[i])
		myEditor("#" + cms[i], '724', '350');
</script>
<?php }?>
<?php }} ?>