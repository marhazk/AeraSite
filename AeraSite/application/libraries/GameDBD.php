<?php
	class GameDBD
	{
		public $db;
		public $dbAttr;
		public $total = 0;
		public $totalAttr = 0;
		public $dbName = "";
		public $dbActive = false;
		public $dbclass = NULL;

		function sqldb($class)
		{
			$this->dbclass = $class;
		}
		function connect($name, $sql = NULL)
		{
			$this->dbName = $name;
			if ($sql == NULL)
				$_sql = "SELECT * FROM ".$this->dbName;
			else
				$_sql = $sql;
			$_query = $this->dbclass->query($_sql);
			$num = 0;
			foreach ($_query->row_array() as $_rkey => $_rval)
			{
				$tempvar = $_rkey;
				$this->dbAttr[$tempvar] = $tempvar;
				$num++;
			}
			$this->totalAttr = $num;
			$num = 0;
			foreach ($_query->row_array() as $_row)
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
				$orderBy = explode(" ", $parameters['order']);
				$orderByName = $orderBy[0];
				$orderByType = $orderBy[1];
				$displayID = $parameters['displayID'];
				$byHorizontal = $parameters['horizontal'];
				$column = $parameters['column'];
				$disLimit = $parameters['limit'];
				$disStart = $parameters['start'];
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
							if ($displayAttr[$key]['mathcalc'])
								$mathcalc = $displayAttr[$key]['mathcalc'];
							else
								$mathcalc = '';
							if ($displayAttr[$key]['allowsort'])
								$sortlink = $displayAttr[$key]['sortlink'];
							else
								$sortlink = '__value2__';
							$temp .= $this->replaceValue($key, $displayAttr[$key]['name'],$sortlink);
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
								if ((isset($displayAttr[$key]['multi'])) && (strlen($displayAttr[$key]['multi']) >= 1))
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
												$val .= $displayAttr[$key]['multi'];
											$tempDB = $displayAttr[$key]['db']->searchBy($displayAttr[$key]['attr'],$valDB);
											if (strlen($displayAttr[$key]['links']) >= 1)
												$val .= $this->links($tempDB[$displayAttr[$key]['displayAttr']],$displayAttr[$key]['links'],$tempDB);
											else
												$val .= $tempDB[$displayAttr[$key]['displayAttr']];
											$ArrNum++;
										}
									}
									else
										$val = "";
								}
								else if ((isset($displayAttr[$key]['multiDB'])) && (strlen($displayAttr[$key]['multiDB']) >= 1))
								{
									if ((strlen($val) >= 1) || (is_array($val)))
									{
										$stateDB = $displayAttr[$key]['db']->retrieveBy(array($displayAttr[$key]['attr'],"==",$val));
										$val = "";
										$ArrNum = 0;
										if (is_array($stateDB))
										{
											foreach ($stateDB as $valDB)
											{
												if ($ArrNum > 0)
													$val .= $displayAttr[$key]['multiDB'];
												if (strlen($displayAttr[$key]['links']) >= 1)
													$val .= $this->links($valDB[$displayAttr[$key]['displayAttr']],$displayAttr[$key]['links'],$valDB);
												else
													$val .= $valDB[$displayAttr[$key]['displayAttr']];
												$ArrNum++;
											}
										}
										else
											$val = "";
									}
									else
										$val = "";
								}
								else if ((isset($displayAttr[$key]['calcPKZone'])) && (strlen($displayAttr[$key]['calcPKZone']) >= 1))
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
								else if ((empty($displayAttr[$key]['attr'])) && (empty($displayAttr[$key]['displayAttr'])))
								{
									if (strlen($displayAttr[$key]['links']) >= 1)
										$val = $this->links($val,$displayAttr[$key]['links'],$valDB,$key,$val);
									else if ($displayAttr[$key]['base64'])
										$val = base64_decode($val);
									else
										$val = $val;
									//if ($displayAttr[$key]['moderator'])
									//	$val = $val." ".$displayAttr[$key]['moderatorlinks']
								}
								else if (strlen($displayAttr[$key]['links']) >= 1)
								{
									$tempDB = $displayAttr[$key]['db']->searchBy($displayAttr[$key]['attr'],$val);
									$val = $this->links($tempDB[$displayAttr[$key]['displayAttr']],$displayAttr[$key]['links'],$tempDB,$key,$val);
								}
								else
								{
									$tempDB = $displayAttr[$key]['db']->searchBy($displayAttr[$key]['attr'],$val);
									$val = $tempDB[$displayAttr[$key]['displayAttr']];
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
										$tempRow .= $displayAttr[$key]['name'].$mid;
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
			return $temp;
		}
	}
?>