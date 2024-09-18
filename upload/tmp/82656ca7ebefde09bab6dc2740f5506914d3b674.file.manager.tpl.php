<?php /* Smarty version Smarty-3.1.13, created on 2024-06-29 17:36:09
         compiled from "/home/u293792719/domains/mtadmin.online/public_html/scorepl/templates/manager.tpl" */ ?>
<?php /*%%SmartyHeaderCode:648515452667ff8b18815a2-79087314%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82656ca7ebefde09bab6dc2740f5506914d3b674' => 
    array (
      0 => '/home/u293792719/domains/mtadmin.online/public_html/scorepl/templates/manager.tpl',
      1 => 1714819969,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '648515452667ff8b18815a2-79087314',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'header' => 0,
    'meta_data' => 0,
    'myId' => 0,
    'i' => 0,
    'object_fields' => 0,
    's_field' => 0,
    'ov' => 0,
    'ok' => 0,
    'status' => 0,
    'session' => 0,
    'records' => 0,
    'url' => 0,
    'tmp' => 0,
    'summary' => 0,
    'summaryIfLessThanNOptions' => 0,
    'object_row' => 0,
    'validationArr' => 0,
    'validationClass' => 0,
    'selected_csv' => 0,
    'cmsfound' => 0,
    'maxlength' => 0,
    'total' => 0,
    'pages' => 0,
    'page_num' => 0,
    'pagesize' => 0,
    'loadEditor' => 0,
    'footer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_667ff8b1978fe9_79840571',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_667ff8b1978fe9_79840571')) {function content_667ff8b1978fe9_79840571($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/home/u293792719/domains/mtadmin.online/public_html/scorepl/scripts/smarty.new/plugins/modifier.replace.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/u293792719/domains/mtadmin.online/public_html/scorepl/scripts/smarty.new/plugins/modifier.date_format.php';
?><?php if (!$_REQUEST['ajax']){?>
<?php echo $_smarty_tpl->tpl_vars['header']->value;?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $_smarty_tpl->tpl_vars['meta_data']->value['plural'];?>
</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php if ($_REQUEST['mode']=='list'){?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
                <div class="card-body">
                	<div class="row">
                    	<div class="col-sm-12 col-md-4">
                        	<h3 class="card-title text-danger"><?php echo $_smarty_tpl->tpl_vars['meta_data']->value['plural'];?>
</h3>
                        </div>
                        <div class="col-sm-12 col-md-8 text-right">
                        	<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['add']){?>
							<a class="icons iadd btn btn-outline-info" <?php if (!$_smarty_tpl->tpl_vars['meta_data']->value['fullpage']){?>onclick="javascript: return toggleEdit('<?php echo $_REQUEST['object_type'];?>
', 0);"<?php }?> href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/<?php echo $_REQUEST['object_type'];?>
?mode=edit" title="Add New <?php echo $_smarty_tpl->tpl_vars['meta_data']->value['singular'];?>
"><i class="fas fa-plus-circle"></i> Add New <?php echo $_smarty_tpl->tpl_vars['meta_data']->value['singular'];?>
</a>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['search']){?>
							<a class="icons isearch btn btn-outline-info" id="anchorSearch_<?php echo $_REQUEST['object_type'];?>
" href="javascript: toggleSearch('<?php echo $_REQUEST['object_type'];?>
');"><i class="fas fa-search"></i>Search <?php echo $_smarty_tpl->tpl_vars['meta_data']->value['plural'];?>
</a>
							<a class="btn btn-outline-info" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/<?php echo $_REQUEST['object_type'];?>
"><i class="fas fas fa-street-view"></i>View All <?php echo $_smarty_tpl->tpl_vars['meta_data']->value['plural'];?>
</a>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['actions']){?>
								<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['meta_data']->value['actions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
							<a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/<?php echo $_REQUEST['object_type'];?>
?action=<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" class="btn btn-outline-info"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</a>
								<?php } ?>
							<?php }?>
                        </div>
	                </div>
				</div>
			</div>
		</div>
	</div>
<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['search']){?>
	<div class="row" id="divSearch_<?php echo $_REQUEST['object_type'];?>
" style="display: none;">
		<div class="col-12">
			<div class="card">
				<div class="row p-2">
					<div class="col-sm-12 col-md-6">
						<h3 class="card-title text-danger">
						Search <?php echo $_smarty_tpl->tpl_vars['meta_data']->value['plural'];?>

						</h3>
					</div>
					<div class="col-sm-12 col-md-6">
						<a href="javascript: void(0);" class="float-right p-2" onclick="javascript: $('#searchform .advanced').toggleClass('hide');"><i class="fas fa-search"></i> Advanced Search</a>
					</div>
				</div>
                <div class="card-body border-top">
					<div class="row">
						<div class="col-md-6" style="margin:0 auto;">
							<form name="searchform" id="searchform" method="post" onsubmit="javascript:return false;" class="form-horizontal">
								<div class="card-body">
								<input type="hidden" name="search" value="1" />
								<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['object_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
									<?php if ($_smarty_tpl->tpl_vars['i']->value['search']){?>
									<?php $_smarty_tpl->tpl_vars["s_field"] = new Smarty_variable("s_{".((string)$_smarty_tpl->tpl_vars['myId']->value)."}", null, 0);?>
									<div class="form-group row <?php if ($_smarty_tpl->tpl_vars['i']->value['search']==="advanced"){?>hide advanced<?php }?>">
										<label class="col-sm-3 text-right control-label col-form-label"><?php echo $_smarty_tpl->tpl_vars['i']->value['displayname'];?>
</label>
										
										<div class="col-sm-9">
	                                        <?php if ($_smarty_tpl->tpl_vars['i']->value['input']=='date'||$_smarty_tpl->tpl_vars['i']->value['input']=='currency'){?>
											<?php $_smarty_tpl->tpl_vars["s_field"] = new Smarty_variable("s_{".((string)$_smarty_tpl->tpl_vars['myId']->value)."}_from", null, 0);?>
											<input type="text" class="form-control" spellcheck="false" value="<?php echo $_REQUEST[$_smarty_tpl->tpl_vars['s_field']->value];?>
" name="s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
_from" id="s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
_from" /> &nbsp;&nbsp; To &nbsp;&nbsp;
											<?php $_smarty_tpl->tpl_vars["s_field"] = new Smarty_variable("s_{".((string)$_smarty_tpl->tpl_vars['myId']->value)."}_to", null, 0);?>
											<input type="text" class="form-control" spellcheck="false" value="<?php echo $_REQUEST[$_smarty_tpl->tpl_vars['s_field']->value];?>
" name="s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
_to" id="s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
_to" />
											<?php if ($_smarty_tpl->tpl_vars['i']->value['input']=='date'){?>
					<script type="text/javascript">
						$(document).ready(function() {
							$("#s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
_from, #s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
_to").css('width', '200px').datepicker({
								format: 'yyyy-mm-dd',
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
											<?php }?>
										<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='select'){?>
											<select name="s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" class="form-control">
												<option value="">Any</option>
											<?php  $_smarty_tpl->tpl_vars['ov'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ov']->_loop = false;
 $_smarty_tpl->tpl_vars['ok'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['i']->value['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['ov']->key => $_smarty_tpl->tpl_vars['ov']->value){
$_smarty_tpl->tpl_vars['ov']->_loop = true;
 $_smarty_tpl->tpl_vars['ok']->value = $_smarty_tpl->tpl_vars['ov']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
												<?php if ($_smarty_tpl->tpl_vars['ov']->value){?>
												<option value="<?php if ($_smarty_tpl->tpl_vars['ok']->value!=$_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['index']||$_smarty_tpl->tpl_vars['i']->value['assoc']){?><?php echo $_smarty_tpl->tpl_vars['ok']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['ov']->value;?>
<?php }?>"><?php echo $_smarty_tpl->tpl_vars['ov']->value;?>
</option>
												<?php }?>
											<?php } ?>
											</select>
					<script type="text/javascript">selectValue("s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
", "<?php echo $_REQUEST[$_smarty_tpl->tpl_vars['s_field']->value];?>
");</script>
										<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='month'){?>
											<select name="s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" class="form-control">
												<option value="">Any</option>
											<?php echo $_smarty_tpl->getSubTemplate ("include/months.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

											</select>
					<script type="text/javascript">selectValue("s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
", "<?php echo $_REQUEST[$_smarty_tpl->tpl_vars['s_field']->value];?>
");</script>
										<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='textarea'){?>
											<textarea name="s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" class="form-control"><?php echo $_REQUEST[$_smarty_tpl->tpl_vars['s_field']->value];?>
</textarea>
										<?php }else{ ?>
											<input type="text" class="form-control" spellcheck="false" value="<?php echo $_REQUEST[$_smarty_tpl->tpl_vars['s_field']->value];?>
" name="s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" id="s_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" />
										<?php }?>
	                                    </div>
									</div>
									<?php }?>
								<?php } ?>
									<div class="form-group row hide advanced">
										<label class="col-sm-3 text-right control-label col-form-label">Order by:</td>
										</label>
										<div class="col-sm-9">
											<div class="row">
												<div class="col-sm-12 col-md-6">
													<select name="orderby" id="orderby" class="form-control">
													<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['object_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
														<?php if ($_smarty_tpl->tpl_vars['i']->value['sort']){?>
														<option value="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['displayname'];?>
</option>
														<?php }?>
													<?php } ?>
													</select>
												</div>
												<div class="col-sm-12 col-md-6">
													<select name="order" id="order" class="form-control">
														<option value="asc">Ascending</option>
														<option value="desc">Descending</option>
													</select>
											</div>
											</div>
										</div>
									</div>
								</div>
								<div class="border-top">
									<div class="card-body text-center">
										<button type="submit" class="btn btn-success icons search" name="search"><i class="fas fa-search"></i>Search</button>
										<button type="reset" name="discard" class="btn btn-primary icons reset" onclick="javascript:toggleSearch('<?php echo $_REQUEST['object_type'];?>
');">Close</button>
										
										<button type="reset" name="discard" class="btn btn-danger icons reset" onclick="javascript:resetSearchPaging('<?php echo $_REQUEST['object_type'];?>
');">Reset</button>
									</div>
								</div>
							</form>
						</div>
                	</div>
				</div>
			</div>
		</div>
	</div>
<?php }?>
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
                <div class="card-body">
                	<div class="row">
                		<div class="table-responsive">
                    	<div id="msgBox">
					        <?php if ($_smarty_tpl->tpl_vars['status']->value){?>
					        <div class="success alert alert-success"><?php echo $_smarty_tpl->tpl_vars['meta_data']->value['singular'];?>
 has been <?php echo $_smarty_tpl->tpl_vars['status']->value;?>
 successfully</div>
					        <?php }elseif($_SESSION[$_smarty_tpl->tpl_vars['session']->value]['status']){?>
					        <div class="success alert alert-success"><?php echo $_SESSION[$_smarty_tpl->tpl_vars['session']->value]['status'];?>
</div>
					        <?php }?>
					    </div>
					    <?php if (!$_smarty_tpl->tpl_vars['meta_data']->value['fullpage']&&($_smarty_tpl->tpl_vars['meta_data']->value['add']||$_smarty_tpl->tpl_vars['meta_data']->value['edit'])){?>
						<div id="divEdit_<?php echo $_REQUEST['object_type'];?>
" class="hide popup_div"></div>
						<?php }?>
						<div id="items_<?php echo $_REQUEST['object_type'];?>
">
	<?php }?>
<?php }else{ ?>
	<?php if ($_smarty_tpl->tpl_vars['status']->value){?>
<script type="text/javascript">
showNotification('<?php echo $_smarty_tpl->tpl_vars['meta_data']->value['singular'];?>
 has been <?php echo $_smarty_tpl->tpl_vars['status']->value;?>
 successfully', 'success');
</script>
<?php }?>
<?php }?>
<?php if ($_REQUEST['mode']=='list'){?>
	<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['listing']){?>
		<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['meta_data']->value['listing'], $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php }else{ ?>
							<table class="table table-striped table-bordered list list_<?php echo $_REQUEST['object_type'];?>
" id="tblObjects">
								<thead>
	                                <tr>
									<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['object_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
										<?php if ($_smarty_tpl->tpl_vars['i']->value['list']){?>
										<th class="<?php echo $_REQUEST['object_type'];?>
_<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" align="left" index="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
">
											<?php if ($_smarty_tpl->tpl_vars['i']->value['sort']){?>
											<a class="sort" sortindex="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
" href="javascript:void(0);" onclick="javascript:sortPaging('<?php echo $_REQUEST['object_type'];?>
', '<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
');"><?php echo $_smarty_tpl->tpl_vars['i']->value['displayname'];?>
</a>
											<?php }else{ ?>
												<?php echo $_smarty_tpl->tpl_vars['i']->value['displayname'];?>

											<?php }?>
										</th>
										<?php }?>
									<?php } ?>
										<th class="c">Controls</th>
									</tr>
	                            </thead>
	                            <tbody>
	                                <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["i"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['name'] = "i";
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['records']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["i"]['total']);
?>
									<tr valign="middle" id="<?php echo $_REQUEST['object_type'];?>
<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['meta_data']->value['edit']){?>title="Edit <?php echo $_smarty_tpl->tpl_vars['meta_data']->value['singular'];?>
"<?php }?>>
									<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['object_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
										<?php if ($_smarty_tpl->tpl_vars['i']->value['list']){?>
										<td <?php if ($_smarty_tpl->tpl_vars['i']->value['title']){?>title="<?php echo $_smarty_tpl->tpl_vars['i']->value['title'];?>
"<?php }?>>
											<?php echo $_smarty_tpl->tpl_vars['i']->value['prefix'];?>

											<?php if ($_smarty_tpl->tpl_vars['i']->value['input']=='image'){?>
											<a target="_blank" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value];?>
"><img src="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value];?>
" height="40px" /></a>
											<?php }elseif($_smarty_tpl->tpl_vars['i']->value['url']){?>
												<?php if ($_smarty_tpl->tpl_vars['i']->value['url']=='self'){?>
											<a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value];?>
</a>
												<?php }else{ ?>
													<?php $_smarty_tpl->tpl_vars['url'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value['url'], null, 0);?>
											<a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['url']->value];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value];?>
</a>
												<?php }?>
											<?php }elseif($_smarty_tpl->tpl_vars['i']->value['link']){?>
											<a href="<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['i']->value['link'],'ID',$_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']);?>
"><?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value];?>
</a>
											<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='file'&&$_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value]){?>
											<div class="el-card-item">
												<div class="el-card-avatar el-overlay-1">
													<a class="btn default btn-outline image-popup-vertical-fit el-link" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value];?>
">
														<img src="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value];?>
" style="max-width:100px; margin: 0 auto;" />
													</a>
				                                </div>
			                                </div>
											<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='month'){?>
											<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value],$_smarty_tpl->getConfigVariable('format_month'));?>

											<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='date'){?>
											<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value],$_smarty_tpl->getConfigVariable('format_date'));?>

											<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='datetime'){?>
											<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value],$_smarty_tpl->getConfigVariable('format_datetime'));?>

											<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='checkbox'){?>
						    					<?php $_smarty_tpl->tpl_vars['tmp'] = new Smarty_variable($_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value], null, 0);?>
						                        <?php if ($_smarty_tpl->tpl_vars['i']->value['options'][$_smarty_tpl->tpl_vars['tmp']->value]){?><?php echo $_smarty_tpl->tpl_vars['i']->value['options'][$_smarty_tpl->tpl_vars['tmp']->value];?>
<?php }elseif($_smarty_tpl->tpl_vars['i']->value['label']&&$_smarty_tpl->tpl_vars['tmp']->value){?><?php echo $_smarty_tpl->tpl_vars['i']->value['label'];?>
<?php }else{ ?><?php }?>
											<?php }elseif($_smarty_tpl->tpl_vars['myId']->value=='userid'&&$_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['userid_id']){?>
												<a href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/customers?id=<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['userid_id'];?>
&mode=details"><?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value];?>
</a>
											<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='select'){?>
											<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value];?>

											<?php }else{ ?>
												<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->tpl_vars['myId']->value];?>

											<?php }?>
											<?php echo $_smarty_tpl->tpl_vars['i']->value['suffix'];?>

										</td>
										<?php }?>
									<?php } ?>
										<td align="center">
											<?php $_smarty_tpl->tpl_vars["added_by"] = new Smarty_variable(intval($_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['added_by']), null, 0);?>
											<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['details']){?>
											<a class="icons idetails btn btn-outline-info"  data-toggle="modal" href="javascript:void(0);" onclick="javascript: return bpopup('<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/<?php echo $_REQUEST['object_type'];?>
?mode=details&id=<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
<?php if (!$_smarty_tpl->tpl_vars['meta_data']->value['fullpage']){?>&popup=true<?php }?>', '<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
');" title="<?php echo $_smarty_tpl->tpl_vars['meta_data']->value['singular'];?>
 Details"><i class="fas fa-info-circle"></i></a>
											<?php }?>
											<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['edit']){?>
											
											<a class="icons iedit btn btn-outline-info" <?php if (!$_smarty_tpl->tpl_vars['meta_data']->value['fullpage']){?>onclick="javascript: return toggleEdit('<?php echo $_REQUEST['object_type'];?>
', '<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
');"<?php }?> href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/<?php echo $_REQUEST['object_type'];?>
?mode=edit&id=<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
<?php if (!$_smarty_tpl->tpl_vars['meta_data']->value['fullpage']){?>&popup=true<?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['meta_data']->value['singular'];?>
 Editor"><i class="fas fa-edit"></i></a>
											<?php }?>
											<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['delete']){?>
											
											<a class="icons idelete btn btn-outline-info" href="javascript:void(0);" onclick="javascript: deleteRecord('<?php echo $_REQUEST['object_type'];?>
', '<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/<?php echo $_REQUEST['object_type'];?>
?mode=delete&id=<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
', '<?php echo $_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
');" title="Delete <?php echo $_smarty_tpl->tpl_vars['meta_data']->value['singular'];?>
"><i class="fas fa-trash"></i></a>
											<?php }?>
											<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['row_actions']){?>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['k'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['k']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['name'] = 'k';
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['meta_data']->value['row_actions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['total']);
?>
												<a style="<?php echo $_smarty_tpl->tpl_vars['meta_data']->value['row_actions'][$_smarty_tpl->getVariable('smarty')->value['section']['k']['index']]['style'];?>
" class="btn btn-outline-info" href="<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['meta_data']->value['row_actions'][$_smarty_tpl->getVariable('smarty')->value['section']['k']['index']]['link'],'ID',$_smarty_tpl->tpl_vars['records']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id']);?>
" title="<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['row_actions'][$_smarty_tpl->getVariable('smarty')->value['section']['k']['index']]['title']){?><?php echo $_smarty_tpl->tpl_vars['meta_data']->value['row_actions'][$_smarty_tpl->getVariable('smarty')->value['section']['k']['index']]['title'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['meta_data']->value['row_actions'][$_smarty_tpl->getVariable('smarty')->value['section']['k']['index']]['text'];?>
<?php }?>" target="<?php echo $_smarty_tpl->tpl_vars['meta_data']->value['row_actions'][$_smarty_tpl->getVariable('smarty')->value['section']['k']['index']]['target'];?>
"><i class="<?php echo $_smarty_tpl->tpl_vars['meta_data']->value['row_actions'][$_smarty_tpl->getVariable('smarty')->value['section']['k']['index']]['icon'];?>
" ></i><?php echo $_smarty_tpl->tpl_vars['meta_data']->value['row_actions'][$_smarty_tpl->getVariable('smarty')->value['section']['k']['index']]['text'];?>
</a>
												<?php endfor; endif; ?>
											<?php }?>
										</td>
									</tr>
									<?php endfor; else: ?>
									<tr><td colspan="10" class="fail alert">No <?php echo $_smarty_tpl->tpl_vars['meta_data']->value['singular'];?>
 found</td></tr>
									<?php endif; ?>
	                        	</tbody>
	                    	</table>
						</div>
	<?php if ($_smarty_tpl->tpl_vars['summary']->value){?>
	<script type="text/javascript">
		summaryLimit = parseInt('<?php echo $_smarty_tpl->tpl_vars['summaryIfLessThanNOptions']->value;?>
');
		summary = <?php echo $_smarty_tpl->tpl_vars['summary']->value;?>
;
		console.debug(summary);
		renderSummaryRow();
	</script>
	<?php }?>
	<?php if (!$_smarty_tpl->tpl_vars['meta_data']->value['details']&&!$_smarty_tpl->tpl_vars['meta_data']->value['edit']&&!$_smarty_tpl->tpl_vars['meta_data']->value['delete']){?>
	<style type="text/css">
		table.list_<?php echo $_REQUEST['object_type'];?>
 th:last-child, table.list_<?php echo $_REQUEST['object_type'];?>
 td:last-child {
			display:none;
		}
	</style>
	<?php }?>
	<?php }?>
	<script type="text/javascript">
		//bindEditRow('<?php echo $_REQUEST['object_type'];?>
', <?php if ($_smarty_tpl->tpl_vars['meta_data']->value['edit']){?>true<?php }else{ ?>false<?php }?>, '<?php echo $_smarty_tpl->tpl_vars['meta_data']->value['fullpage'];?>
');
	</script>
                	</div>
                </div>
                <?php if (!$_REQUEST['ajax']){?>
					<?php if ($_REQUEST['mode']=='list'){?>
					<div class="admin row pt-3" id="div_paging_<?php echo $_REQUEST['object_type'];?>
"></div>
					<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['suffix']){?><?php echo $_smarty_tpl->tpl_vars['meta_data']->value['suffix'];?>
<?php }?>
					<?php }?>
				<?php }?>
            </div>
		</div>
	</div>
</div>

<?php }elseif($_REQUEST['mode']=='details'){?>
	<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['viewer']){?>
		<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['meta_data']->value['viewer'], $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php }else{ ?>
	<div class="modal-header">
        <h3 class="text-danger modal-title"><?php echo $_smarty_tpl->tpl_vars['meta_data']->value['singular'];?>
 Details</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true ">&times;</span>
        </button>
    </div>
    <div class="modal-body">
    	<div class="row">
			<div class="col-12">
				<div class="card">
	                <div class="card-body">
	                	<div class="row">
	                		<div class="table-responsive">
								<table class="table table-striped table-bordered list">
									<?php if (!in_array('id',array_keys($_smarty_tpl->tpl_vars['object_fields']->value))){?>
									<tr>
										<td>ID</td>
										<td><?php echo $_smarty_tpl->tpl_vars['object_row']->value['id'];?>
</td>
									</tr>
									<?php }?>
								<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['object_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
									<?php if ($_smarty_tpl->tpl_vars['i']->value['details']&&($_smarty_tpl->tpl_vars['i']->value['displayname']||$_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value])){?>
									<tr>
										<td><?php echo $_smarty_tpl->tpl_vars['i']->value['displayname'];?>
</td>
										<td>
											<?php if ($_smarty_tpl->tpl_vars['i']->value['input']=='image'){?>
											<a target="_blank" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>
"><img src="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>
" height="40px" /></a>
											<?php }else{ ?>
												<?php if ($_smarty_tpl->tpl_vars['i']->value['input']=='month'){?>
											<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value],$_smarty_tpl->getConfigVariable('format_month'));?>

												<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='date'){?>
											<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value],$_smarty_tpl->getConfigVariable('format_date'));?>

												<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='datetime'){?>
											<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value],$_smarty_tpl->getConfigVariable('format_datetime'));?>

												<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='file'&&$_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value]){?>
											<a class="download" target="_blank" href="<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>
"><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value],$_smarty_tpl->tpl_vars['i']->value['path'],'');?>
</a>
												<?php }elseif($_smarty_tpl->tpl_vars['i']->value['input']=='cms'||$_smarty_tpl->tpl_vars['i']->value['input']=='textarea'){?>
											<?php echo nl2br(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value]));?>

												<?php }else{ ?>
											<?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>

												<?php }?>
											<?php }?>
										</td>
									</tr>
									<?php }?>
								<?php } ?>
								</table>
								<div class="border-top">
									<div class="card-body text-right">
										<input type="button" class="icons discard btn btn-danger" name="discard" value="Close" data-dismiss="modal" aria-label="Close" />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo $_smarty_tpl->tpl_vars['object_row']->value['_details'];?>

	</div>
	<?php }?>
<?php }else{ ?>
	<?php $_smarty_tpl->tpl_vars['cmsfound'] = new Smarty_variable('', null, 0);?>
	<?php if ($_REQUEST['reload']=='true'){?>
<script type="text/javascript">
	self.parent.pagingReload('<?php echo $_REQUEST['object_type'];?>
');
</script>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['editor']){?>
		<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['meta_data']->value['editor'], $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php }else{ ?>
	<?php if ($_smarty_tpl->tpl_vars['meta_data']->value['fullpage']){?>
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
" type="file">
										</div>
										<script>
											var initialPreviewVideo = new Array();
											var initialPreviewConfigVideo = new Array();
											initialPreviewVideo.push("<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
<?php echo $_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value];?>
");
											initialPreviewConfigVideo.push({caption: "<?php echo basename($_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value]);?>
", size: 329892, width: "120px", key: 1});
										</script> 
                                        <script>
											$(document).ready(function() {
												$("#<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
").fileinput({
											        theme: 'fas',
											        allowedFileExtensions: ['jpeg', 'jpg', 'png', 'gif', 'webp'],
											        overwriteInitial: true,
											        maxFileSize: 1000,
											        maxFilesNum: 10,
											        showUploadStats: false,
									        		uploadIcon: false,
									        		showUpload: false,
											        //allowedFileTypes: ['image', 'video', 'flash'],
											        slugCallback: function (filename) {
											            return filename.replace('(', '_').replace(']', '_');
											        },
		        									initialPreviewAsData: true,
											        initialPreview: initialPreviewVideo,
											        initialPreviewConfig: initialPreviewConfigVideo,
											    });
											});
										</script>
												<?php if (!$_smarty_tpl->tpl_vars['object_row']->value[$_smarty_tpl->tpl_vars['myId']->value]){?><?php if (strstr($_smarty_tpl->tpl_vars['i']->value['validation'],'required')){?><div id="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
_err">You must upload a file</div><?php }?><?php }?>
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
" <?php if (in_array($_smarty_tpl->tpl_vars['ok']->value,$_smarty_tpl->tpl_vars['selected_csv']->value)){?>checked<?php }?>>
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
												<input type="text" class="form-control <?php echo $_smarty_tpl->tpl_vars['validationClass']->value;?>
" maxlength="<?php if ($_smarty_tpl->tpl_vars['i']->value['maxlength']){?><?php echo $_smarty_tpl->tpl_vars['i']->value['maxlength'];?>
<?php }else{ ?>128<?php }?>" spellcheck="false" name="<?php echo $_smarty_tpl->tpl_vars['myId']->value;?>
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
								changeYear: true,
								changeMonth: true,
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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
	<?php }?>
<script type="text/javascript">
	try {
		$('#frmEdit_<?php echo $_REQUEST['object_type'];?>
').validate();
		
		callInputMask();
		if(typeof(init<?php echo $_REQUEST['object_type'];?>
Editor) != "undefined")
			setTimeout("init<?php echo $_REQUEST['object_type'];?>
Editor();", 0);
	} catch(e) { }
</script>
<?php }?>

<script type="text/javascript">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['maxlength']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
	charLength($e('<?php echo $_smarty_tpl->tpl_vars['maxlength']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']];?>
'));
<?php endfor; endif; ?>
</script>
<script type="text/javascript">
	hideListingWhileEditing = true;
	<?php if (!$_smarty_tpl->tpl_vars['meta_data']->value['nopaging']&&$_REQUEST['mode']=='list'){?>
	initPaging('div_paging_<?php echo $_REQUEST['object_type'];?>
', '<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['pages']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['page_num']->value;?>
', '<?php echo $_smarty_tpl->getConfigVariable('server_url');?>
manager/<?php echo $_REQUEST['object_type'];?>
<?php if ($_REQUEST['params']){?>?params=<?php echo $_REQUEST['params'];?>
<?php }?>', 'items_<?php echo $_REQUEST['object_type'];?>
', '<?php echo $_smarty_tpl->tpl_vars['meta_data']->value['plural'];?>
', '<?php echo $_smarty_tpl->tpl_vars['pagesize']->value;?>
', ($e('searchform')?'searchform':null), '<?php if ($_REQUEST['orderby']){?><?php echo $_REQUEST['orderby'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['meta_data']->value['default_sort_field'];?>
<?php }?>', '<?php if ($_REQUEST['order']){?><?php echo $_REQUEST['order'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['meta_data']->value['default_sort_order'];?>
<?php }?>', '<?php echo $_REQUEST['object_type'];?>
', 3, false, <?php if ($_REQUEST['ajax']){?>true<?php }else{ ?>false<?php }?>);
	<?php }?>
</script>
<?php if (!$_REQUEST['ajax']){?>
	<?php if ($_smarty_tpl->tpl_vars['loadEditor']->value){?>
<script type="text/javascript">
	window.onload = function() {
		setTimeout("toggleEdit('<?php echo $_REQUEST['object_type'];?>
', '<?php echo $_REQUEST['id'];?>
');", 200);
	};
</script>
	<?php }?>
	<?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

<?php }?><?php }} ?>