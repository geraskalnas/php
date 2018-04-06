<?php
session_start();
if(@$_GET["a"]){!$_SESSION["v"]=$_GET["a"];}
echo $_SESSION["v"];
?>