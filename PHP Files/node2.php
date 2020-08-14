<?php
	require('connect.php');
	
	function console_log($output, $with_script_tags = true) {
		$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
		if ($with_script_tags) {
			$js_code = '<script>' . $js_code . '</script>';
		}
		echo $js_code;
	}
	
	$ct = mysqli_query($connect, "SELECT COUNT(node) FROM (SELECT DISTINCT node from node_data) AS t1");
	$ct = mysqli_fetch_array($ct);
	$ct = (int) $ct[0];
	$location = "Kost Bukit Sari 3";
	$link = "https://www.google.com/maps/place/Jl.+Bukit+Sari+No.3,+Hegarmanah,+Kec.+Cidadap,+Kota+Bandung,+Jawa+Barat+40141/@-6.8797061,107.6009397,17z/data=!3m1!4b1!4m5!3m4!1s0x2e68e6f3d28cace7:0x5e42ffadf5f1097d!8m2!3d-6.8797061!4d107.6031284";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

		<style>
			.weather{
				height: 150px;
				width: 100%;
			}
			.div-weather{
				width: 15%;
				margin-right: auto;
				margin-left: auto;
			}
			
			a{
				font-size: 20px;
			}
			
			.navbar-brand {
				font-size: 25px;
			}
			
			.card {
				box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
				transition: 0.3s;
				background-color: white;
				width: 50%;
				height: 100%;
				border-radius: 25px;
				margin-right: auto;
				margin-left: auto;
			}
			.card:hover {
				box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2);
			}
			

			table {
				border-collapse: collapse;
				width: 100%;
				color: black;
				font-family: monospace;
				font-size: 20px;
				text-align: center;
			}

			th {
				border-radius: 25px;
				background-color: lightblue;
				text-align: center;
				padding: 5px;
			}
			
			td {
				height: 40px;
			}
			.tabel {
				margin-bottom: 25px;
			}
		</style>
	</head>
	<body class="bg-info">
		<div class="div-weather">
			<img src="img/station.png" class="weather"/>
		</div>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
				<a class="navbar-brand" href="index.php"><b>Weather Station</b></a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="index.php">Home</a></li>
					<li class="active" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Node <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<?php
								for ($i = 0; $i < $ct; $i++){
                                    $j = strval($i+1);
                                    if($j == 2) {
									    echo "<li class='active'><a href='node" . $j . ".php'>Node". $j . "</a></li>";
                                    } else {
                                        echo "<li><a href='node" . $j . ".php'>Node". $j . "</a></li>";
                                    }
								}
							?>
						</ul>
					</li>
					<li><a href="history.php">History</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href=<?=$link?>><span class="fa fa-map-marker"></span> <?=$location?></a></li>
				</ul>
			</div>
        </nav>

		<div class="container">
            <?php
                $table = mysqli_query($connect, "SELECT temperature, humidity, pressure, rain, date, time FROM node_data WHERE node = 2 ORDER BY id DESC LIMIT 1");
                $row = mysqli_fetch_array($table);
                echo "<h1>Data at Node 2</h1>";
				echo "<div class='card atas'><table class='tabel'><tr><th><h3>Date/Time</h3></th></tr><tr><td>" . $row['date'] . " / " . $row['time'] . "</td></tr></table></div>";
				echo "<div class='col-sm-6'><table class='tabel card'><tr><th><h3>Temperature</h3></th></tr><tr><td>" . $row['temperature'] . " &#8451;</td></tr></table></div>";
				echo "<div class='col-sm-6'><table class='tabel card'><tr><th><h3>Humidity</h3></th></tr><tr><td>" . $row['humidity'] . " %</td></tr></table></div>";
				echo "<div class='col-sm-6'><table class='tabel card'><tr><th><h3>Pressure</h3></th></tr><tr><td>" . $row['pressure'] . " mBar</td></tr></table></div>";
				echo "<div class='col-sm-6'><table class='tabel card'><tr><th><h3>Rain</h3></th></tr><tr><td>" . $row['rain'] . "</td></tr></table></div>";
            ?>
		</div>
    </body>
</html>
<?php
    $connect->close();
?>