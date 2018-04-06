<?php
$defaults=array();
$defaults["name"]="new";
$defaults["lastValue"]="";
$defaults["autoValue"]=0;
$defaults["newName"]="new";
$defaults["edit"]=0;
$defaults["gui"]=1;

function openUrl($url)
{
	print("<script src='js/openUrl.js'></script>");
	print("<script>openUrl('". $url ."')</script>");
}
function serializeOpenVar($action, $fileName, $mixed="")
{
	if(!isset($action)) {	
		if($mixed="") {
			$fo=fopen($fileName, "w") or die("fail");
			fwrite($fo, serialize($mixed));
			fclose($fo);
		}else {
			$fo=fopen($fileName, "r") or die("fail");
			while(!feof($fo)) $buf=fread($fo,4096);
			$items=(unserialize($buf));
			unset($buf);
			fclose($fo);
			return $items;
		}
	}else{
		$fo=fopen($fileName, $action) or die("fail");
		if($action=="w") {
			fwrite($fo, serialize($mixed));
			fclose($fo);
		}
		else {
			while(!feof($fo)) $buf=fread($fo,4096);
			$items=(unserialize($buf));
			return $items;
		}
	}
}
?>
