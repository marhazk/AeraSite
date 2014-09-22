<div id="slider">


<div id="drawer_1" class="drawer">

				<div id="tab_1" class="tab">
					<span>F</span>
<span>A</span>
<span>C</span>
<span>E</span>
<span>B</span>
<span>O</span>
<span>O</span>
<span>K</span>
	
				</div><!-- .tab -->

				<ul id="drawer_content_1" class="drawer_content">					
					<li id="p3-social-media-icons-3" class="widget widget_p3-social-media-icons"><h3 class='widgettitle'>FACEBOOK PAGE</h3> <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpwmalaysia&amp;width=255&amp;colorscheme=dark&amp;show_faces=true&amp;stream=false&amp;header=false&amp;height=600" scrolling="no" border=0 frameborder="0" style="border:none; overflow:hidden; width:255px; height:600px;" allowTransparency="true"></iframe>
<BR /><BR />
		</li>
				</ul><!-- .drawer_content -->

			</div><!-- .drawer -->
	
			<div id="drawer_2" class="drawer">

				<div id="tab_2" class="tab">
<span>A</span>
<span>B</span>
<span>O</span>
<span>U</span>
<span>T</span>
<span>U</span>
<span>S</span>
	
				</div><!-- .tab -->

				<ul id="drawer_content_2" class="drawer_content">					
					<li id="p3-twitter-simple-badge-5" class="widget p3-simple-twitter-widget">
                    	<h3 class='widgettitle'>ABOUT PWAERA</h3>
<center>
<marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="1" scrolldelay="1" direction="up" height="100%" width="100%">
<center>

</center>
</marquee>
</center>
</li>

					
				</ul><!-- .drawer_content -->

			</div><!-- .drawer -->
	
<div id="drawer_3" class="drawer">

				<div id="tab_3" class="tab">
<span>A</span>
<span>C</span>
<span>C</span>
<span>O</span>
<span>U</span>
<span>N</span>
<span>T</span>
<span>S</span>
	
				</div><!-- .tab -->

				<ul id="drawer_content_3" class="drawer_content">					
					<li id="p3-custom-icon-3" class="widget widget_p3-custom-icon"><h3 class='widgettitle'>ACCOUNT LOGIN AND INFORMATIONS</h3>
<br /><br />
<center>
<font color=white>
<?php
	if ($serverUp)
	{

		if ($userWebID == 5)
		{
			$chkid = $uWeb_vinfo[ID];
			include "modules/files/accounts/user/home.php";
			include "modules/files/accounts/user/homemenu.php";
			
		}
		else
		{
			include "modules/files/accounts/user/login.php";
		}
	}
	else
	{
		maintainance();
	}
?>
</font>

</center>
</li>
					
				</ul><!-- .drawer_content -->

</div><!-- .drawer -->

<div id="drawer_4" class="drawer">

				<div id="tab_4" class="tab">
<span>S</span>
<span>H</span>
<span>O</span>
<span>U</span>
<span>T</span>
<span>B</span>
<span>O</span>
<span>X</span>
	
				</div><!-- .tab -->

				<ul id="drawer_content_4" class="drawer_content">					
					<li id="p3-custom-icon-4" class="widget widget_p3-custom-icon"><h3 class='widgettitle'>SHOUTBOX</h3>
<center>
<p><a href="http://151602.myshoutbox.com/" target="shoutbox">Refresh ShoutBox</a></p>
<p>
<!--webbot bot="HTMLMarkup" startspan --><iframe border="0" name="shoutbox" src="http://151602.myshoutbox.com/" frameborder="0" height="600" width="100%">&lt;!--webbot
    bot="HTMLMarkup" endspan --&gt; Your browser does not support inline frames or is currently
    configured not to display inline frames.&lt;!--webbot bot="HTMLMarkup" startspan --&gt;</iframe><!--webbot
    bot="HTMLMarkup" endspan --> </p>
</center></li>
					
				</ul><!-- .drawer_content -->

</div><!-- .drawer -->
