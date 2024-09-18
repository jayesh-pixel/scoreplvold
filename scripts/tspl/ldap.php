<?php
	$ldapconfig['host'] = '192.168.1.2';
	$ldapconfig['port'] = 389;
	$ldapconfig['basedn'] = 'ou=Users,dc=indra';
	$ldapconfig['authrealm'] = 'Triyama';

	function ldap_authenticate($uid, $password) {
	    global $ldapconfig;
	    if ($uid != "" && $password != "") {
	        if($ds = ldap_connect($ldapconfig['host'], $ldapconfig['port']))
	        {
	        	if (ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3))
	        	{
			        $r = ldap_search($ds, $ldapconfig['basedn'], 'uid=' . $uid);
			        if ($r) {
			            $result = ldap_get_entries($ds, $r);
			            if ($result[0]) {
			                if (ldap_bind($ds, $result[0]['dn'], $password) ) {
			                    return $result[0];
			                }
			                else
			                	echo '<b>' . ldap_errno($ds) . ': ' . ldap_error($ds) . '</b><br />' . ldap_err2str(ldap_errno($ds));
			            }
					}
		        }
				else
				    die("Failed to set protocol version to 3");
	        }
	        else
	        	die("Problem Connecting To LDAP");
	    }
        else
        	die("Username or Password missing");
	    return NULL;
	}

	function ldap_groups() {
	    global $ldapconfig;
        if($ds = ldap_connect($ldapconfig['host'], $ldapconfig['port']))
        {
        	if (ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3))
        	{
		        $r = ldap_search($ds, str_replace('Users', 'Groups', $ldapconfig['basedn']), 'cn=*');
		        if ($r) {
		            $result = ldap_get_entries($ds, $r);
//				   	echo '<pre>' . print_r($result, true) . '</pre>';
		            $groups = array();
		            foreach ($result as $k => $v)
		            {
		            	$groups[] = $v['cn'][0];
		            }
                    return $groups;
                }
                else
                	echo '<b>' . ldap_errno($ds) . ': ' . ldap_error($ds) . '</b><br />' . ldap_err2str(ldap_errno($ds));
	        }
			else
			    die("Failed to set protocol version to 3");
        }
        else
        	die("Problem Connecting To LDAP");
	    return NULL;
	}

	function ldap_users($gid = '*') {
	    global $ldapconfig;
        if($ds = ldap_connect($ldapconfig['host'], $ldapconfig['port']))
        {
        	if (ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3))
        	{
		        $r = ldap_search($ds, str_replace('Users', 'Groups', $ldapconfig['basedn']), "cn=$gid");
		        if ($r) {
		            $result = ldap_get_entries($ds, $r);
//				   	echo '<pre>' . print_r($result, true) . '</pre>';
		            $users = array();
		            foreach ($result as $k => $v)
		            	if($v['memberuid'] && is_array($v['memberuid']))
			            	foreach ($v['memberuid'] as $k1 => $uid)
				            	if($k1 != 'count' && !in_array($uid, $users))
				            		$users[] = $uid;
                    return $users;
                }
                else
                	echo '<b>' . ldap_errno($ds) . ': ' . ldap_error($ds) . '</b><br />' . ldap_err2str(ldap_errno($ds));
	        }
			else
			    die("Failed to set protocol version to 3");
        }
        else
        	die("Problem Connecting To LDAP");
	    return NULL;
	}

//    $uid = 'jjrohit';
//    $password = 'tr1yama';
//
//	if (($result = ldap_authenticate($uid, $password)) == NULL) {
//	    echo('Authorization Failed');
//	    exit(0);
//	}
//	echo('Authorization success');
//   	echo '<pre>' . print_r($result, true) . '</pre>';
?>