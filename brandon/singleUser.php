
			
			<?php
			//Database connection
			$mysqli = new mysqli("localhost", "root", "password", "mydb");
			if ($mysqli->connect_errno) {
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			
			//echo "session " . $_SESSION['test'];
			//echo "<br />";
//!---ET-41---!

			//Load Data from database into array
			if(!empty($_POST['firstName'])) {
				$firstName = ($_POST["firstName"]);
			}
			if(!empty($_POST['lastName'])) {
				$lastName = ($_POST["lastName"]);
			}
			
			if(!empty($_POST['gameId'])) {
				$gameId = ($_POST["gameId"]);
			}
			
			if(!empty($_POST['endDate'])) {
				$endDate = ($_POST["endDate"]);
			}
			
			if(!empty($_POST['startDate'])) {
				$startDate = ($_POST["startDate"]);
			}
			
				//Grab user ID based on firstname and lastname
				$result = $mysqli->query("SELECT userId FROM tbl_users WHERE firstName = '$firstName' AND lastName = '$lastName'") or die(mysql_error());
				if(mysqli_num_rows($result) > 0 ){
					$row = mysqli_fetch_row($result);
					$userId = $row[0];
					$dirResult = $mysqli->query("SELECT dir FROM tbl_data WHERE userId = '$userId' AND gameId = '$gameId' AND gameDate between '$startDate' AND '$endDate'") or die (mysql_error());
					$dirRow = mysqli_fetch_array($dirResult, MYSQLI_NUM);
					if(mysqli_num_rows($dirResult) > 0){
							
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
									$index++;
								}
							}
							else{
								echo "Error Loading file."; echo "<br />";
							} 					
							//echo "Normal: ",  json_encode($data);
							fclose($csv);

						}while ($dirRow = mysqli_fetch_array($dirResult, MYSQLI_NUM));
						
				
						
					mysqli_close($mysqli);
					}
					else{
						echo "No data found for " . $firstName . " " . $lastName . " in the dates between " . $startDate . " and " . $endDate ; echo "<br />";
					}
					
						
		//!---END OF ET-42---!
				}
				else{
					echo "No data found for " . $firstName . " " . $lastName; echo "<br />";
				}			
	
//!---END OF ET-41---!
?>