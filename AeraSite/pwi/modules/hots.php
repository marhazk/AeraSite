<?php
if ($serverUp)
{
		$wsql = mysql_query("SELECT * FROM webdb WHERE title LIKE '%Patch%' OR title LIKE '%HOT%' OR title LIKE '%EVENT%' ORDER BY datetime DESC LIMIT 0,5", $Link);
		if ($wsql)
		{
			$newsnum = 0;
			while ($news = mysql_fetch_array($wsql))
			{
				$uWeb_file_date = date('m-d',$news[datetime]);
				print '<li><a href="?op='.$news[addr].'" title="'.$news[title].'" target="_blank">&gt; ['.$uWeb_file_date.'] ................. '.$news[linkname].'</a></li>';
				$newsnum++;
			}
		}
}
?>