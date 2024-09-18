<?php
	session_start();
	error_reporting(0);
	if(@$_REQUEST['mode'] != 'session')
	{
		require_once('../configs/config.php');
		opendb();
	}
	error_reporting(0);
	check_login();
	global $userid, $session;
	opendb();
	switch(@$_REQUEST['mode'])
	{
		case 'paid_withdraw':
	        if($id = intval(@$_REQUEST['id'])){
	            $query = "update user u, withdraw_requests w set w.paid=1, u.balance=u.balance-w.amount where w.id='{$id}' and u.id=w.userid and u.deleted=0 and w.deleted=0 and w.paid=0;"; 
	            tspl_query($query);
				
	            exit();
	        }
	        break;
		case 'kyc':
	        if($id = intval(@$_REQUEST['id'])){
	            $query = "update kyc set approved=1 where id='{$id}';"; 
	            tspl_query($query);
				
	            exit();
	        }
	        break;
	    case 'notify':
	        if($id = intval(@$_REQUEST['id'])){
	            $news = getRecord("select id, title,videopath, news as message from news where id='{$id}';");
	            
	            $query = "insert into notifications (title, message, news, sent,vpath) values('{$news['title']}', '{$news['message']}', '{$news['id']}', 1,'{$news['videopath']}');";
	            tspl_query($query);
	            
	            require_once(BASE_PATH . "content/fcm.php");
	            
	            $fcm = new FCM();
	            $fcm->send_notification($news);
	            
	            
	            exit();
	        }
	        break;
		case 'video':
			if(@$_FILES)
			{
				require_once(SCRIPTS_DIR . 'tspl/upload.php');
				$tmp = uploadFile('main_videopath', '', BASE_PATH . "upload/news/", array('mp4', 'wav', 'mp3'));
				if(@$tmp['_main'])
					echo json_encode(
								array(
									'imgpath' => str_replace(BASE_PATH, "", $tmp['_main']),
									'original' => @$_REQUEST['fileId']
								));
			}
			exit();
		case 'img':
			if(@$_FILES)
			{
				require_once(SCRIPTS_DIR . 'tspl/upload.php');
				$tmp = uploadFile('imgpath', '', BASE_PATH . "/upload/news/", array("png", "jpg","jpeg", "gif"));
				if(@$tmp['_main'])
					echo json_encode(
								array(
									'imgpath' => str_replace(BASE_PATH, "", $tmp['_main']),
									'original' => @$_REQUEST['fileId']
								));
			}
			exit();
		break;
		case 'payout':
			if(($id = intval(@$_REQUEST['id'])) && @$_REQUEST['redeem'])
			{
				$query = "update redeem_requests r, vendor_wallet w set w.credited=1, w.status='Paid', r.paid=1 where r.id='{$id}' and r.wallet=w.id;";
				tspl_query($query);
				
				$query = "update redeem_requests r, vendor_wallet w, user u set u.vendor_wallet_balance=(vendor_wallet_balance-r.amount) where r.id='{$id}' and r.wallet=w.id and u.id=r.vendor;";
				tspl_query($query);
			}
			elseif(($id = intval(@$_REQUEST['id'])) && $_SESSION[$session]['usertype'] == 'Administrator')
			{
				$query = "update payout_requests set paid=1, pdate=CURDATE() where id='{$id}' and paid=0;";
				tspl_query($query);
				
				$query = "insert into notifications (userid, added_by, otype, oid, title, message, ndate) values('{$userid}', '{$userid}', 'payouts', '{$id}', 'Payout Request', 'Hello,<br />Your Payout Request has been updated', NOW()) on duplicate key update status=0, ndate=NOW();";
				tspl_query($query);
				echo 'success';
			}
			exit();
		break;
		case 'terms':	
			if(($id = intval(@$_REQUEST['id'])) || @$_REQUEST['vendor_specific'])
			{
				echo getRecordField($query = "select terms from terms where " . (@$_REQUEST['vendor_specific']?"vendor='{$userid}' and vendor_terms=1":"vendor='{$id}'") . ";");
			}
			exit();
		break;
		case 'unassign_order':
			if(($id = intval(@$_REQUEST['id'])) && ($orderid = intval(@$_REQUEST['orderid'])))
			{
				$query = "update db_orders set deleted=1, status='', assigned_by=0, dbid=0 where dbid='{$id}' and order_id='{$orderid}';";
				tspl_query($query);
				echo 'success';
			}
			exit();
		break;
		case 'assign_order':
			if(($id = intval(@$_REQUEST['id'])) && ($orderid = intval(@$_REQUEST['orderid'])))
			{
				$status = (@getRecordField($query = "select id from db_orders where dbid='{$id}' and order_id='{$orderid}' and deleted=0;")?0:1);
				
				$query = "insert into db_orders(dbid, order_id, status, assigned_by) values('{$id}', '{$orderid}', 'assigned', '{$userid}') on duplicate key update deleted=0, status='assigned', assigned_by='{$userid}', dbid='{$id}', id=LAST_INSERT_ID(id);";
				tspl_query($query);
				if($did = tspl_insert_id())
				{
					$query = "insert into notifications (userid, added_by, otype, oid, title, message, ndate) values('{$id}', '{$userid}', 'assign_db', '{$did}', 'Order Assign', 'Hello,<br />You have New Order Assigned', NOW()) on duplicate key update status=0, ndate=NOW();";
					tspl_query($query);
					echo json_encode($record = getRecord($query = "select id, name, address from user where id='{$id}';"));
				}
			}
			exit();
		break;
		case 'accept_order':
			if($id = intval(@$_REQUEST['id']))
			{
				$status = (@getRecordField($query = "select accepted from orders where id='{$id}';")?0:1);
				$query = "update orders set accepted={$status}, ostatus='" . ($status?'Accepted':'Rejected') . "' where id='{$id}';";
				tspl_query($query);
				
				echo json_encode($record = getRecord($query = "select * from orders where id='{$id}';"));
			}
			exit();
		break;
		case 'vendors':
			if(@$_REQUEST['tbl'])
				$tbl = $_REQUEST['tbl'];
			else
				$tbl = 'user';
			
			switch(@$_REQUEST['level'])
			{
				case 'area':
					if($city = intval(@$_REQUEST['city']))
					{
						$records['data'] = getRecords($query = "select id, name from subarea where city='{$city}' and status=1;");
						if($id = intval(@$_REQUEST['id']))
							$records['id'] = getRecordField($query = "select subarea from {$tbl} where id='{$id}';");
						echo json_encode($records);
					exit();
					}
					break;
				case 'city':
					if($state = intval(@$_REQUEST['state']))
					{
						$records['data'] = getRecords($query = "select id, name from city where state='{$state}' and status=1;");
						if($id = intval(@$_REQUEST['id']))
							$records['id'] = getRecordField($query = "select city from {$tbl} where id='{$id}';");
						echo json_encode($records);
					exit();
					}
					break;
			}
		break;
		case 'category':
			if($category = intval(@$_REQUEST['category']))
			{
				$records['data'] = getRecords($query = "select id, name from subcategories where category='{$category}' and status=1;");
				if($id = intval(@$_REQUEST['id']))
					$records['id'] = getRecordField($query = "select subcategory from products where id='{$id}';");
				echo json_encode($records);
			exit();
			}
		break;
		case 'unlock':
			$query = "select id from user where id=$userid and pass='" . md5(@$_REQUEST['pass']) . "';";
			$result = tspl_query($query);
			if($row = mysqli_fetch_assoc($result))
			{
				unset($_SESSION['locked']);
				echo 'unlock';
			}
			else
				echo 'password';
			break;
		case 'session':
			$_SESSION['last'] = time();
			$_SESSION['locked'] = true;
			break;
		case 'subscription_modules':
			if(in_array($_SESSION[$session]['usertype'], array('Administrator')))
				echo json_encode(getRecords("select modules from subscription_modules where subscriptions=" . intval(@$_REQUEST['subscriptions'])));
			else
				echo null;
			break;
		case 'passwords':
			if(in_array($_SESSION[$session]['usertype'], array('Administrator')))
				echo json_encode(getRecord("select password, db_password, test_db_password from clients where id=" . intval(@$_REQUEST['id'])));
			else
				echo null;
			
	}

	if(@$_REQUEST['mode'] != 'session')
		closedb();
?>