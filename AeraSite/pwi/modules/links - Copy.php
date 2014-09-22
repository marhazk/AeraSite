<?php
	$uWeb_path = "./modules/common/news";
	$uWeb_dh = opendir( $uWeb_path );
	$uwebsubtype = ".php";
	$newsnum = 0;
	while (gettype($uWeb_file = readdir( $uWeb_dh )) != boolean)
	{
		if ((is_dir("$uWeb_path/$uWeb_file") == false) && ($uWeb_file != "index.php"))
		{
			//print is_dir("$uWeb_path/$uWeb_file");
			$uWeb_file_hot = 0;
			$uWeb_file_name = str_replace($uwebsubtype,"",$uWeb_file);
			$uWeb_file_display = str_replace("_"," ",$uWeb_file_name);
			$uWeb_file_date = substr($uWeb_file_display,4,2)."-".substr($uWeb_file_display,6,2); // 201205270
			if (substr($uWeb_file_display,8,1) == "a") // 201205270
				$uWeb_file_hot = 1;
			//$uWeb_file_display = str_replace("0","",substr($uWeb_file_display,0,3));
			//$uWeb_file_display = str_replace("1","",substr($uWeb_file_display,0,3));
			//$uWeb_file_display = str_replace("2","",substr($uWeb_file_display,0,3));
			//$uWeb_file_display = str_replace("3","",substr($uWeb_file_display,0,3));
			//$uWeb_file_display = str_replace("4","",substr($uWeb_file_display,0,3));
			//$uWeb_file_display = str_replace("5","",substr($uWeb_file_display,0,3));
			//$uWeb_file_display = str_replace("6","",substr($uWeb_file_display,0,3));
			//$uWeb_file_display = str_replace("7","",substr($uWeb_file_display,0,3));
			//$uWeb_file_display = str_replace("8","",substr($uWeb_file_display,0,3));
			//$uWeb_file_display = str_replace("9","",substr($uWeb_file_display,0,3));
			include "$uWeb_path/$uWeb_file";
			$pagedb[$news[nurl]] = $news[ntitle];
			if ($includefilemain)
			{
				//print "<li><a href=\"$uwebfile?op=view&module=$uWeb_file_name&redirect=1\">".strtoupper($uWeb_file_display)."</a></li>";
				if (($uWeb_file_hot) && ($newshot))
				{
					print '<tr><td><a href="?op='.$news[nurl].'" title="'.$news[ntitle].'" target="_blank"><font color="red">'.$news[nname].'</font></a></td><td><img src="src/hot.gif"></td></tr>';
					if ($newsnum >= 1)
					{
						break;
					}
					$newsnum++;
				}
				else if ((!$uWeb_file_hot) && (!$newshot))
				{
					if ($newsnum < 4)
					{
						print '<tr><td><a href="?op='.$news[nurl].'" title="'.$news[ntitle].'" target="_blank"><font color="red">'.$news[nname].'</font></a></td><td> ['.$uWeb_file_date.']</td></tr>';
					}
					else if ($newsnum < 8)
					{
						print '<tr><td><a href="?op='.$news[nurl].'" title="'.$news[ntitle].'" target="_blank">'.$news[nname].'</a></td><td> ['.$uWeb_file_date.']</td></tr>';
					}
					else
					{
						break;
					}
					$newsnum++;
				}
			}
			$newsnum++;
		}
	}
	$newshot = 0;
	closedir( $uWeb_dh );
?>