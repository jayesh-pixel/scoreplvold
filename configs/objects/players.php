<?php
	$teams = getRecords($query = "select team_id, name from teams where deleted=0;");
	$teamsArr = array();
	foreach ($teams as $key => $value) {
		$teamsArr[$value['team_id']] = $value['name'];
	}
	
	$objects['players'] = array(
		'meta' => array(
			'access' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'singular' => 'Player',
			'plural' => 'Players',
			'table' => 'players',
			'default_sort_field' => 'id',
			'default_sort_order' => 'desc',
			'add' => false,
			'edit' => true,
			'search' => true,
			'details' => true,
			'delete' => false,
			'fullpage' => false,
			'filter' => "deleted=0"
		),
		'fields' => array(
			'team_id' => array(
				'displayname' => 'Team',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => true,
				'details' => true,
				'input' => 'select',
				'options' => $teamsArr,
				'assoc' => true,
				'validation' => 'required',
			),
			'title' => array(
				'displayname' => 'Player Name',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => true,
				'details' => true,
				'assoc' => true,
				'validation' => 'required',
			),
			'playing_role' => array(
				'displayname' => 'Role',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
				'assoc' => true,
				'validation' => 'required',
			),
			'imgpath' => array(
				'displayname' => 'Profile Picture',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => false,
				'details' => true,
				'assoc' => true,
				'input' => 'image',
				'path' => 'upload/players/',
				'validation' => 'required',
			),
		)
	)
?>