<html>
<?php
require './php-ref/ref.php';
?>
<head>
	<title id='title'>youtubeC</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<script src='js/openUrl.js'></script>

<?php
function openUrl($url)
{
	echo "<a href='$url'>$url</a>";
	print("<script>openUrl('". $url ."')</script>");
	die();
}
function openStructureFile() {
	$fileName="data/structures/artists";
	$fo=fopen($fileName, "r") or die("fail");
	$buf=stream_get_contents($fo);
	#while(!feof($fo)) $buf=fread($fo,4096);
	$index=json_decode($buf, $assoc=true);
	unset($buf);
	fclose($fo);
	return $index;
}
function openElementsFile($fileName){
	$elementDir="data/elements/artists";
	$filePath=$elementDir."/".$fileName;
	$fo=fopen($filePath, "r") or die("fail");
	$buf=stream_get_contents($fo);
	$items=array();
	$items[$fileName]=json_decode($buf, $assoc=true);
	unset($buf);
	fclose($fo);
	return $items;
}

function tableGenerator($arr, $method=0){
	$code="<table>";
	if($method==0){
		foreach($arr as $item){
			$key=key($arr);
			$code.="<tr><td>$key</td>";
			foreach($item as $item2){
				$code.="<td>$item2</td>";
			}
			$code.="</tr>";
			next($arr);
		}
	}else{
		$i=-1;
		while($i<=count($arr)){
			$code.="<tr>";
			if($i==-1){
				foreach($arr as $item){
					$key=key($arr);
					$code.="<td>$key</td>";
					next($arr);
				}
			}else{
				foreach($arr as $item){
					$code.="<td>$item[$i]</td>";
				}
			}
			$i++;
		}
		$code.="</tr>";
	}
	$code.="</table>";
	return $code;
}
$action=!empty($_GET["action"])?$_GET["action"]:"inicialize";

