<?php //Registers a new unique user to the database
    require("config.php");
    if(!empty($_POST)) 
    { 
        // Ensure that the user fills out fields 
        if(empty($_POST['username'])) 
        { die("Please enter a username."); } 
        if(empty($_POST['password'])) 
        { die("Please enter a password."); } 
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { die("Invalid E-Mail Address"); } 
          
        // Check if the username is already taken
        $query = " 
            SELECT 
                1 
            FROM tbl_login 
            WHERE 
                username = :username 
        "; 
        $query_params = array( ':username' => $_POST['username'] ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        $row = $stmt->fetch(); 
        if($row){ die("This username is already in use"); } 
        $query = " 
            SELECT 
                1 
            FROM tbl_login 
            WHERE 
                email = :email 
        "; 
        $query_params = array( 
            ':email' => $_POST['email'] 
        ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage());} 
        $row = $stmt->fetch(); 
        if($row){ die("This email address is already registered"); } 
          
        // Add row to database 
        $query = " 
            INSERT INTO tbl_login ( 
                username, 
                password, 
                salt, 
                email 
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :email 
            ) 
        "; 
          
        // Security measures
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
        $password = hash('sha256', $_POST['password'] . $salt); 
        for($round = 0; $round < 65536; $round++){ $password = hash('sha256', $password . $salt); } 
        $query_params = array( 
            ':username' => $_POST['username'], 
            ':password' => $password, 
            ':salt' => $salt, 
            ':email' => $_POST['email'] 
        ); 
        try {  
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        header("Location: index.php"); 
        die("Redirecting to index.php"); 
    } 
?>


<!DOCTYPE html>
<html lang="en">
 <head>
 
 
      <meta charset="UTF-8" />
      <title>Registration</title>
      <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
      <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
      <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
      <link href="css/more-btns.css" rel="stylesheet">
  
<style type="text/css">
    .bs-example{
    	margin: 150px;
    }
</style>

  </head>


<body>

<div class="jumbotron">
  <h1>REGISTRATION</h1>
 </div>

<!-- Forms to enter details for registration -->
<div class=" well bs-example">
<form action="register.php" method="post"> 
    
	<div class="well">
            <label for="inputusername">USERNAME</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="username" style="width: 300px">
        </div>
	
	
	<div class="well">
            <label for="inputemail">EMAIL</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="email" style="width: 300px">
        </div>
    
	
	<div class="well">
            <label for="inputpassword">PASSWORD</label>
            <input type="text" class="form-control" name="password" id="password" placeholder="password" style="width: 300px">
        </div>
    
	
	
	<input type="submit" class="btn btn-info" value="Register" /> 
</form>

<!-- Nav bar -->
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

