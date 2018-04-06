<?php
$debug = 0;
$errors = array();

#url testing
if($_GET["url"] == null)
{
	$errors[] = "You didn't enter video url.";
	if($debug==1){echo "<script>console.log('url -')</script>";}
}else
{
	if($debug==1){echo "<script>console.log('url +')</script>";}
	if($debug==1){echo "<script>console.log('url:" . $_GET["url"] . "')</script>";}
}

#format testing
if($_GET["format"] == null)
{
	$errors[] = "You didn't enter video format.";
	if($debug==1){echo "<script>console.log('format -')</script>";}
}else
{
	if($debug==1){echo "<script>console.log('format +')</script>";}
	if($debug==1){echo "<script>console.log('format:" . $_GET["format"] . "')</script>";}
}

#errors:
foreach($errors as $err)
{
	print($err);
}
if(!$errors)
{
	print("<a href='www.google'>Convert</a>");
}
?>
