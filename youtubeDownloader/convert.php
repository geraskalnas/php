<?php session_start();?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/main.css">
<?php
set_time_limit(4*60);
if($_GET["autoDownload"]==1)
{
  print("<title id='title'>Downloading...</title>");
}else if($_GET["autoDownload"]==0)
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
$workingDirectory="uploads";
$sesionId=rand();
print("<a href='index.php'>Home</a>");
print("<p>" . $_SESSION["viName"] . "</p>");
shell_exec("mkdir " . $workingDirectory . "/" . $sesionId);
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
	$executable="cd " . $workingDirectory . "/" . $sesionId . "; " . "youtube-dl -x --audio-format " . $realFormat . " " . $_GET["url"];
	if($debug==1){echo "<script>console.log(\"Executable: " . $executable . "\")</script>";}
	shell_exec($executable);
	//if($debug==1){echo "<script>console.log(\"Download: " . "download.php?filename=" . urlencode($_SESSION["viName"]) . "-" . $_SESSION["viId"] . "." . $realFormat . "\")</script>";}

}else if($_GET["format"][0]==="v")#if format is video
{
	$realFormat="";
	for($a=1; $a<=(strlen($_GET["format"])); $a++) {
		$realFormat=$realFormat.$_GET["format"][$a];
	}
	$executable="cd " . $workingDirectory . "/" . $sesionId . "; " . "youtube-dl -f " . $realFormat . " " . $_GET["url"];
   if($debug==1){echo "<script>console.log(\"Executable: " . $executable . "\")</script>";}
	shell_exec($executable);
	//if($debug==1){echo "<script>console.log(\"Download: " . "download.php?filename=" . urlencode($_SESSION["viName"]) . "-" . $_SESSION["viId"] . "." . $realFormat . "\")</script>";}
}else{#problem...
	print("Hmmm, there's a small problem...<br><bold>You are hacker!</bold>");
}
if($_GET["format"][0]==="m" || $_GET["format"][0]==="v")
{
	$fileName=substr(shell_exec("ls " . $workingDirectory . "/" . $sesionId), 0, -1);
	$downloadUrl="download.php?fileName=" . $fileName . "&filePath=" . $workingDirectory . "/" . $sesionId;

	if($debug==1){echo "<script>console.log(\"Download: " . $downloadUrl . ")</script>";}

	print("<p><a href='". $downloadUrl . "'>" . $fileName . "</a></p>");
	if($_GET["autoDownload"]==1){
		print("<script language=\"javascript\" type=\"text/javascript\">");
     	#print("window.location=\"download.php?filename=" . urlencode($_SESSION["viName"]) . "-" . $_SESSION["viId"] . "." . $realFormat . "\";");
		print("window.location='" . $downloadUrl . "';");
     	print("</script>");
  }
}
#$viFormat=$realFormat;

#$result=exec("you-get -o '/uploads' " . $_GET["url"] . " > /uploads/out.txt");
print($result);
#var_dump($result);
?>
</body>
</html>