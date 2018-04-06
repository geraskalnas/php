<?php
session_start();
require "ref/ref.php";
r($_SESSION);
session_unset();
r($_SESSION);
?>