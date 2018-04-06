<?php
//session_start();
$err=array();
if(!isset($_GET["action"]))
{
	$err[] = "Please enter action!";
	#after it save data
	exit();
}
include("defaults.php");
?>
<html>
<style>
</style>
<body>
<?php
switch ($_GET["action"])
{
	case "createSession":
		$sessionId=isset($_GET["sessionId"])?($_GET["sessionId"]):rand();
		while(file_exists($sessionId)){
			$sessionId=rand();
		}
		
		$items=array(1=>array("name"=>$defaults["name"], "autoValue"=>$defaults["autoValue"], "lastValue"=>$defaults["lastValue"]));
		serializeOpenVar("w", $sessionId, $items);
		unset($items);

		openUrl("admin.php?action=viewRule&item=0&sessionId=" . $sessionId);
		break;
	case "viewRule":
		print("<p>");
		if(!(isset($_GET["sessionId"]) xor isset($_GET["machineId"]))) {
			print("<script>openUrl('admin.php?action=createSession')</script>");
		}elseif(isset($_GET["sessionId"])) {$sessionId=$_GET["sessionId"];}
		elseif(isset($_GET["machineId"])) {
			if(false) {#test is it not already used
				print("<script>openUrl('admin.php?action=createSession')</script>");
			}
			$sessionId=$_GET["machineId"];
		}
		
		$items=serializeOpenVar("r", $sessionId);
		
		$edit=isset($_GET["edit"])?$_GET['edit']:$defaults["edit"];
		
		if($_GET["item"]==0){
			$i=0;
			$executable="<table border='1'><tr><td>name</td>";
			foreach($items as $item){
				$executablePlus=$edit==1?"<a href='admin.php?action=editRule&id=".++$i."&what=name&redirectTo=admin.php?action=viewRule&sessionId=".$sessionId."&item=-1&edit=".$edit."'><b>edit</b></a>":"";
				$executable.="<td>".$item["name"]."</br>".$executablePlus."</td>";
			}
			$i=0;
			$executable.="</tr><tr><td>Auto value</td>";
			foreach($items as $item){
				$executablePlus=$edit==1?"<a href='admin.php?action=editRule&id=".++$i."&what=autoValue&redirectTo=admin.php?action=viewRule&sessionId=".$sessionId."\"&item=-1&edit=".$edit."'><b>edit</b></a>":"";				
				$executable.="<td>".$item["autoValue"]."</br>".$executablePlus."</td>";
			}
			$i=0;
			$executable.="</tr><tr><td>Last value</td>";
			foreach($items as $item){
				#$executablePlus=$edit==1?"<a href='admin.php?action=editRule&id=".++$i."&what=value&redirectTo=admin.php?action=viewRule&sessionId=".$sessionId."&item=-1&edit=".$edit."'><b>edit</b></a>":"";
				$executablePlus="";				
				$executable.="<td>".$item["lastValue"]."</br>".$executablePlus."</td>";
			}
			$executable.="</tr></table>";
			print($executable);
			
		}else{
			$executable="<table border='1'><tr><td>name</td>";
			$executablePlus=$edit==1?"<a href='admin.php?action=editRule&id=".$_GET["item"]."&what=name&redirectTo=admin.php?action=viewRule&sessionId=".$sessionId."&item=".$_GET["item"]."&edit=".$edit."'><b>edit</b></a>":"";
			$executable.="<td>".$items[$_GET["item"]]["name"]."</br>".$executablePlus."</td>";
			
			$executable.="</tr><tr><td>auto value</td>";
			$executablePlus=$edit==1?"<a href='admin.php?action=editRule&id=".$_GET["item"]."&what=autoValue&redirectTo=admin.php?action=viewRule&sessionId=".$sessionId."\"&item=".$_GET["item"]."&edit=".$edit."'><b>edit</b></a>":"";
			$executable.="<td>".$items[$_GET["item"]]["autoValue"]."</br>".$executablePlus."</td>";
			
			$executable.="</tr><tr><td>value</td>";
			#$executablePlus=$edit==1?"<a href='admin.php?action=editRule&id=".$_GET["item"]."&what=value&redirectTo=admin.php?action=viewRule&sessionId=".$sessionId."&item=".$_GET["item"]."&edit=".$edit."'><b>edit</b></a>":"";
			$executablePlus="";			
			$executable.="<td>".$items[$_GET["item"]]["lastValue"]."</br>".$executablePlus."</td>";			
			
			$executable.="</tr></table>";
			print($executable);
		}
		echo "<a href='admin.php?action=addRule&sessionId=".$sessionId."'>Add new rule</a>";
		print("</p>");
		break;
	case "addRule":
		#print("<p>");
		if(!(isset($_GET["sessionId"]) xor isset($_GET["machineId"]))) {
			print("<script>openUrl('admin.php?action=createSession')</script>");
		}elseif(isset($_GET["sessionId"])) {$sessionId=$_GET["sessionId"];}
		elseif(isset($_GET["machineId"])) {
			if(false) {#test is it not already used
				print("<script>openUrl('admin.php?action=createSession')</script>");
			}
			$sessionId=$_GET["machineId"];
		}
		$items=serializeOpenVar("r", $sessionId);
		$id=isset($_GET["id"])?$_GET["id"]:sizeof($items)+1;
		$name=isset($_GET["name"])?$_GET["name"]:rand();
		$autoValue=isset($_GET["autoValue"])?$_GET["autoValue"]:$defaults["autoValue"];
		$gui=isset($_GET["gui"])?$_GET["gui"]:$defaults["gui"];
		if($gui==1) {
			echo "<form action='admin.php' method='get'>";
					echo "<input type='hidden' name='action' value='addRule'>";
					echo "<input type='hidden' name='sessionId' value='". $sessionId ."'>";
					echo "<input type='hidden' name='gui' value='0'>";
					echo "<input type='hidden' name='redirectTo' value='admin.php?action=viewRule&sessionId=". $sessionId ."&id=0'>";
				echo "<p>Id on array(must be >0):";
					echo "<input type='text' name='id' value='". $id ."'>";
				echo "</p><p>Name: ";					
					echo "<input type='text' name='name' value='". $name ."'>";
				echo "</br></p><p>Auto value: ";					
					echo "<input type='text' name='autoValue' value='". $autoValue ."'>";
				echo "</br></p><p>";
					echo "<input type='submit' name='submit' value='submit'>";
				echo "</br></p>";
			echo "</form>";
		}else {
			if($_GET["id"]!=0) {
				
			}else if($_GET['id']==0){
				$id=sizeof($items+1);
			}
			$items[$id]=array();
			$items[$id]["name"]=$_GET["name"];
			$items[$id]["autoValue"]=$_GET["autoValue"];
			$items[$id]["lastValue"]="";
		}
		
		break;
	case "removeRule":
	case "deleteRule":
	if(!(isset($_GET["sessionId"]) xor isset($_GET["machineId"]))) {
			print("<script>openUrl('admin.php?action=createSession')</script>");
		}elseif(isset($_GET["sessionId"])) {$sessionId=$_GET["sessionId"];}
		elseif(isset($_GET["machineId"])) {
			if(false) {#test is it not already used
				print("<script>openUrl('admin.php?action=createSession')</script>");
			}
			$sessionId=$_GET["machineId"];
		}
		if(!isset($_GET["id"])){
			print("fail");
		}
		$items=serializeOpenVar("r", $sessionId);
		var_dump($items);
			
}
if(isset($_GET["redirectTo"])) openUrl($_GET["redirectTo"]);
?>
</body></html>
