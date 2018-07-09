<?php
/*$output='{"content": "Nothing that can interest you","buttons": [{"name": "fdhhdfd", "id": "1", "action": "report", "data": "yt"}, {"name": "fdgs", "id":"2", "action": "alert", "data": "dsf"}]}';

if(isset($_GET["button"]) and $_GET["button"]==1){$output='{"content": "Changed", "buttons":[]}';}

echo $output;*/

$data = new stdClass();

include "functions.php";
include "php-ref/ref.php";

//r($_GET);

$d = loadContents();
//r($d);
$way = isset($_GET["way"]) && $_GET["way"]!=""?(array)$_GET["way"]:[];
//if(is_array($way)){$way=array($way);}
//r($way);
$selectedID = selectID($way, sizeof($d)-1);
//r($selectedID);
$way[sizeof($way)] = $selectedID;
//r($way);

$data->content = $d[$selectedID];
$data->buttons = array(array("name" => "next", "id" => $selectedID, "action" => "report"));
$data->way = json_encode($way);

//r($data);
$output = json_encode($data);
echo $output;
?>
