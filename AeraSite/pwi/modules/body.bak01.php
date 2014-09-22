<?php include "modules/forumdb.php";?>
<div class="right_l"><div class="flash_bg">
            <div class="flash"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" height="249" width="334"><param name="movie" value="images/eubonew.swf"><param name="quality" value="high"><param name="bgcolor" value="#F0F0F0">
              <param name="menu" value="true">
              <param name="wmode" value="transparent">
              <param name="play" value="true">
              <embed src="images/eubonew.swf" wmode="transparent" height="249" width="334" play="true" flashvars="play=true"></object>
            </div>
          </div>
          <div class="hot_update">
            <h3>Recent Hot Update</h3>            
            <ul>
            <?php include "modules/hotlinks.php";?>
</ul>            
          </div>
          <div class="s_t">
            <h3>Stories &amp; Tips</h3>
            <div class="con">              
              <!-- cmschiptag:chiptag Wl Articles begin -->
              <table class="cmsTable"><tbody><?php echo $body[ts];?></tbody></table>
              <!-- cmschiptag:chiptag Wl Articles end -->
            </div>
            <a title="Summit Stories &amp; Tips" class="art_more" style="margin: 10px 0pt 0pt 200px;" href="http://article.perfectworld.my/englishnews/nd91news/uparticle/index.aspx?cid=32" target="_blank">Submit</a> <a title="More Stories &amp; Tips" class="art_more" style="margin: -15px 0pt 0pt 270px;" href="http://aera.perfectworld.my/list/article_list.shtml">More</a> </div>
        </div>
        <div class="right_r">
          <div class="news_list">
            <h3>Announcements &amp; Events</h3>
            <div class="con">
              <!-- cmschiptag:chiptag Wl News begin -->
              <table class="set_tab"><tbody><?php include "modules/links.php";?></tbody></table>
<BR />
                                  <?php include "modules/countdown.php";?>
              <!-- cmschiptag:chiptag Wl News end -->
            </div>
            <div class="more_n">
              <p><a title="More Announcements" href="http://aera.perfectworld.my/list/news_list.shtml">More</a></p>
              
              <div class="rss"> <a title="RSS" target="_blank" href="http://aera.perfectworld.my/list/rss_news.xml"><img src="src/rss.jpg" border="0"></a> </div>
              
              
            </div>
          </div>
          <div class="q_a">
            <h3>Questions &amp; Answers</h3>
            <div class="con">
              <table class="cmsTable"><tbody><?php echo $body[qa];?></tbody></table>
            </div>
            <a title="Summit Q&amp;A" class="art_more" style="margin: 10px 0pt 0pt 205px;" href="http://help.perfectworld.my/member/question.php" target="_blank">Summit</a> <a title="More Q&amp;A" class="art_more" style="margin: -15px 0pt 0pt 275px;" href="http://help.perfectworld.my/answerlist.php?parentid=35&amp;status=R&amp;sType=1" target="_blank">More</a> </div>


</div>


<br class="clearfloat">
        <?php include "modules/community.php";?>
        