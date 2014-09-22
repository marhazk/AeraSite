<?php
	class GameDBD
	{
		public $db;
		public $dbAttr;
		public $total = 0;
		public $totalAttr = 0;
		public $dbName = "";
		public $dbActive = false;
		function connect($name, $sql = NULL)
		{
			$this->dbName = $name;
			if ($sql == NULL)
				$_sql = "SELECT * FROM ".$this->dbName;
			else
				$_sql = $sql;
			$_query = mysql_query($_sql);
			$num = 0;
			while ($_row = mysql_fetch_field($_query))
			{
				$this->dbAttr[$_row->name] = $_row->name;
				$num++;
			}
			$this->totalAttr = $num;
			$num = 0;
			while ($_row = mysql_fetch_array($_query))
			{
				$this->db[$num] = $_row;
				$num++;
			}
			$this->total = $num;
			$this->dbActive = true;
		}
		function searchBy($att,$id, $operation = "OR", $array = false)
		{
			$temp = NULL;
			foreach ($this->db as $val)
			{
				if ($operation == "OR")
				{
					if ($val[$att] == $id)
						$temp = $val;
					else if (is_array($array))
						foreach($array as $condition)
							if ($condition[0] == $condition[1])
								$temp = $val;
					else
						$temp = NULL;
				}
				else if ($operation == "AND")
				{
					if ($val[$att] == $id)
					{
						if (is_array($array))
						{
							foreach($array as $condition)
							{
								if ($condition[0] == $condition[1])
									$temp = $val;
								else
								{
									$temp = NULL;
									break;
								}
							}
						}
						else
							$temp = $val;
					}
					else
						$temp = NULL;
				}
			}
			return $temp;
		}
		function boolArray($array, $db = NULL, $operation = "OR")
		{
			// AND : a * (((b + c) + d) + e)
			// OR  : a + (((b + c) + d) + e)
			//
			// CONSTRUCTORS:
			//	boolArray(array(x, y, z))
			//	boolArray(array(x, y, z), DB)
			//	boolArray(array(x, y, z), "OR")
			//	boolArray(array(x, y, z), "AND")
			//	boolArray(array(x, y, z), DB, "OR")
			//	boolArray(array(x, y, z), DB, "AND")
			//	boolArray(array(x, y, array()))
			//	boolArray(array(x, y, array()), DB)
			//	boolArray(array(x, y, array()), "OR")
			//	boolArray(array(x, y, array()), "AND")
			//	boolArray(array(x, y, array()), DB, "OR")
			//	boolArray(array(x, y, array()), DB, "AND")
			//	boolArray(array(x, y, DB))
			//	boolArray(array(x, y, DB), DB)
			//	boolArray(array(x, y, DB), "OR")
			//	boolArray(array(x, y, DB), "AND")
			//	boolArray(array(x, y, DB), DB, "OR")
			//	boolArray(array(x, y, DB), DB, "AND")
			$temp = false;
			if ($db == NULL)
				$db = $this->db;
			else if ($db == "OR")
			{
				$db = $this->db;
				$operation = "OR";
			}
			else if ($db == "AND")
			{
				$db = $this->db;
				$operation = "AND";
			}
			if ($operation == "OR")
			{
				// boolArray(ARRAY(), x, y) : else return FALSE
				if (is_array($array))
				{
					// boolArray(array(?, ?, ARRAY()), x, y)
					if ((is_array($array[0]) == false) && (is_array($array[2])))
					{
						// boolArray(array(?, ?, array(ref, ARRAY())), x, y)
						if ((is_array($array[2][0]) == false) && (is_array($array[2][1])))
						{
							foreach ($array[2] as $refArr)
							{
								if (is_array($refArr) == false)
									continue;
								foreach ($refArr as $value)
								{
									// boolArray(array(?, ?, array(ref, array(ARRAY()))), x, y)
									// boolArray(array(array(0, 1, array(ref, GameDBD))), x, y) 
									// boolArray(array(array(0, 1, array(ref, DB))), x, y) 
									if (is_array($value))
									{
										//echo $db[$array[0]].$array[1].$val[$array[2][0]]."<BR>";
										if (($array[1] == "==") && ($db[$array[0]] == $value[$array[2][0]]))
										{
											$temp = true;
											break;
										}
										else if (($array[1] == "!=") && ($db[$array[0]] != $value[$array[2][0]]))
										{
											$temp = true;
											break;
										}
										else if (($array[1] == ">=") && ($db[$array[0]] >= $value[$array[2][0]]))
										{
											$temp = true;
											break;
										}
										else if (($array[1] == "<=") && ($db[$array[0]] <= $value[$array[2][0]]))
										{
											$temp = true;
											break;
										}
										else if (($array[1] == ">") && ($db[$array[0]] > $value[$array[2][0]]))
										{
											$temp = true;
											break;
										}
										else if (($array[1] == "<") && ($db[$array[0]] < $value[$array[2][0]]))
										{
											$temp = true;
											break;
										}
										else
											$temp = false;
									}
									else if (($array[1] == "==") && ($db[$array[0]] == $value))
									{
										$temp = true;
										break;
									}
									else if (($array[1] == "!=") && ($db[$array[0]] != $value))
									{
										$temp = true;
										break;
									}
									else if (($array[1] == ">=") && ($db[$array[0]] >= $value))
									{
										$temp = true;
										break;
									}
									else if (($array[1] == "<=") && ($db[$array[0]] <= $value))
									{
										$temp = true;
										break;
									}
									else if (($array[1] == ">") && ($db[$array[0]] > $value))
									{
										$temp = true;
										break;
									}
									else if (($array[1] == "<") && ($db[$array[0]] < $value))
									{
										$temp = true;
										break;
									}
									else
										$temp = false;
								}
							}
						}
						else
						{
							foreach ($array[2] as $value)
						{
							// boolArray(array(?, ?, array(ARRAY())), x, y)
							// boolArray(array(array(0, 1, GameDBD)), x, y) 
							// boolArray(array(array(0, 1, DB)), x, y) 
							if (is_array($value))
							{
								foreach ($value as $val)
								{
									if (($array[1] == "==") && ($db[$array[0]] == $val[$array[0]]))
									{
										$temp = true;
										break;
									}
									else if (($array[1] == "!=") && ($db[$array[0]] != $val[$array[0]]))
									{
										$temp = true;
										break;
									}
									else if (($array[1] == ">=") && ($db[$array[0]] >= $val[$array[0]]))
									{
										$temp = true;
										break;
									}
									else if (($array[1] == "<=") && ($db[$array[0]] <= $val[$array[0]]))
									{
										$temp = true;
										break;
									}
									else if (($array[1] == ">") && ($db[$array[0]] > $val[$array[0]]))
									{
										$temp = true;
										break;
									}
									else if (($array[1] == "<") && ($db[$array[0]] < $val[$array[0]]))
									{
										$temp = true;
										break;
									}
									else
										$temp = false;
								}
							}
							else if (($array[1] == "==") && ($db[$array[0]] == $value))
							{
								$temp = true;
								die("TEST");
								break;
							}
							else if (($array[1] == "!=") && ($db[$array[0]] != $value))
							{
								$temp = true;
								break;
							}
							else if (($array[1] == ">=") && ($db[$array[0]] >= $value))
							{
								$temp = true;
								break;
							}
							else if (($array[1] == "<=") && ($db[$array[0]] <= $value))
							{
								$temp = true;
								break;
							}
							else if (($array[1] == ">") && ($db[$array[0]] > $value))
							{
								$temp = true;
								break;
							}
							else if (($array[1] == "<") && ($db[$array[0]] < $value))
							{
								$temp = true;
								break;
							}
							else
								$temp = false;
						}
						}
					}
					// boolArray(array(ARRAY(), ?, ?), x, y)
					else if (is_array($array[0]))
					{
						foreach($array as $condition)
						{
							// boolArray(array(array(0, 1, ARRAY())), x, y)
							if (is_array($condition[2])) 
							{
								foreach ($condition[2] as $value)
								{
									// boolArray(array(array(0, 1, array(ARRAY()))), x, y) 
									// boolArray(array(array(0, 1, GameDBD)), x, y) 
									// boolArray(array(array(0, 1, DB)), x, y) 
									if (is_array($value))
									{
										foreach ($value as $val)
										{
											if (($condition[1] == "==") && ($db[$condition[0]] == $val[$condition[0]]))
											{
												$temp = true;
												break;
											}
											else if (($condition[1] == "!=") && ($db[$condition[0]] != $val[$condition[0]]))
											{
												$temp = true;
												break;
											}
											else if (($condition[1] == ">=") && ($db[$condition[0]] >= $val[$condition[0]]))
											{
												$temp = true;
												break;
											}
											else if (($condition[1] == "<=") && ($db[$condition[0]] <= $val[$condition[0]]))
											{
												$temp = true;
												break;
											}
											else if (($condition[1] == ">") && ($db[$condition[0]] > $val[$condition[0]]))
											{
												$temp = true;
												break;
											}
											else if (($condition[1] == "<") && ($db[$condition[0]] < $val[$condition[0]]))
											{
												$temp = true;
												break;
											}
											else
												$temp = false;
										}
									}
									else if (($condition[1] == "==") && ($db[$condition[0]] == $value))
									{
										$temp = true;
										break;
									}
									else if (($condition[1] == "!=") && ($db[$condition[0]] != $value))
									{
										$temp = true;
										break;
									}
									else if (($condition[1] == ">=") && ($db[$condition[0]] >= $value))
									{
										$temp = true;
										break;
									}
									else if (($condition[1] == "<=") && ($db[$condition[0]] <= $value))
									{
										$temp = true;
										break;
									}
									else if (($condition[1] == ">") && ($db[$condition[0]] > $value))
									{
										$temp = true;
										break;
									}
									else if (($condition[1] == "<") && ($db[$condition[0]] < $value))
									{
										$temp = true;
										break;
									}
									else
										$temp = false;
								}
							}
							else if (($condition[1] == "==") && ($db[$condition[0]] == $condition[2]))
							{
								$temp = true;
								break;
							}
							else if (($condition[1] == "!=") && ($db[$condition[0]] != $condition[2]))
							{
								$temp = true;
								break;
							}
							else if (($condition[1] == ">=") && ($db[$condition[0]] >= $condition[2]))
							{
								$temp = true;
								break;
							}
							else if (($condition[1] == "<=") && ($db[$condition[0]] <= $condition[2]))
							{
								$temp = true;
								break;
							}
							else if (($condition[1] == ">") && ($db[$condition[0]] > $condition[2]))
							{
								$temp = true;
								break;
							}
							else if (($condition[1] == "<") && ($db[$condition[0]] < $condition[2]))
							{
								$temp = true;
								break;
							}
							else
								$temp = false;
						}
					}
					else
					{
						if (($array[1] == "==") && ($db[$array[0]] == $array[2]))
						{
							$temp = true;
						}
						else if (($array[1] == "!=") && ($db[$array[0]] != $array[2]))
						{
							$temp = true;
						}
						else if (($array[1] == ">=") && ($db[$array[0]] >= $array[2]))
						{
							$temp = true;
						}
						else if (($array[1] == "<=") && ($db[$array[0]] <= $array[2]))
						{
							$temp = true;
						}
						else if (($array[1] == ">") && ($db[$array[0]] > $array[2]))
						{
							$temp = true;
						}
						else if (($array[1] == "<") && ($db[$array[0]] < $array[2]))
						{
							$temp = true;
						}
						else
							$temp = false;
					}
				}
				else
					$temp = false;
			}
			else
			{
				if (is_array($array))
				{
					// boolArray(array(?, ?, ARRAY()), x, y)
					if ((!is_array($array[0])) && (is_array($array[2])))
					{
						// boolArray(array(?, ?, array(ref, ARRAY())), x, y)
						if ((is_array($array[2][0]) == false) && (is_array($array[2][1])))
						{
							foreach ($array[2] as $refArr)
							{
								if (is_array($refArr) == false)
									continue;
								foreach ($refArr as $value)
								{
									// boolArray(array(?, ?, array(ref, array(ARRAY()))), x, y)
									// boolArray(array(array(0, 1, array(ref, GameDBD))), x, y) 
									// boolArray(array(array(0, 1, array(ref, DB))), x, y) 
									if (is_array($value))
									{
										if (($array[1] == "==") && ($db[$array[0]] == $value[$array[2][0]]))
											$temp = true;
										else if (($array[1] == "!=") && ($db[$array[0]] != $value[$array[2][0]]))
											$temp = true;
										else if (($array[1] == ">=") && ($db[$array[0]] >= $value[$array[2][0]]))
											$temp = true;
										else if (($array[1] == "<=") && ($db[$array[0]] <= $value[$array[2][0]]))
											$temp = true;
										else if (($array[1] == ">") && ($db[$array[0]] > $value[$array[2][0]]))
											$temp = true;
										else if (($array[1] == "<") && ($db[$array[0]] < $value[$array[2][0]]))
											$temp = true;
										else
										{
											//echo $db[$array[0]]." ".$value[$array[2][0]]."<BR>";
											$temp = false;
											break;
										}
									}
									else if (($array[1] == "==") && ($db[$array[0]] == $value))
										$temp = true;
									else if (($array[1] == "!=") && ($db[$array[0]] != $value))
										$temp = true;
									else if (($array[1] == ">=") && ($db[$array[0]] >= $value))
										$temp = true;
									else if (($array[1] == "<=") && ($db[$array[0]] <= $value))
										$temp = true;
									else if (($array[1] == ">") && ($db[$array[0]] > $value))
										$temp = true;
									else if (($array[1] == "<") && ($db[$array[0]] < $value))
										$temp = true;
									else
									{
										$temp = false;
										break;
									}
								}
							}
						}
						else
						{
								
							foreach ($array[2] as $value)
							{
								// boolArray(array(?, ?, array(ARRAY())), x, y)
								// boolArray(array(array(0, 1, GameDBD)), x, y) 
								// boolArray(array(array(0, 1, DB)), x, y) 
								if (is_array($value))
								{
									foreach ($value as $val)
									{
										if (($array[1] == "==") && ($db[$array[0]] == $val[$array[0]]))
											$temp = true;
										else if (($array[1] == "!=") && ($db[$array[0]] != $val[$array[0]]))
											$temp = true;
										else if (($array[1] == ">=") && ($db[$array[0]] >= $val[$array[0]]))
											$temp = true;
										else if (($array[1] == "<=") && ($db[$array[0]] <= $val[$array[0]]))
											$temp = true;
										else if (($array[1] == ">") && ($db[$array[0]] > $val[$array[0]]))
											$temp = true;
										else if (($array[1] == "<") && ($db[$array[0]] < $val[$array[0]]))
										{
											$temp = true;
											break;
										}
										else
										{
											$temp = false;
											break;
										}
									}
								}
								else if (($array[1] == "==") && ($db[$array[0]] == $value))
									$temp = true;
								else if (($array[1] == "!=") && ($db[$array[0]] != $value))
									$temp = true;
								else if (($array[1] == ">=") && ($db[$array[0]] >= $value))
									$temp = true;
								else if (($array[1] == "<=") && ($db[$array[0]] <= $value))
									$temp = true;
								else if (($array[1] == ">") && ($db[$array[0]] > $value))
									$temp = true;
								else if (($array[1] == "<") && ($db[$array[0]] < $value))
									$temp = true;
								else
								{
									$temp = false;
									break;
								}
							}
						}
					}
					else if (is_array($array[0]))
					{
						foreach($array as $condition)
						{
							if (is_array($condition[2]))
							{
								foreach ($condition[2] as $value)
								{
									if (is_array($value))
									{
										foreach ($value as $val)
										{
											if (($condition[1] == "==") && ($db[$condition[0]] == $val[$condition[0]]))
											{
												$temp = true;
												break;
											}
											else if (($condition[1] == "!=") && ($db[$condition[0]] != $val[$condition[0]]))
											{
												$temp = true;
												break;
											}
											else if (($condition[1] == ">=") && ($db[$condition[0]] >= $val[$condition[0]]))
											{
												$temp = true;
												break;
											}
											else if (($condition[1] == "<=") && ($db[$condition[0]] <= $val[$condition[0]]))
											{
												$temp = true;
												break;
											}
											else if (($condition[1] == ">") && ($db[$condition[0]] > $val[$condition[0]]))
											{
												$temp = true;
												break;
											}
											else if (($condition[1] == "<") && ($db[$condition[0]] < $val[$condition[0]]))
											{
												$temp = true;
												break;
											}
											else
												$temp = false;
										}
									}
									else if (($condition[1] == "==") && ($db[$condition[0]] == $value))
									{
										$temp = true;
										break;
									}
									else if (($condition[1] == "!=") && ($db[$condition[0]] != $value))
									{
										$temp = true;
										break;
									}
									else if (($condition[1] == ">=") && ($db[$condition[0]] >= $value))
									{
										$temp = true;
										break;
									}
									else if (($condition[1] == "<=") && ($db[$condition[0]] <= $value))
									{
										$temp = true;
										break;
									}
									else if (($condition[1] == ">") && ($db[$condition[0]] > $value))
									{
										$temp = true;
										break;
									}
									else if (($condition[1] == "<") && ($db[$condition[0]] < $value))
									{
										$temp = true;
										break;
									}
									else
										$temp = false;
								}
							}
							else if (($condition[1] == "==") && ($db[$condition[0]] == $condition[2]))
								$temp = true;
							else if (($condition[1] == "!=") && ($db[$condition[0]] != $condition[2]))
								$temp = true;
							else if (($condition[1] == ">=") && ($db[$condition[0]] >= $condition[2]))
								$temp = true;
							else if (($condition[1] == "<=") && ($db[$condition[0]] <= $condition[2]))
								$temp = true;
							else if (($condition[1] == ">") && ($db[$condition[0]] > $condition[2]))
								$temp = true;
							else if (($condition[1] == "<") && ($db[$condition[0]] < $condition[2]))
								$temp = true;
							else
							{
								$temp = false;
								break;
							}
						}
					}
					else
					{
						if (($array[1] == "==") && ($db[$array[0]] == $array[2]))
						{
							$temp = true;
						}
						else if (($array[1] == "!=") && ($db[$array[0]] != $array[2]))
						{
							$temp = true;
						}
						else if (($array[1] == ">=") && ($db[$array[0]] >= $array[2]))
						{
							$temp = true;
						}
						else if (($array[1] == "<=") && ($db[$array[0]] <= $array[2]))
						{
							$temp = true;
						}
						else if (($array[1] == ">") && ($db[$array[0]] > $array[2]))
						{
							$temp = true;
						}
						else if (($array[1] == "<") && ($db[$array[0]] < $array[2]))
						{
							$temp = true;
						}
						else
							$temp = false;
					}
				}
				else
					$temp = false;
			}
			return $temp;
		}
		
		function retrieveBy($array, $operation = "OR")
		{
			$num = 0;
			if (is_array($this->db))
			{
				foreach ($this->db as $db)
				{
					$found = $this->boolArray($array, $db, $operation);
					if ($found)
					{
						$temp[$num] = $db;
						$num++;
					}
				}
			}
			return $temp;
		}
		function retrieve()
		{
			return $this->db;
		}
		function explodeToDB($att, $state = "", $db = "X")
		{
			if ($db == "X")
				$db = $this->db;
			$num = 0;
			$stateDB = explode(":",$state);
			foreach ($db as $val)
			{
				foreach ($stateDB as $_state)
					if ($val[$att] == $state)
						$newDB[$num] = $val;
				$num++;
			}
			return $newDB;
		}
		function sortmulti($array, $index, $order, $natsort=FALSE, $case_sensitive=FALSE) {
			if(is_array($array) && count($array)>0) {
				foreach(array_keys($array) as $key)
				$temp[$key]=$array[$key][$index];
				if(!$natsort) {
					if ($order=='asc')
						asort($temp);
					else   
						arsort($temp);
				}
				else
				{
					if ($case_sensitive===true)
						natsort($temp);
					else
						natcasesort($temp);
				if($order!='asc')
					$temp=array_reverse($temp,TRUE);
				}
				foreach(array_keys($temp) as $key)
					if (is_numeric($key))
						$sorted[]=$array[$key];
					else   
						$sorted[$key]=$array[$key];
				return $sorted;
			}
			return $sorted;
		}
		function active()
		{
			return $this->dbActive;
		}
		function update($rAtt, $rVal, $nAtt, $nVal)
		{
			$num = 0;
			foreach ($this->db as $db)
			{
				if ($db[$rAtt] == $rVal)
				$this->db[$num][$nAtt] = $nVal;
				$num++;
			}
		}
		function merge($attr, $rDB, $rAttr)
		{
			$max = count($this->db);
			for ($num = 0; $num < $max; $num++)
			{
				$db = $rDB->searchBy($rAttr,$this->db[$num][$attr]);
				foreach ($this->db[$num] as $key => $val)
				{
					if (is_int($key))
						$arrNum = $key;
					$this->db[$num][$key] = $val;
				}
				$arrNum++;
				if (is_array($db))
				{
					foreach ($db as $key => $val)
					{
						if (is_int($key))
							$key = $arrNum + $key;
						$this->db[$num][$key] = $val;
					}
				}
			}
		}
		function addToDB($attr, $rDB, $rAttr)
		{
			$db = $rDB->retrieve();
			for ($num = 0; $num < $max; $num++)
			{
				foreach ($this->db[$num] as $key => $val)
				{
					if (is_int($key))
						$arrNum = $key;
					$this->db[$num][$key] = $val;
				}
				$arrNum++;
				$chkArray = 0;
				foreach ($db as $key => $val)
				{
					if ($key == $rAttr)
					{
						$tempArr[$chkArray] = $val;
						$chkArray++;
					}
				}
				if (isset($this->db[$num][$attr]))
					$this->db[$num][$arrNum] = $tempArr;
				$this->db[$num][$attr] = $tempArr;
				unset($tempArr);
			}
		}
		function insert($db)
		{
		}
		function links($val, $links, $db = NULL, $attr = NULL, $value = NULL)
		{
			if (is_array($db))
			{
				foreach ($db as $key => $link)
					if (!is_int($key))
						$links = str_replace("__".$key."__", $link, $links);
			}
			else if (strlen($db) >= 1)
			{
				$value = $attr;
				$attr = $db;
			}
			if (strlen($attr) >= 1)
				$links = str_replace("__".$attr."__", $value, $links);
			return str_replace("__value__", $val, $links);
		}
		function replaceValue($val, $val2, $text)
		{
			if (strlen($text) >= 1)
			{
				$text = str_replace("__value__", $val, $text);
				$text = str_replace("__value2__", $val2, $text);
			}
			return $text;
		}
		function printRows($first,$mid,$end, $parameters = NULL, $displayAttr = NULL, $condition = NULL)
		{
			$temp = "";
			$num = 1;
			$array = 0;
			$sortlink = "";
			$mathcalc = "";
			if (is_array($parameters))
			{
				$orderBy = explode(" ", $parameters[order]);
				$orderByName = $orderBy[0];
				$orderByType = $orderBy[1];
				$displayID = $parameters[displayID];
				$byHorizontal = $parameters[horizontal];
				$column = $parameters[column];
				$disLimit = $parameters[limit];
				$disStart = $parameters[start];
				if (empty($byHorizontal))
					$byHorizontal = false;
				if (empty($disLimit))
					$disLimit = 100;
				if (empty($disStart))
					$disStart = 0;
			}
			if (empty($column))
				$column = 1;
			if (!is_array($displayAttr))
				$displayAttr = $this->dbAttr;
			if ((($column <= 1) && ($byHorizontal == false)) || (($column <= 1) && ($displayID) && ($byHorizontal)))
				$temp .= $first;
			if ($displayID)
			{
				if ($column > 1)
					$temp .= $first;
				$temp .= "#".$mid;
				$array++;
			}
			if ($byHorizontal == false)
			{
				$numAttr = 1;
				$maxAttr = count($displayAttr);
				//foreach ($this->dbAttr as $key => $val)
				foreach ($displayAttr as $key => $val)
				{
					if (isset($displayAttr[$key]))
					{
						if (is_array($displayAttr[$key]))
						{
							if ($displayAttr[$key][mathcalc])
								$mathcalc = $displayAttr[$key][mathcalc];
							else
								$mathcalc = '';
							if ($displayAttr[$key][allowsort])
								$sortlink = $displayAttr[$key][sortlink];
							else
								$sortlink = '__value2__';
							$temp .= $this->replaceValue($key, $displayAttr[$key][name],$sortlink);
						}
						else
							$temp .= $displayAttr[$key];
						if ($numAttr < $maxAttr)
							$temp .= $mid;
						$numAttr++;
					}
					$array++;
				}
				$temp .= $end;
				$temp .= "\r\n";
			}
			$tempListDB = $this->sortmulti($this->db, $orderByName, $orderByType);
			//
			// foreach all the GameDBD in database
			if (is_array($tempListDB))
			{
				foreach ($tempListDB as $valDB)
				{
					$tempRow = "";
					if ($byHorizontal == false)
						$tempRow .= $first;
					if ($displayID)
					{
						$columnNum = 1;
						if (($byHorizontal) && ($columnNum >= $column))
						{
							$tempRow .= $num.$end;
							$columnNum = 0;
						}
						else if ($byHorizontal)
						{
							$tempRow .= $num;
							$columnNum = -1;
						}
						else
						{
							$tempRow .= $num.$mid;
						}
					}
					$numAttr = 1;
					//
					// foreach all the attributes each GameDBD
					foreach ($valDB as $key => $val)
					{
						if (is_array($condition))
						{
							if (is_array($condition[1]))
								$useCondition = $this->boolArray($condition[1], $valDB, $condition[0]);
							else if ($condition[0] == $key)
							{
								if (($condition[1] == "==") && ($val == $condition[2]))
									$useCondition = true;
								else if (($condition[1] == ">=") && ($val >= $condition[2]))
									$useCondition = true;
								else if (($condition[1] == "<=") && ($val <= $condition[2]))
									$useCondition = true;
								else if (($condition[1] == ">") && ($val > $condition[2]))
									$useCondition = true;
								else if (($condition[1] == "<") && ($val < $condition[2]))
									$useCondition = true;
								else
									$useCondition = false;
							}
						}
						else
							$useCondition = true;
						//
						// checking either the attributes are allowed to displayed or not
						if (isset($displayAttr[$key]))
						{
							//
							// checking if the attributes cointains an array or not
							if (is_array($displayAttr[$key]))
							{
								if ((isset($displayAttr[$key][multi])) && (strlen($displayAttr[$key][multi]) >= 1))
								{
									if ((strlen($val) >= 1) || (is_array($val)))
									{
										if (is_array($val))
											$stateDB = $val;
										else
											$stateDB = explode(":",$val);
										$val = "";
										$ArrNum = 0;
										foreach ($stateDB as $valDB)
										{
											if ($ArrNum > 0)
												$val .= $displayAttr[$key][multi];
											$tempDB = $displayAttr[$key][db]->searchBy($displayAttr[$key][attr],$valDB);
											if (strlen($displayAttr[$key][links]) >= 1)
												$val .= $this->links($tempDB[$displayAttr[$key][displayAttr]],$displayAttr[$key][links],$tempDB);
											else
												$val .= $tempDB[$displayAttr[$key][displayAttr]];
											$ArrNum++;
										}
									}
									else
										$val = "";
								}
								else if ((isset($displayAttr[$key][multiDB])) && (strlen($displayAttr[$key][multiDB]) >= 1))
								{
									if ((strlen($val) >= 1) || (is_array($val)))
									{
										$stateDB = $displayAttr[$key][db]->retrieveBy(array($displayAttr[$key][attr],"==",$val));
										$val = "";
										$ArrNum = 0;
										if (is_array($stateDB))
										{
											foreach ($stateDB as $valDB)
											{
												if ($ArrNum > 0)
													$val .= $displayAttr[$key][multiDB];
												if (strlen($displayAttr[$key][links]) >= 1)
													$val .= $this->links($valDB[$displayAttr[$key][displayAttr]],$displayAttr[$key][links],$valDB);
												else
													$val .= $valDB[$displayAttr[$key][displayAttr]];
												$ArrNum++;
											}
										}
										else
											$val = "";
									}
									else
										$val = "";
								}
								else if ((isset($displayAttr[$key][calcPKZone])) && (strlen($displayAttr[$key][calcPKZone]) >= 1))
								{
									if ((strlen($val) >= 1) || (is_array($val)))
									{
										$min = (26 - $val)*10;
										$val = (((int)(5 + (($val/25) * 195)))/100);
										$xval = $val;
										if (strlen($xval) == 3)
											$val = $xval."0 AeraGold<BR>";
										else
											$val = $xval." AeraGold<BR>";
										$val = $val."Total Idle: +".$min."mins";
									}
									else
										$val = "";
								}
								else if (isset($displayAttr[$key][type]) && ($displayAttr[$key][type] == int))
								{
									if (!is_array($val))
									{
										$val = (int)$val;
									}
									else
										$val = "0";
								}
								else if ((empty($displayAttr[$key][attr])) && (empty($displayAttr[$key][displayAttr])))
								{
									if (strlen($displayAttr[$key][links]) >= 1)
										$val = $this->links($val,$displayAttr[$key][links],$valDB,$key,$val);
									else if ($displayAttr[$key][base64])
										$val = base64_decode($val);
									else
										$val = $val;
									//if ($displayAttr[$key][moderator])
									//	$val = $val." ".$displayAttr[$key][moderatorlinks]
								}
								else if (strlen($displayAttr[$key][links]) >= 1)
								{
									$tempDB = $displayAttr[$key][db]->searchBy($displayAttr[$key][attr],$val);
									$val = $this->links($tempDB[$displayAttr[$key][displayAttr]],$displayAttr[$key][links],$tempDB,$key,$val);
								}
								else
								{
									$tempDB = $displayAttr[$key][db]->searchBy($displayAttr[$key][attr],$val);
									$val = $tempDB[$displayAttr[$key][displayAttr]];
								}
							}
							if ($byHorizontal)
							{
								if (isset($displayAttr[$key]))
								{
									if ($columnNum == 0)
										$tempRow .= $first;
									else
										$tempRow .= $mid;
									if (is_array($displayAttr[$key]))
										$tempRow .= $displayAttr[$key][name].$mid;
									else
										$tempRow .= $displayAttr[$key].$mid;
								}
								$tempRow .= $val;
								$columnNum++;
								$array++;
							}
							else if ($numAttr < $maxAttr)
								$tempRow .= $val.$mid;
							else
								$tempRow .= $val;
							$numAttr++;
						}
						if (($byHorizontal) && ($columnNum >= $column))
						{
							$tempRow .= $end;
							$tempRow .= "\r\n";
							$columnNum = 0;
						}
					}
					if (($byHorizontal == false) && ($columnNum >= $column))
					{
						$tempRow .= $end;
						$tempRow .= "\r\n";
						$columnNum = 0;
					}
					if ($useCondition)
					{
						if (($num-1) >= $disStart)
							$tempList[($num-1)] = $tempRow;
						if ($num >= $disLimit)
							break;
						$num++;
					}
				}
			}
			if (is_array($tempList))
			{
				foreach ($tempList as $tempVar)
				{
					$temp .= $tempVar;
				}
			}
			else
				$temp = "<TR><td colspan=$array align=center>No result found for this records</td></tr>";
			echo $temp;
		}
	}
	class DBConfig {
	
		var $host;
		var $user;
		var $pass;
		var $db;
		var $db_link;
		var $conn = false;
		var $persistant = false;
	   
		public $error = false;
	
		public function config(){ // class config
			$this->error = true;
			$this->persistant = false;
		}
		function query($sql)
		{
			return $this->mysql_query($sql);
		}
		function fetch($sql)
		{
			return $this->mysql_fetch_array($sql);
		}
		function conn($host='db.perfectworld.com.my',$user='aera',$pass='N@mazes8887',$db='aera'){ // connection function
			$this->host = $host;
			$this->user = $user;
			$this->pass = $pass;
			$this->db = $db;
		   
			// Establish the connection.
			if ($this->persistant)
				$this->db_link = mysql_pconnect($this->host, $this->user, $this->pass, true);
			else
				$this->db_link = mysql_connect($this->host, $this->user, $this->pass, true);
	
			if (!$this->db_link) {
				if ($this->error) {
					$this->error($type=1);
				}
				return false;
			}
			else {

                mysql_set_charset('utf8',$this->db_link);
                if (empty($db)) {
				if ($this->error) {
					$this->error($type=2);
				}
			}
			else {
				$db = mysql_select_db($this->db, $this->db_link); // select db
				if (!$db) {
					if ($this->error) {
						$this->error($type=2);
					}
				return false;
				}
				$this -> conn = true;
			}
				return $this->db_link;
			}
		}
	
		function close() { // close connection
			if ($this -> conn){ // check connection
				if ($this->persistant) {
					$this -> conn = false;
				}
				else {
					mysql_close($this->db_link);
					$this -> conn = false;
				}
			}
			else {
				if ($this->error) {
					return $this->error($type=4);
				}
			}
		}
	   
		public function error($type=''){ //Choose error type
			if (empty($type)) {
				return false;
			}
			else {
				return false;
				//if ($type==1)
				//	echo "<strong>Database could not connect</strong> ";
				//else if ($type==2)
				//	echo "<strong>mysql error</strong> " . mysql_error();
				//else if ($type==3)
				//	echo "<strong>error </strong>, Proses has been stopped";
				//else
				//	echo "<strong>error </strong>, no connection !!!";
			}
		}
	}
	function getpatch($row)
	{
		$version = $row[id];
		$patch[id] = $version;
		$patch[version] = $version;
		$patch[filename] = "PWAeraBeta3a".$version.".cup";
		$patch[path] = "../patches";
		$patch[size] = _format_bytes(filesize($patch[path]."/".$patch[filename]));
		$patch[url] = "http://patches.perfectworld.com.my/".$patch[filename];
		$patch[mdate] = date("d/M/Y", filemtime($patch[path]."/".$patch[filename]));
		$patch[details] = $row[url];
		$patch[enable] = $row[show];
		$patch[linkable] = $row[linkable];
		return $patch;
	}
	function _format_bytes($a_bytes)
	{
		if ($a_bytes < 1024) {
			return $a_bytes .' B';
		} elseif ($a_bytes < 1048576) {
			return round($a_bytes / 1024, 2) .' KB';
		} elseif ($a_bytes < 1073741824) {
			return round($a_bytes / 1048576, 2) . ' MB';
		} elseif ($a_bytes < 1099511627776) {
			return round($a_bytes / 1073741824, 2) . ' GB';
		} elseif ($a_bytes < 1125899906842624) {
			return round($a_bytes / 1099511627776, 2) .' TB';
		} elseif ($a_bytes < 1152921504606846976) {
			return round($a_bytes / 1125899906842624, 2) .' PB';
		} elseif ($a_bytes < 1180591620717411303424) {
			return round($a_bytes / 1152921504606846976, 2) .' EB';
		} elseif ($a_bytes < 1208925819614629174706176) {
			return round($a_bytes / 1180591620717411303424, 2) .' ZB';
		} else {
			return round($a_bytes / 1208925819614629174706176, 2) .' YB';
		}
	}
	function space($text, $total)
	{
		$len = $total-strlen($text);
		$w = "";
		for ($num = 0; $num < $len; $num++)
		{
			$w .= chr(32);
		}
		$text .= $w;
		return $text;
	}
	function strName($text)
	{
		$name = "";
		$num = 0;
		$arr = explode(" ", $text);
		$count = count($arr);
		foreach ($arr as $val)
		{
			$len = strlen($val);
			$name .= strtoupper(substr($val,0,1));
			$name .= strtolower(substr($val,1,($len-1)));
			if ($num < $count)
				$name .= chr(32);
		}
		return $name;
	}
	function tokenArray($state, $arrayList)
	{
		$arrNum = 0;
		$arrLNum = 0;
		$tokens = ":";
		$arrLTotal = count($arrayList);
		$arrList = explode($tokens, $state);
		foreach ($arrList as $val)
		{
			$newArray[$arrNum][$arrayList[$arrLNum]] = $val;
			$arrLNum++;
			if ($arrLNum == $arrLTotal)
			{
				$arrNum++;
				$arrLNum = 0;
			}
		}
		return $newArray;
	}
	function occupation($strocu){

    switch ($strocu % 10) :
	case 0:	return "Blademaster.png";
	case 1:	return "Wizzard.png";
	case 2:	return "Psychic.png";
	case 3:	return "Venomancer.png";
	case 4:	return "Barbarian.png";
	case 5:	return "Assasin.png";
	case 6:	return "Archer.png";
	case 7:	return "Cleric.png";
	case 8:	return "Seeker.png";
	case 9:	return "Mystic.png";
    endswitch;
}
	function mdate($_temp)
	{
		return date('l jS \of F Y h:i:s A',$_temp);
	}
	function mmonth($_temp)
	{
		return date('n',$_temp);
	}
	function maintainance()
	{
		include "modules/files/common/maintainance.php";
	}
	function getcountrybyip($iplong)
	{
		$sql = "SELECT * FROM uWebipcountry WHERE (ipfrom>=$iplong AND ipto<=$iplong) LIMIT 0,1";
		$result = mysql_query($sql);
		if ($result)
		{
			$row = mysql_fetch_array($result);
			return strtolower($row[country2]);
		}
		else
		{
			return "null";
		}
	}
	function getuidbyrole($uid)
	{
		$targetid = $uid;
		$getuidbyroleq = mysql_query("SELECT ID FROM users");
		if ($getuidbyroleq)
		{
			while ($getuidbyroler = mysql_fetch_array($getuidbyroleq))
			{
				$getuidbyrolemin = $getuidbyroler[ID];
				$getuidbyrolemax = $getuidbyroler[ID]+15;
				if (($targetid >= $getuidbyrolemin) && ($targetid <= $getuidbyrolemax))
				{
					return $getuidbyrolemin;
				}
				//echo "<BR>(($buypointminID >= $targetid) && ($buypointmaxID <= $targetid))";
			}
			return 0;
		}
		else
			return 0;
	}
	function getudbbyrole($uid)
	{
		$count = (int)((int)($val/16))*16;
		$getuidbyroleq = mysql_query("SELECT * FROM users WHERE ID=".$count." ORDER BY ID ASC LIMIT 0,1");
		if ($getuidbyroleq)
		{
			$getuidbyroler = mysql_fetch_array($getuidbyroleq);
			return $getuidbyroler;
		}
		else
			return 0;
	}
	function isonline($uid)
	{
		$funcq = "SELECT Id FROM Online WHERE Id=$uid";
		if ($uid)
		{
			if ($funcr = mysql_query($funcq))
			{
				if ($funcrow = mysql_fetch_array($funcr))
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	function getclass($class)
	{
		if ($class >= 4)
			return "Elf";
		else if ($class >= 1)
			return "Beast";
		else if ($class >= 0)
			return "Human";
		else
			return "N/A";
	}
	function getculti($culti)
	{
		if ($culti == 1)
			return "N/A";
		else if ($culti == 2)
			return "Autoscopy";
		else if ($culti == 3)
			return "Naissance";
		else if ($culti == 4)
			return "Reborn";
		else if ($culti == 5)
			return "Vigilance";
		else if ($culti == 6)
			return "Doom";
		else if ($culti == 7)
			return "Disengage";
		else if ($culti == 8)
			return "Nirvana";
		else if ($culti == 20)
			return "Basic Immortal";
		else if ($culti == 21)
			return "Advanced Immortal";
		else if ($culti == 22)
			return "Professional Immortal";
		else if ($culti == 30)
			return "Basic Devil";
		else if ($culti == 31)
			return "Advanced Devil";
		else if ($culti == 32)
			return "Professional Devil";
		else
			return "N/A";
	}
	function getusername($uid)
	{
		$getunq = "SELECT name FROM users WHERE system!=1 AND ID=$uid";
		$getunr = mysql_query($getunq);
		if ($getunr)
			$getunrow = mysql_fetch_array($getunr);
		if (empty($getunrow[name]))
			return "N/A";
		else
			return $getunrow[name];
	}
	function getuid($name)
	{
		$getunq = "SELECT ID FROM users WHERE system!=1 AND name='$name'";
		$getunr = mysql_query($getunq) or die("SQL_ERROR");
		$getunrow = mysql_fetch_array($getunr);
		return $getunrow[ID];
	}
	function getgender($gender)
	{
		if ($gender == 1) return "Female";
		else return "Male";
	}
	function getgenderimg($gender)
	{
		if ($gender == 1) return "<img src=\"images/female.png\" alt=Female title=Female width=20 height=20>";
		else return "<img src=\"images/male.png\" alt=Male title=Male width=20 height=20>";
	}
	function _OLDgetgenderdb($gender)
	{
		if ($gender == 1) return "Male";
		else return "Female";
	}
	function getroleid($rolename)
	{
		$getroleidq = "SELECT * FROM uWebplayers WHERE rolename=\"$rolename\"";
		$getroleidr = mysql_query($getroleidq);
		if ($getroleidr)
		{
			$getroleidrow = mysql_fetch_array($getroleidr);
			if ($getroleidrow) return $getroleidrow[roleid];
			else return 0;
		}
		else return -1;
	}
	function isroleonline($uid)
	{
		$ruid = (int)($uid/16)*16;
		$funcq = "SELECT Id FROM Online WHERE Id=$ruid";
		if ($uid)
		{
			if ($funcr = mysql_query($funcq))
			{
				if ($funcrow = mysql_fetch_array($funcr))
				{
					$funcuq = "SELECT onlineID FROM users WHERE ID='".$funcrow[Id]."'";
					if ($funcur = mysql_query($funcuq))
					{
						if ($funcurow = mysql_fetch_array($funcur))
						{
							if ($funcurow[onlineID] == $uid)
								return 1;
							else
								return 0;
						}
						else
							return 0;
					}
					else
						return 0;
				}
				else
					return 0;
			}
			else
				return 0;
		}
		else
			return 0;
	}
	function roleinfo($uid, $type)
	{
		$ruid = (int)($uid/16)*16;
		//$ruid = $uid;
		$funcq = "SELECT * FROM uWebplayers WHERE roleid=$ruid";
		if ($uid)
		{
			if ($funcr = mysql_query($funcq))
			{
				if ($funcrow = mysql_fetch_array($funcr))
					return $funcrow[$type];
				else
					return 0;
			}
			else
				return 0;
		}
		else
			return 0;
	}
	function getaccstat($x)
	{
		if ($x == 1)
			return "BANNED USER";
		else if ($x == 2)
			return "SYSTEM";
		else if ($x == 3)
			return "VIP USER<BR><img src=images/star.gif><img src=images/star.gif>";
		else if ($x == 4)
			return "HELPER<BR><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif>";
		else if ($x == 5)
			return "STAFF<BR><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif>";
		else if ($x == 6)
			return "GAME MODERATOR<BR><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif>";
		else if ($x > 6)
			return "ADMINISTRATOR<BR><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif>";
		else
			return "NORMAL USER<BR><img src=images/star.gif>";
	}
	function getaccstat2($x)
	{
		if ($x == 1)
			return "BANNED USER";
		else if ($x == 2)
			return "SYSTEM";
		else if ($x == 3)
			return "<img src=images/star.gif><img src=images/star.gif>";
		else if ($x == 4)
			return "<img src=images/star.gif><img src=images/star.gif><img src=images/star.gif>";
		else if ($x == 5)
			return "<img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif>";
		else if ($x == 6)
			return "<img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif>";
		else if ($x > 6)
			return "<img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif>";
		else
			return "<img src=images/star.gif>";
	}
	function getstar1($x)
	{
		if ($x == 3)
			return "<img src=images/gstar_3.png>";
		else if ($x == 4)
			return "<img src=images/gstar_4.png>";
		else if ($x == 5)
			return "<img src=images/gstar_5.png>";
		else if ($x >= 6)
			return "<img src=images/gstar_6.png>";
	}
	function isgm($uid)
	{
		$ruid = ((int)($uid/16))*16;
		$funcq1 = "SELECT * FROM auth WHERE userid=$ruid";
		$funcq2 = "SELECT accstat FROM users WHERE ID=$ruid";
		if ($ruid)
		{
			if ($funcr1 = mysql_query($funcq1))
			{
				if (mysql_num_rows($funcr1) >= 1)
					return mysql_num_rows($funcr1);
				if ($funcr2 = mysql_query($funcq2))
				{
					$row = mysql_fetch_array($funcr2);
					return $row[accstat];
				}
			}
			else
				return 0;
		}
		else
			return 0;
	}
	function getuserdb($type, $val)
	{
		$count = (int)((int)($val/16))*16;
		if ($type == "ID")
			$getunq = "SELECT * FROM users WHERE ID=".$count." ORDER BY ID ASC LIMIT 0,1";
		else
			$getunq = "SELECT * FROM users WHERE $type='$val' LIMIT 0,1";
		$getunr = mysql_query($getunq);
		$row = mysql_fetch_array($getunr);
		return $row;
	}
	function getroledb($type, $val)
	{
		$getunq = "SELECT * FROM roles, factionusers, factions WHERE roles.roleid=factionusers.rid AND factionusers.fid=factions.fid AND $type='$val' GROUP BY roles.roleid LIMIT 0,1";
		$getunr = mysql_query($getunq);
		return mysql_fetch_array($getunr);
	}
	function getipdb($iplong)
	{
		$sql = "SELECT * FROM uwebipcountry WHERE ipfrom<=$iplong AND ipto>=$iplong LIMIT 0,1";
		$result = mysql_query($sql);
		if ($result)
		{
			$row = mysql_fetch_array($result);
			return $row;
		}
		else
		{
			return "null";
		}
	}
	include "modules/files/accounts/user/autoconf.php";
?>