<?php 
include 'controller_player.php';

    while($row = $result->fetch_assoc()) {
        $canal = $row['url'];
        // echo $canal;
        }

$conn->close();
 ?>