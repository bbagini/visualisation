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
			$mysqli = new mysqli("localhost", "root", "", "sep");
			if ($mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			
			//echo "session " . $_SESSION['test'];
			//echo "<br />";
//!---ET-41---!
			//Load Data from database into array
				$firstName = ($_POST["firstName"]);
				//echo "firstName ".$firstName; echo "<br />";
				$lastName = ($_POST["lastName"]);
				$gameId = ($_POST["gameId"]); 
				//echo "gameID ".$gameId; echo "<br />";
				$endDate = ($_POST["endDate"]);
				$startDate = ($_POST["startDate"]);
				
				//Grab user ID based on firstname and lastname
				$result = $mysqli->query("SELECT userId FROM tbl_users WHERE firstName = '$firstName' AND lastName = '$lastName'") or die(mysql_error());
				$row = mysqli_fetch_row($result);
				
				//Add in accountability for users with same first/lastname combination by allowing selection of usernames.
				// if ($rowcount=mysqli_num_rows($result) > 1){
					// echo "Multiple users found under the name " . $firstName . " " . $lastName; echo "<br />";
					// $username = $mysqli->query("SELECT username from tbl_users where firstName = '$firstName' AND lastname = '$lastName'") or die(mysqli_error());

				// }
				
				$userId = $row[0];
				$dirResult = $mysqli->query("SELECT dir FROM tbl_data WHERE userId = '$userId' AND gameId = '$gameId'") or die (mysql_error());
				$dirRow = mysqli_fetch_array($dirResult, MYSQLI_NUM);		
//!---END OF ET-41---!


//!---ET-42---!	
				//Loop through each directory 
				do{
					//echo number of loops and include data gathered from csv files.
					echo "loop";echo "<br />";
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