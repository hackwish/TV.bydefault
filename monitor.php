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
    c.idgrupo, g.descgrupo, c.nomcanal, c.url
FROM
    canales.canal c
INNER JOIN canales.grupo g
ON c.idgrupo=g.idgrupo
WHERE
    c.activo = '1'  and c.idgrupo in(10,11,12,13)
ORDER BY c.idgrupo , c.idcanal , c.nomcanal DESC;";
$result = $conn->query($sql); // or die('Query failed: ' . mysql_error());

    while($row = $result->fetch_assoc()) {
        echo "- labels:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;job: iptv <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;module: http_2xx <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;host: " . $row['nomcanal']. "<br>&nbsp;&nbsp;targets: <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;" . $row['url']. "<br><br>";
//        echo "#EXTINF:0, radio='" . $row['radio']. "' group-title='" . $row['descgrupo']. "' tvg-logo='" . $row['logocanal']. "', " . $row['nomcanal']. "<br>" . $row['url']. "<br>";
//      $lista ="#EXTINF:0, group-title='" . $row['grupocanal']. "', " . $row['nomcanal']. "<br>" . $row['url']. "<br>";

// fwrite($fo, $playlist);
// fclose($fo);
        }

$conn->close();
?>
