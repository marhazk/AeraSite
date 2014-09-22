<h1>Galleries - Wallpapers, Screenshots, Player Photos, Fan Arts</h1>
<style type="text/css">

.flashclass{ /*sample CSS class added to image slideshow container*/
border: 5px solid #FFFFFF;
background-color:#FFFFFF;
padding: 5px;
}

.flashclass img{
border-width: 0;
width: 500px;
}


a {color:#000;}
a:hover {text-decoration:none;}
a:visited {color:#000;}
/* =Hoverbox Code
----------------------------------------------------------------------*/

p
{
	clear: both;
	font: 10px Verdana, sans-serif;
	padding: 10px 0;
	text-align: center;
}

p a
{
	background: inherit;
	color: #777;
}

p a:hover
{
	background: inherit;
	color: #000;
}
.hoverbox
{
	cursor: default;
	list-style: none;
}

.hoverbox a
{
	cursor: default;
}

.hoverbox a .preview
{
	display: none;
}

.hoverbox a:hover .preview
{
	display: block;
	position: absolute;
	top: -33px;
	left: -45px;
	z-index: 1;
}

.hoverbox img
{
	background: #fff;
	border-color: #aaa #ccc #ddd #bbb;
	border-style: solid;
	border-width: 1px;
	color: inherit;
	padding: 2px;
	vertical-align: top;
	width: 100px;
	height: 75px;
}

.hoverbox li
{
	/*background: #786545;*/
	background: #888639;
	border-color: #ddd #bbb #aaa #ccc;
	border-style: solid;
	border-width: 1px;
	color: inherit;
	display: inline;
	float: left;
	margin: 3px;
	padding: 5px;
	position: relative;
}

.hoverbox .preview
{
	border-color: #000;
	width: 200px;
	height: 150px;
}
</style>


<center>
<?php if ($_REQUEST["cat"] >= 1) { ?>
<h1>Album Photos Category <?php echo $_REQUEST[cat]; ?></h1>
<ul class="hoverbox">
	<?php
		$sql = "SELECT * FROM uwebphotos WHERE pcat=".$_REQUEST[cat]." ORDER BY pid DESC";
		$query = mysql_query($sql);
		if ($query)
		{
			while ($row = mysql_fetch_array($query))
			{
	?>
			<li><a class=highlightit href="?op=photos/view&cat=<?php echo $row[pcat];?>&name=<?php echo $row[pfile];?>"><img src="?op=gfx&type=icon&file=<?php echo $row[pfile];?>" alt="<?php echo $row[pdesc];?>" title="<?php echo $row[pdesc];?>" /></a></li>
	<?php } }?>
		</ul>	
	
<P></P>
<?php } else { ?>
<h1>Screenshot Photos</h1>
<ul class="hoverbox">
	<?php
		$sql = "SELECT * FROM uwebphotos WHERE pcat=1 ORDER BY pid DESC LIMIT 0,20";
		$query = mysql_query($sql);
		if ($query)
		{
			while ($row = mysql_fetch_array($query))
			{
	?>
			<li><a class=highlightit href="?op=photos/view&cat=<?php echo $row[pcat];?>&name=<?php echo $row[pfile];?>"><img src="?op=gfx&type=icon&file=<?php echo $row[pfile];?>" alt="<?php echo $row[pdesc];?>" title="<?php echo $row[pdesc];?>" /></a></li>
	<?php } }?>
		</ul>
	<!--[if lte IE 6]></td></tr></table></a><![endif]-->

	<!--[if lte IE 6]><table><tr><td><![endif]-->
<p>Want More? <a href="?op=photos&cat=1">click here to view more photos</a></p>
<h1>Player Photos</h1>
<ul class="hoverbox">
	<?php
		$sql = "SELECT * FROM uwebphotos WHERE pcat=2 ORDER BY pid DESC LIMIT 0,20";
		$query = mysql_query($sql);
		if ($query)
		{
			while ($row = mysql_fetch_array($query))
			{
	?>
			<li><a class=highlightit href="?op=photos/view&cat=<?php echo $row[pcat];?>&name=<?php echo $row[pfile];?>"><img src="?op=gfx&type=icon&file=<?php echo $row[pfile];?>" alt="<?php echo $row[pdesc];?>" title="<?php echo $row[pdesc];?>" /></a></li>
	<?php } }?>
		</ul>
	<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	
	<!--[if lte IE 6]><table><tr><td><![endif]-->

<p>Want More? <a href="?op=photos&cat=2">click here to view more photos</a></p>
<h1>Fan Arts Photos</h1>
<ul class="hoverbox">
	<?php
		$sql = "SELECT * FROM uwebphotos WHERE pcat=3 ORDER BY pid DESC LIMIT 0,20";
		$query = mysql_query($sql);
		if ($query)
		{
			while ($row = mysql_fetch_array($query))
			{
	?>
			<li><a class=highlightit href="?op=photos/view&cat=<?php echo $row[pcat];?>&name=<?php echo $row[pfile];?>"><img src="?op=gfx&type=icon&file=<?php echo $row[pfile];?>" alt="<?php echo $row[pdesc];?>" title="<?php echo $row[pdesc];?>" /></a></li>
	<?php } }?>
		</ul>
	<!--[if lte IE 6]></td></tr></table></a><![endif]-->

	<!--[if lte IE 6]><table><tr><td><![endif]-->

<p>Want More? <a href="?op=photos&cat=3">click here to view more photos</a></p>
<h1>Wallpaper Photos</h1>
<ul class="hoverbox">
	<?php
		$sql = "SELECT * FROM uwebphotos WHERE pcat=4 ORDER BY pid DESC LIMIT 0,20";
		$query = mysql_query($sql);
		if ($query)
		{
			while ($row = mysql_fetch_array($query))
			{
	?>
			<li><a class=highlightit href="?op=photos/view&cat=<?php echo $row[pcat];?>&name=<?php echo $row[pfile];?>"><img src="?op=gfx&type=icon&file=<?php echo $row[pfile];?>" alt="<?php echo $row[pdesc];?>" title="<?php echo $row[pdesc];?>" /></a></li>
	<?php } }?>
		</ul>
	<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	
	<!--[if lte IE 6]><table><tr><td><![endif]-->

<p>Want More? <a href="?op=photos&cat=4">click here to view more photos</a></p>

<h1>Funny Photos</h1>
<ul class="hoverbox">
	<?php
		$sql = "SELECT * FROM uwebphotos WHERE pcat=5 ORDER BY pid DESC LIMIT 0,20";
		$query = mysql_query($sql);
		if ($query)
		{
			while ($row = mysql_fetch_array($query))
			{
	?>
			<li><a class=highlightit href="?op=photos/view&cat=<?php echo $row[pcat];?>&name=<?php echo $row[pfile];?>"><img src="?op=gfx&type=icon&file=<?php echo $row[pfile];?>" alt="<?php echo $row[pdesc];?>" title="<?php echo $row[pdesc];?>" /></a></li>
	<?php } }?>
		</ul>

	<!--[if lte IE 6]></td></tr></table></a><![endif]-->

<p>Want More? <a href="?op=photos&cat=5">click here to view more photos</a></p>
<br class="clear" />

<?php } ?>
</center>
