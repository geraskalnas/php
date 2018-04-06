<?php
if(@$_GET["action"]=="set"){
  $f=fopen("data", "w");
  @fwrite($f, $_GET["val"]);
  fclose($f);
}else{
  $f=fopen("data", "r");
  $data=fread($f, 4096);
  fclose($f);
  echo $data;
}
?>
