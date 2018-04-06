<?php
require "ref/ref.php";
function readf($name="session/1"){
	$file=fopen($name, "r");
	$buf=fread($file, 4096);
	fclose($file);
	return json_decode($buf, $assoc=true);
}
function writef($data=array(), $name="session/1"){
	$file=fopen($name, "w");
	$buf=json_encode($data);
	fwrite($file, $buf);
	fclose($file);
	unset($buf);
}
function getNextColor($buttonID, $output="name", $edge=0){
	global $colorsLinks, $buttonsValues;
	if($edge==0){
		$edge=(sizeof($colorsLinks)-1);
	}
	$colorID=$buttonsValues[$buttonID]==$edge?0:$buttonsValues[$buttonID]+1;
	switch ($output) {
		case "name":
			return $colorsLinks[$colorID];
		case "id":
			return $colorID;
		default:
			return 0;
	}
}
function getCurrentLine($buttonID, $rows){
	$a=$buttonID/$rows;
	$b=round($a);
	return $a>$b?$b+1:$b;
}
function getCurrentRow($buttonID, $rows){
	if($rows>=$buttonID){
		return $buttonID;
	}else{
		$currLine=getCurrentLine($buttonID, $rows);
		return $rows-(($rows*$currLine)-$buttonID);
	}
}
function mark($id, $value){
	global $buttonsValues;
	$buttonsValues[$id]=$value;
}
function generateRandomList($rows=5, $lines=5){
	$values=array();
	for($i=1; $i<=($rows*$lines); $i++){
		$values[$i]=rand(0,2);
	}
	return $values;
}
function generateMonoList($rows=5, $lines=5 , $value=0)
{
	$values=array();
	for($i=1; $i<=($rows*$lines); $i++){
		$values[$i]=$value;
	}
	return $values;
}
function generateForPlayList($length=10, $rows=5, $lines=5, $value=0){
	$values=array();
	$maxN=$rows*$lines;
	for($i=0; $i<$length; $i++){
		$values[$i]=rand(1, $maxN);
	}
	return $values;
}
function explodeR($buttonID, $rows, $lines){
	$currRow=getCurrentRow($buttonID, $rows);
	$currLine=getCurrentLine($buttonID, $rows);
	$nColor=getNextColor($buttonID, $output="id");
	mark($buttonID, $nColor);
	if($currRow!=1){
		$nColor=getNextColor($buttonID-1, $output="id");
		mark($buttonID-1, $nColor);
	}
	if($currRow!=$rows){
		$nColor=getNextColor($buttonID+1, $output="id");
		mark($buttonID+1, $nColor);
	}
	if($currLine!=1){
		$nColor=getNextColor($buttonID-$rows, $output="id");
		mark($buttonID-$rows, $nColor);
	}
	if($currLine!=$lines){
		$nColor=getNextColor($buttonID+$rows, $output="id");
		mark($buttonID+$rows, $nColor);
	}
}

if(@$_GET["empty"]==1 or !is_file("session/1")){writef();}

$buttonsValues=readf();
$lines=7;
$rows=6;
$colorLinkPrefix="colors/";
#$colorsLinks=array("white.jpg", "red.jpg", "green.jpg", "orange.jpg");
$colorsLinks=array("white.jpg", "red.jpg", "green.jpg");
@$id=$_GET["id"]?$_GET["id"]:-1;

if(empty($buttonsValues)){
	#echo "Generating...";
	
	$mode=isset($_GET["mode"])?$_GET["mode"]:1;
	switch($mode){
		case 1:
			$buttonsValues=generateMonoList();
			$n=generateForPlayList();
			foreach($n as $i){
				explodeR($i, $rows, $lines);
			}
			break;
		case 2:
			$buttonsValues=generateRandomList();
			break;
		case 3:
			$buttonsValues=generateMonoList();
			break;
		default:
			die("err gen");
	}	
	writef($data=$buttonsValues);
}else{
	#echo "Opening...";
	$buttonsValues=readf();
}
?>
<html>
<head>
</head>
<body>
<table>
<?php
if($id!=-1){
	#$buttonsValues[$id]=getNextColor($id, $colors=$colorsLinks, $values=$buttonsValues, $output="id");
	echo getCurrentRow($id, $rows);
	explodeR($id, $rows, $lines);
	#generateForPlayList();
	writef($data=$buttonsValues);
}

$e="<table align='center'>";
for($line=1; $line<=$lines; $line++)
{
	$e.="<tr>";
	for($row=1; $row<=$rows; $row++)
	{
		if($line==1){
			$currentId=$row;
		}else{
			$currentId=($line-1)*$rows+$row;
		}
		@$color=$colorsLinks[$buttonsValues[$currentId]];
		$e.='<td><a href="index.php?id=' . $currentId . '">
		<img border="0" alt="' . $color . '" src="' . $colorLinkPrefix . $color .'">
</a></td>';
	}
	$e.="</tr>";
}
$e.="</table>";
echo $e;

?>
</table>
</body>
</html>