switch($action) {
	case "inicialize":
	//$index=openIndexFile();	
	foreach(scandir("data/elements/artists") as $i){
		//$key=key($index);
		//r($index);
		//r($i);
		//r($key);
		//if($key!="structure"){
		//r($i);
		//if($i!="asd"){
			echo $i[sizeof($i)];
			if($i[-1]!='~'){
				$href="index.php?action=selectE&element=" . $i;
				echo "<a href=$href>" . $i . "</a></br>";
			}
		//}
		//next($index);
	}
	break;
#----------------------------------------------------------------------------
	case "selectE":
	if(empty($_GET["element"])){openurl(!empty($_GET["r"])?$_GET["r"]:"index.php?action=inicialize");}
	$element=$_GET["element"];
	$items=openElementsFile($element);
	
	//r($items);
	switch(isset($_GET["method"])?$_GET["method"]:"2"){
	case 0:
	case 1:
		//r($items["a2"]);
		tableConvertor($items["a2"]);
		break;
	case 2:
		$id=-1;
		foreach($items[$element] as $item){
			$id++;
			echo "<p>";
			foreach($item as $item2){
				//r(key($item));
				if(key($item)[0]=="#"){
					//if(key($item)=="#id"){$id=$item2;}
				}
				else{
					echo key($item).": <textarea cols='50' rows='0'>".$item2."</textarea></br>";
				}
				next($item);
			}
			echo "Separator: <textarea cols='50' rows='5'>".$item["#separator"]."</textarea></br>";
			
			$href="index.php?action=editE&element=" . $element . "&id=" . $id;
			echo "<p><a href='$href'>Edit</a></br>";
			
			$href="index.php?action=dropE&element=" . $element . "&id=" . $id;
			echo "<a href='$href'>Drop</a></p>";
			
			echo "-----------------------------------------------------------------------------------------------------------------------------------";
		}
		break;
	}
	$href="index.php?action=createE&element=" . $element;
	echo "</br><a href='$href'>Create</a>";
	break;
#-------------------------------------------------------------------------------
	case "editE":
	if(!isset($_GET["element"])){openurl(isset($_GET["r"])?$_GET["r"]:"index.php?action=inicialize");}
	if(!isset($_GET["id"])){openurl(isset($_GET["r"])?$_GET["r"]:"index.php?action=inicialize");}
	$element=$_GET["element"];
	$id=$_GET["id"];
	$items=openElementsFile($element);
	
	#reset($items["a2"][0]);
	echo "<form action=index.php method=get>";
	echo "<input type='hidden' name='redirectTo' value='index.php?action=inicialize'>";
	echo "<input type='hidden' name='element' value='" . $element . "'>";
	echo "<input type='hidden' name='id' value='" . $_GET["id"] . "'>";
	#tableConvertor($items["a2"]["0"]);
	foreach($items[$element][$id] as $item){
		$key=key($items[$element][$id]);
		if($key[0]=="#"){continue;}
		echo $key . ": <textarea name='$key' cols='50' rows='0'>".$item."</textarea></br>";
		next($items[$element][$id]);
	}
		##echo "Separator: <textarea cols='50' rows='5'>".$item["sep"]."</textarea></br>";
		echo "Separator: <textarea name='#separator' cols='50' rows='5'>".$items[$element][$id]["#separator"]."</textarea></br>";
		echo '<input type="submit" name="action" value="commit">';
	echo "</form>";
	break;
#----------------------------------------------------------------------------
	case "commit":
	if(!isset($_GET["element"])){openurl(isset($_GET["r"])?$_GET["r"]:"index.php?action=inicialize");}
	if(!isset($_GET["id"])){openurl(isset($_GET["r"])?$_GET["r"]:"index.php?action=inicialize");}
	$element=$_GET["element"];
	$items=openElementsFile($element);
	
	foreach(array_keys($items[$element][$_GET["id"]]) as $key){
		$items[$element][$_GET["id"]][$key]=$_GET[$key];
	}
	
	$fo=fopen("data/elements/artists/".$_GET["element"], "w") or die("fail");
	$buf=json_encode($items[$element]);
	fwrite($fo, $buf);
	unset($buf);
	fclose($fo);
	
	if(!isset($_GET["redirectTo"])){openurl(isset($_GET["r"])?$_GET["r"]:"index.php?action=inicialize");}
	break;
#----------------------------------------------------------------------------
	case "createE":
	//r($_GET);
	if(!isset($_GET["element"])){openurl(isset($_GET["r"])?$_GET["r"]:"index.php?action=inicialize");}
	$element=$_GET["element"];
	$items=openElementsFile($element);
	$structure=openStructureFile();
	
	//$id=isset($_GET["id"])?$_GET["id"]:$items[$element][sizeof($items[$element])-1]+1;
	$id=isset($_GET["id"])?$_GET["id"]:sizeof($items[$element]);
	$items[$element][$id]=array();
	#foreach(array_keys($items[$element][0]) as $key){
	foreach($structure as $key){
		$items[$element][$id][$key]=0;
	}
	$items[$element][$id]["#separator"]=0;
	//$items[$element][$id]["#id"]=$id;
	r($items);
	#foreach(array_keys($items[$element][0]) as $key){
	
	$fo=fopen("data/elements/artists/".$element, "w") or die("fail");
	$buf=json_encode($items[$element]);
	fwrite($fo, $buf);
	unset($buf);
	fclose($fo);
	
	//openUrl("index.php?action=editE&id=$id&element=".$element);
	if(!isset($_GET["redirectTo"])){openurl(isset($_GET["r"])?$_GET["r"]:"index.php?action=inicialize");}
	break;
#----------------------------------------------------------------------------
	case "dropE":
	//if(!isset($_GET["element"]) or !isset($_GET["id"])){openurl(isset($_GET["r"])?$_GET["r"]:"index.php?action=selectE&element=". $_GET["element"]);}
	if(!isset($_GET["element"])){openurl(isset($_GET["r"])?$_GET["r"]:"index.php?action=inicialize");}
	if(!isset($_GET["id"])){openurl(isset($_GET["r"])?$_GET["r"]:"index.php?action=inicialize");}
	$element=$_GET["element"];
	$items=openElementsFile($element);
	
	$element=$_GET["element"];
	$id=isset($_GET["id"])?$_GET["id"]:sizeof($items[$element]);
	
	r($items);
	//if($id!=sizeof($items)-1) {
	//	echo "expection".$id;
	//	for ($i=$id+1; $i!=sizeof($items); $i++){
	//		echo $i;
	//		$items[$element][$i-1]=$items[$element][$i];
	//		
	//	}
	//}
	unset($items[$element][$id]);
	
	$fo=fopen("data/elements/artists/".$element, "w") or die("fail");
	$buf=json_encode($items[$element]);
	fwrite($fo, $buf);
	unset($buf);
	fclose($fo);
	
	//openUrl("index.php?action=selectE&element=".$element);
	if(!isset($_GET["redirectTo"])){openurl(isset($_GET["r"])?$_GET["r"]:"index.php?action=inicialize");}
	break;
#----------------------------------------------------------------------------
	default:
	r($GLOBALS);
}

if(isset($_GET["redirectTo"])){
	openUrl($_GET["redirectTo"]);
}
?>
</body>
</html>
