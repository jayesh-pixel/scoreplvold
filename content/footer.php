<?php
	if(@$_REQUEST['ajax'] || @$_REQUEST['byajax'])
		$smarty->assign('footer', '');
	else
		$smarty->assign('footer', $smarty->fetch('footer.tpl'));
?>