<?php session_start();?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/main.css">
<?php
set_time_limit(4*60);
if($_GET["autoDownload"]==1)
{
  print("<title id='title'>Downloading...</title>");
}else if($_GET["autoDownload"]==1)
{
  print("<title id='title'>File is ready</title>");
}else 
{
	print("<title id='title'>Failure</title>");
}
?>
</head>
<body>
<?php
$debug=1;
$workingDirectory="uploads/";
print($_SESSION["viName"]);
#shell_exec("cd " . $workingDirectory);
#function sendHistory(url, format, s)
#{
#
#}
if($debug==1){echo "<script>console.log('AutoLoad: " . $_GET["autoDownload"] . "')</script>";}
if($_GET["format"][0]==="m")#if format is music
{
	$realFormat="";
	for($a=1; $a<=(strlen($_GET["format"])); $a++) {
		$realFormat=$realFormat.$_GET["format"][$a];
	}
	$executable="cd " . $workingDirectory . "; " . "youtube-dl -x --audio-format " . $realFormat . " " . $_GET["url"];
	if($debug==1){echo "<script>console.log(\"Executable: " . $executable . "\")</script>";}
	#shell_exec($executable);
	if($_GET["autoDownload"]==1){
		print("download.php?filename=" . urlencode($_SESSION["viName"]) . "." . $realFormat);
		print("<script language=\"javascript\" type=\"text/javascript\">");
      print("window.location=\"download.php?filename=" . urlencode($_SESSION["viName"]) . "." . $realFormat . "\";");
      print("</script>");
   }
}else if($_GET["format"][0]==="v")#if format is video
{
	$realFormat="";
	for($a=1; $a<=(strlen($_GET["format"])); $a++) {
		$realFormat=$realFormat.$_GET["format"][$a];
	}
	$executable="youtube-dl -f " . $realFormat . " " . $_GET["url"];
   if($debug==1){echo "<script>console.log(\"Executable: " . $executable . "\")</script>";}
	#shell_exec($executable);	
	if($_GET["autoDownload"]==1){
		print("download.php?filename=" . urlencode($_SESSION["viName"]) . "-" . $_SESSION["viUrl"] . "." . $realFormat);
		print("<script language=\"javascript\" type=\"text/javascript\">");
      print("window.location=\"download.php?filename=" . urlencode($_SESSION["viName"]) . "-" . $_SESSION["viUrl"] . "." . $realFormat . "\";");
      print("</script>");
   }
	if($debug==1){echo "<script>console.log(\"Executable: " . $executable . "\")</script>";}
}else{#problem...
	print("Hmmm, there's a small problem...<br><bold>You are hacker!</bold>");
}
#$viFormat=$realFormat;

#$result=exec("you-get -o '/uploads' " . $_GET["url"] . " > /uploads/out.txt");
print($result);
#var_dump($result);
?>
</body>
</html>