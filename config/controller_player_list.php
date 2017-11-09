<?php 

include 'db.php';

$sql = "SELECT nomcanal,url FROM canales.canal;";
$result = $conn->query($sql); // or die('Query failed: ' . mysql_error());

 ?>