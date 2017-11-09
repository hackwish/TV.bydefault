<?php 

include 'db.php';

$sql = "SELECT url FROM canales.canal where activo=1 and radio='FALSE' and url like 'http%' and idgrupo <= 1140 ORDER BY RAND() LIMIT 1;";
$result = $conn->query($sql); // or die('Query failed: ' . mysql_error());

 ?>