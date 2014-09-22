
<?php
	if (empty($_POST[addr]))
		$wmgrlink = "common/news/".time();
	else
	{
		$wmgrlink = $_POST[addr];
		if ($_POST[posttype] == 1)
			$_POST[posttypet] = "Hot Topic";
		else if ($_POST[posttype] == 2)
			$_POST[posttypet] = "Front Page";
		else
			$_POST[posttypet] = "Normal";
		if ($_POST[redirect] == 1)
			$_POST[redirectt] = "Redirect";
		else
			$_POST[redirectt] = "Non-Redirect";
	}
	if (empty($_POST["datetime"]))
		$_POST["datetime"] = time();
?>
  <table width="100%" border="0">
    <tr>
      <td width="20%" align="right" valign="top">Title : </td>
      <td width="80%" align="left" valign="top"><label for="title"></label>
      <input name="title" type="text" id="obj" value="<?php echo $_POST[title];?>" size="50"></td>
    </tr>
    <tr>
      <td width="20%" align="right" valign="top">Address : </td>
      <td width="80%" align="left" valign="top"><input name="addr" id="obj" type="text" value="<?php echo $wmgrlink;?>" size="50">
        <input name="remember" type="checkbox" id="remember" value="1" <?php echo $wmgrchk;?>>
        <label for="remember"></label>
Remember link name in future post</td>
    </tr>
    <tr>
      <td align="right" valign="top">DateTime :</td>
      <td align="left" valign="top"><input name="datetime" type="text" id="obj" value="<?php echo $_POST[datetime];?>" size="50" /></td>
    </tr>
    <tr>
      <td width="20%" align="right" valign="top">Link Name :</td>
      <td width="80%" align="left" valign="top"><input name="linkname" id="obj" type="text" value="<?php echo $_POST[linkname];?>" size="50"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Redirect type:</td>
      <td align="left" valign="top"><select name="redirect">
          <option value="<?php echo $_POST[redirect];?>"><?php echo $_POST[redirectt];?></option>
          <option value="0">-</option>
        <option value="0">Non-Redirect</option>
        <option value="1">Redirect</option>
      </select></td>
    </tr>
    <tr>
      <td align="right" valign="top">Redirect Address :</td>
      <td align="left" valign="top"><input name="redirectaddr" id="obj"type="text" value="<?php echo $_POST[redirectaddr];?>" size="50" /></td>
    </tr>
    <tr>
      <td width="20%" align="right" valign="top">Type : </td>
      <td width="80%" align="left" valign="top"><label for="type"></label>
        <select name="posttype" id="type">
          <option value="<?php echo $_POST[posttype];?>"><?php echo $_POST[posttypet];?></option>
          <option value="0">-</option>
          <option value="0">Normal</option>
          <option value="1">Hot Topic</option>
          <option value="2">Front Page</option>
      </select></td>
    </tr>
    <tr>
      <td width="20%" align="right" valign="top">Content in HTML :</td>
      <td width="80%" align="left" valign="top"><p>
        <label for="textarea"></label>
        <textarea name="content" id="obj" class="editor" cols="55" rows="10"><?php echo $_POST[content];?></textarea>
      </p></td>
    </tr>
  </table>