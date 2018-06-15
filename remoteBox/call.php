<?php
$output='{"content": "Nothing that can interest you","buttons": [{"name": "fdhhdfd", "id": "1", "action": "report", "data": "yt"}, {"name": "fdgs", "id":"2", "action": "alert", "data": "dsf"}]}';

if(isset($_GET["button"]) and $_GET["button"]==1){$output='{"content": "Changed", "buttons":[]}';}

echo $output;
?>