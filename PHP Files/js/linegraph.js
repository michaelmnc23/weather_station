$(document).ready(function(){
	
	// ==============temperature================
	$.ajax({
		url : "http://localhost/followersdata.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var date = [];
			var temperature = [];

			for(var i in data) {
				date.push(data[i].date);
				temperature.push(data[i].temp);
			}

			var chartdata = {
				labels: date,
				datasets: [
					{
						label: "Temperature",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(59, 89, 152, 0.75)",
						borderColor: "rgba(59, 89, 152, 1)",
						pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
						pointHoverBorderColor: "rgba(59, 89, 152, 1)",
						data: temperature
					}
				]
			};

			var ctx = $("#temp");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
				options: {
					scales: {
						yAxes:[{
							ticks: {
								suggestedMin: 20,
								suggestedMax: 35,
								stepSize: 2
							}
						}]
					}
				}
			});
		},
		error : function(data) {

		}
	});

	// ==============humidity================
	$.ajax({
		url : "http://localhost/followersdata.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var date = [];
			var humidity = [];

			for(var i in data) {
				date.push(data[i].date);
				humidity.push(data[i].humidity);
			}

			var chartdata = {
				labels: date,
				datasets: [
					{
						label: "Humidity",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(59, 89, 152, 0.75)",
						borderColor: "rgba(59, 89, 152, 1)",
						pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
						pointHoverBorderColor: "rgba(59, 89, 152, 1)",
						data: humidity
					}
				]
			};

			var ctx = $("#hum");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
				options: {
					scales: {
						yAxes:[{
							ticks: {
								suggestedMin: 70,
								suggestedMax: 90,
								stepSize: 2
							}
						}]
					}
				}
			});
		},
		error : function(data) {

		}
	});

	// ==============pressure================
	$.ajax({
		url : "http://localhost/followersdata.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var date = [];
			var pressure = [];

			for(var i in data) {
				date.push(data[i].date);
				pressure.push(data[i].pressure);
			}

			var chartdata = {
				labels: date,
				datasets: [
					{
						label: "Pressure",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(59, 89, 152, 0.75)",
						borderColor: "rgba(59, 89, 152, 1)",
						pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
						pointHoverBorderColor: "rgba(59, 89, 152, 1)",
						data: pressure
					}
				]
			};

			var ctx = $("#pressure");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
				options: {
					scales: {
						yAxes:[{
							ticks: {
								suggestedMin: 900,
								suggestedMax: 1015,
								stepSize: 20
							}
						}]
					}
				}
			});
		},
		error : function(data) {

		}
	});

	// ==============rain================
	$.ajax({
		url : "http://localhost/followersdata.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var date = [];
			var rain = [];

			for(var i in data) {
				date.push(data[i].date);
				rain.push(data[i].rain);
			}

			var chartdata = {
				labels: date,
				datasets: [
					{
						label: "Rain",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(59, 89, 152, 0.75)",
						borderColor: "rgba(59, 89, 152, 1)",
						pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
						pointHoverBorderColor: "rgba(59, 89, 152, 1)",
						data: rain
					}
				]
			};

			var ctx = $("#rain");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
				options: {
					scales: {
						yAxes:[{
							ticks: {
								suggestedMin: 0,
								suggestedMax: 1025,
								stepSize: 100
							}
						}]
					}
				}
			});
		},
		error : function(data) {

		}
	});
});