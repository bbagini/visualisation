<!-- LANDING/LOGIN PAGE OF EYETRACK -->



<?php
//Checks credentials of user in database to allow access to site if valid
    require("config.php"); 
    $submitted_username = '';
		
	if(!empty($_POST)){ 
        $query = " 
            SELECT 
                loginId, 
                username, 
                password, 
                salt, 
                email 
            FROM tbl_login 
            WHERE 
                username = :username 
        "; 
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
          
        try{ 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        $login_ok = false; 
        $row = $stmt->fetch(); 
        if($row){ 
            $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++){
                $check_password = hash('sha256', $check_password . $row['salt']);
            } 
            if($check_password === $row['password']){
                $login_ok = true;
            } 
        } 
 
        if($login_ok){ 
            unset($row['salt']); 
            unset($row['password']); 
            $_SESSION['user'] = $row;  
            header("Location: menu_selection.php"); 
            die("Redirecting to: menu_selection.php"); 
        } 
        else{ 
           
			echo '
			
			<div class=" alert alert-warning" role="alert" style="width: 200px" ><h2><strong>LOGIN FAILED</h2></strong></div>


';
			$submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
?> 




<!DOCTYPE html>
<html class="full" lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	
	<!-- Bootstrap Core CSS and other frameworks -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
	 <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	

    <!-- Custom CSS -->
    <link href="css/the-big-picture.css" rel="stylesheet">
    <link href="css/more-btns.css" rel="stylesheet">
	
	
	<style type="text/css">
		.page-margin
		{
			margin: 50px;
		}
	</style>
	
	
    <title>EyeTrack Data Visualisation</title>
  
 
</head>

<body>

	<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
          		<h1 class="text-center">EyeTrack Data Visualisation</h1>
				</div>
      
	  
	  
	  <!-- Form to submit username and password -->
		<div class="modal-body">
			<form class="form col-md-12 center-block" action="index.php" method="post">
				
			<div class="form-group">
			<input type="text" name="username" class="form-control input-lg" placeholder="Username" value="<?php echo $submitted_username; ?>" />
			</div>
            
			<div class="form-group">
			<input type="password" name="password" class="form-control input-lg" placeholder="Password">
			</div>
            
			<div class="form-group">
            <input type="submit" class="btn btn-info" value="Login" /> 
            </div>
			</form>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          
		  </div>	
      </div>
			</div>
  </div>
</div>




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
                <a class="navbar-brand" href="#"><strong>EyeTrack</strong></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
				</ul>
            </div>
         </div>
    </nav>
  

</body>

</html>
