<?php /* Smarty version Smarty-3.1.13, created on 2023-10-21 13:31:37
         compiled from "/home/u233274077/domains/adminapp.tech/public_html/crickapp/templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:112683094565338561f2aa61-80000964%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b715d11f9b35d2d86e789b316a12aa067c55bb9a' => 
    array (
      0 => '/home/u233274077/domains/adminapp.tech/public_html/crickapp/templates/footer.tpl',
      1 => 1685446569,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '112683094565338561f2aa61-80000964',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'session' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_65338561f2f113_78978824',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65338561f2f113_78978824')) {function content_65338561f2f113_78978824($_smarty_tpl) {?>		<?php if ($_SESSION[$_smarty_tpl->tpl_vars['session']->value]['userid']&&!strstr($_SERVER['REQUEST_URI'],'terms')&&!strstr($_SERVER['REQUEST_URI'],'privacy')){?>
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