<?php
	
	function mainlist_settings($id){
		global $row, $smarty;
		$smarty->assign('object_row', $orow = getRecord($query = "select * from site_settings where deleted=0 limit 1;"));
		$_REQUEST['id'] = $orow['id'];
	}
	
	function editor_settings($id){
		global $row;
		if($_REQUEST['id'] = getRecordField($query = "select id from site_settings where deleted=0 limit 1;"))
			$row = getRecord($query = "select * from site_settings where deleted=0 and id='{$_REQUEST['id']}' limit 1;");
	}
	
	$objects['settings'] = array(
		'meta' => array(
			'access' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'singular' => 'Settings',
			'plural' => 'Settings',
			'table' => 'site_settings',
			'default_sort_field' => 'title',
			'default_sort_order' => 'asc',
			'add' => false,
			'edit' => true,
			'search' => false,
			'details' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'delete' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'fullpage' => false,
			'nopaging' => true,
			'listing' => 'manager/settings.tpl',
			'filter' => "deleted=0"
		),
		'fields' => array(
			'onesignal_app_id' => array(
				'displayname' => 'User Onesignal APP ID',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => true,
				'details' => true,
			),
			'onesignal_api_key' => array(
				'displayname' => 'User Onesignal REST API KEY',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => true,
				'details' => true,
			),
			'title' => array(
				'displayname' => 'Website Title',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
			),
			'email' => array(
				'displayname' => 'Email',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'validation' => 'email',
			),
			'phone' => array(
				'displayname' => 'Phone',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'validation' => 'number',
				'maxlength' > '10',
				'datatype' => 'int'
			),
			'payment_limit' => array(
				'displayname' => 'Minimum Payment for wallet',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'validation' => 'number',
			),
			'withdraw_limit' => array(
				'displayname' => 'Withdraw Limit',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'validation' => 'number',
			),
			'admin_upi' => array(
				'displayname' => 'Admin UPI ID',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
			),
			'logo_imgpath' => array(
				'displayname' => 'Website Logo',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => true,
				'details' => true,
				'input' => 'file',
				'extention' => array('png', 'jpeg', 'jpg'),
				'path' => 'upload/logo/'
			),
			'favicon' => array(
				'displayname' => 'Favicon Icon',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => true,
				'details' => true,
				'input' => 'file',
				'extention' => array('svg', 'png', 'jpg', 'jpeg', 'ico'),
				'path' => 'upload/favicon/'
			),
			'play_store_link' => array(
				'displayname' => 'Google Play Link',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => true,
				'details' => true,
			),
			'terms' => array(
				'displayname' => 'Terms And Conditions',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => true,
				'details' => true,
				'input' => 'cms'
			),
			'terms_url' => array(
				'displayname' => 'Terms And Conditions Link',
				'sort' => false,
				'list' => false,
				'edit' => false,
				'search' => false,
				'details' => false,
			),
			'privacy' => array(
				'displayname' => 'Privacy Policy',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => true,
				'details' => true,
				'input' => 'cms'
			),
			'privacy_url' => array(
				'displayname' => 'Privacy Policy Link',
				'sort' => false,
				'list' => false,
				'edit' => false,
				'search' => false,
				'details' => false,
			),
			'contact_us' => array(
				'displayname' => 'Contact Us',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => true,
				'details' => true,
				'input' => 'cms'
			),
		)
	);
?>
