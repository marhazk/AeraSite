<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
$amount = 10000;


$link = mysql_connect('localhost', 'root', 'Ff190388!');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
else
{
    echo 'Connected successfully';
    $chkdb = mysql_select_db('fw', $link) or die('Could not select database.');
    if ($chkdb)
        echo '<BR>Connected to DB successfully';
}
if ($_REQUEST['addgm'] >= 10)
{
    $result = mysql_query("call addGM  (".$_REQUEST['addgm']." , 1)");
    if ($result)
        echo '<BR>GM has been inserted';
    else
        echo '<BR>GM failed to be inserted';
}
elseif ($_REQUEST['delgm'] >= 10)
{
    $result = mysql_query("DELETE FROM auth WHERE userid=".$_REQUEST['delgm']);
    if ($result)
        echo '<BR>GM has been removed';
    else
        echo '<BR>GM failed to be removed';
}
elseif ($_REQUEST['deluser'] >= 10)
{
    $result = mysql_query("DELETE FROM users WHERE ID=".$_REQUEST['deluser']);
    if ($result)
        echo '<BR>USER has been removed';
    else
        echo '<BR>USER failed to be removed';
}
elseif (($_POST[userid] >= 10))
{

    //$result = mysql_query("call usecash (".$_POST[userid]." , 1, 0, 1, 0, ".$_POST[cash]."00, 1, @error)");
    $result = mysql_query("call usecash (".$_POST[userid]." , 1, 0, 19, 0, ".$amount.", 1, @error)");

    if ($result)
    {
        echo '<BR>CASH has been inserted';
    }
    else
    {
        echo '<BR>CASH failed to be inserted';
    }
}
?>
<hr>
<form method=post>
    User Name : <select name=userid>
<?php
        $result = mysql_query("SELECT ID, name FROM users ORDER BY name ASC");
        while ($row = mysql_fetch_array($result))
        {
            echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
        }
?>
</select>
    <input type=submit value="Add <?=$amount?> EydraLeaf Now">
</form>
<hr>
<h1>POINT STATUS</h1>
<table width=100%>
    <?php
    $result = mysql_query("SELECT u.ID, u.name, c.fintime FROM users u, usecashlog c WHERE u.ID=c.userid ORDER BY c.fintime DESC");
    while ($row = mysql_fetch_array($result))
    {
        echo '<tr><td>'.$row['fintime'].'</td><td>Point has successfully transfered into '.$row['name'].' account</td></tr>';
    }
    ?>
</table>
<hr>
<h1>PENDING POINT STATUS</h1>
<table width=100%>
    <?php
    $result = mysql_query("SELECT u.ID, u.name, c.fintime FROM users u, usecashnow c WHERE u.ID=c.userid ORDER BY c.creatime DESC");
    while ($row = mysql_fetch_array($result))
    {
        echo '<tr><td>'.$row['creatime'].'</td><td>Point has pending transferred into '.$row['name'].' account</td></tr>';
    }
    ?>
</table>
<hr>
<h1>USER REGISTRATION STATUS</h1>
<table width=100%>
<?php
$result = mysql_query("SELECT u.ID, u.name, u.creatime FROM users u ORDER BY u.ID DESC");
while ($row = mysql_fetch_array($result))
{
    echo '<tr><td>'.$row['creatime'].'</td><td>'.$row['name'].' account has been registered</td><td>[<a href="/cash/?deluser='.$row['ID'].'">REMOVE</a>]</td><td>[<a href="/cash/?addgm='.$row['ID'].'">ADD GM</a>]</td></tr>';
}
?>
</table>
<hr>
<h1>GAME MODERATOR STATUS</h1>
<table width=100%>
<?php
$result = mysql_query("SELECT u.ID, u.name FROM users u, auth a WHERE u.ID=a.userid GROUP BY a.userid ORDER BY u.name DESC");
while ($row = mysql_fetch_array($result))
{
    echo '<tr><td>'.$row['name'].' is a GM</td><td>[<a href="/cash/?removegm='.$row['ID'].'">REMOVE</a>]</td></tr>';
}
?>
</table>
<hr>

<?php
mysql_close($link);

?>
</html>