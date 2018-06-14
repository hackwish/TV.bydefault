<?php 
include 'controller_monitor.php';

    while($row = $result->fetch_assoc()) {
		$url = $row['url'];
//		print_r(get_headers($url, 1));

		file_get_contents($url);
		//and check by echoing
		echo " " . $url."\r\n" . $http_response_header[0]. "\r\n";
		echo "\r\n";
	};

$conn->close();
 ?>