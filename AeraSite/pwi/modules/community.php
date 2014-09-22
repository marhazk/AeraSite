<?php
	$Link = @mysql_connect($dbuhost, $dbuname, $dbupass);
	if ($Link)
	{
		$dbsel = @mysql_select_db('dbo', $Link) or die ("Database do not exists.");	
		$serverUp = 1;
	}
		$sql = "SELECT * FROM uwebphotos ORDER BY pid DESC";
		$query = mysql_query($sql);
		if ($query)
		{
			$uwebcat1 = 0; //screenshot
			$uwebcat2 = 0; //photos
			$uwebcat3 = 0; //fanart
			$uwebcat4 = 0; //wallpaper
			while ($row = mysql_fetch_array($query))
			{
				if (($uwebcat1 == 0) && ($row[pcat] == 1))
				{
					$uwebcat1 = 1;
					$uWebpic1_link	= "?op=photos/view&name=".$row[pfile];
					$uWebpic1		= "?op=gfx&type=icon&file=".$row[pfile];
				}
				else if (($uwebcat2 == 0) && ($row[pcat] == 2))
				{
					$uwebcat2 = 1;
					$uWebpic2_link	= "?op=photos/view&name=".$row[pfile];
					$uWebpic2		= "?op=gfx&type=icon&file=".$row[pfile];
				}
				else if (($uwebcat3 == 0) && ($row[pcat] == 3))
				{
					$uwebcat3 = 1;
					$uWebpic3_link	= "?op=photos/view&name=".$row[pfile];
					$uWebpic3		= "?op=gfx&type=icon&file=".$row[pfile];
				}
				else if (($uwebcat4 == 0) && ($row[pcat] == 4))
				{
					$uWebpic4 = 1;
					$uWebpic4_link	= "?op=photos/view&name=".$row[pfile];
					$uWebpic4		= "?op=gfx&type=icon&file=".$row[pfile];
				}
				if (($uWebpic1) && ($uWebpic2) && ($uWebpic3) && ($uWebpic4))
					break;
			}
		}
		//uWebpic3_link
?>
<div class="img_bg">
          <h3>Community</h3>
          <div class="con">
                                    <div class="img">
                                        <dl>
                                            <dt><img src="src/screenshots.jpg" alt="Screenshots" title="Screenshots"></dt>
                                            <dd>
                                                <table class="album_js" width="100%"><tbody><tr><td><div align="center"><a href="<?php echo $uWebpic1_link;?>" target="_blank"><img src="<?php echo $uWebpic1;?>" border="0" height="135" width="180"></a></div></td></tr></tbody></table>
                                              <ul><li class="more_n"><a href="?op=accounts&type=photos" title="Submit Screenshots" target="_blank">Submit</a></li>
                                              <li class="more_n"><a href="?op=photos&cat=1" title="More Screenshots" target="_blank">More</a></li>
                                              </ul>
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="img">
                                        <dl>
                                            <dt><img src="src/photos.jpg" alt="Photos" title="Photos"></dt>
                                            <dd>
                                                <table class="album_js" width="100%"><tbody><tr><td><div align="center"><a href="<?php echo $uWebpic2_link;?>" target="_blank"><img src="<?php echo $uWebpic2;?>" border="0" height="160" width="140"></a></div></td></tr></tbody></table>
                                              <ul><li class="more_n"><a href="?op=accounts&type=photos" title="Submit Photos" target="_blank">Submit</a></li>
                                              <li class="more_n"><a href="?op=photos&cat=2" title="More Photos" target="_blank">More</a></li>
                                              </ul>
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="img">
                                        <dl>
                                            <dt><img src="src/fanart.jpg" alt="Fan Art" title="Fan Art"></dt>
                                            <dd class="img1">
                                                <div><a target="_blank" title="Fan Art" href="<?php echo $uWebpic3_link;?>"><img src="<?php echo $uWebpic3;?>"></a></div>
                                                <ul class="art">
<li class="more_n1"><a href="http://forum.perfectworld.my" title="Join Painter Team and win prizes" target="_blank">Join</a></li>
<li class="more_n1"><a href="?op=accounts&type=photos" title="Submit" target="_blank">Submit</a></li>
                                              <li class="more_n1"><a href="?op=photos&cat=3" title="More Fan Art" target="_blank">More</a></li>
                                              </ul>
                                            </dd>
                                        </dl>
                                  </div>
                                    <div class="img">
                                        <dl>
                                            <dt><img src="src/wallpapers.jpg" alt="Wallpapers" title="Wallpapers"></dt>
                                            <dd class="img1">
                                                <div><a target="_blank" title="Wallpapers" href="<?php echo $uWebpic4_link;?>"><img src="<?php echo $uWebpic4;?>"></a></div>
                                                <ul><li class="more_n"><a href="?op=accounts&type=photos" title="Submit" target="_blank">Submit</a></li>
                                                       <li class="more_n"><a href="?op=photos&cat=4" title="More Wallpapers" target="_blank">More</a></li>
                                              </ul>
                                            </dd>
                                        </dl>
                                  </div>
                                  </div>
        </div>
        