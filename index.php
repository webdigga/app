<?

// connect to the database
include('dbconnect.php');

// start the session
session_start();
if (isset($_SESSION['username'])) {
	$sessuser = $_SESSION['username'];
	
	/* companyid */
	$companyidresult = mysql_query("SELECT companyid FROM users WHERE username = '$sessuser'");
	while($row = mysql_fetch_array($companyidresult)) {
		$companyid = $row['companyid'];
	}

	/* big switch! */
	switch ($companyid) {
		case '2'; 
			$imgNum = 2;
		break;
		case '3'; 
			$imgNum = 3;
		break;
	}	
	
	/* pull out all of the companies drivers */
	$driverresult = mysql_query("SELECT * FROM driver WHERE companyid = $companyid");
	/* pull out all of the companies vehicles */
	$vehicleresult = mysql_query("SELECT * FROM vehicle WHERE companyid = $companyid");
	/* pull out all of the weather */
	$weatherresult = mysql_query("SELECT * FROM weather");	
}
?>

<!doctype html>
<!-- Conditional comment for mobile ie7 http://blogs.msdn.com/b/iemobile/ -->
<!--[if IEMobile 7 ]>    <html class="no-js iem7"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<title>App-cident</title>
	<meta name="description" content="">
	<meta name="author" content="David White">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/h/apple-touch-icon.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/m/apple-touch-icon.png">
	<link rel="apple-touch-icon-precomposed" href="img/l/apple-touch-icon-precomposed.png">  
	<link rel="shortcut icon" href="img/l/apple-touch-icon.png">
	<meta http-equiv="cleartype" content="on">
	<link rel="stylesheet" href="css/style.php?v=1">
	<script src="js/libs/modernizr-custom.js"></script>
	<script>Modernizr.mq('(min-width:0)') || document.write('<script src="js/libs/respond.min.js">\x3C/script>')</script>  
</head>

