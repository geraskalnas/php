<?php
$file = "";
if((isset($_GET["fileName"])) and (isset($_GET["filePath"]))) {
	$fileName=$_GET["fileName"];
	$file=$_GET["filePath"] . "/" . $fileName;
}
// Quick check to verify that the file exists
if( !file_exists($file) ) die("File \"" . $fileName . "\" not found");
// Force the download
header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");
header("Content-Length: " . filesize($file));
header("Content-Type: application/octet-stream;");
readfile($file);
?>