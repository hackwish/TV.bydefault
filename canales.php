<?php
$servername = "localhost";
$username = "root";
$password = "korpkorp";
$dbname = "canales";

$playlist = "canales_test.m3u";
// $fo = fopen($playlist, 'w') or die("can't open file");

// Cabecera Playlist
echo "#EXTM3U <br>";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT g.descgrupo,c.nomcanal,c.logocanal,c.radio,c.url 
		FROM canal c
		inner join grupo g
		on c.idgrupo = g.idgrupo
		WHERE activo = '1' ORDER BY g.idgrupo,c.nomcanal,c.idcanal ASC";
$result = $conn->query($sql); // or die('Query failed: ' . mysql_error());

    while($row = $result->fetch_assoc()) {
        echo "#EXTINF:-1, radio='" . $row['radio']. "' group-title='" . $row['grupocanal']. "' tvg-logo='" . $row['logocanal']. "', " . $row['nomcanal']. "<br>" . $row['url']. "<br>";
//      $lista ="#EXTINF:0, group-title='" . $row['grupocanal']. "', " . $row['nomcanal']. "<br>" . $row['url']. "<br>";

// fwrite($fo, $playlist);
// fclose($fo);
        }

$conn->close();
?>