<body>
	<? if(isset($_SESSION["username"])) {?>
  <div id="container">  
    <header>
      <h1></h1>			
    </header>
    <div id="main" data-role="page">	
		<form id="sendMail" action="mail-send.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
			<fieldset>			
			    <div class="formSectionOne formSection" id="pg1">
					<div class="traffic-lights">
						<div class="red light-holder holder1 light-selected">
							<div class="red-light light">1</div>
						</div>
						<div class="red light-holder holder2">
							<div class="red-light light">2</div>
						</div>
						<div class="red light-holder holder3">
							<div class="red-light light">3</div>
						</div>
						<div class="red light-holder holder4">
							<div class="red-light light">4</div>
						</div>
					</div>
					<div class="container-padding">
						<a class="logout" href="logout.php">Log out</a>
						<img src="/images/logos/<?=$imgNum;?>.png" />					
						<h2>About third party.....</h2>
						<div class="photo-alert">** Please make sure you have your accident photos ready before starting.</div>
						<input type="text" name="tpName" id="tpName" placeholder="Enter 3rd party full name" />
						<input type="tel" name="tpPneNumber" id="tpPneNumber" placeholder="Enter 3rd party phone number" />	
						<input type="text" name="tpLicensePlateNumber" id="tpLicensePlateNumber" placeholder="Enter 3rd party license plate number" />	
						<input type="text" name="tpMake" id="tpMake" placeholder="Enter 3rd party Manufacturer" />				
						<input type="text" name="tpModel" id="tpModel" placeholder="Enter 3rd party Model" />					
					</div>
					<div class="steps">
						Step 1 of 4.  Swipe left to go to the next step.
					</div>
				</div>				
				<div class="formSectionTwo formSection" id="pg2">
					<div class="traffic-lights">
						<div class="red light-holder holder1">
							<div class="red-light light">1</div>
						</div>
						<div class="green light-holder holder2 light-selected">
							<div class="red-light light">2</div>
						</div>
						<div class="red light-holder holder3">
							<div class="red-light light">3</div>
						</div>
						<div class="red light-holder holder4">
							<div class="red-light light">4</div>
						</div>
					</div>
					<div class="container-padding">
						<a class="logout" href="logout.php">Log out</a>
						<img src="/images/logos/<?=$imgNum;?>.png" />					
						<h2>About the accident.....</h2>
						<div class="photo-upload-note">Please upload photo(s) of accident here...</div>
						<input type="file" name="file[]" id="file0" size="20" />		
						<span class="add-photo">+</span>
						<span class="remove-photo" style="display:none;">-</span>
						<textarea name="message" id="message" placeholder="Description / Other"></textarea>						
					</div>
					<div class="steps">
						Step 2 of 4.  Swipe left to go to the next step.
					</div>
				</div>				
				<div class="formSectionThree formSection" id="pg3">
					<div class="traffic-lights">
						<div class="red light-holder holder1">
							<div class="red-light light">1</div>
						</div>
						<div class="green light-holder holder2">
							<div class="red-light light">2</div>
						</div>
						<div class="red light-holder holder3 light-selected">
							<div class="red-light light">3</div>
						</div>
						<div class="red light-holder holder4">
							<div class="red-light light">4</div>
						</div>
					</div>
					<div class="container-padding">
						<a class="logout" href="logout.php">Log out</a>
						<img src="/images/logos/<?=$imgNum;?>.png" class="logo" />					
						<h2>Checklist.....</h2>
						<input type="checkbox" id="takenPhotograph" name="takenPhotograph" />
						<label for="takenPhotograph">Take Photographs</label>					
						<input type="checkbox" id="check3rdPartyId" name="check3rdPartyId" />
						<label for="check3rdPartyId">Check 3rd Party ID</label>					
						<input type="checkbox" id="checkInjuries" name="checkInjuries" />
						<label for="checkInjuries">Check for injuries to 3rd party</label>
						<input type="checkbox" id="checkPhotos" name="checkPhotos" />
						<label for="checkPhotos">Take photos of damage to both vehicles</label>
						<input type="checkbox" id="checkInteriorPhotos" name="checkInteriorPhotos" />
						<label for="checkInteriorPhotos">Take photos of TP interior</label>
						<input type="checkbox" id="checkTpPhotos" name="checkTpPhotos" />
						<label for="checkTpPhotos">Take photos of TP's</label>
						<input type="checkbox" id="checkPolice" name="checkPolice" />
						<label for="checkPolice">Report the incident to the Police</label>						
					</div>
					<div class="steps">
						Step 3 of 4.  Swipe left to go to the next step.
					</div>
				</div>				
				<div class="formSectionFour formSection" id="pg4">
					<div class="traffic-lights">
						<div class="red light-holder holder1">
							<div class="red-light light">1</div>
						</div>
						<div class="green light-holder holder2">
							<div class="red-light light">2</div>
						</div>
						<div class="red light-holder holder3">
							<div class="red-light light">3</div>
						</div>
						<div class="red light-holder holder4 light-selected">
							<div class="red-light light">4</div>
						</div>
					</div>
					<div class="container-padding">
						<a class="logout" href="logout.php">Log out</a>
						<img src="/images/logos/<?=$imgNum;?>.png" class="logo" />					
						<h2>About you.....</h2>
						<!-- driver details -->
						<select id="driver-select" name="driver-select">
							<option disabled="disabled" selected="selected" value="0">Please choose your name from this list...</option>
							<?
							while($row = mysql_fetch_array($driverresult)) {
								echo "<option value=". $row['id'] .">". $row['name'] ."</option>";
							}
							?>
						</select>
						<!-- vehicle details -->
						<select id="vehicle-select" name="vehicle-select">
							<option disabled="disabled" selected="selected" value="0">Please choose your license plate from this list...</option>
							<?
							while($row = mysql_fetch_array($vehicleresult)) {
								$licenseplate = str_replace(' ', '', $row['licenseplate']); 
								echo "<option value=". $licenseplate .">". $row['licenseplate'] ."</option>";
							}
							?>
						</select>
						<input type="hidden" value="" id="geolocation" name="geolocation" />					
						<input type="hidden" value="" id="temperature" name="temperature" />
						<input type="hidden" value="" id="weather" name="weather" />
						<input type="hidden" value="" id="wind" name="wind" />
						<input type="hidden" value="" id="visibility" name="visibility" />
						<input type="hidden" value="" id="image" name="image" />
						<input type="hidden" value="" id="imagealt" name="imagealt" />
						<input type="hidden" value="<?=$companyid;?>" id="companyid" name="companyid" />
						<input type="submit" class="mailSubmit" value="Log Appcident" />
					</div>
				</div>				
			</fieldset>
		</form>		
    </div>
    <footer></footer>
  </div>
	<?
	} else {
		include('login.php');
	}	
	?> 
  <script src="/js/libs/jquery-1.7.2.min.js"></script>  
  <script src="/js/plugins.js"></script>
  <!-- scripts concatenated and minified via ant build script -->
  <script src="js/mylibs/helper.js"></script>
  <!-- end concatenated and minified scripts-->
  <script src="/js/script.js"></script> 
  <script>
    MBP.scaleFix();
  </script>
  <script>
    var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
    g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
    s.parentNode.insertBefore(g,s)}(document,"script"));
  </script>

</body>
</html>