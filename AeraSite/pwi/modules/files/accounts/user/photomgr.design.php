
  <table width="100%" border="0">
    <tr>
      <td align="right" valign="top">Photo ID : </td>
      <td align="left" valign="top"><label for="title4"></label>
        <input name="pid" type="text" id="id" value="<?php echo $_POST[pid];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top">User ID : </td>
      <td align="left" valign="top"><label for="title2"></label>
      <input name="pby" type="text" id="id2" value="<?php echo $_POST[pby];?>" size="50" />
      </td>
    </tr>
    <tr>
      <td width="20%" align="right" valign="top">Photo Name: </td>
      <td width="80%" align="left" valign="top"><label for="uname"></label>
      <input name="pfile" type="text" id="uname" value="<?php echo $_POST[pfile];?>" size="50"></td>
    </tr>
    <tr>
      <td width="20%" align="right" valign="top">Date : </td>
      <td width="80%" align="left" valign="top"><input name="pdate" type="text" id="urealuname" value="<?php echo $_POST[pdate];?>" size="50"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Original Filename: </td>
      <td align="left" valign="top"><label for="title3"></label>
        <input name="porifile" type="text" id="title3" value="<?php echo $_POST[porifile];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Category :</td>
      <td align="left" valign="top"><p>
        <select name="pcat">
          <option value="<?php echo $_POST[pcat];?>" selected="selected"><?php echo $_POST[pcat];?></option>
          <option value="0">--------</option>
          <option value="1">Screenshot</option>
          <option value="2">Real Life</option>
          <option value="3">FanArt</option>
          <option value="4">Wallpaper</option>
          <option value="5">Funny Photos</option>
          <option value="6">Event Screenshot</option>
        </select>
      </p></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Description :</td>
      <td align="left" valign="top"><input name="pdesc" type="text" id="linkname7" value="<?php echo $_POST[pdesc];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Photo Meta:</td>
      <td align="left" valign="top"><input name="poritype" type="text" id="ubuyid" value="<?php echo $_POST[poritype];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Original Width:</td>
      <td align="left" valign="top"><input name="pwidth" type="text" id="linkname6" value="<?php echo $_POST[pwidth];?>" size="50" /></td>
    </tr>
    <tr>
      <td align="right" valign="top"> Original Height</td>
      <td align="left" valign="top"><input name="pheight" type="text" id="linkname5" value="<?php echo $_POST[pheight];?>" size="50" /></td>
    </tr>
    <TR><td valign=top colspan=2>&nbsp;</td></tr>
  </table>
