<?php
	function edit_languages($id){
		global $session, $userid;
	}
	
	function editor_languages($id){
	}
	
	$objects['languages'] = array(
		'meta' => array(
			'access' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'singular' => 'Languages',
			'plural' => 'Language',
			'table' => 'languages',
			'default_sort_field' => 'id',
			'default_sort_order' => 'asc',
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
				'displayname' => 'Language',
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