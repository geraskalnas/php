<?php
session_start();
?>
<html>
<head>
<title>Simple youtube downloader</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/inde.css">
<script type="text/javascript" src="js/HTMLRadioChecker.js"></script>
<script type="text/javascript" src="js/showHideElements.js">
</script>
</head>
<body onLoad="initValue()">
<img id="i" src="img/loading.gif" style="display: none;">
<form action="index.php" method="get">
<p>Youtube video url:
<input id="url" type="text" name="url" id="url" value=<?php if(isset($_GET["url"])){print($_GET["url"]);} ?>></p>
<p>Format:
<select id="format" multiple name="format" id="format">
	<option value="vmp4">mp4</option>
	<option value="mmp3">mp3</option>
	<option value="maac">aac</option>
	<option value="mvorbis">vorbis</option>
	<option value="mopus">opus</option>
	<option value="mwav">wav</option>
</select>
</p><br>
<p>Name for file:<br>
<p>Use original name: <input type="radio" name="nameMethod" value="orig" onclick="setShemp(false);fullName(this.form)"></p>
<p>Original name + video url<input type="radio" name="nameMethod" value="orig+url" onclick="setShemp(false);fullName(this.form)" checked></p>
<p>Custom: <input type="radio" name="nameMethod" onclick="setShemp(true);fullName(this.form)" value="custom">
<input id="customField" type="text" name="custom" style="display: none;" value=<?php if(isset($_GET["s"])){print("'" . $_SESSION["viName"] . "'");} ?>></p>
</p><br>
<p id="but"><input type="submit" name="s" value="Submit">
<input id="reset" type="reset" name="r" value="Reset"></p>
</form>
<script type="text/javascript" src="js/styleChanges.js"></script>
<script type="text/javascript" src="js/openUrl.js"></script>
<?php
if(isset($_GET["url"]))
{
	$debug = 1;
	$errors = array();

	#url testing
	if(!isset($_GET["url"]))
	{
		$errors[] = "You didn't enter video url.";
		if($debug==1){echo "<script>console.log('url -')</script>";}
	}else
	{
		if($debug==1){echo "<script>console.log('url +')</script>";}
		if($debug==1){echo "<script>console.log('url:" . $_GET["url"] . "')</script>";}
	}

	#format testing
	if(!isset($_GET["format"]))
	{
		$errors[] = "You didn't enter video format.";
		if($debug==1){echo "<script>console.log('format -')</script>";}
	}else
	{
		if($debug==1){echo "<script>console.log('format +')</script>";}
		if($debug==1){echo "<script>console.log('format:" . $_GET["format"] . "')</script>";}
	}
	
	#
	if(!isset($_GET["nameMethod"]))
	{
		$_GET["nameMethod"] = "orig+url";
	}else if($_GET["nameMethod"] == "custom")
	{
		$errors[] = "You didn't select name method.";
		if($debug==1){echo "<script>console.log('nameMethod -')</script>";};
	}else
	{
		if($debug==1){echo "<script>console.log('nameMethod +')</script>";};
		if($debug==1){echo "<script>console.log('nameMethod: ". $_GET["nameMethod"] . "')</script>";};
	}

	#unknow source?
	#if($_GET["s"] == null)
	#{
		#if($debug==1){echo "<script>console.log('source -')</script>";}
		#$s="web";
	#}else
	#{
		#if($debug==1){echo "<script>console.log('source +')</script>";}
		#if($debug==1){echo "<script>console.log('source:" . $_GET["s"] . "')</script>";}
	#}

	#errors:
	foreach($errors as $err)
	{
		print("<p>" . $err . "</p>");
	}
	if(!$errors)
	{
		print("<br><p>");
		print("<a id='link' href='javascript:openUrl(\"convert.php?url=" . urlencode($_GET["url"]) . "&format=" . urlencode($_GET["format"]) . "&autoDownload=1" . "\")'><b>Convert & download</b></a>");
		print("		");
		print("<a id='link' href='javascript:openUrl(\"convert.php?url=" . urlencode($_GET["url"]) . "&format=" . urlencode($_GET["format"]) . "&autoDownload=0" . "\")'><b>Convert only</b></a>");
		print("</p>");
		$executable = "youtube-dl -e --get-id --get-duration -g " . $_GET["url"];
		$result=explode("\n", shell_exec($executable));
		#$_SESSION["viUrl"]=shell_exec("youtube-dl -g " . $_GET["url"]);
		#$_SESSION["viId"]=shell_exec("youtube-dl --get-id " . $_GET["url"]);
		#$_SESSION["viName"]=shell_exec("youtube-dl -e " . $_GET["url"]);
		#$_SESSION["viDuration"]=shell_exec("youtube-dl --get-duration " . $_GET["url"]);
		#$_SESSION["viDescription"]=shell_exec("youtube-dl --get-filename " . $_GET["url"]);
		$_SESSION["viUrl"]=$result[2];
		$_SESSION["viId"]=$result[1];
		$_SESSION["viName"]=$result[0];
		$_SESSION["viDuration"]=$result[4];
		$_SESSION["viDescription"]=shell_exec("youtube-dl --get-description " . $_GET["url"]);
		print("<p id=\"pName\">Name: " . $_SESSION["viName"] . "<br></p>");
		print("<p id=\"pDur\">Duration: " . $_SESSION["viDuration"] . "<br></p>");		
		print("<a id=\"pId\" href=\"" . $_GET["url"] . "\">Id: " . $_SESSION["viId"] . "</a><br></p>");
		print("<p id=\"pDesc\" style=\"display: none;\">Description: " . $_SESSION["viDescription"] . "<br></p>
		<button onclick=\"styleDesc()\">Show/hide Description</button>");
		print("<a id=\"pUrl\" style=\"display: none;\" href=\"" . $_SESSION["viUrl"] . "\">Url: " . $_SESSION["viUrl"] . "</a><br></p>
		<button onclick=\"styleUrl()\">Show/hide Video url</button>");
	}
}
?>

</body>
</html>