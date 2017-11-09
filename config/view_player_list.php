<?php 
include 'controller_player_list.php';

$canal = $_POST['canal'];

echo "
<div class='container contenedor'>
	<div class='row'>
		<div class='col-md-8 reproductor'>
				<div style='width: 100%; height: 480px;'>
					<!-- player container-->
					<a style='width: 100%; height: 480px;' id='player'></a>
						<!-- Flowplayer installation and configuration -->
						<script type='text/javascript'>
							flowplayer('player', '../player/flowplayer/flowplayer.swf', {
							// configure the required plugins
							wmode: 'direct',
							plugins: {
							httpstreaming: {
							url: '../player/bin/release/flashlsFlowPlayer.swf',
							hls_debug : false,
							hls_debug2 : false,
							hls_lowbufferlength : 3,
							hls_minbufferlength : -1,
							hls_maxbufferlength : 300,
							hls_startfromlevel : -1,
							hls_seekfromlevel : -1,
							hls_live_flushurlcache : false,
							hls_seekmode : 'ACCURATE',
							hls_fragmentloadmaxretry : -1,
							hls_manifestloadmaxretry : -1,
							hls_capleveltostage : false,
							hls_maxlevelcappingmode : 'downscale'
							}
							},
							clip: {
							accelerated: true,
							url: '" . $canal. "',
							ipadUrl: '" . $canal. "',
							urlResolvers: 'httpstreaming',
							lang: 'en',
							provider: 'httpstreaming',
							autoPlay: true,
							autoBuffering: true
							},
							log: {
							level: 'debug',
							filter: 'org.flowplayer.controller.*'
							}
							}).ipad();
						</script>
				</div>";

echo "	
		</div>	
		<div class='col-md-4 lista'>


			<form class='' name='form' method='post' action='' >
				<div class='form-group' >
					<select multiple  size='13' class='form-control form-canales' id='canales' name='canal'>";

				    while($row = $result->fetch_assoc()) {
				        echo "<option value='" . $row['url']. "'>" . $row['nomcanal']. "</option>";
				    };

echo "
					</select>
				</div>
				<input type='submit' value='Cambiar' name='submit' />
			</form>

		</div>
  		</div>
 		<div class='row'>
			<div class='col-md-12 descripcion'>
				ESTAS VIENDO:" . $row['nomcanal']. "			</div>
  		</div>
  	</div>

	";

$conn->close();

 ?>

