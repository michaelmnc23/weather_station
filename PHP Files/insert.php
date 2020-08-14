<?php
// connect to database
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
    
// get value from sensor
    $temperature = $_GET["temperature"];
    $humidity = $_GET["humidity"]; 
    $p = $_GET["pressure"];
    $r = $_GET["rain"];
    $node = $_GET["node"];
    date_default_timezone_set('Asia/Jakarta');
    $date = date("Y-m-d");
    $time = date("H:i:s");

// insert data
    $query = "INSERT INTO node_data (node, temperature, humidity, pressure, rain, date, time)
     VALUES ('$node', '$temperature', '$humidity', '$p', '$r', '$date', '$time')";
    $result = mysqli_query($connect,$query);

    echo "Insertion Success!<br>";

// get weather
    $temp = $temperature;
    $hum = $humidity;
    $rain = $r;
    $pressure = $p;
    for ($i = 0; $i < $ct; $i++){
        if ($i + 1 != $node)
        $table = mysqli_query($connect, "SELECT temperature, humidity, pressure, rain FROM node_data WHERE node = $i+1 ORDER BY id DESC LIMIT 1");
        $row = mysqli_fetch_array($table);
        $temp += $row['temperature'];
        $hum += $row['humidity'];
        $rain += $row['rain'];
        $pressure += $row['pressure'];
    }
    $meanTemp = (int) ($temp/$ct);
    $meanHum = (int) ($hum/$ct);
    $meanRain = (int) ($rain/$ct);
    $meanPressure = (int) ($pressure/$ct);

    $resTemp = 0;
    $resHum = 0;
    $resPressure = 0;
    $resRain = 0;

    // 1 = rendah
    // 2 = normal
    // 3 = tinggi

    if ($meanTemp < 24) {
        $resTemp = 1;
    } elseif ( $meanTemp > 30) {
        $resTemp = 3;
    } else {
        $resTemp = 2;
    }

    if ($meanHum < 80) {
        $resHum = 1;
    } elseif ($meanHum > 90) {
        $resHum = 3;
    } else {
        $resHum = 2;
    }

    if ($meanPressure < 1012) {
        $resPressure = 1;
    } elseif ($meanPressure > 1014) {
        $resPressure = 3;
    } else {
        $resPressure = 2;
    }

    if ($meanRain < 20) {
        $resRain = 1;
    } elseif ($meanRain > 500) {
        $resRain = 3;
    } else {
        $resRain = 2;
    }

    $weather = "";

    switch($resTemp) {
    // ==============================================================================================
        case 1:
            switch($resHum) {
                case 1:
                    switch($resPressure) {
                        case 1:
                            switch($resRain) {
                                case 1:
                                    $weather = "Mendung";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan Lebat";
                                    break;
                            }
                            break;
                        case 2:
                            switch($resRain) {
                                case 1:
                                    $weather = "Mendung";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                        case 3:
                            switch($resRain) {
                                case 1:
                                    $weather = "Berawan";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                    }
                    break;
                case 2:
                    switch($resPressure) {
                        case 1:
                            switch($resRain) {
                                case 1:
                                    $weather = "Mendung";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                        case 2:
                            switch($resRain) {
                                case 1:
                                    $weather = "Berawan";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                        case 3:
                            switch($resRain) {
                                case 1:
                                    $weather = "Berawan";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                    }
                    break;
                case 3 :
                    switch($resPressure) {
                        case 1:
                            switch($resRain) {
                                case 1:
                                    $weather = "Berawan";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                        case 2:
                            switch($resRain) {
                                case 1:
                                    $weather = "Berawan";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                        case 3:
                            switch($resRain) {
                                case 1:
                                    $weather = "Berawan";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                    }
                    break;	
            }
            break;
    // ==============================================================================================
        case 2:
            switch($resHum) {
                case 1:
                    switch($resPressure) {
                        case 1:
                            switch($resRain) {
                                case 1:
                                    $weather = "Mendung";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                        case 2:
                            switch($resRain) {
                                case 1:
                                    $weather = "Mendung";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                        case 3:
                            switch($resRain) {
                                case 1:
                                    $weather = "Berawan";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                    }
                    break;
                case 2:
                    switch($resPressure) {
                        case 1:
                            switch($resRain) {
                                case 1:
                                    $weather = "Mendung";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                        case 2:
                            switch($resRain) {
                                case 1:
                                    $weather = "Berawan";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                        case 3:
                            switch($resRain) {
                                case 1:
                                    $weather = "Panas";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                    }
                    break;
                case 3 :
                    switch($resPressure) {
                        case 1:
                            switch($resRain) {
                                case 1:
                                    $weather = "Berawan";
                                case 2:
                                    $weather = "Gerimis";
                                case 3:
                                    $weather = "Hujan";
                            }
                            break;
                        case 2:
                            switch($resRain) {
                                case 1:
                                    $weather = "Cerah/Panas";
                                case 2:
                                    $weather = "Gerimis";
                                case 3:
                                    $weather = "Hujan";
                            }
                            break;
                        case 3:
                            switch($resRain) {
                                case 1:
                                    $weather = "Cerah/Panas";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                    }
                    break;
            }
            break;
    // ==============================================================================================
        case 3:
            switch($resHum) {
                case 1:
                    switch($resPressure) {
                        case 1:
                            switch($resRain) {
                                case 1:
                                    $weather = "Mendung";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                        case 2:
                            switch($resRain) {
                                case 1:
                                    $weather = "Mendung";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                        case 3:
                            switch($resRain) {
                                case 1:
                                    $weather = "Berawan";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                    }
                    break;
                case 2:
                    switch($resPressure) {
                        case 1:
                            switch($resRain) {
                                case 1:
                                    $weather = "Berawan";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                        case 2:
                            switch($resRain) {
                                case 1:
                                    $weather = "Cerah/Panas";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                        case 3:
                            switch($resRain) {
                                case 1:
                                    $weather = "Cerah/Panas";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                    }
                    break;
                case 3 :
                    switch($resPressure) {
                        case 1:
                            switch($resRain) {
                                case 1:
                                    $weather = "Berawan";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                        case 2:
                            switch($resRain) {
                                case 1:
                                    $weather = "Cerah/Panas";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                        case 3:
                            switch($resRain) {
                                case 1:
                                    $weather = "Panas Terik";
                                    break;
                                case 2:
                                    $weather = "Gerimis";
                                    break;
                                case 3:
                                    $weather = "Hujan";
                                    break;
                            }
                            break;
                    }
                    break;
            }
            break;
    }
    $query = "SELECT COUNT(id) FROM weather_history WHERE date = '$date' ORDER BY id DESC LIMIT 1";

    $result = mysqli_query($connect,$query);
    $row = mysqli_fetch_array($result);

    var_dump($row[0]);
    if($row[0] > 0) {
        $query = "SELECT COUNT(id) FROM weather_history WHERE date = '$date' AND weather = '$weather' ORDER BY id DESC LIMIT 1";
        
        $result = mysqli_query($connect,$query);
        $cek = mysqli_fetch_array($result);

        if($cek[0] == 0) {
            $query = "INSERT INTO weather_history (weather, temp, humidity, pressure, rain, date, time)
            VALUES ('$weather', '$meanTemp', '$meanHum', '$meanPressure', '$meanRain', '$date', '$time')";
            $result = mysqli_query($connect,$query);
            console_log("Success Insert New Weather! on if");
        } else {
            console_log("Weather is already exist!");
        }
    } else {
        $query = "INSERT INTO weather_history (weather, temp, humidity, pressure, rain, date, time)
        VALUES ('$weather', '$meanTemp', '$meanHum', '$meanPressure', '$meanRain', '$date', '$time')";
        $result = mysqli_query($connect,$query);
        console_log("Success Insert New Weather! on else");
    }

// close connection
    $connect->close();