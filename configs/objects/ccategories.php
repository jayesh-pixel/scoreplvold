<?php
	$objects['ccategories'] = array(
		'meta' => array(
			'access' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'singular' => 'Contest Categories',
			'plural' => 'Contest Category',
			'table' => 'contest_categories',
			'default_sort_field' => 'id',
			'default_sort_order' => 'desc',
			'add' => true,
			'edit' => true,
			'search' => true,
			'details' => true,
			'delete' => true,
			'fullpage' => false,
			'filter' => "deleted=0"
		),
		'fields' => array(
			'name' => array(
				'displayname' => 'Name',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'validation' => 'required',
			),
		)
	)
?>