<?php /* Smarty version Smarty-3.1.13, created on 2024-07-10 10:42:57
         compiled from "/home/u293792719/domains/mtadmin.online/public_html/scorepl/templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:570308141668e1859dbafb3-50487283%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30aea1f52f79c86a11064576a3afc1e3249f905a' => 
    array (
      0 => '/home/u293792719/domains/mtadmin.online/public_html/scorepl/templates/footer.tpl',
      1 => 1714819969,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '570308141668e1859dbafb3-50487283',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'session' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_668e1859dbdcd1_80466772',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_668e1859dbdcd1_80466772')) {function content_668e1859dbdcd1_80466772($_smarty_tpl) {?>		<?php if ($_SESSION[$_smarty_tpl->tpl_vars['session']->value]['userid']&&!strstr($_SERVER['REQUEST_URI'],'terms')&&!strstr($_SERVER['REQUEST_URI'],'privacy')){?>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
	<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
        <div class="modal-dialog" role="document ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Popup Header</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true ">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Here is the text coming you can put also image if you want…
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
	$(document).ready(function() {
		pageLoaded();
	});
</script>
</body>
</html><?php }} ?>