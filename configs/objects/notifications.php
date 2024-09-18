<?php
	function edit_notifications($id){
	    if($_REQUEST['title'])
	    {
    	    require_once(BASE_PATH . "content/fcm.php");
            $fcm = new FCM();
            $fcm->send_notification(array($_REQUEST));
	    }
	}
	
	$objects['notifications'] = array(
		'meta' => array(
			'access' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'singular' => 'Notification',
			'plural' => 'Notifications',
			'table' => 'notifications',
			'default_sort_field' => 'id',
			'default_sort_order' => 'desc',
			'add' => true,
			'edit' => true,
			'search' => true,
			'details' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'delete' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'fullpage' => false,
			'nopaging' => true,
			'filter' => "deleted=0"
		),
		'fields' => array(
			'id' => array(
				'displayname' => 'ID',
				'sort' => false,
				'list' => false,
				'edit' => false,
				'search' => false,
				'details' => false,
			),    
			'title' => array(
				'displayname' => 'Title',
				'sort' => true,
				'list' => true,
				'edit' => (!@$_REQUEST['id']),
				'search' => true,
				'details' => true,
				'validation' => 'required'
			),
			'message' => array(
				'displayname' => 'Message',
				'sort' => true,
				'list' => false,
				'edit' => (!@$_REQUEST['id']),
				'search' => false,
				'details' => true,
				'input' => 'textarea',
				'rows' => 5,
				'validation' => 'required'
			),
			'sent' => array(
				'displayname' => 'Status',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => true,
				'details' => true,
				'input' => 'select',
				'options' => array('1' => 'Sent', '0' => 'Not Sent')
			),
			'dt' => array(
				'displayname' => 'Date',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
				'input' => 'date',
			),
		)
	);
?>
