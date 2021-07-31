<?php

	$weather="";
	$error="";
	
	if (array_key_exists('city', $_GET)){
		
		$city=  str_replace(' ', '', $_GET['city']);
		
		$file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");

		if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
    
	$error= "That city could not be found.";
}

		else {
    
		$forecastPage= file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
		
		$pageArray= explode('(1&ndash;3 days)</div><p class="b-forecast__table-description-content"><span class="phrase">',  $forecastPage);
		
		if (sizeof($pageArray) > 1){
		
				$secondPageArray= explode('</span></p></td>',$pageArray[1]);
			
				if(sizeof($secondPageArray) > 1){
			
					$weather= $secondPageArray[0];
				
				}else{
					
					$error= "That city could not be found.";
					
				}
				
			}else{
				
				$error= "That city could not be found.";
				
			}
		
		}
	}
	
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Weather</title>
  </head>
  <style type="text/css">
  body{
	  
	 
	  background: url(https://images.unsplash.com/photo-1552301726-d43f8f24c112?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  }
  .container{
	 text-align:center;
margin-top:15%;	 
	  width:40%;
  }
  input{
	  margin:20px 0;
	  
  }
  #weather{
	  margin-top:3%;
	 
  }
  </style>
  <body>
  <div class="container">
    <h1>What's the weather?</h1>
	<form >
  <div class="form-group">
    <label for="city">Enter the name of a city .</label>
    <input type="text" name="city" class="form-control" id="city" placeholder="Eg. London, Tokyo" value="<?php 
	if (array_key_exists('city', $_GET)){
	
	echo $_GET['city']; 
	
	}
	?>">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div id="weather"><?php

if ($weather){
	
	echo '<div class="alert alert-success" role="alert">
 '.$weather.'
</div>';
	
}else{
	echo '<div class="alert alert-danger" role="alert">
 '.$error.'
</div>';
}

 ?></div>
   </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>