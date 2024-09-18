<?php
	if(defined('DAPP'))
	{
		if(!function_exists('getRecords'))
		{
			function getRecords($query)
			{
				global $window;
				return $window->getRecordsJS($query);
			}
		}

		if(!function_exists('getRecord'))
		{
			function getRecord($query)
			{
				global $window;
				return $window->getRecordJS($query);
			}
		}

		if(!function_exists('dbUpdate'))
		{
			function dbUpdate($query)
			{
				global $window;
				return $window->dbUpdateJS($query);
			}
		}

		if(!function_exists('dbInsert'))
		{
			function dbInsert($query)
			{
				global $window;
				return $window->dbInsertJS($query);
			}
		}

		if(!function_exists('getColumnNames'))
		{
			function getColumnNames($tableName)
			{
				global $window;
				return $window->getColumnNamesJS($tableName);
			}
		}
	}
	else
	{
		if(!function_exists('getRecords'))
		{
			function getRecords($query)
			{
			    global $conn;
				$records = array();
				$result = mysqli_query($conn, $query) or db_fail($query);
				while($row = mysqli_fetch_assoc($result))
					$records[] = $row;
				return $records;
			}
		}

		if(!function_exists('getRecord'))
		{
			function getRecord($query)
			{
				$records = getRecords($query);
				if(count($records))
					return $records[0];
				else
					return null;
			}
		}

		if(!function_exists('dbUpdate'))
		{
			function dbUpdate($query)
			{
			    global $conn;
				mysqli_query($conn, $query) or db_fail($query);
				return mysqli_affected_rows($conn);
			}
		}

		if(!function_exists('dbInsert'))
		{
			function dbInsert($query)
			{
			    global $conn;

				mysqli_query($conn, $query) or db_fail($query);
				return mysqli_insert_id($conn);
			}
		}

		if(!function_exists('getColumnNames'))
		{
			function getColumnNames($tableName)
			{
				$columns = array();
				$records = getRecords("desc $tableName;");
				foreach($records as $row)
					$columns[] = $row['Field'];
				return $columns;
			}
		}
	}
?>