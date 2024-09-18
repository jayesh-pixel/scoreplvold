<?php
	function list_contests($id){
		global $row;
		$match = getRecord($query = "select date_start, format_str, status_str from matches where id='{$row['match_id_id']}';");
		$row['date_start'] = $match['date_start'];
		$row['match_status'] = $match['status_str'];
		$row['format'] = $match['format_str'];
	}
	
	function edit_contests($id){
		if(array_filter($_REQUEST['rid'])){
			$query = "delete from contest_rules where id not in (" . join(",", $_REQUEST['rid']) . ") and cid='{$id}';";
			tspl_query($query);
		}
		
		foreach ($_REQUEST['max_rank'] as $key => $value) {
			if(floatval(@$_REQUEST['rank_amount'][$key]) > 0){
				$data = array(
					'id' => intval($_REQUEST['rid'][$key]),
					'cid' => $id,
					'min_rank' => $_REQUEST['min_rank'][$key],
					'max_rank' => $value,
					'amount' => $_REQUEST['rank_amount'][$key],
					'deleted' => 0
				);
				DB3::updateObject('contest_rules', $data);
			}
		}
	}
	
	function editor_contests($id){
		global $smarty, $row;
		$rules = getRecords($query = "select * from contest_rules where cid='{$id}' and deleted=0;");
		$smarty->assign('rules', $rules);
	}
	
	function details_contests($id){
		global $row;
		$match = getRecord($query = "select date_start, format_str, status_str from matches where id='{$row['match_id_id']}';");
		$row['date_start'] = $match['date_start'];
		$row['match_status'] = $match['status_str'];
		$row['format'] = $match['format_str'];
	}
	
	$objects['contests'] = array(
		'meta' => array(
			'access' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'singular' => 'Contests',
			'plural' => 'Contest',
			'table' => 'contests',
			'default_sort_field' => 'id',
			'default_sort_order' => 'desc',
			'add' => true,
			'edit' => true,
			'search' => true,
			'details' => true,
			'delete' => true,
			'fullpage' => false,
			'editor' => 'manager/edit_contest.tpl',
			'filter' => "deleted=0",
			'row_actions' => array(
				array(
					'link' => "{$server_url}manager/ucontests?id=ID",
					'title' => 'Joined Users',
					'icon' => 'mdi mdi-account-multiple',
					'text' => 'Users',
				)
			),
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
				'options' => DB3::findChildren('matches', "title", array(), "deleted=0 and status in (1, 3)"),
				'assoc' => true,
				'validation' => 'required',
			),
			'date_start' => array(
				'displayname' => 'Match Date',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
				'input' => 'datetime',
			),
			'format' => array(
				'displayname' => 'Format',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
			),
			'match_status' => array(
				'displayname' => 'Match Status',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
			),
			'cid' => array(
				'displayname' => 'Contest Category',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'input' => 'select',
				'options' => DB3::findChildren('contest_categories', "name", array(), "deleted=0"),
				'assoc' => true,
				'validation' => 'required',
			),
			'name' => array(
				'displayname' => 'Name',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'validation' => 'required',
			),
			'price' => array(
				'displayname' => 'Price Pool',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => false,
				'details' => true,
				'input' => 'number',
				'validation' => 'required',
			),
			'fees' => array(
				'displayname' => 'Joining Fee',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => false,
				'details' => true,
				'input' => 'number',
				'validation' => 'required',
			),
			'team_size' => array(
				'displayname' => 'Team Size',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => false,
				'details' => true,
				'input' => 'number',
				'validation' => 'required',
			),
			'sopts' => array(
				'displayname' => 'Spots',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => false,
				'details' => true,
				'input' => 'number',
				'validation' => 'required',
			),
			'admin_comm' => array(
				'displayname' => 'Admin Commition',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => false,
				'details' => true,
				'input' => 'number',
				'suffix' => '%',
				'validation' => 'required',
			),
		)
	)
?>