<!-- 

EDITS SINCE LAST SUBMISSION

*Now queries database first for test participant details and then directs to visualisation tab

-->

<!DOCTYPE html>
<html lang="en">
 <head>
      <meta charset="UTF-8" />
      <title>Multiple Test Participants</title>
      <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
      <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" media="all" href="css/daterangepicker-bs3.css" />
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
      <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="js/moment.js"></script>
      <script type="text/javascript" src="js/daterangepicker.js"></script>
	  
	  <link href="css/the-big-picture.css" rel="stylesheet">
	  <link href="css/bootstrap.min.css" rel="stylesheet">
  
<style type="text/css">
    .bs-example{
    	margin: 100px;
    }
</style>

</head>

   
<body>     
  
<div class="well bs-example">
 
<!-- Criteria selection for data visualisation of test participants -->
	<form action="brandon/multiUser.php" method="post">
	
		 <div class="well">
		<label>Game Selection</label>
		<select name="gameId" id="gameId" class="form-control" style="width: 200px">
			<option value="1">Static Images</option>
			<option value="2">Moving Objects</option>
			<option value="3">Reading Game</option>
   
	</select>
	</div>
	
	
	<div class="well">
		 <label>Test Participant Disorder</label>
		<select name="disorder" id="disorder" class="form-control" style="width: 200px">
			<option value="dyslexia">Dyslexia</option>
			<option value="disorder two">Disorder Two</option>
			<option value="disorder three">Disorder Three</option>
   
	</select>
	</div>
	
	<div class="well">
		<label>Test Location</label>
		<select class="form-control" style="width: 200px">
			<option value="sydney">Sydney</option>
			<option value="perth">Perth</option>
			<option value="melbourne">Melbourne</option>
   
	</select>
	</div>
	
	
	
	<div class="well">
            <label> Start Date </label>
           	<input type="date" class="form-control" name="startDate" id="startDate" style="width: 200px">
    </div>
	
	
	<div class="well">
            <label> End Date </label>
           	<input type="date" class="form-control" name="endDate" id="endDate" style="width: 200px">
    </div>
 


		
<!-- This date range picker is originally written by Dan Grossman shared on https://github.com/dangrossman/bootstrap-daterangepicker Modified as necessary -->	
<!-- <div class="well"> 	***** This date selector is no longer used. Compatibility issues. *****
<label for="daterange">Test Date Range</label>
               <form class="form-horizontal">
                 <fieldset>
                  <div class="control-group">
                    <div class="controls">
                     <div class="input-prepend input-group">
                       <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
					   <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control" value="01/01/2014 - 01/12/2014" /> 
                     </div>
                    </div>
                  </div>
                 </fieldset>
               </form>

               <script type="text/javascript">
               $(document).ready(function() {
                  $('#reservation').daterangepicker(
				  
				  { 
    format: 'DD-MM-YYYY',
    startDate: '01-01-2014',
    endDate: '31-12-2014'
  }
				  , function(start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                  });
               });
               </script>

            </div> -->
	   
	   	  <div class="well">
            <label for="inputstartage">From ages</label>
            <input type="text" class="form-control" name="startage" id="startage" placeholder="0" style="width: 75px"> 
			<label for="inputendage">to</label>
            <input type="text" class="form-control" name="endage" id="endage" placeholder="99" style="width: 75px">
        </div>
	   
	   
       <input type="submit" class="btn btn-info" value="Submit" /> 
    </form>
	
	  	
</div>



<!-- Navigation -->
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