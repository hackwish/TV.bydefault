<?php 

$servername = "localhost";
$username = "root";
$password = "korpkorp";
$dbname = "canales";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
    c.idgrupo, g.descgrupo, c.nomcanal, c.logocanal, c.radio, c.url
FROM
    canales.canal c
INNER JOIN canales.grupo g
ON c.idgrupo=g.idgrupo
WHERE
    c.activo = '1'
ORDER BY c.idgrupo , c.idcanal , c.nomcanal DESC;";
$result = $conn->query($sql); // or die('Query failed: ' . mysql_error());

 ?>