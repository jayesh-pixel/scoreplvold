<?php
	check_login();
	if($_REQUEST['ajax'] && $_REQUEST['mode'] == 'ac')
	{
		opendb();
		if($_REQUEST['table'] && $_REQUEST['name'])
		{
			$q = tspl_escape_string($_REQUEST['q']);
			$query = "select " . ($_REQUEST['id'] == 'self'?"distinct({$_REQUEST['name']})":($_REQUEST['id']?$_REQUEST['id']:"id") . ", {$_REQUEST['name']}") . " from {$_REQUEST['table']} where {$_REQUEST['name']} like '%$q%' order by {$_REQUEST['name']};";
			$result = tspl_query($query);
			while($row = mysqli_fetch_row($result))
				if($_REQUEST['id'] == 'self')
					printf("%s\n", $row[0]);
				else
					printf("%d|%s\n", $row[0], $row[1]);
		}
		closedb();
		exit();
	}

	require_once(SCRIPTS_DIR . "tspl/DB3.php");

	$default_mode = 'list';
	$default_object = 'members';
	$summaryIfLessThanNOptions = 5;

	if(@$_REQUEST['status'])
		$status = $_REQUEST['status'];

	$smarty->assign('admin_js', true);
	opendb();

	$object_type = $_REQUEST['object_type'] = (@$_REQUEST['object_type']?$_REQUEST['object_type']:$default_object);
	$mode = $_REQUEST['mode'] = (@$_REQUEST['mode']?$_REQUEST['mode']:$default_mode);

	if(in_array($mode, array('prev', 'next')))
		$mode = 'details';

	$configFile = 'configs/objects/' . $object_type . '.php';
	if(file_exists($configFile))
		require($configFile);
	else
		home('notfound');
	unset($configFile);

	if(!@$objects[$object_type])
		home('notfound');

	if(!@$objects[$object_type]['meta']['access'])
		if(@$userid)
			home('denied');
		else
			home('login');

	if(!@$_REQUEST["ajax"])
	{
		// SEO Tags
		$smarty->assign('meta', array(
			'title' => $sitename_caps . ' - Manage ' . $objects[$object_type]['meta']['plural'],
			'description' => $site_description,
			'keywords' => $sitename_caps
		));

		// Render Layout
		require('content/header.php');
		require('content/footer.php');
	}

	$page = $_REQUEST['page'];
	$table = $objects[$object_type]['meta']['table'];

	$object_fields = $objects[$object_type]['fields'];

	if(@$_REQUEST['action'] && function_exists(@$_REQUEST['action']))
		call_user_func($_REQUEST['action']);

	if(@$objects[$object_type]['meta']['filter'])
		$filter = " and {$objects[$object_type]['meta']['filter']}";
	else
		$filter = "";

	$id = intval(@$_REQUEST['id']);

	if(@$_REQUEST['mode'] == 'edit' && !@$objects[$object_type]['meta']['fullpage'] && !$_REQUEST['ajax'] && !isset($_POST['mysubmit']))
	{
		$mode = $_REQUEST['mode'] = 'list';
		$smarty->assign('loadEditor', true);
	}
	$smarty->assign('userid', @$userid);

	if($mode == 'edit' && (@$objects[$object_type]['meta']['add'] || (@$_REQUEST['id'] && @$objects[$object_type]['meta']['edit'])))
	{
		if (isset($_POST['mysubmit']))
		{
			$reEdit = false;
			$update = array();
			$insert_name = array();
			$insert_value = array();
			if(!$reEdit)
			{
				foreach ($object_fields as $field => $tmp)
				{
					if(@$tmp['edit'])
					{
						unset($v);
						if(isset($_REQUEST[$field]))
							$v = @$_REQUEST[$field];
						// {
							// $v = DB3::dataCleaner(urldecode(@$_REQUEST[$field]));
							// if(@$tmp['input'] != 'cms')
								// $v = filter_var($v, FILTER_SANITIZE_STRING);
							// else
								// $v = preg_replace('/((\<\?(php)?)|(\?\>)|(<script\b[^>]*>.*?<\/script>))/i', '', $v);
						// }
						if((@$object_fields[$field]['input'] == 'image' || @$object_fields[$field]['input'] == 'file'))
						{
							if(@$_FILES[$field]['tmp_name'])
							{
								require_once(SCRIPTS_DIR . 'tspl/upload.php');
								$dirMode = 0777;
								mkdir('upload', $dirMode, true);
								if($object_fields[$field]['path'])
									mkdir($object_fields[$field]['path'], $dirMode, true);
								$tmp = uploadFile($field, '', ($object_fields[$field]['path']?$object_fields[$field]['path']:'upload/'), ($object_fields[$field]['extention']?$object_fields[$field]['extention']:null), ($object_fields[$field]['resize']?$object_fields[$field]['resize']:null));
								if(is_array($tmp) && @$tmp['_main'])
									$_REQUEST[$field] = $v = $tmp['_main'];
								else
									unset($v);
							}
							elseif(@$_REQUEST[$field . '_ajax'])
								$v = $_REQUEST[$field . '_ajax'];
							else
								unset($v);
						}
						elseif($tmp['input'] == 'currency')
						{
							if(isset($_REQUEST[$field]))
							{
								$v = 0;
								// echo "Field: $field, Value: {$_REQUEST[$field]}<br />";
								$tmp = str_replace(",", "", $_REQUEST[$field]);
								// echo "Comma: $tmp<br />";
								$tmp = explode("\+", $tmp);
								if(is_array($tmp))
								{
									// echo "+: <pre>" . print_r($tmp, true) . "</pre>";
									foreach($tmp as $k)
									{
										$tmp1 = explode("-", $k);
										if(is_array($tmp1))
											foreach($tmp1 as $i => $k1)
												if($i == 0)
													$v += floatval($k1);
												else
													$v -= floatval($k1);
									}
								}
							}
							else
								$v = 0;
						}
						elseif($tmp['input'] == 'time')
						{
							/*
							$time = explode(":", $_REQUEST[$field]);
							if($time[0] != 12 && $_REQUEST['ampm_' . $field])
								$time[0] += 12;
							if($time[0] == 12 && !$_REQUEST['ampm_' . $field])
								$time[0] = 0;
							$v = sprintf("%02d:%02d:00", $time[0], $time[1]);
							*/
							// debug($_REQUEST[$field]);
							// debug(date('H:i A', strtotime($_REQUEST[$field]))); die;
							if($_REQUEST[$field])
								$v = date('H:i', strtotime($_REQUEST[$field]));
							else
								$v = "00:00:00";
						}
						elseif($tmp['input'] == 'checkbox' && $tmp['edit'])
						{
							if($tmp['type'] == 'csv')
								$v = join(',',@$_REQUEST[$field]);
							elseif(isset($tmp['options']) && is_array($tmp['options']))
							{
								foreach($tmp['options'] as $k => $v)
								{
									$v = intval(@$_REQUEST[$k]);

									$update[] = '`' . $k . "`='" . $v . "'";
									$insert_name[] = $k;
									$insert_value[] = "'" . $v . "'";
								}
								unset($v);
							}
							else
								$v = intval($_REQUEST[$field]);
						}
						elseif($tmp['input'] == 'date')
							$v = date("Y-m-d", strtotime($v));
						elseif($tmp['input'] == 'time')
							$v = date("H-i-s", strtotime($v));
						elseif($tmp['datatype'] == 'int')
							$v = intval($v);
						elseif($tmp['datatype'] == 'float')
							$v = floatval($v);
						
						if(isset($v))
						{
							if($tmp['input'] == 'password')
							{
								if($v)
								{
									$v = tspl_escape_string($v);
		
									$update[] = '`' . $field . "`='" . $v . "'";
									$insert_name[] = $field;
									$insert_value[] = "'" . $v . "'";
								}
							}
							else{
								$v = tspl_escape_string($v);
		
								$update[] = '`' . $field . "`='" . $v . "'";
								$insert_name[] = $field;
								$insert_value[] = "'" . $v . "'";
							}
						}
						
					}
				}
			}

			if(count($update))
			{
				if($id)
				{
					$query = "UPDATE $table SET " . join(",", $update) . " WHERE id=" . $_REQUEST['id'] . " $filter;";
					$status = 'updated';
				}
				else
				{
					$query = "INSERT INTO $table(`" . join("`,`", $insert_name) . "`) VALUES(" . join(",", $insert_value) . ") on duplicate key update " . join(",", $update) . ";";
					$status = 'added';
				}
				tspl_query($query);
				if(!tspl_affected_rows())
					$status = '';

				if(!$id)
					$id = intval(tspl_insert_id());

				if(function_exists('edit_' . $object_type))
					call_user_func_array('edit_' . $object_type, array($id));
			}

			if(@$_REQUEST['popup'] && $object_type != 'listings')
			{
				echo '<script type="text/javascript">window.top.pagingRecordAdded(\'' . $object_type . '\'); window.top.Shadowbox.close();</script>';
				closedb();
				exit();
			}
			elseif(@$_REQUEST['ajax'])
			{
				echo '<script type="text/javascript">pagingRecordAdded(\'' . $object_type . '\');</script>';
				closedb();
				exit();
			}
			else
			{
				header("Location: {$server_url}manager/" . $object_type);
				closedb();
				exit();
			}
			$mode = $_REQUEST['mode'] = 'list';
		}
		elseif($id)
		{
			$query = "select * from $table where id=$id $filter;";
			$result = tspl_query($query);

			if($row = mysqli_fetch_assoc($result))
			{
				if(function_exists('editor_' . $object_type))
					call_user_func_array('editor_' . $object_type, array($id));

				foreach ($object_fields as $k => $tmp)
					if(!$tmp['edit'] && $object_type != 'listings')
						if($tmp['options'] && ($tmp['assoc'] || array_keys($tmp['options']) !== range(0, count($tmp['options']) - 1)))
							$row[$k] = $tmp['options'][$row[$k]];

				$smarty->assign('object_row', $row);
			}
			else
				home('denied');
		}
		else
		{
			if(@$objects[$object_type]['meta']['add'])
			{
				$row = array();
				if(function_exists('editor_' . $object_type))
					call_user_func_array('editor_' . $object_type, array($id));

				foreach ($object_fields as $k => $tmp)
					if($tmp['edit'] && isset($tmp['default']))
						$row[$k] = $tmp['default'];
				$smarty->assign('object_row', $row);
			}
			else
				home('denied');
		}
	}
	elseif($mode == 'delete' && ($id || is_array($_REQUEST['ids'])) && @$objects[$object_type]['meta']['delete'])
	{
		if(is_array($_REQUEST['ids']))
			$idString = " in (" . join(",", $_REQUEST['ids']) . ")";
		else
			$idString = "=$id";

		$files = array();
		foreach ($object_fields as $field => $tmp)
			if($tmp['input'] == 'file' || $tmp['input'] == 'image')
				$files[] = $field;

		if(count($files))
		{
			$query = "select " . join(",", $files) . " from $table where id{$idString} $filter";
			$result = tspl_query($query);
			while($row = mysqli_fetch_assoc($result))
				foreach($files as $k)
					if($row[$k])
						@unlink($row[$k]);
		}

		if(function_exists('delete_' . $object_type))
		{
			call_user_func_array('delete_' . $object_type, array($idString));
			$status = 'deleted';
		}
		else
		{
			if($objects[$object_type]['meta']['delete'] === 'deleted')
				$query = "update $table set deleted=1 where id{$idString} $filter";
			else
				$query = "delete from $table where id{$idString} $filter";
			tspl_query($query);

			if(tspl_affected_rows())
			{
				$status = 'deleted';

				$query = "delete from urls where otype='$table' and oid not in (select id from $table);";
				tspl_query($query);
			}
		}

		if(function_exists('deleted_' . $object_type))
			call_user_func_array('deleted_' . $object_type, array($idString));

		if($_REQUEST['ajax'])
		{
			if($status == 'deleted')
				echo '<div class="success">' . $objects[$object_type]['meta']['singular'] . ' has been deleted successfully.</div><script type="text/javascript">window.top.pagingRecordDeleted(\'' . $object_type . '\');</script>';
			closedb();
			exit();
		}
		else
			$mode = $_REQUEST['mode'] = 'list';
	}
	elseif($mode == 'details' && $id)
	{
		if(in_array($_REQUEST['mode'], array('prev', 'next')))
		{
			$lastid = 0;
			$id = 0;
			$query = str_replace("select *", "select id", $_SESSION['manager'][$object_type]['query']);
			$result = tspl_query($query);
			while($row = mysqli_fetch_assoc($result))
			{
				if($_REQUEST['mode'] == 'prev' && $_REQUEST['id'] == $row['id'])
				{
					$id = $lastid;
					break;
				}
				elseif($_REQUEST['mode'] == 'next' && $_REQUEST['id'] == $lastid)
				{
					$id = $row['id'];
					break;
				}
				else
					$lastid = $row['id'];
			}

			if($id)
				$_REQUEST['mode'] = $mode;
			else
			{
				if(!$_REQUEST['popup'])
					home("manager/" . $object_type);
				else
				{
					echo '<script type="text/javascript">self.parent.Shadowbox.close();</script>';
					closedb();
					exit();
				}
			}
		}

		$query = "select * from $table where id=$id $filter;";
		$result = tspl_query($query);
		if($row = mysqli_fetch_assoc($result))
		{
			foreach ($object_fields as $k => $tmp)
				if($tmp['options'] && array_keys($tmp['options']) !== range(0, count($tmp['options']) - 1)){
					$row[$k . '_id'] = $row[$k];
					$row[$k] = $tmp['options'][$row[$k]];
				}
				elseif($tmp['label'])
					if($row[$k])
						$row[$k] = $tmp['label'];
					else
						$row[$k] = '';
				elseif($tmp['input'] == 'currency')
					if($row[$k])
						$row[$k] = (@$tmp['currency']?$tmp['currency']:$currency) . ' ' . number_format($row[$k], 2);
					else
						$row[$k] = '';

			if(function_exists('details_' . $object_type))
				call_user_func_array('details_' . $object_type, array($id));

			$smarty->assign('object_row', $row);
		}
		else
			home('denied');
	}

	if($mode == 'list')
	{
		$conditions = array();
		foreach ($object_fields as $f => $tmp)
        {
			if(@$tmp['search'])
			{
				if(@$tmp['input'] == 'date' || @$tmp['input'] == 'currency')
				{
					if(@$_REQUEST['s_' . $f . '_from'])
						$conditions[] = "$f >= '" . DB3::dataCleaner(urldecode($_REQUEST['s_' . $f . '_from'])) . "'";
					if(@$_REQUEST['s_' . $f . '_to'])
						$conditions[] = "$f <= '" . DB3::dataCleaner(urldecode($_REQUEST['s_' . $f . '_to'])) . "'";
				}
				else
				{
					if((@$_REQUEST['s_' . $f] || @$_REQUEST['s_' . $f] === "0"))
                    {
						if($tmp['input'] == 'select')
							$conditions[] = "$f='" . DB3::dataCleaner(urldecode($_REQUEST['s_' . $f])) . "'";
						else
							$conditions[] = "$f like '%" . DB3::dataCleaner(urldecode($_REQUEST['s_' . $f])) . "%'";
					}
				}
			}
		}

		if(@$_REQUEST['q'])
		{
			$q = DB3::dataCleaner(urldecode($_REQUEST['q']));
			$qconditions = array();
			foreach ($object_fields as $f => $tmp)
				if(@$tmp['qsearch']) {
					$qconditions[] = "$f like '%{$q}%'";
				}
			if(count($qconditions))
				$conditions[] = "(" . join(" or ", $qconditions) . ")";
		}

		if(count($conditions))
			$where = " where " . join(" and ", $conditions) . $filter;
		elseif(@$objects[$object_type]['meta']['filter'])
			$where = " where " . $objects[$object_type]['meta']['filter'];
		else
			$where = "";

		$query = "select count(*) as cnt from $table $where;";
		$result = tspl_query($query);
		if($row = mysqli_fetch_assoc($result))
			$total = $row['cnt'];

		if(isset($_REQUEST['page_num']))
			$_SESSION['manager'][$object_type]['page_num'] = $page_num = intval(@$_REQUEST['page_num']);
		elseif(isset($_SESSION['manager'][$object_type]['page_num']))
			$page_num = intval($_SESSION['manager'][$object_type]['page_num']);
		else
			$page_num = 0;

		$total = intval($total);
		$start = intval($page_num) * $pagesize;
		$pages = ceil($total / $pagesize);

		if($pages <= 1)
			$page_num = 0;

		$smarty->assign('start', $start);
		$smarty->assign('pages', $pages);
		$smarty->assign('total', $total);
		$smarty->assign('page_num', $page_num);
		$smarty->assign('pagesize', $pagesize);

		if(@$_REQUEST['orderby'])
		{
			$_SESSION['manager'][$object_type]['orderby'] = $orderby = $_REQUEST['orderby'];
			$_SESSION['manager'][$object_type]['order'] = $order = $_REQUEST['order'];
		}
		elseif(@$_SESSION['manager'][$object_type]['orderby'])
		{
			$orderby = $_SESSION['manager'][$object_type]['orderby'];
			$order = $_SESSION['manager'][$object_type]['order'];
		}
		else
		{
			if(!@$_REQUEST['orderby'])
			{
				$_REQUEST['orderby'] = $objects[$object_type]['meta']['default_sort_field'];
				$_REQUEST['order'] = $objects[$object_type]['meta']['default_sort_order'];
			}
			$_SESSION['manager'][$object_type]['orderby'] = $orderby = $_REQUEST['orderby'];
			$_SESSION['manager'][$object_type]['order'] = $order = $_REQUEST['order'];
		}

		if($orderby && $orderby != 'id' && !in_array($orderby, array_keys($object_fields)))
			$orderby = $_REQUEST['orderby'] = $objects[$object_type]['meta']['default_sort_field'];
		if($order && !in_array($order, array('asc', 'desc')))
			$order = $_REQUEST['order'] = $objects[$object_type]['meta']['default_sort_order'];

		$records = array();
		$query = "select * from $table $where order by $orderby $order";
		$_SESSION['manager'][$object_type]['query'] = $query;
		if(@$objects[$object_type]['meta']['nopaging'])
			$query .= ";";
		else
			$query .= " limit $start, $pagesize;";
		// echo "$query<br />";
		$result = tspl_query($query);
		while($row = mysqli_fetch_assoc($result))
		{
			foreach ($object_fields as $k => $tmp)
				if(@$tmp['options'] && array_keys(@$tmp['options']) !== range(0, count(@$tmp['options']) - 1))
				{
					$row[$k . '_id'] = $row[$k];
					$row[$k] = $tmp['options'][$row[$k]];
				}
				elseif(@$tmp['label'])
					if(@$row[$k])
						$row[$k] = $tmp['label'];
					else
						$row[$k] = '';
				elseif(@$tmp['input'] == 'select' && @$tmp['options'])
				{
					$row[$k] = $tmp['options'][$row[$k]];
				}
				elseif(@$tmp['input'] == 'currency')
					if($row[$k])
					{
						$row[$k . '_id'] = $row[$k];
						if(@$tmp['currency'])
							$row[$k] = $tmp['currency'] . ' ' . number_format($row[$k], 2);
						else
							$row[$k] = $currency . ' ' . number_format($row[$k], 2);
					}
					else
						$row[$k] = '';

			if(function_exists('list_' . $object_type))
				call_user_func_array('list_' . $object_type, array(@$row['id']?$row['id']:0));
			$records[] = $row;
		}

		if(function_exists('mainlist_' . $object_type))
			call_user_func_array('mainlist_' . $object_type, array(@$row['id']?$row['id']:0));
		$smarty->assign('records', $records);

		if(@$objects[$object_type]['meta']['summary'])
		{
			$summary = array();
			foreach ($object_fields as $k => $tmp)
				if($tmp['list'] && $tmp['summary'] !== false && (
					$tmp['input'] == 'currency' ||
					$tmp['summary'] ||
					($tmp['input'] == 'select') // && count($tmp['options']) <= $summaryIfLessThanNOptions)
				))
					$summary[$k] = 0;
			if(count($summary))
			{
				$smarty->assign('summary', json_encode($summary));
				$smarty->assign('summaryIfLessThanNOptions', $summaryIfLessThanNOptions);
			}
		}
	}

	$smarty->assign('page', $page);
	$smarty->assign('meta_data', $objects[$object_type]['meta']);
	$smarty->assign('object_fields', $object_fields);
	$smarty->assign('status', @$status);

	closedb();
	$smarty->display('manager.tpl');
?>
