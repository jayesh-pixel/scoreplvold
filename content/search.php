<?php
	$smarty->assign('meta', array(
		'title' => "Search Results",
		'description' => "$sitename_caps Search",
		'keywords' => $sitename_caps
	));

	require('content/header.php');
	require('content/footer.php');
	
	$types = array(
		'Clients' => array(
			'table' => 'clients',
			'name' => 'clients',
			'filter' => "",
			'fields' => array(
				'name' => array(
					'type' => 'string',
					'prefix' => true,
					'suffix' => true
				),
				'contact_name' => array(
					'type' => 'string',
					'prefix' => true,
					'suffix' => true
				),				
				'email' => array(
					'type' => 'string',
					'prefix' => true,
					'suffix' => true
				),
				'contact_email' => array(
					'type' => 'string',
					'prefix' => true,
					'suffix' => true
				),
				'server_url' => array(
					'type' => 'string',
					'prefix' => true,
					'suffix' => true
				),
				'username' => array(
					'type' => 'string',
					'prefix' => true,
					'suffix' => true
				)				
			),
			'details' => "users/client?id=ID",
			'listing' => "manager/clients"
		)					
	);
		
	function searchRecords($stype, $q = null)
	{
		global $types;
		if(!@$types[$stype])
			return 0;
		
		$is_string = $is_numeric = false;
		if(!$q)
			$q = tspl_escape_string($_REQUEST['q']);
			
		$is_numeric = is_numeric($q);
		$is_string = is_string($q);
					
		$arrWhere = array();			
		foreach ($types[$stype]['fields'] as $k1 => $v1)
		{
			if($is_numeric && ($v1['type'] == 'numeric')){				
				$arrWhere[] = "{$types[$stype]['table']}."."$k1 = '$stype'";
			}

			if($is_string && ($v1['type'] == 'string')){	
				if($v1['prefix'] && $v1['suffix'])			
					$arrWhere[] = $types[$stype]['table'].".$k1 like '%$q%'";
				elseif($v1['prefix'])
					$arrWhere[] = $types[$stype]['table'].".$k1 like '%$q'";
				elseif($v1['suffix'])
					$arrWhere[] = $types[$stype]['table'].".$k1 like '$q%'";
				elseif(!$v1['prefix'] && !$v1['suffix'])
					$arrWhere[] = $types[$stype]['table'].".$k1 = '$q'";																		
			}
		}
				
		if(count($arrWhere))
			$where = "(" . join(" or ", $arrWhere) . ")";
		else
			$where = '1=1';
		$query = "select id from {$types[$stype]['table']} where " . ($types[$stype]['filter']?"{$types[$stype]['filter']}":"1=1") . " and {$where}";
		$result = tspl_query($query);
		$count = mysqli_num_rows($result);
		if($count != 1)
			$return = $count;
		elseif ($row = mysqli_fetch_assoc($result))
			$return = (-1 * $row['id']);
			
		return 	$return;	
	}	

	$results = array();
	$multiple = 0;
	$lastType = null;
	
	if($_REQUEST['qtype'] == 'All')
	{
		foreach(array_keys($types) as $type)
		{
			$results[$type]['cnt'] = searchRecords($type);
			$results[$type]['url'] = "manager/{$types[$type]['name']}?q={$_REQUEST['q']}";
			if($results[$type]['cnt'] != 0)
			{
				$multiple++;
				$lastType = $type;
			}
		}
	}
	else
	{
		$type = $_REQUEST['qtype'];
		$results[$type]['cnt'] = searchRecords($type);
		$results[$type]['url'] = "manager/{$types[$type]['name']}?q={$_REQUEST['q']}";
		if($results[$type]['cnt'] != 0)
		{
			$multiple++;
			$lastType = $type;
		}
	}
	
	// die("<pre>" . print_r($results, true));
	
	if($multiple == 0)
		$smarty->assign("results", null);
	elseif($multiple == 1)
	{	
		if($results[$lastType]['cnt'] < 0)
			home(str_replace("ID", -1 * $results[$lastType]['cnt'], $types[$lastType]['details']));
		else
			home("manager/{$types[$lastType]['name']}?q={$_REQUEST['q']}");
	}
	else
		$smarty->assign('results', $results);
	
	$smarty->display('search.tpl');
?>