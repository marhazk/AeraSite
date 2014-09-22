 <div class="news_main" >
                <div class="news_main_head">
                <a href="http://www.perfectworld.my/">Home</a>
<?php
	$opdb = explode("/", trim($op));
	$optotal = substr_count($op, "/");
	$optotal = $optotal-1;
	$opnum = 0;
	$optemp = "";
	//for ($opnum=0; $opdb<$optotal; $opnum++)
	foreach ($opdb as $oprow)
	{
		$opsdb = explode("_", $oprow);
		$opstotal = substr_count($oprow, "_");
		$opstemp = "";
		$_op = "";
		foreach ($opsdb as $opsrow)
		{
			//$oprow = $opdb[$opnum];
			$_op1 = strtoupper(substr($opsrow, 0, 1));
			$_op2 = strtolower(substr($opsrow, 1));
			$_op = $_op1.$_op2;
			$opstemp = $opstemp.$_op." ";
		}
		$optemp = $optemp.$oprow."/";
		if (($includefilemain == 0) && (strtolower($op) == strtolower(substr($optemp,0,-1))))
			break;
		echo "&gt;&gt; <a href=?op=".strtolower(substr($optemp,0,-1)).">$opstemp</a>";
	}
	if (isset($pagedb[strtolower($op)]))
		echo "&gt;&gt; ".$pagedb[strtolower($op)];
?> 
                </div>                
                <div class="news_main_body">
                  <h1><?php echo $pagedb[strtolower($op)];?></h1>
                  <!--article content-->
				  <div class="news_main_con">
                 <table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td>
<?php if ($_REQUEST[op] != "accounts") { ?>
<p><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.perfectworld.com.my%2F%3F<?php echo str_replace("/","%2F",str_replace("&","%26amp%3B",$_SERVER['QUERY_STRING']));?>&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=80" style="border: medium none; overflow: hidden; width: 450px; height: 80px;" allowtransparency="true" scrolling="no" frameborder="0"></iframe> 


<?php } include $includefile; if ($_REQUEST[op] != "accounts") { ?>
<?php if ($_REQUEST[op] != "photos/view") { ?>

<p><fb:comments href="http://www.perfectworld.com.my/?<?php echo $_SERVER['QUERY_STRING'];?>" num_posts="20" width="580"></fb:comments></p>
<?php } ?>

<p><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.perfectworld.com.my%2F%3F<?php echo str_replace("/","%2F",str_replace("&","%26amp%3B",$_SERVER['QUERY_STRING']));?>&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=80" style="border: medium none; overflow: hidden; width: 450px; height: 80px;" allowtransparency="true" scrolling="no" frameborder="0"></iframe></p> 
<fb:like-box href="http://www.facebook.com/pwmalaysia" width="580" height="290" show_faces="true" stream="false" header="true"></fb:like-box>
<?php } ?>
</td></tr></tbody></table>
<br>
                  </div>
				  <!--/article content-->
                </div>

              <div class="news_main_foot"></div>
             <?php //include "modules/footertext.php";?>
      
            </div>
              <div class="footer"><?php include "modules/footertext.php";?>
</div>       
