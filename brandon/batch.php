<!--Brandon Bagini 15488662-->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Batch Updating</title>

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
          <a class="navbar-brand" href="databaseMenu.html">Batch</a>
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
			<h1>Batch Update in Progress</h1>
			<p>Please wait while processes the files.</p>
		</div>
		</div>
		
		<!-- Begin Batch Loading -->
		<?php		
			//Connect to the database
			$mysqli = new mysqli("localhost", "root", "password", "mydb");
			// On Error			
			if ($mysqli->connect_errno) {
				printf("Connect failed: %s\n", $mysqli->connect_error);
				exit();
			}

			$usbFolders = scandir('C:\wamp\www\EyeTrack\databaseMenu\data');
			foreach($usbFolders as $usbFolder){
				 //Skip through the . and .. indexes of scandir array for $usbFolders
				if($usbFolder != '.' && $usbFolder != '..'){
					$userFolders = scandir("C:/wamp/www/EyeTrack/databaseMenu/data/$usbFolder");

					foreach($userFolders as $userFolder){
						 //Skip through the . and .. indexes of scandir array for $userFolders
						if($userFolder != '.' && $userFolder != '..'){
							$dir = "C:\wamp\www\EyeTrack\databaseMenu\data/$usbFolder/$userFolder\userInfo.csv";
							$user = fopen($dir, "r");
							$userSQL = (fgetcsv($user));
							
							//Check array contents
							
							//echo $userSQL[1];
							//echo $userSQL[2];
							//echo $userSQL[3];
							//echo $userSQL[4];
							//echo $userSQL[5];
							
							$username = $userSQL[0];
							$result = $mysqli->query("SELECT userId FROM tbl_users WHERE username = '$username'");
								
							$exists = false;
							//Loops into recordset, checks if empty, if empty sets exists to true.
							while($row = $result->fetch_array()){
								$exists = true;
							}
							
							//Add new user
							if(!$exists){
								echo "User added"; echo "<br />";
								$result = $mysqli->query("INSERT INTO tbl_users (username, firstName, lastName, age, disorder, locationId) VALUES ('$userSQL[0]', '$userSQL[1]', '$userSQL[2]', '$userSQL[3]', '$userSQL[4]', '$userSQL[5]')");
							}
							else{
								echo "Pre-existing user"; echo "<br />";
							}
							fclose($user);
							
							$dataFiles = scandir("C:\wamp\www\EyeTrack\databaseMenu\data/$usbFolder/$userFolder");
							foreach($dataFiles as $dataFile){
								//Skip through the . and .. indexes of scandir array for $dataFiles
								if($dataFile != '.' && $dataFile != '..' && $dataFile != 'userInfo.csv'){
									$dir = "C:\wamp\www\EyeTrack\databaseMenu\data/$usbFolder/$userFolder/$dataFile";
									$data = fopen($dir, "r");
									$dataSQL = (fgetcsv($data));
									
									//Check for correct data 
											// echo $dir; 							echo "<br />";

											// echo $dataSQL[0]; 							echo "<br />";
											// echo $dataSQL[1]; 							echo "<br />";
											// echo $dataSQL[2]; 							echo "<br />";
									
									//<----If Username is needed rather than user ID---->
									// $username = $dataSQL[2];
									// $dataResult = $mysqli->query("SELECT userId FROM tbl_users WHERE username = '$username'");
									// $dataResult->store_result();
									// $num_rows = $mysqli_result->num_rows;
									
									//Add Header of CSV File and include Directory									
									$dataResult = $mysqli->query("INSERT INTO tbl_data (gameId, userId, locationId, dir) VALUES ($userSQL[0], $userSQL[1], $userSQL[2], '$dir')");
									echo "Finished Processing File:  " . $dir; echo "<br />";
																	
									fclose($data);
								}
							}					
						}
					}
				}
			}	
		mysqli_close($mysqli);
		?>
		
	  </body>
</html>