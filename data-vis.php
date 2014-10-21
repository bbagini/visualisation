<!-- JOHN RAMOS

EDITS SINCE LAST SUBMISSION

*Now use server-side code to acquire data to populate graphs. 
Reads chart data from a local text file when a page is requested under 'data_php'.
No long uses hard-coded data.

**Added scatter graph.

 -->


<?php

	require("brandon/singleUser.php");
	//echo "data: ".$data; echo "<br />";


	//var_dump($firstName, json_encode($firstName));
	
	//echo "test" . $test;
    //require("brandon/singleUser.php");
	
	//echo "firstname " . $firstName;
	
	//$_SESSION['test'] = "hello";
    
	/*if(empty($_SESSION['user'])) 
    {
        header("Location: index.php");
        die("Redirecting to index.php"); 
    }*/
?>

<html>
  <head>
  
  <!-- Bootstrap Core CSS and other frameworks -->
  <meta charset="UTF-8" />
		<title>Data Visualisation</title>
		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" media="all" href="css/daterangepicker-bs3.css" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
		<script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/moment.js"></script>
		<script type="text/javascript" src="js/daterangepicker.js"></script>
		<link href="css/more-btns.css" rel="stylesheet">	  
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script src="js/simpleheat.js"></script>
		<script src="js/heatdata.js"></script>
   
   <style type="text/css">
    .bs
	{
    	margin: 100px;
    }
	
</style>
   
	</head>
  
<body>

 <script type="text/javascript">
 
 var obj = <?php echo json_encode($data); ?>;
 var count = <?php echo json_encode($index); ?>;
	document.write(count);
	document.write(obj)
	
 
</script>
    
<div class="jumbotron">
  <h1>DATA VISUALISATION</h1>
</div>
   
   <!-- Line graphs used to visually represent the time (Y-axis) it takes for a game participant to correctly identify the specified target for every trial (X-axis). -->
    
  <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
     
	 function drawChart() {
        var jsonData = $.ajax({
			url: "data_php/getLineData.php",
			dataType: "json",
			async: false
			}).responseText;
			
		var data = new google.visualization.DataTable(jsonData);

        var options = {
          title: 'TIME TO TARGET'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
 </script>
		
<div class="bs" id="chart_div" style="height: 500px; border: 3px solid #a1a1a1; border-radius: 3px; " ></div>	
	
	<!-- 
Bar/column charts will be used to represent the time it takes for a single game participant to read a word set and the number of times visual cues are given on the particular words game participants have a difficult time of reading.
	-->
	
	<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      
	  
	  function drawChart() {
	  
	   var jsonData = $.ajax({
			url: "data_php/getBarData.php",
			dataType: "json",
			async: false
			}).responseText;
			
      var data = new google.visualization.DataTable(jsonData);

        var options = {
          title: 'TIME TO READ EACH WORD SET',
          vAxis: {title: 'WORD SET',  titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div2'));

        chart.draw(data, options);
      }
    </script>
	
	
	
	<div class="bs" id="chart_div2" style="height: 500px; border: 3px solid #a1a1a1; border-radius: 3px; " ></div>	
	
	

	
	<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
	  
	  var jsonData = $.ajax({
			url: "data_php/getColumnData.php",
			dataType: "json",
			async: false
			}).responseText;
			
		 var data = new google.visualization.DataTable(jsonData);	
       

        var options = {
          title: 'VISUAL CUES GIVEN PER WORD',
          legend: { position: 'none' },
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
      }
    </script>
	
	
	<div class="bs" id="chart_div3" style=" height: 500px; border: 3px solid #a1a1a1; border-radius: 3px; " ></div>	
	
	
	<!-- ET-24 SCATTER MAP. NEW GRAPH AS REQUESTED BY CLIENT 
	Each data point represents where a test respondent was looking at a specific point in time on a particular image or frame that has been shown to them. 
	-->
	
	
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
       var jsonData = $.ajax({
			url: "data_php/getScatterData.php",
			dataType: "json",
			async: false
			}).responseText;
			
		 var data = new google.visualization.DataTable(jsonData);	

        var options = {
		  backgroundColor: 'none',
          title: 'Scatter Map',
		  hAxis: {minValue: 0, maxValue: 1200},
          vAxis: {minValue: 0, maxValue: 800, direction: -1},
		  legend: 'none'
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div4'));

        chart.draw(data, options);
      }
    </script>
	
	
	<div class="bs container" id="chart_div4" style="height: 500px; border: 3px solid #a1a1a1; border-radius: 3px; " > </div>	
	
  <!-- END ET-24 -->
	
	
	<!-- Heatmaps are the graphical representation of data in colour of a participant’s gaze is at any given time. 
	The colour on the heat map depends on the density of data points in a given area – the colour leans to the right of the colour spectrum (red) the more dense the data points are, 
	and to the left of the spectrum (green/blue) for the less dense it is.
This will provide researchers with in immediate visual summary of collated information. 
This type of visualisation is suitable for larger and more complex data sets. -->

	<canvas class="bs" style="border: 3px solid #a1a1a1; border-radius: 3px; background-image: url(http://kellidease.com/wp-content/uploads/2014/03/best-baby-photographers-1000x500.jpg)" id="canvas" width="1000" height="500">
	</canvas>

	<script>

function get(id) {
    return document.getElementById(id);
}

var heat = simpleheat('canvas').data(data).max(18),
    frame;

function draw() {
    console.time('draw');
    heat.draw();
    console.timeEnd('draw');
    frame = null;
}

draw();



var radius = get('radius'),
    blur = get('blur'),
    changeType = 'oninput' in radius ? 'oninput' : 'onchange';

radius[changeType] = blur[changeType] = function (e) {
    heat.radius(+radius.value, +blur.value);
    
};

</script>
	

	<!-- Navigation Bar at the bottom of every EyeTrack web page  -->
	<nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
        <div class="container">
    
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">EyeTrack</a>
            </div>
         
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  
                   
                </ul>
            </div>
 
        </div>
 
    </nav>
	
	
	
	
	
	
  </body>
</html>