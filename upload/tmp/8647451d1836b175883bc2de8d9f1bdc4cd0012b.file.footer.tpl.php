<?php /* Smarty version Smarty-3.1.13, created on 2024-04-19 13:19:18
         compiled from "/home/u293792719/domains/mtadmin.online/public_html/bhagyalaxmi11/templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1429766851662221fecf2f97-02549746%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8647451d1836b175883bc2de8d9f1bdc4cd0012b' => 
    array (
      0 => '/home/u293792719/domains/mtadmin.online/public_html/bhagyalaxmi11/templates/footer.tpl',
      1 => 1713417483,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1429766851662221fecf2f97-02549746',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'session' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_662221fecf6bd4_30907819',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_662221fecf6bd4_30907819')) {function content_662221fecf6bd4_30907819($_smarty_tpl) {?>		<?php if ($_SESSION[$_smarty_tpl->tpl_vars['session']->value]['userid']&&!strstr($_SERVER['REQUEST_URI'],'terms')&&!strstr($_SERVER['REQUEST_URI'],'privacy')){?>
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