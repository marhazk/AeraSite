<?php
  require_once "class.imagebmp.php";
  $img = imagecreatefromgif("icons/".$_REQUEST[file].".gif");

  header('Content-Type: image/bmp');
  header('Content-Disposition: inline; filename=icon.bmp');
  
  imagebmp::imagebmp($img);
  imagedestroy($img);
  unset($img);

?>