<?php
	// Global Database for Faction / Guild
	class DBFaction
	{
		public var $db;
		public var $total;
		DBFaction()
		{
			$num = 0;
			$_sql = "SELECT * FROM factions";
			$_query = mysql_query($_sql);
			while ($_row = mysql_fetch_array($_query))
			{
				$this->db[$num] = $_row;
				$num++;
			}
			$this->total = $num;
		}
		function searchByID($id)
		{
			foreach ($this->db as $val)
			{
				if ($val["fid"] == $id)
					$temp = $val;
			}
			return $temp;
		}
	}
?>