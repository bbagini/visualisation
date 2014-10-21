<!--
EDITS SINCE LAST SUBMISSION 

*Place holder buttons are now functional.

-->
<!DOCTYPE html>
<html class="full" lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EyeTrack Data Visualisation</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.js"></script>
    
	<!-- Custom CSS -->
    <link href="css/the-big-picture.css" rel="stylesheet">
	<link href="css/more-btns.css" rel="stylesheet">
	
	

   <style type="text/css">
    .btn-layout
	{
    		
	display: block;
	margin-left: auto;
	margin-right: auto;
	text-align:center;
	margin: 100px;
	
    }
	
	</style> 
  

 
 
</head>

<body>


<div class="btn-layout"> <!-- Updates the database by uploading new test participant data to the database server. (Back-end is done by Brandon)-->
<a href="brandon/batch.php" class="btn btn-block btn-sunny btn-xl text-uppercase">
<span class="glyphicon glyphicon-list-alt"></span>Update Database</a>
</div> 


<!-- User will select this option if an analysis of one test participant is desired. (Back-end is done by Brandon) -->
<div class="btn-layout">
<a href="single-user-form.php" class="btn btn-block btn-sky btn-xl text-uppercase">
<span class="glyphicon glyphicon-user"></span> Data Analysis - Single Test Subject </a>
<a href="multi-user-form.php" class="btn btn-block btn-sky btn-xl text-uppercase">
<span class="glyphicon glyphicon-th-large"></span> Data Analysis - Multiple Test Subjects </a>
</div>

<div class="btn-layout"><!-- User will select this option if an analysis of multiple test participants is desired. (Back-end is done by Brandon) -->
<a href="register.php" class="btn btn-block btn-fresh btn-xl text-uppercase">
<span class="glyphicon glyphicon glyphicon-edit"></span> Register a User</a>
</div> 

<!-- Navigation Bar -->
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