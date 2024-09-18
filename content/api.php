<?php
require_once ('configs/config.php');
require_once (SCRIPTS_DIR . 'tspl/upload.php');
require_once (SCRIPTS_DIR . 'tspl/DB3.php');
class api {
	function api() {
		tspl_query("SET session TIME_ZONE = '+05:30'");
	}
	
	function sendResponse($response){
		if($response['status'] == '400'){
			header("HTTP/1.1 400 Not Found");
		}
		else{
			header("HTTP/1.1 200 Not Found");
		}
		echo json_encode($response);
	}

	function settings() {
		global $server_url;
		if ($settings = getRecord($query = "select *, concat('{$server_url}','',logo_imgpath) as logo_imgpath, concat('{$server_url}','', favicon) as favicon from site_settings where deleted=0")) {
			$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $settings);
		} else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Settings Not Found");
		$this->sendResponse($response);
		exit();
	}
	
	function getMakePaymentInfo() {
		global $server_url;
		if ($settings = getRecord($query = "select payment_limit, admin_upi from site_settings where deleted=0")) {
			$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $settings);
		} else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Settings Not Found");
		$this->sendResponse($response);
		exit();
	}

	// params : {name:"test test",email:"test@test.com",phone:"9168109933",password:"test", referral:"farm00001"}
	function register() {
		if (@$_REQUEST['name'] && (@$_REQUEST['email'] || @$_REQUEST['phone']) && @$_REQUEST['password']) {
			if ((@$_REQUEST['phone'] && getRecordField($query = "select id from user where phone='" . @$_REQUEST['phone'] . "' and status=1 and deleted=0 and usertype='user';")) || (@$_REQUEST['email'] && getRecordField($query = "select id from user where phone='" . @$_REQUEST['email'] . "' and status=1 and deleted=0 and usertype='user';"))) {
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Duplicate User");
			} else {
				if(@$_REQUEST['referral']){
					$referId = getRecordField($query = "select id from user where referral='{$_REQUEST['referral']}' and deleted=0;");
					if($referId){
						$query = "insert into user(usertype, name, email, phone, pass, status, pid) values('user', '" . tspl_escape_string(@$_REQUEST['name']) . "', '" . tspl_escape_string($_REQUEST['email']) . "', '" . $_REQUEST['phone'] . "', '" . ($_REQUEST['password']) . "', '1', '{$referId}')";
						tspl_query($query);
						$id = tspl_insert_id();
						
						$query = "update user set referral='DELWN" . sprintf("%04d", $id) . "' where id='{$id}';";
						tspl_query($query);
					
						$query = "insert into transactions(type, amount, userid, date, remark) values('credit', '100', '{$referId}', curdate(), 'Referral bonus');";
						tspl_query($query);
						
						$query = "update user set balance=balance+100 where id='{$referId}';";
						tspl_query($query);
						
						$query = "insert into transactions(type, amount, userid, date, remark) values('credit', '50', '{$id}', curdate(), 'Referral bonus');";
						tspl_query($query);
						
						$query = "update user set balance=balance+50 where id='{$id}';";
						tspl_query($query);
						$values = array();
                        
                        // Handle image upload if image file exists
                        if (@$_FILES['imgpath']) {
                            $upload_result = uploadFile('imgpath', '', "upload/users/", array("png", "jpg", "jpeg"));
                            if (!empty($upload_result['_main'])) {
                                $values['imgpath'] = $upload_result['_main'];
                            }
                        }
                        
                        // Update user record with image path if exists
                        if (!empty($values)) {
                            $values['id'] = $id; // Ensure the user ID is included in the $values array for the update
                            DB3::updateObject('user', $values);
                        }
						
						$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('id' => "{$id}"));
					}
					else
						$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Referal");
				}
				else{
					$query = "insert into user(usertype, name, email, phone, pass, status) values('user', '" . tspl_escape_string(@$_REQUEST['name']) . "', '" . tspl_escape_string($_REQUEST['email']) . "', '" . $_REQUEST['phone'] . "', '" . ($_REQUEST['password']) . "', '1')";
					tspl_query($query);
					$id = tspl_insert_id();
					
					$query = "update user set referral='DELWN" . sprintf("%04d", $id) . "' where id='{$id}';";
					tspl_query($query);
					$values = array();

                    // Handle image upload if image file exists
                    if (@$_FILES['imgpath']) {
                        $upload_result = uploadFile('imgpath', '', "upload/users/", array("png", "jpg", "jpeg"));
                        if (!empty($upload_result['_main'])) {
                            $values['imgpath'] = $upload_result['_main'];
                        }
                    }
                    
                    // Update user record with image path if exists
                    if (!empty($values)) {
                        $values['id'] = $id; // Ensure the user ID is included in the $values array for the update
                        DB3::updateObject('user', $values);
                    }
					
					$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('id' => "{$id}"));
				}
			}
		} else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing Required Parameters");
		$this->sendResponse($response);
		exit();
	}
	
	function sendOtp(){
	    $phone=@$_REQUEST['phone'];
	    if(isset($phone)){
	      $otp = rand(1111, 9999);
	       $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=cfQulrNAheSy1BgJVZGUmdj6zW428aEkRvMX0YspOqKiCbLoTHnSDVd8bXRWqxKUOQ3muZey2L4Pjs7o&route=q&message='".urlencode("Never Share This Code.Your Scorepl OTP is ")."$otp'&flash=0&numbers=$phone",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_SSL_VERIFYHOST => 0,
              CURLOPT_SSL_VERIFYPEER => 0,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
              ),
            ));
            
            $response_otp = curl_exec($curl);
            //print_r($response_otp);die;
            $err = curl_error($curl);
            
            curl_close($curl);

            if($response_otp){
                $query = "update user_otp set deleted=1 where phone='$phone';";
            				$ss=tspl_query($query);
            				
            				$queryy = "insert into user_otp(phone, otp) values('$phone', '{$otp}')";
            				$si=tspl_query($queryy);
            				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'message' => 'OTP send successfully','otp'=>$otp);
            }
	    }else{
	        $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing Required Parameters");
	    }
		$this->sendResponse($response);
		exit();    
	}
	
	function verifyOtp() {
	    $phone = @$_REQUEST['phone'];
	    $otp = @$_REQUEST['otp'];
	    if (isset($phone) && isset($otp)  ) {
			$otpcheck = getRecordField($query = "select otp from user_otp where phone='$phone' and deleted=0 order by id desc limit 1");
			if($otp == $otpcheck){
			    $query = "update user_otp set deleted=1 where phone='$phone';";
				tspl_query($query);
				
				$response = array('status' => '200', 'error' => 0, 'success' => 1,'message'=> "Sucessfully Verified");
			}else{
			    $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid OTP");
			}
		}else{
	        $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing Required Parameters");
	    }
		$this->sendResponse($response);
		exit();
	      
	}

	//params : {"phone":"1234567890", "token":"dfsd465sdfsd46sd"}
	function loginWithPhone() {
		global $server_url;
		if (@$_REQUEST['phone']) {
			$user = getRecord($query = "select u.* from user u where u.deleted=0 and u.usertype in('user') and (u.phone='" . $_REQUEST['phone'] . "');");
			if ($user) {
				$query = "update user set device_token='{$_REQUEST['token']}' where id='{$user['id']}';";
				tspl_query($query);
				
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('id' => $user['id'], 'message' => 'Login In Successfully'));
			} else{
				$query = "insert into user(usertype, phone, status, device_token) values('user', '{$_REQUEST['phone']}', 1, '{$_REQUEST['token']}');";
				tspl_query($query);
				
				$id = tspl_insert_id();
				
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('id' => $id, 'message' => 'Login In Successfully'));
			}
		} else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing Phone");
		$this->sendResponse($response);
		exit();
	}
	
	//params : {userid: 2, "token":"dsfsd123gsdg45dsgsd67890"}
	function updateDeviceToken() {
		global $server_url;
		
		if (!app_login(@$_REQUEST['userid'])) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if (@$_REQUEST['token']) {
			$query = "update user set device_token='{$_REQUEST['token']}' where id='{$_REQUEST['userid']}';";
			tspl_query($query);
			
			$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('message' => 'Device Token Upadated Successfully'));
		} 
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing Token");
		
		$this->sendResponse($response);
		exit();
	}

	
	//params : {"userid":"4", amount:"100", payment_mode: "bank/upi"}
	 function withdrawRequest() {
		global $server_url;
		if (!app_login(@$_REQUEST['userid'])) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if (($userid = intval(@$_REQUEST['userid'])) && ($amount = floatval($_REQUEST['amount'])) && @$_REQUEST['payment_mode']) {
			$user = getRecord($query = "select u.* from user u where u.deleted=0 and u.usertype in('user') and u.id='{$userid}';");
			if ($user) {
			    $checklimit=getRecordField("SELECT withdraw_limit FROM `site_settings` WHERE id=1");
			   if($amount >= $checklimit){
				if($kid = getRecordField($query = "select id from kyc where userid='{$userid}' and approved=1 and deleted=0;")){
					if($amount <= floatval($user['balance'])){
						$query = "insert into withdraw_requests(userid, amount, payment_mode) values('{$userid}', '{$amount}', '{$_REQUEST['payment_mode']}');";
						tspl_query($query);
						
						$query = "update user set balance=balance-'{$amount}' where id='{$userid}';"; 
	                    tspl_query($query);
						
						$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('message' => 'Withdraw Request Sent Successfully'));
					}
					else
						$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Not enough balance");
				}
				else
					$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "KYC not approved");
			   }else{
			       $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Minimum Withdraw $checklimit Rs");
			   }
			} else{
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "User Not Found");
			}
		} else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing userid or amount");
		$this->sendResponse($response);
		exit();
	}
	//params : {"userid":"4", amount:"100"}
	function addFunds() {
		global $server_url;
		if (!app_login(@$_REQUEST['userid'])) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		$settings = getRecord($query = "select payment_limit, admin_upi from site_settings where deleted=0");
		
		if (($userid = intval(@$_REQUEST['userid'])) && ($amount = floatval($_REQUEST['amount'])) && (floatval($settings['payment_limit']) <= floatval($_REQUEST['amount']))) {
			$user = getRecord($query = "select u.* from user u where u.deleted=0 and u.usertype in('user') and u.id='{$userid}';");
			if ($user) {
					$query = "update user set balance=balance+{$amount} where id='{$userid}';";
					tspl_query($query);
					
					$query = "insert into transactions(type, amount, userid, date, remark) values('credit', '{$amount}', '{$userid}', '" . date("Y-m-d") . "', 'Fund Add');";
					tspl_query($query);
					
					$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('message' => 'Fund Added Successfully'));
			} else{
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "User Not Found");
			}
		} else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing userid or amount or Minimum amount should be greater than {$settings['payment_limit']}");
		$this->sendResponse($response);
		exit();
	}
	
	function checkUserStatus() {
	    $phone=@$_REQUEST['phone'];
	    if(isset($phone)){
	        $user = getRecord($query = "select * from user where phone='$phone'  and deleted=0 ");
	        if(sizeof($user)>0){
	            $response = array('status' => '200', 'error' => 0, 'success' => 1, 'message' => "User Already Exist",'userid'=>$user['id']);
	        }else{
	            $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "User Not Exist");  
	        }
	    }else{
	      $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing Phone");  
	    }
	    $this->sendResponse($response);
		exit();
	}
	
	//params : {"email":"test@test.com", "password":"admin"}
	function login() {
		global $server_url;
		if (@$_REQUEST['phone'] && ($password = $_REQUEST['password'])) {
			$user = getRecord($query = "select u.* from user u where u.deleted=0 and u.usertype in('user') and (u.phone='" . $_REQUEST['phone'] . "');");
			if ($user) {
				$securityCheckPass = false;
				if ($password && ($user['pass'] == $password || $user['pass'] == md5($password)))
					$securityCheckPass = true;
				if ($securityCheckPass && $user['status']) {
					if ($user['imgpath'])
						$user['imgpath'] = $server_url . $user['imgpath'];
					$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $user);
				} elseif (!$securityCheckPass)
					$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Password not match");
				elseif (!$row['status'])
					$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "User inactive");
				else
					$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Some technical issue");
			} else
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "User Not Found");
		} else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing phone Or Password");
		$this->sendResponse($response);
		exit();
	}

	// params : {name:"test",email:"test@test.com",auth:"sfsd44564gdfgdfg"}
	function googleLogin() {
		if (@$_REQUEST['name'] && @$_REQUEST['email'] && @$_REQUEST['auth']) {
			$query = "insert into user(usertype, name, email, status, auth,imgpath) values('user', '" . tspl_escape_string(@$_REQUEST['name']) . "', '" . tspl_escape_string($_REQUEST['email']) . "', '1', '" . tspl_escape_string(@$_REQUEST['auth']) . "', '" . urldecode((@$_REQUEST['imgpath'])) . "') on duplicate key update deleted=0, status=1, name='" . tspl_escape_string(@$_REQUEST['name']) . "', auth='" . tspl_escape_string(@$_REQUEST['auth']) . "', 
		   imgpath='" . (@$_REQUEST['imgpath']) . "', id=LAST_INSERT_ID(id);";
			tspl_query($query);
			$id = tspl_insert_id();
			if (!$id)
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Something Went Wrong');
			else
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $this -> getprofile($id, true));
		} else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing Required Parameters");
		$this->sendResponse($response);
		exit();
	}

	function getprofile($id = 0, $internal = false) {
		global $server_url;
		if (!$id)
			$id = intval(@$_REQUEST['userid']);
		if (!app_login($id)) {
			if ($internal)
				return array();
			else {
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
				$this->sendResponse($response);
				exit();
			}
		}
		if ($id) {
			//{$server_url}
			$user = getRecord($query = "select u.* from user u where u.id='{$id}' and u.usertype='user' group by u.id;");
			if ($internal)
				return $user;
			else {
				if (empty($user))
					$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'User Not Found');
				else
					$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $user);
			}
		} elseif ($internal)
			return array();
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing Userid");
		if (!$internal) {
			$this->sendResponse($response);
			exit();
		}
	}

	//params : {userid:"1",name:"test est",email:"test@test.com",phone:"9168109933",password:"test", "imgpath":'images.test.jpeg'}
	function updateprofile() {
		global $server_url;
		if (!app_login(intval(@$_REQUEST['userid']))) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		if (($id = intval(@$_REQUEST['userid'])) && @$_REQUEST['name']) {
			$fields = array('name', 'email', 'phone', 'dob','gender');
			$values = array();
			foreach ($fields as $f) {
				$values[$f] = tspl_escape_string(urldecode(@$_REQUEST[$f]));
			}
			if (@$_REQUEST['password'])
				$values['pass'] = (@$_REQUEST['password']);
			
			$values['id'] = $id;
			
			if (@$_FILES['imgpath']) {
				$tmp = uploadFile('imgpath', '', "upload/users/", array("png", "jpg", "jpeg"));
				if (@$tmp['_main'])
					$values['imgpath'] = $tmp['_main'];
			}
			
			$id = DB3::updateObject('user', $values);
			$result = array('id' => $id);
			if (@$tmp['_main'])
				$result['imgpath'] = $server_url . $tmp['_main'];
			$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $result);
		} else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing Rquired Parameters");
		$this->sendResponse($response);
		exit();
	}

	//params : {userid:"1",oldPassword:"test",password:"test"}
	function changepswd() {
		if (!app_login(intval(@$_REQUEST['userid']))) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		if (($id = intval(@$_REQUEST['userid'])) && ($oldPassword = (trim($_REQUEST['oldPassword']))) && ($password = (trim($_REQUEST['password'])))) {
			$userPass = getRecordField($query = "select pass from user where id='{$id}';");
			if ($userPass == $oldPassword) {
				$id = DB3::updateObject('user', array('id' => $id, 'pass' => $password));
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('userid' => $id));
			} else
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Old Password doesnt match");
		} else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing Old Passwrd or New Password");
		$this->sendResponse($response);
		exit();
	}
	
	function forgetPassword(){
	   
		
		if (($id = intval(@$_REQUEST['phone']))  && ($newpassword = (trim($_REQUEST['new_password'])))) {
			$userPass = getRecordField($query = "select phone from user where phone='{$id}';");	
			if($userPass){
			  $update= tspl_query("UPDATE `user` SET  `pass`='$newpassword'  WHERE phone='{$id}' ");
			  $response = array('status' => '200', 'error' => 0, 'success' => 1, 'message' => "update password successfully",'new_password'=>$newpassword); 
			}else{
			    $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Mobile");
			}
		} else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing param");
		$this->sendResponse($response);
		exit();
	}
	
	//params : {userid:"1", "img_pan":'img_pan.jpeg', "img_addhar":'images.img_addhar.jpeg'}
	function updateKyc() {
		global $server_url;
		if (!app_login(intval(@$_REQUEST['userid']))) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if (($id = intval(@$_REQUEST['userid'])) && @$_FILES['img_pan'] && @$_FILES['img_addhar']) {
			$values['userid'] = $id;
			if (@$_FILES['img_pan']) {
				$tmp = uploadFile('img_pan', '', "upload/users/", array("png", "jpg", "jpeg"));
				if (@$tmp['_main'])
					$values['img_pan'] = $tmp['_main'];
			}
			if (@$_FILES['img_addhar']) {
				$tmp = uploadFile('img_addhar', '', "upload/users/", array("png", "jpg", "jpeg"));
				if (@$tmp['_main'])
					$values['img_addhar'] = $tmp['_main'];
			}
			$id = DB3::updateObject('kyc', $values);
			
			$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array("message" => "KYC documents uploaded successfully"));
		} else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing Rquired Parameters");
		$this->sendResponse($response);
		exit();
	}

	function banners() {
		global $server_url;
		$categories = getRecords($query = "select * from banners where deleted=0 order by id desc;");
		if (empty($categories))
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Banners Not Found');
		else
			$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $categories);
		
		$this->sendResponse($response);
		exit();
	}
	
	function matches($id = 0, $internal = false) {
		global $server_url;
		$matches = getRecords($query = "select * from matches where deleted=0 and status in(3, 1) order by date_start asc;");
		foreach ($matches as &$match) {
			$match['teama'] = getRecord($query = "select * from teams where match_id='{$match['match_id']}' and mid='{$match['id']}' order by id asc limit 1;");
			$match['teamb'] = getRecord($query = "select * from teams where match_id='{$match['match_id']}' and mid='{$match['id']}' order by id desc limit 1;");
			$match['prize'] = floatval(getRecordField($query = "select price from contests where match_id='{$match['id']}' and deleted=0 order by price desc limit 1;"));
			
			if(!$match['prize'])
				$match['prize'] = 0;
		}
		
		if ($internal)
			return $matches;
		else {
			if (empty($matches))
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Matches Not Found');
			else
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $matches);
		}
		
		if (!$internal) {
			$this->sendResponse($response);
			exit();
		}
	}

	function contestCategories() {
		global $server_url;
		$categories = getRecords($query = "select * from contest_categories where deleted=0");
		if (!empty($categories)) {
			$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $categories);
		} else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Categories Not Found");
		$this->sendResponse($response);
		exit();
	}
	//params : {userid:"1", matchid:"2", cid:"1"}
	function contests($id = 0, $internal = false) {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		$matchid = intval(@$_REQUEST['matchid']);
		$cid = intval(@$_REQUEST['cid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		if($userid && $matchid){
			$contests = getRecords($query = "select c.*, count(distinct u.id) as joinedSlots from contests c left join user_contests u on ((c.match_id=u.match_id or c.match_id=0) and u.cid=c.id and u.deleted=0 and u.match_id='{$matchid}') where c.deleted=0 and c.match_id in (0, '{$matchid}')" . ($cid?" and c.cid='{$cid}'":"") . " group by c.id having c.id > 0;");
			foreach ($contests as &$contest) {
				$contest['rules'] = getRecords($query = "select * from contest_rules where cid='{$contest['id']}' and deleted=0;");
				$contest['joinedSlots'] = intval($contest['joinedSlots']);
				
				if(!$contest['joinedSlots'])
					$contest['joinedSlots'] = 0;
			}
			
			if ($internal)
				return $contests;
			else {
				if (empty($contests))
					$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Contests Not Found');
				else
					$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $contests);
			}
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		if (!$internal) {
			$this->sendResponse($response);
			exit();
		}
	}
	
	//params : {userid:"1", contestid:"2"}
	function contestRules($id = 0, $internal = false) {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		$contestid = intval(@$_REQUEST['contestid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		if($userid && $contestid){
			$rules = getRecords($query = "select * from contest_rules where deleted=0 and cid='{$contestid}' order by min_rank asc;");
			
			if ($internal)
				return $rules;
			else {
				if (empty($rules))
					$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Rules Not Found');
				else
					$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $rules);
			}
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		if (!$internal) {
			$this->sendResponse($response);
			exit();
		}
	}
	
	//params : {userid:"1", contestid:"2", matchtid:"3"}
	function joinContest() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		$contestid = intval(@$_REQUEST['contestid']);
		$matchid = intval(@$_REQUEST['matchtid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		if($userid && $contestid && $matchid){
			$userContest = getRecord($query = "select * from user_contests where deleted=0 and cid='{$contestid}' and userid='{$userid}' and match_id='{$matchid}';");
			
			if($contest = getRecord($query = "select * from contests where deleted=0 and id='{$contestid}' and match_id='{$matchid}';")){
			
				$user = getRecord($query = "select * from user where deleted=0 and id='{$userid}';");
				if(floatval($user['balance']) >= floatval($contest['fees'])){
					// if(!$userContest['id']){
						$query = "insert into user_contests (userid, cid, match_id) values('{$userid}', '{$contestid}', '{$matchid}');";
						tspl_query($query);
						
						$query = "update user set balance=balance-'".  floatval($contest['fees'])."' where id='{$userid}';";
						tspl_query($query);
					
						$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('message' => 'Contest Joined Successfully'));
					// }
					// else
						// $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Contest Already Joined');
				}
				else
					$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Not enough balance');
			}
			else
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Contest Not Found');
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}

	//params : {userid:"1", matchid:"2"}
	function myContests() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		$matchid = intval(@$_REQUEST['matchid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($userid){
			//$contests = getRecords($query = "select c.*, m.status, m.status_str, u.match_id from contests c, user_contests u left join matches m on m.id=u.match_id where u.userid='{$userid}' and u.cid=c.id and c.deleted=0 " . ($matchid?"and u.match_id in ('{$matchid}')":"") . " group by u.id order by u.dt desc;");
			$contests = getRecords("select c.*,m.status, m.status_str, u.match_id from contests c left join user_contests u on c.id=u.cid left join matches m on m.id=u.match_id where u.userid='{$userid}' and c.deleted=0 " . ($matchid?"and u.match_id in ('{$matchid}')":"") . "  GROUP by u.cid  order by u.dt desc");
			foreach ($contests as &$contest) {
				$contest['rules'] = getRecords($query = "select * from contest_rules where cid='{$contest['id']}' and deleted=0;");
				
				$contest['joinedSlots'] = getRecordField($query = "select count(id) as cnt from user_contests where cid='{$contest['id']}' and match_id in ('{$contest['match_id']}') and deleted=0;");
			}
			
			if (empty($contests))
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Contests Not Found');
			else
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $contests);
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}
	//params : {matchid:"2"}
	function players($matchid = 0, $internal = false) {
		global $server_url;
		$matchid = intval(@$_REQUEST['matchid']);
		
		if($matchid){
			$query = "select p.*, t.match_id, t.name as team_name, t.logo_url, TRUNCATE((count(distinct tp.id) / count(distinct mt1.id) * 100), 2) as selectedBy, TRUNCATE((count(distinct if(tp.captain=1, tp.id, null)) / count(distinct mt1.id) * 100), 2) as cSelectedBy, TRUNCATE((count(distinct if(tp.vice_captain=1, tp.id, null)) / count(distinct mt1.id) * 100), 2) as vcSelectedBy from teams t, players p left join my_team_players tp on tp.player_id=p.id and tp.deleted=0 left join my_teams mt on tp.team_id=mt.id and mt.deleted=0 left join my_teams mt1 on mt.cid=mt1.cid and mt1.deleted=0 where p.deleted=0 and t.deleted=0 and t.mid='{$matchid}' and t.team_id=p.team_id and t.match_id=p.mid group by p.id order by selectedBy desc, p.title asc;";
			$players = getRecords($query);
			
			foreach ($players as &$player) {
				
				if(!$player['selectedBy'])
					$player['selectedBy'] = "0";
				
				if(!$player['cSelectedBy'])
					$player['cSelectedBy'] = "0";
				
				if(!$player['vcSelectedBy'])
					$player['vcSelectedBy'] = "0";
				
				$player['points'] = floatval(getRecordField($query = "select sum(mtp.points) as points from matches m1, matches m, my_teams mt, my_team_players mtp where m1.match_id='{$player['match_id']}' and m1.cid=m.cid and mt.match_id=m.id and mtp.match_id=m.id and mt.id=mtp.team_id and mtp.player_id='{$player['id']}'"));
				
			}
			
			if ($internal)
				return $players;
			else {
				if (empty($players))
					$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Players Not Found');
				else
					$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $players);
			}
		}
		else if ($internal)
			return array();
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Matches ID Required');
		
		if (!$internal) {
			$this->sendResponse($response);
			exit();
		}
	}
	
	//params : {userid:"2", cid:"2", matchid:"2", teamid:"2"}
	/*function assignContest() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		$matchid = intval(@$_REQUEST['matchid']);
		$cid = intval(@$_REQUEST['cid']);
		$teamid = intval(@$_REQUEST['teamid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($matchid && $teamid && $cid){
			$contest = getRecord($query = "select c.* from contests c where c.match_id in (0, '{$matchid}') and c.deleted=0 and c.id='{$cid}';");
			if(!$contest){
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Contest Not Found');
				$this->sendResponse($response);
				exit();
			}

			$teamid = getRecordField($query = "select id as cnt from my_teams where match_id in (0, '{$matchid}') and id='{$teamid}' and userid='{$userid}' and deleted=0;");
			
			if($teamid){
				$joinedUsers = getRecordField($query = "select count(u.id) as cnt from contests c, user_contests u where u.match_id='{$matchid}' and u.cid='{$contest['id']}' and u.deleted=0 and c.id=u.cid;");
				
				if(intval($joinedUsers) < intval($contest['sopts'])){
					$myTeamsCnt = getRecordField($query = "select count(id) as cnt from my_teams where match_id='{$matchid}' and cid='{$contest['id']}' and userid='{$userid}' and deleted=0;");
					
					
					if(intval($myTeamsCnt) < intval($contest['team_size'])){
						$query = "update my_teams set cid='{$cid}' where id='{$teamid}';";
						tspl_query($query);
						
						$query = "insert into user_contests (userid, cid, match_id) values('{$userid}', '{$cid}', '{$matchid}');";
						tspl_query($query);
						
						$query = "update user set balance=balance-'".  floatval($contest['fees'])."' where id='{$userid}';";
						tspl_query($query);
						
						$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('message' => 'Contest Assigned Successfully'));
					}
					else{
						$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Team size Reached');
					}
				}
				else{
					$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Contest Spots Reached');
				}
			}
			else
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Team Not Found');
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}*/
	
	
	
	function assignContest() {
    global $server_url;
    $userid = intval(@$_REQUEST['userid']);
    $matchid = intval(@$_REQUEST['matchid']);
    $cid = intval(@$_REQUEST['cid']);
    $teamids_str = @$_REQUEST['teamid'];
    
    // Split the comma-separated team IDs into an array
    $teamids = array_map('intval', explode(',', $teamids_str));
    
    if (!app_login($userid)) {
        $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
        $this->sendResponse($response);
        exit();
    }

    if ($matchid && !empty($teamids) && $cid) {
        $contest = getRecord($query = "select c.* from contests c where c.match_id in (0, '{$matchid}') and c.deleted=0 and c.id='{$cid}';");
        if (!$contest) {
            $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Contest Not Found');
            $this->sendResponse($response);
            exit();
        }

        foreach ($teamids as $teamid) {
            $teamRecord = getRecordField($query = "select id as cnt from my_teams where match_id in (0, '{$matchid}') and id='{$teamid}' and userid='{$userid}' and deleted=0;");
            
            if ($teamRecord) {
                $joinedUsers = getRecordField($query = "select count(u.id) as cnt from contests c, user_contests u where u.match_id='{$matchid}' and u.cid='{$contest['id']}' and u.deleted=0 and c.id=u.cid;");
                
                if (intval($joinedUsers) < intval($contest['sopts'])) {
                    $myTeamsCnt = getRecordField($query = "select count(id) as cnt from my_teams where match_id='{$matchid}' and cid='{$contest['id']}' and userid='{$userid}' and deleted=0;");
                    
                    if (intval($myTeamsCnt) < intval($contest['team_size'])) {
                        $query = "update my_teams set cid='{$cid}' where id='{$teamid}';";
                        tspl_query($query);

                        $query = "insert into user_contests (userid, cid, match_id) values('{$userid}', '{$cid}', '{$matchid}');";
                        tspl_query($query);

                        $query = "update user set balance=balance-'".  floatval($contest['fees'])."' where id='{$userid}';";
                        tspl_query($query);

                        $response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('message' => 'Contest Assigned Successfully'));
                    } else {
                        $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Team size Reached');
                        $this->sendResponse($response);
                        exit();
                    }
                } else {
                    $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Contest Spots Reached');
                    $this->sendResponse($response);
                    exit();
                }
            } else {
                $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Team Not Found');
                $this->sendResponse($response);
                exit();
            }
        }
    } else {
        $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
        $this->sendResponse($response);
        exit();
    }

    $this->sendResponse($response);
    exit();
}


	
	
	
	//params : {userid:"2", cid:"2", matchid:"2", name:"Team 1", players:{2,4,9,3,7,5,6}, captain: 9, vice_captain: 6, points:"90"}
	function addTeam() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		$matchid = intval(@$_REQUEST['matchid']);
		$cid = intval(@$_REQUEST['cid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($matchid && @$_REQUEST['players'] && $_REQUEST['captain'] && $_REQUEST['vice_captain']){
			if($cid){
				$contest = getRecord($query = "select c.* from contests c where c.match_id='{$matchid}' and c.deleted=0 and c.id='{$cid}';");
				if(!$contest){
					$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Team size Reached');
					$this->sendResponse($response);
					exit();
				}
				
				$joinedUsers = getRecordField($query = "select count(u.id) as cnt from contests c, user_contests u where u.match_id='{$matchid}' and u.cid='{$contest['id']}' and u.deleted=0 and c.id=u.cid;");
				
				if(intval($joinedUsers) < intval($contest['sopts'])){
					$myTeamsCnt = getRecordField($query = "select count(id) as cnt from my_teams where match_id='{$matchid}' and cid='{$contest['id']}' and userid='{$userid}' and deleted=0;");
					
					if(intval($myTeamsCnt) < intval($contest['team_size'])){}
					else{
						$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Team size Reached');
						$this->sendResponse($response);
						exit();
					}
				}
				else{
					$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Contest Spots Reached');
					$this->sendResponse($response);
					exit();
				}
			}
			
			$query = "insert into my_teams(userid, match_id, cid, name, total) values('{$userid}', '{$matchid}', '{$cid}', '{$_REQUEST['name']}', '" . floatval($_REQUEST['points']) . "');";
			tspl_query($query);
			
			$teamId = tspl_insert_id();
			
			$query = "update my_teams set name='Team {$teamId}' where id='{$teamId}';";
			tspl_query($query);
			
			if(!is_array($_REQUEST['players']))
				$players = explode(",", str_replace(array("[", "]"),"", urldecode($_REQUEST['players'])));
			else
				$players = $_REQUEST['players'];
				
			foreach($players as $player){
				$query = "insert into my_team_players(userid, match_id, team_id, player_id) values('{$userid}', '{$matchid}', '{$teamId}', '" . trim($player) . "');";
				tspl_query($query);
			}
			
			$query = "update my_team_players set captain=0 where team_id='{$teamId}' and userid='{$userid}' and deleted=0;";
			tspl_query($query);
			
			$query = "update my_team_players set captain=1 where team_id='{$teamId}' and userid='{$userid}' and player_id='{$_REQUEST['captain']}' and deleted=0;";
			tspl_query($query);
			
			$query = "update my_team_players set vice_captain=0 where team_id='{$teamId}' and userid='{$userid}' and deleted=0;";
			tspl_query($query);
			
			$query = "update my_team_players set vice_captain=1 where team_id='{$teamId}' and userid='{$userid}' and player_id='{$_REQUEST['vice_captain']}' and deleted=0;";
			tspl_query($query);
			
			$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('message' => 'Team created Successfully', 'teamId' => $teamId));
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}

	//params : {userid:"2", teamid:"2", matchid:"2", players:{2,4,9,3,7,5,6}, captain: 9, vice_captain: 6, points:"90"}
	function modifyTeam() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		$matchid = intval(@$_REQUEST['matchid']);
		$teamid = intval(@$_REQUEST['teamid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($matchid && @$_REQUEST['players'] && $_REQUEST['captain'] && $_REQUEST['vice_captain']){
			$query = "update my_teams set userid='{$userid}', match_id='{$matchid}', name='Team {$teamId}', total='" . floatval($_REQUEST['points']) . "' where id='{$teamid}';";
			tspl_query($query);
			
			$query = "update my_team_players set deleted=1 where team_id='{$teamid}';";
			tspl_query($query);
			
			if(!is_array($_REQUEST['players']))
				$players = explode(",", str_replace(array("[", "]"),"", urldecode($_REQUEST['players'])));
			else
				$players = $_REQUEST['players'];
			
			foreach($players as $player){
				$query = "insert into my_team_players(userid, match_id, team_id, player_id) values('{$userid}', '{$matchid}', '{$teamid}', '" . trim($player) . "') on duplicate key update deleted=0;";
				tspl_query($query);
			}
			
			$query = "update my_team_players set captain=0 where team_id='{$teamid}' and userid='{$userid}';";
			tspl_query($query);
			
			$query = "update my_team_players set captain=1 where team_id='{$teamid}' and userid='{$userid}' and player_id='{$_REQUEST['captain']}' and deleted=0;";
			tspl_query($query);
			
			$query = "update my_team_players set vice_captain=0 where team_id='{$teamid}' and userid='{$userid}';";
			tspl_query($query);
			
			$query = "update my_team_players set vice_captain=1 where team_id='{$teamid}' and userid='{$userid}' and player_id='{$_REQUEST['vice_captain']}' and deleted=0;";
			tspl_query($query);
			
			$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('message' => 'Team Updated Successfully'));
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}
	
	//params : {userid:"2", teamid:"2"}
	function deleteTeam() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		$teamid = intval(@$_REQUEST['teamid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($teamid){
			
			$query = "update my_teams set deleted=1 where id='{$teamid}';";
			tspl_query($query);
			
			$query = "update my_team_players set deleted=1 where team_id='{$teamid}';";
			tspl_query($query);
			
			$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('message' => 'Team Deleted Successfully'));
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}

	//params : {userid:"1", matchid:"2"}
	function myTeams() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		$matchid = intval(@$_REQUEST['matchid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($userid){
			$teams = getRecords($query = "select * from my_teams where userid='{$userid}' and deleted=0 " . ($matchid?"and match_id='{$matchid}'":"") . " order by id desc;");
			foreach ($teams as &$team) {
				$team['players'] = getRecords($query = "select p.*, t.captain, t.vice_captain, t1.name as team_name, t1.logo_url from my_team_players t left join  matches m on t.match_id=m.id left join  players p on t.player_id=p.id  left join teams t1 on p.team_id=t1.team_id and m.match_id=t1.match_id where t.deleted=0 and t.team_id='{$team['id']}';");
			}	
			if (empty($teams))
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Teams Not Found');
			else
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $teams);
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}
	
	
	function getTeams(){
	   	global $server_url; 
	   	$userid = intval(@$_REQUEST['userid']);
		$matchid = @$_REQUEST['matchid'];
		$cid = @$_REQUEST['cid'];
			if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
			if(isset($matchid) && isset($cid)){
			    $teams = getRecords($query = "select * from my_teams where userid='{$userid}' and match_id='$matchid' and cid='$cid' and deleted=0  order by id desc;");
			    foreach ($teams as &$team) {
				$team['players'] = getRecords($query = "select p.*, t.captain, t.vice_captain, t1.name as team_name, t1.logo_url from my_team_players t left join  matches m on t.match_id=m.id left join  players p on t.player_id=p.id  left join teams t1 on p.team_id=t1.team_id and m.match_id=t1.match_id where t.deleted=0 and t.team_id='{$team['id']}';");
			}	
			if (empty($teams))
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Teams Not Found');
			else
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $teams);
			}else{
			  $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');  
			}
	  $this->sendResponse($response);
		exit();  
	}
	
	//params : {userid:"1", teamid:"2"}
	function teamDetails() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		$teamid = intval(@$_REQUEST['teamid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($userid && $teamid){
			$team = getRecord($query = "select t.* from my_teams t where t.userid='{$userid}' and t.deleted=0 and t.id='{$teamid}' order by t.id desc;");
			$team['players'] = getRecords($query = "select p.*, t.captain, t.vice_captain, t1.name as team_name, t1.logo_url from my_team_players t left join  matches m on t.match_id=m.id left join  players p on t.player_id=p.id  left join teams t1 on p.team_id=t1.team_id and m.match_id=t1.match_id where t.deleted=0 and t.team_id='{$teamid}';");
				
			if (empty($team))
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Team Not Found');
			else
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $team);
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}
	//params : {userid:"1"}
	function transactions() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($userid){
			$transactions = getRecords($query = "select * from transactions where userid='{$userid}' and deleted=0 order by id desc;");			
			if (empty($transactions))
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Transactions Not Found');
			else
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $transactions);
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}
	
	//params : {userid:"1"}
	function winners() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($userid){
			$matches = getRecords($query = "select * from matches where deleted=0 and status=2 order by date_start asc;");
		//	print_r($matches);
			$teams = array();
			foreach ($matches as &$match) {
				
				$match['teama'] = getRecord($query = "select * from teams where match_id='{$match['match_id']}' and mid='{$match['id']}' order by id asc limit 1;");
				
				$match['teamb'] = getRecord($query = "select * from teams where match_id='{$match['match_id']}' and mid='{$match['id']}' order by id desc limit 1;");
				
				$match['contest'] = $contests = getRecords($query = "select name, price from contests where match_id='{$match['id']}' and deleted=0 order by price desc limit 1;");
				
				$winners = $this->getUsersRankByMatchId($match['id']);
				
				$match['winners'] = $winners;
				if($contests && $match['teama'] && $match['teamb'])
					$teams[] = $match;
			}
				
			if (empty($teams))
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $teams);
			else
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $teams);
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}
	
	
	function getUserwinnings(){
	  global $server_url;
		$userid = intval(@$_REQUEST['userid']);  
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		$getdata=getRecords("SELECT * FROM transactions WHERE userid='$userid' and deleted=0 ORDER BY id DESC");
		if($getdata){
		    	$response = array('status' => '200', 'error' => 0, 'success' => 1, 'message' => 'Loaded Successfully', 'data' => $getdata);
		}else{
		    	$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'No data found');
		}
		$this->sendResponse($response);
		exit();
	}

	//params : {userid:"1", match_id:"2", cid:"2"}
	function ranks() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		$matchid = intval(@$_REQUEST['match_id']);
		$cid = intval(@$_REQUEST['cid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($userid && $matchid){
			$teams = $this->getUsersRankByMatchId($matchid, $cid);
			// $this->updateUserBalance();	
			if (empty($teams))
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array());
			else
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $teams);
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}

	function updateUserBalance(){
		$matches = getRecords($query = "select m.id, m.match_id, c.cid as cid, m.title from matches m, user_contests c where m.deleted=0 and m.status=2 and m.distributed=0 and c.match_id=m.id order by m.id desc;");
		
		foreach ($matches as $key => $match) {
			$teams = $this->getUsersRankByMatchId($match['id'], $match['cid']);
			
			foreach ($teams as $team) {
				if(floatval($team['amount']) > 0){
					$ids = explode(",", $team['userIds']);
					
					foreach ($ids as $key => $id) {
						$query = "update user set balance=balance+'{$team['amount']}' where id in('{$id}');";
						tspl_query($query);
						
						$query = "insert into transactions(type, amount, userid, date, remark) values('credit', '{$team['amount']}', '{$id}', curdate(), 'Winning amount against {$match['title']}');";
						tspl_query($query);
					}
				}
			}

			$query = "update matches set distributed=1 where id in('{$match['id']}');";
			tspl_query($query);
		}
	}

	function getUsersRankByMatchId($mid = 0, $cid = 0){
		$teams = getRecords($query = "select t.points, t.total, count(t.id) as userCount, group_concat(u.id) as userIds, u.name from my_teams t, user u where t.match_id='{$mid}' and t.cid='{$cid}' and t.deleted=0 and t.userid=u.id group by t.points order by t.points desc;");
		$rank = 1;
		
		foreach ($teams as &$team) {
			$rule = getRecord($query = "select * from contest_rules where cid='{$cid}' and deleted=0 and min_rank >= {$rank} and max_rank <= {$rank};");
			
			$team['amount'] = floatval($rule['amount']) / intval($team['userCount']);
			$team['rank'] = $rank;
			
			$rank++;
		}
		
		return $teams;
	}
	//params : {match_id:"2"}
	function scorecard() {
		global $server_url, $entityToken;
		$matchid = intval(@$_REQUEST['match_id']);
		
		if($matchid){
			$match = getRecord($query = "select id, match_id, cid from matches where deleted=0 and id='{$matchid}';");
			$url = "https://rest.entitysport.com/v2/matches/{$match['id']}/scorecard?token={$entityToken}";
			$response = getCurlResponse($url);
			$response = json_decode($response, 1);
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}
	
	//params : {userid:"1", matchid:"2"}
	function opinions() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		$matchid = intval(@$_REQUEST['matchid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($matchid){
			$opinions = getRecords($query = "select * from opinions where deleted=0 and match_id='{$matchid}' order by id desc;");
			if (empty($opinions))
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Not Found');
			else
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $opinions);
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}

	//params : {userid:"1"}
	function kycStatus() {
		global $server_url;
		if (!app_login(@$_REQUEST['userid'])) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if ($userid = intval(@$_REQUEST['userid'])) {
			$user = getRecord($query = "select u.* from user u where u.deleted=0 and u.usertype in('user') and u.id='{$userid}';");
			if ($user) {
				if($kid = getRecordField($query = "select id from kyc where userid='{$userid}' and approved=1 and deleted=0;")){
					$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('message' => "KYC approved"));
				}
				else
					$response = array('status' => '300', 'error' => 1, 'success' => 0, 'message' => "KYC not approved");
			} else{
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "User Not Found");
			}
		} else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Missing userid or amount");
		$this->sendResponse($response);
		exit();
	}

	//params : {userid:"1"}
	function myMatches() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($userid){
			$matches = getRecords($query = "select m.* from my_teams t, matches m where t.userid='{$userid}' and t.deleted=0 and t.match_id=m.id and t.cid > 0 group by t.match_id order by t.id desc;");
			
			foreach ($matches as &$match) {
				$match['teama'] = getRecord($query = "select * from teams where match_id='{$match['match_id']}' and mid='{$match['id']}' order by id asc limit 1;");
				$match['teamb'] = getRecord($query = "select * from teams where match_id='{$match['match_id']}' and mid='{$match['id']}' order by id desc limit 1;");
				$match['prize'] = floatval(getRecordField($query = "select price from contests where match_id='{$match['id']}' and deleted=0 order by price desc limit 1;"));
				
				if(!$match['prize'])
					$match['prize'] = 0;
			}
			if (empty($matches))
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Matches Not Found');
			else
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $matches);
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}
	
	//params : {userid:"1", matchid: "7851", cid: "2"}
	function teamDetailsByContest() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		$matchid = intval(@$_REQUEST['matchid']);
		$cid = intval(@$_REQUEST['cid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($userid && $matchid && $cid){
			$team = getRecord($query = "select t.* from my_teams t where t.userid='{$userid}' and t.deleted=0 and t.match_id='{$matchid}' and t.cid='{$cid}' order by t.id desc;");
			$team['players'] = getRecords($query = "select p.*, t.captain, t.vice_captain, t1.name as team_name, t1.logo_url from my_team_players t left join  matches m on t.match_id=m.id left join  players p on t.player_id=p.id  left join teams t1 on p.team_id=t1.team_id and m.match_id=t1.match_id where t.backup=0 and t.deleted=0 and t.team_id='{$team['id']}';");
				
			if (empty($team))
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Team Not Found');
			else
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $team);
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}

	//params : {userid:"1"}
	function getLiveMatches() {
		global $server_url, $entityToken;
		$userid = intval(@$_REQUEST['userid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($userid){
			file_get_contents($server_url . 'crons/getLiveMatches');
			file_get_contents($server_url . 'crons/getScheduledMatches');
			file_get_contents($server_url . 'crons/getCompletedMatches');
			
			$matches = getRecords($query = "select m.* from my_teams t,matches m where m.status=3 and t.userid='{$userid}' and t.deleted=0 and t.match_id=m.id and t.cid>0 group by m.id order by t.id desc;");
			
			foreach ($matches as &$match) {
				$match['teama'] = getRecord($query = "select * from teams where match_id='{$match['match_id']}' and mid='{$match['id']}' order by id asc limit 1;");
				$match['teamb'] = getRecord($query = "select * from teams where match_id='{$match['match_id']}' and mid='{$match['id']}' order by id desc limit 1;");
				$match['prize'] = floatval(getRecordField($query = "select price from contests where match_id='{$match['id']}' and deleted=0 order by price desc limit 1;"));
				
				if(!$match['prize'])
					$match['prize'] = 0;
				
				$url = "https://rest.entitysport.com/v2/matches/{$match['match_id']}/scorecard?token={$entityToken}";
				$scorecard = getCurlResponse($url);
				$match['scorecard'] = json_decode($scorecard, 1);
			}
				
			if (empty($matches))
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Matches Not Found');
			else
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $matches);
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}

	//params : {userid:"114", matchid:"2", teamid:"28"}
	function backupPlayers($matchid = 0, $internal = false) {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		$matchid = intval(@$_REQUEST['matchid']);
		$teamid = intval(@$_REQUEST['teamid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($matchid && $teamid){
			$query = "select p.*, t.match_id, t.name as team_name, t.logo_url, TRUNCATE((count(distinct tp.id) / count(distinct mt1.id) * 100), 2) as selectedBy, TRUNCATE((count(distinct if(tp.captain=1, tp.id, null)) / count(distinct mt1.id) * 100), 2) as cSelectedBy, TRUNCATE((count(distinct if(tp.vice_captain=1, tp.id, null)) / count(distinct mt1.id) * 100), 2) as vcSelectedBy from teams t, players p left join my_team_players tp on tp.player_id=p.id and tp.deleted=0 left join my_teams mt on tp.team_id=mt.id and mt.deleted=0 left join my_teams mt1 on mt.cid=mt1.cid and mt1.deleted=0 where p.deleted=0 and t.deleted=0 and t.mid='{$matchid}' and t.team_id=p.team_id and t.match_id=p.mid and p.id not in (select player_id from my_team_players where team_id='{$teamid}' and deleted=0) group by p.id order by selectedBy desc, p.title asc;";
			$players = getRecords($query);
			
			foreach ($players as &$player) {
				
				if(!$player['selectedBy'])
					$player['selectedBy'] = "0";
				
				if(!$player['cSelectedBy'])
					$player['cSelectedBy'] = "0";
				
				if(!$player['vcSelectedBy'])
					$player['vcSelectedBy'] = "0";
				
				$player['points'] = floatval(getRecordField($query = "select sum(mtp.points) as points from matches m1, matches m, my_teams mt, my_team_players mtp where m1.match_id='{$player['match_id']}' and m1.cid=m.cid and mt.match_id=m.id and mtp.match_id=m.id and mt.id=mtp.team_id and mtp.player_id='{$player['id']}'"));
				
			}
			
			if ($internal)
				return $players;
			else {
				if (empty($players))
					$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Players Not Found');
				else
					$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $players);
			}
		}
		else if ($internal)
			return array();
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Matches ID Required');
		
		if (!$internal) {
			$this->sendResponse($response);
			exit();
		}
	}

	//params : {userid:"2", teamid:"2", matchid:"2", players:{2,4,9,3}}
	function addBackupPlayers() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		$matchid = intval(@$_REQUEST['matchid']);
		$teamid = intval(@$_REQUEST['teamid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($matchid && $teamid && @$_REQUEST['players']){
			if(!is_array($_REQUEST['players']))
				$players = explode(",", str_replace(array("[", "]"),"", urldecode($_REQUEST['players'])));
			else
				$players = $_REQUEST['players'];
			
			if(count($players) > 4){
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Playrs should not be greater than 4 players');
			}
			else{	
				foreach($players as $player){
					$query = "insert into my_team_players(userid, match_id, team_id, player_id, backup) values('{$userid}', '{$matchid}', '{$teamid}', '" . trim($player) . "', 1);";
					tspl_query($query);
				}
			
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('message' => 'Backup Players Added Successfully', 'teamId' => $teamid));
			}
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}
	
	//params : {userid:"2", upi_id:"2564@ybl", bank_name:"SBI", acc_no:"123456487978", ifsc:"SBIN0000785"}
	/*function addBankDetails() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if((@$_REQUEST['upi_id']) || (@$_REQUEST['bank_name'] && @$_REQUEST['acc_no'] && @$_REQUEST['ifsc'])){
		    $update = array();
		    $fields = array("upi_id", "bank_name", "acc_no", "ifsc");
		    foreach($fields as $v){
		        if(@$_REQUEST[$v])
		            $update[] = "$v='{$_REQUEST[$v]}'";
		    }
				
			$query = "update user set " . join(',', $update) . " where id='{$userid}';";
			tspl_query($query);
		
			$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('message' => 'Bank Details Updated Successfully'));
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}*/
	
	
	function addBankDetails() {
    global $server_url; // If $server_url is necessary, consider passing it as a parameter instead of using a global variable.
	$userid = $_POST['userid'];
	$upi_id = $_POST['upi_id'];
	$bank_name = $_POST['bank_name'];
	$acc_no = $_POST['acc_no'];
	$ifsc = $_POST['ifsc'];
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
   	if((@$_POST['upi_id']) || (@$_POST['bank_name'] && @$_POST['acc_no'] && @$_POST['ifsc'])){
   	   $update = array();
		    $fields = array("upi_id", "bank_name", "acc_no", "ifsc");
		    foreach($fields as $v){
		        if(@$_REQUEST[$v])
		            $update[] = "$v='{$_REQUEST[$v]}'";
		    }
				
			$query = "update user set " . join(',', $update) . " where id='{$userid}';";
			tspl_query($query);
   	    $response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => array('message' => 'Bank Details Updated Successfully'));
   	}else{
   	  $response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');  
   	}
   	
   	$this->sendResponse($response);
		exit();
}

	
	//params : {userid:"1"}
	function getBankDetails() {
		global $server_url;
		$userid = intval(@$_REQUEST['userid']);
		
		if (!app_login($userid)) {
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => "Invalid Userid or User Not Active");
			$this->sendResponse($response);
			exit();
		}
		
		if($userid){
			$data = getRecord($query = "select upi_id, bank_name, acc_no, ifsc from user where id='{$userid}';");
				
			if (empty($data))
				$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Bank details not found');
			else
				$response = array('status' => '200', 'error' => 0, 'success' => 1, 'result' => $data);
		}
		else
			$response = array('status' => '400', 'error' => 1, 'success' => 0, 'message' => 'Missing Required Parameters');
		
		$this->sendResponse($response);
		exit();
	}
}
?>