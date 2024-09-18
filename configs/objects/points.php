<?php
	$objects['points'] = array(
		'meta' => array(
			'access' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'singular' => 'Point',
			'plural' => 'Points',
			'table' => 'points',
			'default_sort_field' => 'id',
			'default_sort_order' => 'desc',
			'add' => false,
			'edit' => true,
			'search' => true,
			'details' => true,
			'delete' => true,
			'fullpage' => false,
			'filter' => "deleted=0"
		),
		'fields' => array(
			'match_format' => array(
				'displayname' => 'Match Format',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => true,
				'details' => true,
				'input' => 'select',
				'options' => DB3::findChildren('match_formats', "format_str", array(), "deleted=0"),
				'assoc' => true,
				'validation' => 'required',
			),
			'name' => array(
				'displayname' => 'Name',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => true,
				'details' => true,
				'validation' => 'required',
			),
			'point_key' => array(
				'displayname' => 'Key',
				'sort' => true,
				'list' => false,
				'edit' => false,
				'search' => false,
				'details' => true,
				'validation' => 'required',
			),
			'points' => array(
				'displayname' => 'Points',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'input' => 'number',
				'validation' => 'required',
			),
		)
	)
?>