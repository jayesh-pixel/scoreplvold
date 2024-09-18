<?php
	require('dbFunctions.php');

	if(!class_exists('DB3'))
	{
		// $status_text = false;
		// require('../../ioncube/html_encoder_1.9.php');

		/************************************************************
		 * Class Name 		: DB3 (Database Versioning System)		*
		 * Author	  		: Triyama Software Pune.				*
		 * Description		: It's a framework for database 		*
		 * 					   versioning 							*
		 * Language Support :  PHP, MySql							*
		 * Year				: July 2009								*
		 ************************************************************/
		class DB3 {

			static public $versioning = false;
			static public $objectProps = array();

			static function dataCleaner($value)
			{
			    global $conn;

				$value = stripcslashes($value);
                if(function_exists("tspl_escape_string"))
                    $value = tspl_escape_string( $value );
                elseif(function_exists("mysqli_real_escape_string"))
                    $value = mysqli_real_escape_string($conn, $value );
                elseif(function_exists("mysql_real_escape_string"))
                    $value = mysql_real_escape_string( $value );
			    else
					$value = addcslashes($value);
				if(get_magic_quotes_gpc())
					$value = stripcslashes($value);
	   			return preg_replace('/((\<\?(php)?)|(\?\>)|(<script\b[^>]*>.*?<\/script>))/i', '', $value);
			}

			static function inputCleaner(&$data)
			{
				if(is_array($data))
				{
					foreach ($data as $k => $v)
						$data[$k] = DB3::inputCleaner($v);
				}
				else
					$data = DB3::dataCleaner($data);
				return $data;
			}

			static function get_config_value($name)
			{
				global $globalTableFilter;
				global $$globalTableFilter;

				if($name)
				{
					if($row = getRecord("select value from config where name='" . DB3::dataCleaner($name) . "'" . ($globalTableFilter?" and $globalTableFilter in ('{$$globalTableFilter}', '', 0) order by $globalTableFilter desc":"") . ";"))
						return $row['value'];
				}
				return null;
			}

			static function getGlobalFilter($add = false, $objectName = "")
			{
				global $globalTableFilter;
				global $$globalTableFilter;

				if($globalTableFilter)
					return ($add?" and ":"") . ($objectName?"$objectName.":"") . "$globalTableFilter='{$$globalTableFilter}'";
				else
					return "";
			}

			static function deleteObjects($objectType, $strWhere = "")
			{
				global $globalTableFilter;
				global $$globalTableFilter;

				if($globalTableFilter)
					$strWhere .= ($strWhere?" and ":"") . "$globalTableFilter='{$$globalTableFilter}'";

				return dbUpdate("delete from $objectType " . ($strWhere?" where $strWhere":"") . ";");
			}

			static function getObjectsByQuery($strQuery)
			{
				return getRecords($strQuery);
			}

			static function getObjects($objectType, $strFields = "*", $strWhere = "", $strOrderBy = "")
			{
				global $globalTableFilter;
				global $$globalTableFilter;

				if($globalTableFilter)
					$strWhere .= ($strWhere?" and ":"") . "$globalTableFilter='{$$globalTableFilter}'";

				return DB3::getObjectsByQuery("select $strFields from $objectType " . ($strWhere?" where $strWhere":"") . ($strOrderBy?" order by $strOrderBy":"") . ";");
			}

			static function findObjects($objectType, $select = array('id'), $map = false, $strWhere = '', $orderby = '', $objects = array())
			{
				if(!$objectType || !count($select))
					return array();

				global $globalTableFilter;
				global $$globalTableFilter;

				if($globalTableFilter)
					$strWhere .= ($strWhere?" and ":"") . "$globalTableFilter='{$$globalTableFilter}'";

				if($map)
				{
					if(array_search('id', $select) === false)
					{
						if(count($select) == 2)
						{
							$displayField = $select[1];
							$indexField = $select[0];
						}
						elseif(count($select) == 1)
						{
							$displayField = $select[0];
							$indexField = 'id';
							$select[] = 'id';
						}
					}
					if(!$orderby)
						$orderby = $displayField;
				}
				
				$records = getRecords("select " . join(",", $select) . " from $objectType " . ($strWhere?"where $strWhere":"") . ($orderby?" order by $orderby":"") . ";");
				foreach($records as $row)
					if($map)
						$objects[$row[$indexField]] = $row[$displayField];
					else
						$objects[] = $row;
				return $objects;
			}

			static function findObjectsByQuery($query, $objects = array())
			{
				$records = getRecords($query);
				foreach($records as $row)
					$objects[$row[0]] = $row[1];
				return $objects;
			}

			static function findChildren($objectType, $displayField, $startWith = array(), $where = '')
			{
				return DB3::findObjects($objectType, $select = array($displayField), $map = true, $where, $orderby = $displayField, $startWith);
			}

			static function updateObject($objectType, $values, $versioning = null, $strWhere = null)
			{
				if($versioning === null)
					$versioning = DB3::$versioning;

				global $fields;
				if($fields[$objectType])
					DB3::$objectProps[$objectType] = $fields[$objectType];

				if(!@DB3::$objectProps[$objectType])
					DB3::$objectProps[$objectType] = getColumnNames($objectType);

				global $globalTableFilter;
				global $$globalTableFilter;

				if($globalTableFilter)
				{
					if(!DB3::$objectProps[$objectType][$globalTableFilter] && !in_array($globalTableFilter, DB3::$objectProps[$objectType]))
					{
						$values[$globalTableFilter] = $$globalTableFilter;
						DB3::$objectProps[$objectType][] = $globalTableFilter;
					}
				}

				$updateObject = false;
				$update = array();
				$insert = array();

				$values = DB3::inputCleaner($values);
				foreach($values as $k => $v)
	//				if($k != intval($k))
					{
						if($k == 'id')
							$objectID = intval($v);
						else
						{
							if(
	//						DB3::$objectProps[$objectType][$k] ||
							in_array($k, DB3::$objectProps[$objectType]))
								if(!array_key_exists($k, $insert))
								{
									$v = DB3::dataCleaner($v);
									$insert[$k] = $v;
									$update[] = "$k='$v'";
								}
						}
					}

				if(@$objectID || @$strWhere)
				{
					if(@$strWhere)
					{
						if($record = getRecord("select id from $objectType where $strWhere;"))
						{
							$updateObject = true;
							$objectID = $record['id'];
						}
					}
					else
					{
						if($record = getRecord("select id from $objectType where id=$objectID;"))
							$updateObject = true;
					}
				}

				if($updateObject && count($update))
				{
					if($versioning)
					{
						$version = dbInsert("insert into {$objectType}_version(" . join(',', array_values(DB3::$objectProps[$objectType])) . ") select " . join(',', array_values(DB3::$objectProps[$objectType])) . " from $objectType where id=$objectID ON DUPLICATE KEY UPDATE " . join(',', $update) . ";");

						dbUpdate("update {$objectType}_version set next=$version where id=$objectID and next=0 and uid!=$version;");
					}

					dbUpdate("update {$objectType} set " . join(',', $update) . " where id=$objectID;");
					return ($versioning?$version:$objectID);
				}
				elseif(count($insert))
				{
					return dbInsert("insert into {$objectType}(" . join(',', array_keys($insert)) . ") values('" . join("','", array_values($insert)) . "') ON DUPLICATE KEY UPDATE " . join(',', $update) . ";");
				}
				else
					return 0;
			}
		}
	}
?>