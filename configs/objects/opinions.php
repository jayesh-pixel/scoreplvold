<?php
	$objects['opinions'] = array(
		'meta' => array(
			'access' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'singular' => 'Opinion',
			'plural' => 'Opinions',
			'table' => 'opinions',
			'default_sort_field' => 'id',
			'default_sort_order' => 'desc',
			'add' => true,
			'edit' => true,
			'search' => true,
			'details' => true,
			'delete' => true,
			'fullpage' => false,
			'filter' => "deleted=0",
		),
		'fields' => array(
			'match_id' => array(
				'displayname' => 'Match',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'input' => 'select',
				'options' => DB3::findChildren('matches', "title", array(), "deleted=0 and status in(1,3)"),
				'assoc' => true,
				'validation' => 'required',
			),
			'opinion' => array(
				'displayname' => 'Opinion',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => false,
				'details' => true,
				'input' => 'textarea',
				'rows' => 5,
				'validation' => 'required',
			),
		)
	)
?>