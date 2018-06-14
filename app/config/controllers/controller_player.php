<?php 

include 'config/core/db.php';

$sql = "SELECT url FROM tv.canal where activo=1 and radio='FALSE' and url like 'http%' and idgrupo <= 10 ORDER BY RAND() LIMIT 1;";
$result = $conn->query($sql); // or die('Query failed: ' . mysql_error());

 ?>