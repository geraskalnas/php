<?php
session_start();
?>
<html>
<head>
<title>Simple youtube downloader</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/inde.css">
</head>
<body>
<img id="i" src="img/loading.gif" style="display: none;">
<form action="index.php" method="get">
<p>Youtube video url:
<input id="url" type="text" name="url" id="url" value=<?php if($_GET["url"] != null){print($_GET["url"]);} ?>></p>
<p>Format:
<select id="format" multiple name="format" id="format">
	<option value="vmp4">mp4</option>
	<option value="mmp3">mp3</option>
	<option value="maac">aac</option>
	<option value="mvorbis">vorbis</option>
	<option value="mopus">opus</option>
	<option value="mwav">wav</option>
</select>
</p>
<p>
<p>Use original name: <input type="radio" name="nameMethod" value="orig" checked></p>
<p>Original name + video url<input type="radio" name="nameMethod" value="orig+url"></p>
<p>Custom: <input type="radio" name="nameMethod" value="custom">
<input type="text" name="custom" value=<?php if($_GET["s"] != null){print("\"" . $_SESSION["viName"] . "\"");} ?>></p>
</p>
<p id="but"><input type="submit" name="s" value="Submit">
<input id="reset" type="reset" name="r" value="Reset"></p>
</form>
<script type="text/javascript">
function styleUrl() {
    var x = document.getElementById('pUrl');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}
function styleDesc() {
    var x = document.getElementById('pDesc');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}
function openUrl(url) {
  //var x = document.createElement("IMG");
  var x = document.getElementById('i');
  //document.write();
  x.style.display = 'block';  
  //x.setAttribute("src", "img/loading.gif");
  //x.setAttribute("width", "304");
  //x.setAttribute("height", "228");
  //x.setAttribute("alt", "The Pulpit Rock");
  //document.body.appendChild(x);
  window.location.href=url;
}
</script>
<?php
#if($_GET["s"] != null)
#{
	$debug = 0;
	$errors = array();

	#url testing
	/*
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
*/
	#errors:
	
		print("<p>");
		print("<a id='link' href='javascript:openUrl(\"convert.php?url=" . "bla" . "&format=" . "vmp4" . "&autoDownload=1" . "\")'><b>Convert & download</b></a>");
		print("		");
		print("<a id='link' href='javascript:openUrl(\"convert.php?url=" . "bla" . "&format=" . "vmp4" . "&autoDownload=0" . "\")'><b>Convert only</b></a>");
		print("</p>");
		$_SESSION["viUrl"]="qN4ooNx77u0";
		$_SESSION["viId"]="blablabla";
		$_SESSION["viName"]="Harry Styles - Sign of the Times";
		$_SESSION["viDuration"]="3";
		$_SESSION["viDescription"]="This is song about... bla bla bla";
		print("<p id=\"pName\">Name: " . $_SESSION["viName"] . "<br></p>");
		print("<p id=\"pDur\">Duration: " . $_SESSION["viDuration"] . "<br></p>");		
		print("<p id=\"pId\">Id: " . $_SESSION["viId"] . "<br></p>");
		print("<p id=\"pDesc\" style=\"display: none;\">Description: " . $_SESSION["viDescription"] . "<br></p>
		<button onclick=\"styleDesc()\">Show/hide Description</button>");
		print("<p id=\"pUrl\" style=\"display: none;\">Url: " . $_SESSION["viUrl"] . "<br></p>
		<button onclick=\"styleUrl()\">Show/hide Video url</button>");
	
#}
?>

</body>
</html>