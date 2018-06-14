<?php 

include '../config/core/db.php';

$sql = "SELECT 
    c.idgrupo, g.descgrupo, c.nomcanal, c.logocanal, c.radio, c.url
FROM
    tv.canal c
INNER JOIN tv.grupo g
ON c.idgrupo=g.idgrupo
WHERE
    c.activo = '1'
ORDER BY c.idgrupo , c.idcanal , c.nomcanal DESC;";
$result = $conn->query($sql); // or die('Query failed: ' . mysql_error());

 ?>