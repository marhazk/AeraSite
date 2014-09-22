<?php
if (strlen($_REQUEST[q]) >= 1)
{
	if (isset($_REQUEST[start]))
		$start = $_REQUEST[start];
	else
		$start = 0;
	$sval = str_replace("*","%",$_REQUEST[q]);
	$sval = str_replace(" ","%",$_REQUEST[q]);
	$DB[items] = new GameDBD();
	$DB[items]->connect("items", "SELECT iid AS iid, iid AS iid2, iname, iinfo FROM itemlist WHERE iid = '$sval' OR iname LIKE '%$sval%' or iinfo LIKE '%$sval%' ORDER BY iid ASC LIMIT ".$start.", 100");
	$itemList = $DB[items]->retrieve();
	$total = count($itemList);
	
?>
<h1>Item List</h1>
<table width="100%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$sortBy = $_REQUEST["sort"];
	if ($sortBy == "")
		$sortBy = "iid";
	$sortlink = '<a href="?op=search&sort=__value__">__value2__</a>';
	$DB[items]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			"order"=>"iid desc",
			"displayID"=>true
		), 
		array(
			"iid"=>array(
				name=>"",
				links=>'<img src="http://www.perfectworld.my/images/icons/__iid2__.gif">'
			),
			"iname"=>array(
				name=>"Item Name",
				links=>'<a href="http://www.perfectworld.my/?op=item&id=__iid__">__iname__</a>'
			)
		)
	);
?>
</table>

<?php
if ($start >= 100)
{
	$newnum = $start-100;
	?>
    <a href="?op=search&q=<?php echo $_REQUEST[q]; ?>&start=<?php echo $newnum; ?>">BACK</a>
    <?php
}
if ($total >= 100)
{
	$newnum = $start+100;
	?>
    <a href="?op=search&q=<?php echo $_REQUEST[q]; ?>&start=<?php echo $newnum; ?>">NEXT</a>
    <?php
}
}?>