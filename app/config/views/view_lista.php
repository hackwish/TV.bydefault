<?php 
include '../config/controllers/controller_lista.php';

// Cabecera Playlist
echo "#EXTM3U \r\n";

//CONTENIDO CANAL
    while($row = $result->fetch_assoc()) {
        echo "#EXTINF:0, radio=\"" . $row['radio']. "\" group-title=\"" . $row['descgrupo']. "\" tvg-logo=\"" . $row['logocanal']. "\", " . $row['nomcanal']. "\r\n" . $row['url']. "\r\n";
        }

$conn->close();
 ?>