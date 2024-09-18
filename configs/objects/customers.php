<?php
	
	function list_customers($id){
		global $row;
		$row['kyc_id'] = getRecordField($query = "select approved from kyc where userid='{$id}';");
		$row['kyc'] = ($row['kyc_id']?"Approved":"Pending");
	}
	
	function edit_customers($id){
		$query = "update user set usertype='user' where id='{$id}';";
		tspl_query($query);
	}
	
	function details_customers($id){
		global $row;
		$row['kyc_id'] = getRecordField($query = "select approved from kyc where userid='{$id}';");
		$row['kyc'] = ($row['kyc_id']?"Approved":"Pending");
	}
	
	$objects['customers'] = array(
		'meta' => array(
			'access' => ($_SESSION[$session]['usertype'] == 'Administrator'),
			'singular' => 'User',
			'plural' => 'Users',
			'table' => 'user',
			'default_sort_field' => 'name',
			'default_sort_order' => 'asc',
			'add' => true,
			'edit' => true,
			'search' => true,
			'details' => true,
			'delete' => 'deleted',
			'fullpage' => false,
			'filter' => "deleted=0 and usertype='user'"
		),
		'fields' => array(
			'name' => array(
				'displayname' => 'Customer Name',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'validation' => 'required',
			),
			'phone' => array(
				'displayname' => 'Mobile Number',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'validation' => 'required, int',
			),
			'email' => array(
				'displayname' => 'Email',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => true,
				'details' => true,
				'validation' => 'required',
			),
			'dob' => array(
				'displayname' => 'DOB',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => false,
				'details' => true,
				'input' => 'date',
				'validation' => 'required',
			),
			'state' => array(
				'displayname' => 'State',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => false,
				'details' => true,
				'validation' => 'required',
			),
			'gender' => array(
				'displayname' => 'Gender',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => false,
				'details' => true,
				'input' => 'select',
				'options' => array('male' => 'Male', 'female' => 'Female', 'other' => 'Other'),
				'assoc' => true,
				'validation' => 'required',
			),
			'balance' => array(
				'displayname' => 'Balance',
				'sort' => true,
				'list' => true,
				'edit' => true,
				'search' => false,
				'details' => true,
				'validation' => 'required',
			),
			'kyc' => array(
				'displayname' => 'KYC',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
				'input' => 'select',
				'options' => array(1 => 'Approved', 0 => 'Pending'),
				'assoc' => true,
				'validation' => 'required',
			),
			'imgpath' => array(
				'displayname' => 'Profile Image',
				'sort' => true,
				'list' => false,
				'edit' => true,
				'search' => false,
				'details' => true,
				'input' => 'file',
				'validation' => 'required'
			),
			'pass' => array(
				'displayname' => 'Password',
				'sort' => true,
				'list' => false,
				'edit' => false,
				'search' => false,
				'details' => true,
				'input' => 'password',
				'validation' => 'required',
				'help' => 'Leave blank to keep the same password'
			),
			'upi_id' => array(
				'displayname' => 'UPI Id',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
			),
			'bank_name' => array(
				'displayname' => 'Bank Name',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
			),
			'acc_no' => array(
				'displayname' => 'Account No.',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
			),
			'ifsc' => array(
				'displayname' => 'IFSC',
				'sort' => true,
				'list' => true,
				'edit' => false,
				'search' => false,
				'details' => true,
			),
		)
	);
?>
