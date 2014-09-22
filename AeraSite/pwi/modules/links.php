<?php
if ($serverUp)
{
	// TYPE (0: normal, 1: HOT)
		$wsql = mysql_query("SELECT * FROM webdb WHERE posttype=1 ORDER BY datetime DESC LIMIT 0,2", $Link);
		if ($wsql)
		{
			while ($news = mysql_fetch_array($wsql))
			{
				print '<tr><td><a href="http://www.perfectworld.my/?op='.$news[addr].'" title="'.$news[title].'" target="_blank"><font color="red">'.$news[linkname].'</font></a></td><td><img src="src/hot.gif"></td></tr>';
			}
		}
?>
</tbody></table>
<!-- cmschiptag:chiptag Wl News end -->
 <!-- cmschiptag:chiptag Wl News begin -->
<table class="cmsTable"><tbody>
              
<?php
	// TYPE (0: normal, 1: HOT)
		/*$wsql = mysql_query("SELECT * FROM webdb WHERE posttype=2 ORDER BY datetime DESC LIMIT 0,8", $Link);
		if ($wsql)
		{
			$newsnum = 0;
			while ($news = mysql_fetch_array($wsql))
			{
				$uWeb_file_date = date('m-d',$news[datetime]);
				if ($newsnum < 4)
				{
					print '<tr><td><a href="http://www.perfectworld.my/?op='.$news[addr].'" title="'.$news[title].'" target="_blank"><font color="red">'.$news[linkname].'</font></a></td><td> ['.$uWeb_file_date.']</td></tr>';
				}
				else if ($newsnum < 8)
				{
					print '<tr><td><a href="http://www.perfectworld.my/?op='.$news[addr].'" title="'.$news[title].'" target="_blank">'.$news[linkname].'</a></td><td> ['.$uWeb_file_date.']</td></tr>';
				}
				else
				{
					break;
				}
				$newsnum++;
			}
		}*/


        //XML from FB
        ini_set('user_agent', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.9) Gecko/20071025 Firefox/2.0.0.9');
        $rssUrl = "http://www.facebook.com/feeds/page.php?id=336851746368576&format=rss20";
        $xml    = simplexml_load_file($rssUrl); // Load the XML file
        $entry  = $xml->channel->item;

        //NEWS
        $i = 0;
        while ($i < 20)
        {
            if ($entry[$i]->author == "Perfect World: Aera Malaysia International")
            {
                $fbxml = array(
                    "TITLE"     => $entry[$i]->title,
                    "LINK"      => $entry[$i]->link,
                    "DESC"      => $entry[$i]->description,
                    "DATE"      => $entry[$i]->pubDate,
                    "AUTHOR"    => $entry[$i]->author,
                    "PIC"       => '',
                    "FIRST"     => '',
                    "TEXT"      => '',
                    "REALTITLE" => ''
                );

                $_msg               = explode('<br /> <br /> ', $fbxml['DESC']);
                $fbxml['REALTITLE'] = $_msg[0];
                $fbxml['TEXT']      = $_msg[1];


                //<li><a href="http://tera.perfectworld.com.my/?/Maintenance" title="" target="_blank">-!</a></li>

                $uWeb_file_date = date('m-d', strtotime($fbxml['DATE']));
                //$uWeb_file_date = '0-0';
                $fbxml['REALTITLE'] = str_replace("l.php?u=","",$fbxml['REALTITLE']);
                if ($i < 4)
                {
                    print '<tr><td><a href="'.$fbxml['LINK'].'" title="'.$fbxml['REALTITLE'].'" target="_blank"><font color="red">'.$fbxml['REALTITLE'].'</font></a></td><td> ['.$uWeb_file_date.']</td></tr>';
                }
                else if ($i < 8)
                {
                    print '<tr><td><a href="'.$fbxml['LINK'].'" title="'.$fbxml['REALTITLE'].'" target="_blank">'.$fbxml['REALTITLE'].'</a></td><td> ['.$uWeb_file_date.']</td></tr>';
                }
                else
                {
                    break;
                }
            }
            $i++;
        }
}
?>