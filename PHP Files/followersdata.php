<?php
//setting header to json
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Authorization, Content-Type');
header('Access-Control-Allow-Origin: *');
header('content-type: application/json; charset=utf-8');

require('connect.php');

//query to get data from the table
$query = sprintf("SELECT * FROM (SELECT id, temp, humidity, pressure, rain, date, time FROM weather_history ORDER BY id DESC LIMIT 10) AS t1 ORDER BY t1.id ASC");

//execute query
$result = $connect->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$connect->close();

//now print the data
print json_encode($data);