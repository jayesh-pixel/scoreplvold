<?php
	$objects['wrequests'] = array(
		'meta' => array(
			'access' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'singular' => 'Withdraw Requests',
			'plural' => 'Withdraw Request',
			'table' => 'withdraw_requests',
			'default_sort_field' => 'id',
			'default_sort_order' => 'desc',
			'add' => false,
			'edit' => false,
			'search' => true,
			'details' => true,
			'delete' => true,
			'fullpage' => false,
			'row_actions' => array(
				array(
					'link' => 'javascript: markPaid(ID);',
					'title' => 'Mark Paid',
					'icon' => '',
					'text' => 'Mark Paid',
				)
			),
			'filter' => "deleted=0"
		),
		'fields' => array(
			'userid' => array(
				'displayname' => 'User Name',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => true,
				'details' => true,
				'input' => 'select',
				'options' => DB3::findChildren('user', "name", array(), "usertype='user' and deleted=0"),
				'assoc' => true,
				'validation' => 'required',
			),
			'amount' => array(
				'displayname' => 'Amount',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
				'input' => 'number',
				'validation' => 'required',
			),
			'payment_mode' => array(
				'displayname' => 'Transfer To',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
				'validation' => 'required',
			),
			'paid' => array(
				'displayname' => 'Status',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
				'input' => 'select',
				'options' => array(0 => 'Unpaid', 1 => 'Paid'),
				'assoc' => true,
				'validation' => 'required',
			),
			'dt' => array(
				'displayname' => 'Date',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
				'input' => 'date',
				'validation' => '',
			)
		)
	)
?>