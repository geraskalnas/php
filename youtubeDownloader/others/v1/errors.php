<!doctype html>
<html>
<?php
echo "check<br>";
var_dump(_GET);
	$errors = array();

	if($_GET["url"] === "" or $_GET["url"] === null)
	{
		$errors[] = "You didn't enter video url.";
	}
	
	if($_GET["vformat"] === "" or $_GET["vformat"] === null)
	{
		$errors[] = "You did'n select format.";
	}
	if(count($errors) > 0)
	{
		foreach($errors as $nerror)
		{
			print ("<p>" . $nerror . "<//p>");
		}
	}else
	{
		//echo '<script>window.location="convert.php?url=' . _GET["url"] . '&vformat=' . _GET["vformat"] . '"</script>';
	}
?>