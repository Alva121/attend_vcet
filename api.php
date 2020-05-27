<?php
include "helper.php";
$sid=$_GET['sid'];
$course=$_GET['course'];
echo addAttendance($sid,$course);
?>
