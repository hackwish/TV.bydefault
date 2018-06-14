<?php 

include '../core/db.php';

$sql = "SELECT url FROM tv.canal;";
$result = $conn->query($sql); // or die('Query failed: ' . mysql_error());

 ?>