<?php
if (strlen($_REQUEST[id]) >= 1)
{
	$sval = $_REQUEST[id];
	$DB[items] = new GameDBD();
	$DB[items]->connect("items", "SELECT iid AS iid, iid AS iid2, iname, iinfo FROM itemlist WHERE iid = '$sval'");
	
	
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
			order=>"iid desc",
			displayID=>false,
			horizontal=>true,
			column=>1
		), 
		array(
			"iid"=>"Item ID",
			"iname"=>array(
				name=>"Item Name",
				links=>'<img src="http://www.perfectworld.my/images/icons/__iid__.gif"><BR>__iname__'
			),
			"iinfo"=>"Description"
		)
	);
?>
</table>

<?php }?>