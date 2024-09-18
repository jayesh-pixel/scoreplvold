<?php
	function refloadMatches(){
		global $server_url;
		file_get_contents($server_url . 'crons/getLiveMatches');
		file_get_contents($server_url . 'crons/getScheduledMatches');
		file_get_contents($server_url . 'crons/getCompletedMatches');
		file_get_contents($server_url . 'crons/updatePlayersByMatch');
		
		home('manager/matches');
	}
	
	$objects['matches'] = array(
		'meta' => array(
			'access' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'singular' => 'Match',
			'plural' => 'Matches',
			'table' => 'matches',
			'default_sort_field' => 'status',
			'default_sort_order' => 'desc',
			'add' => false,
			'edit' => false,
			'search' => true,
			'details' => false,
			'delete' => false,
			'fullpage' => false,
			'filter' => "deleted=0",
			'actions' => array(
					'refloadMatches' => 'Refresh Matches'
			)
		),
		'fields' => array(
			'title' => array(
				'displayname' => 'Name',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'validation' => 'required',
			),
			'short_title' => array(
				'displayname' => 'Short Name',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => false,
				'details' => true,
				'validation' => 'required',
			),
			'format_str' => array(
				'displayname' => 'Format',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => false,
				'details' => true,
				'validation' => 'required',
			),
			'status_str' => array(
				'displayname' => 'Status',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'input' => 'select',
				'options' => array('Scheduled' => 'Scheduled', 'Completed' => 'Completed', 'Live' => 'Live', 'Abandoned' => 'Abandoned', 'Canceled' => 'Canceled'),
				'validation' => 'required',
			),
			'date_start' => array(
				'displayname' => 'Start Date',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => false,
				'details' => true,
				'input' => 'datetime',
				'validation' => 'required',
			),
			'date_end' => array(
				'displayname' => 'End Date',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => false,
				'details' => true,
				'input' => 'datetime',
				'validation' => 'required',
			),
		)
	)
?>