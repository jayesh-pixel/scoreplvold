<?php
	// function details_kyc($id){
		// global $session, $smarty;
		// if($id)
		// {
			// $smarty->assign('images', $images = getRecords($query = "select * from news_images where news='{$id}' and deleted=0;"));
			// $smarty->assign('video', getRecords($query = "select * from news_videos where news='{$id}' and deleted=0;"));
		// }
	// }
	
	$objects['kyc'] = array(
		'meta' => array(
			'access' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'singular' => 'KYC',
			'plural' => 'KYC',
			'table' => 'kyc',
			'default_sort_field' => 'id',
			'default_sort_order' => 'asc',
			'add' => false,
			'edit' => false,
			'search' => true,
			'details' => true,
			'delete' => false,
			'fullpage' => true,
			'filter' => "deleted=0",
			'row_actions' => array(
			        array(
    					'link' => "javascript: approveKyc(ID);",
    					'title' => 'Approve',
    					'text' => 'Approve',
    					'icon' => 'fas fa-book'
    				),
			    )
		),
		'fields' => array(
			'userid' => array(
				'displayname' => 'Name',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'input' => 'select',
				'options' => DB3::findChildren('user', "phone", array(), "usertype='user' and deleted=0"),
				'assoc' => true,
				'validation' => 'required',
			),
			'img_pan' => array(
				'displayname' => 'Pan',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => false,
				'details' => true,
				'input' => 'file',
				'validation' => 'required'
			),
			'img_addhar' => array(
				'displayname' => 'Addhar',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => false,
				'details' => true,
				'input' => 'file',
				'validation' => 'required'
			),
			'approved' => array(
				'displayname' => 'Status',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => false,
				'details' => true,
				'input' => 'select',
				'options' => array('1' => 'Approved', 'Pending'),
				'assoc' => true,
				'validation' => 'required'
			),
		)
	);
?>
