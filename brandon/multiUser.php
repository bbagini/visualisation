<!--Brandon Bagini 15488662-->
<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Database Menu</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<!--Custom CSS -->
	
	<link href="css/design.css" rel="stylesheet">

  </head>
  <body>

	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="databaseMenu.html">Database Menu</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="databaseMenu.html">Home</a></li>
            <li><a href="databaseMenu.html">About</a></li>
            <li><a href="databaseMenu.html">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div class="design">
		<div class="container">
			<h1>Data Analysis</h1>
			
			<?php
			//Database connection
			$mysqli = new mysqli("localhost", "root", "password", "mydb");
			if ($mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
//!---ET-41---!
			//Variables are temporary fixes for POST data
			//Load Data from database into array
			
			if(!empty($_POST['startDate'])) {
				$startDate = ($_POST["startDate"]);
			}
			if(!empty($_POST['endDate'])) {
				$endDate = ($_POST["endDate"]);
			}
			if(!empty($_POST['gameId'])) {
				$gameId = ($_POST["gameId"]);
			}
			if(!empty($_POST['disorder'])) {
				$disorder = ($_POST["disorder"]);
			}
			//Add age accountability in the future.
			
			
			//Combine tbl_users disorder and tbl_data to gather all directories between dates of users with a specific disorder
			$dirResult = $mysqli->query("SELECT	d.dir FROM tbl_data as d, tbl_users as u WHERE u.userId = d.userId AND u.disorder = '$disorder'	AND d.gameId = '$gameId' AND d.gameDate between '$startDate' AND '$endDate'")or die (mysql_error());
			if(mysqli_num_rows($result) > 0 ){
				//Read header of data file
				$dirRow = mysqli_fetch_array($dirResult, MYSQLI_NUM);
			}
			else{
				echo "No data found for this selection"; echo "<br />";
			}
//!---END OF ET-41---!


//!---ET-42---!	
				//Loop through each directory 
				do{
					//echo number of loops and include data gathered from csv files.
					//echo "loop";echo "<br />";
					echo $dirRow[0]; echo "<br />";
					$csv = fopen($dirRow[0], "r");
					if ($csv){
					//read each line of the csv and load the entire string including the commas into an array
					$header = fgets($csv);
					$index = 0;
						while (($line = fgets($csv)) !== false) {
						//Using dir (the data file location)
						//read first header -> do nothing
						//loop reading actual data into the data array
							$data[$index] = $line;
							echo $data[$index]; echo "<br />";
							$index++;
						}
					}
					else{
						echo "Error Loading file."; echo "<br />";
					} 
					fclose($csv);

				}while ($dirRow = mysqli_fetch_array($dirResult, MYSQLI_NUM));
			mysqli_close($mysqli);
//!---END OF ET-42---!
			?>
			
				

		</div>
	</div>
			
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>