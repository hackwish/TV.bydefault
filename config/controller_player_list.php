<?php 

include 'db.php';

$sql = "SELECT nomcanal,url FROM tv.canal;";
$result = $conn->query($sql); // or die('Query failed: ' . mysql_error());

 ?>