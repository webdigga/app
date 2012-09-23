<?

// connect to the database
include('dbconnect.php');

// start the session
session_start();
if (isset($_SESSION['username'])) {
	$sessuser = $_SESSION['username'];	
	/* companyid */
	$companyidresult = mysql_query("SELECT id, companyid FROM driver WHERE username = '$sessuser'");
	while($row = mysql_fetch_array($companyidresult)) {
		$driverid = $row['id'];
		$companyid = $row['companyid'];
	}		
	/* pull out all of the companies vehicles */
	$vehicleresult = mysql_query("SELECT * FROM vehicle WHERE companyid = $companyid");
	/* pull out all of the weather */
	$weatherresult = mysql_query("SELECT * FROM weather");	
}
?>

<!DOCTYPE html> 
<html> 
	<head> 
	<title>App-cident</title> 
	<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/main.css" />

	<?
	// check which company we are logged in as and switch the stylesheet
	if(isset($companyid)) {	
		switch ($companyid) {
			// dhl
			case 2:
				echo "<link rel=\"stylesheet\" href=\"/css/dhl.css\" />";
			break;
			// demo
			case 3:
				echo "<link rel=\"stylesheet\" href=\"/css/demo.css\" />";
			break;
			case 4:
				echo "<link rel=\"stylesheet\" href=\"/css/unite.css\" />";
			break;
			default:
				echo "<link rel=\"stylesheet\" href=\"/css/default.css\" />";
			break;
		}
	} else {
		echo "<link rel=\"stylesheet\" href=\"/css/default.css\" />";
	}
	?>
	
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile.structure-1.1.1.min.css" /> 
  <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script> 
	<script src="/js/main.js"></script>
  <script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
</head> 
<body>
	
	<? if(isset($_SESSION["username"])) {?>

	<form id="sendMail" action="action.php" method="post" enctype="multipart/form-data">
	
		<div data-role="page" id="one">
			<div data-role="header">
				<a href="#one" data-icon="home" data-transition="flip" data-iconpos="notext" data-direction="reverse" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Home">Home</a>			
				<h1>APP-CIDENT</h1>
				<a href="#" data-icon="info" data-iconpos="notext" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Help">Help</a>
			</div>
			<div data-role="content" class="section-1">	
				<h2>About third party.....</h2>
				<p>
					<em>**Please ensure you have photos of the accident ready before starting.</em>
				</p>
				<label for="tpName">Enter 3rd party full name:</label>
				<input type="text" name="tpName" id="tpName" value="" data-mini="true" />				
				<label for="tpPneNumber">Enter 3rd party phone number:</label>
				<input type="tel" name="tpPneNumber" id="tpPneNumber" value="" data-mini="true" />
				<label for="tpLicensePlateNumber">Enter 3rd party license plate number:</label>
				<input type="text" name="tpLicensePlateNumber" id="tpLicensePlateNumber" value="" data-mini="true" />	
				<label for="tpMake">Enter 3rd party manufacturer:</label>
				<input type="text" name="tpMake" id="tpMake" value="" data-mini="true" />	
				<label for="tpModel">Enter 3rd party model:</label>
				<input type="text" name="tpModel" id="tpModel" value="" data-mini="true" />					
				<a href="#two" class="next" data-inline="true" data-role="button" data-icon="forward" data-transition="flip data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Next</a>
			</div><!-- /content -->			
			<div data-role="footer" data-position="fixed" class="footer">
				<div class="prev logo"></div>
				<a class="next" href="/logout.php" data-role="button" data-icon="back" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Logout</a>
			</div><!-- /footer -->			
		</div><!-- /page -->
		
		<div data-role="page" id="two">
			<div data-role="header">
				<a href="#one" data-icon="home" data-transition="flip" data-iconpos="notext" data-direction="reverse" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Home">Home</a>
				<h1>APP-CIDENT</h1>
				<a href="#" data-icon="info" data-iconpos="notext" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Help">Help</a>
			</div>
			<div data-role="content" class="section-2">
				<h2>About the accident.....</h2>
				<p>
					<em>Please upload photo(s) of accident here.</em>
				</p>
				<input type="file" name="file[]" id="file0" size="20">				
				<a href="#" class="add-photo" data-role="button" data-icon="add" data-iconpos="notext">Add</a>
				<a href="#" class="remove-photo" style="display:none;" data-role="button" data-icon="minus" data-iconpos="notext">Minus</a>
				<label for="message">Give a description here of exactly how the accident occurred:</label>
				<textarea name="message" id="message"></textarea>				
				<a href="#one" class="prev" data-inline="true" data-role="button" data-icon="back" data-transition="flip" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Back</a>
				<a href="#three" class="next" data-inline="true" data-role="button" data-icon="forward" data-transition="flip data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Next</a>
			</div><!-- /content -->
			<div data-role="footer" data-position="fixed" class="footer">
				<div class="prev logo"></div>
				<a class="next" href="/logout.php" data-role="button" data-icon="back" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Logout</a>
			</div><!-- /footer -->
		</div><!-- /page -->		
		
		<div data-role="page" id="three">
			<div data-role="header">
				<a href="#one" data-icon="home" data-transition="flip" data-iconpos="notext" data-direction="reverse" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Home">Home</a>
				<h1>APP-CIDENT</h1>
				<a href="#" data-icon="info" data-iconpos="notext" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Help">Help</a>
			</div>
			<div data-role="content" class="section-3">	
				<h2>Checklist.....</h2>
				<label><input type="checkbox" name="takenPhotograph" id="takenPhotograph" /> Take photographs </label>
				<label><input type="checkbox" name="check3rdPartyId" id="check3rdPartyId" /> Check 3rd party id </label>		
				<label><input type="checkbox" name="checkInjuries" id="checkInjuries" /> Check for injuries to 3rd party </label>
				<label><input type="checkbox" name="checkPhotos" id="checkPhotos" /> Take photos of damage to both vehicles </label>
				<label><input type="checkbox" name="checkInteriorPhotos" id="checkInteriorPhotos" /> Take photos of 3rd party interior </label>
				<label><input type="checkbox" name="checkTpPhotos" id="checkTpPhotos" /> Take photos of 3rd party </label>
				<label><input type="checkbox" name="checkPolice" id="checkPolice" /> Report the incident to the police </label>	
				<a href="#two" class="prev" data-inline="true" data-role="button" data-icon="back" data-transition="flip" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Back</a>
				<a href="#four" class="next" data-inline="true" data-role="button" data-icon="forward" data-transition="flip data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Next</a>
			</div><!-- /content -->
			<div data-role="footer" data-position="fixed" class="footer">
				<div class="prev logo"></div>
				<a class="next" href="/logout.php" data-role="button" data-icon="back" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Logout</a>
			</div><!-- /footer -->
		</div><!-- /page -->
		
		<div data-role="page" id="four">
			<div data-role="header">
				<a href="#one" data-icon="home" data-transition="flip" data-iconpos="notext" data-direction="reverse" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Home">Home</a>
				<h1>APP-CIDENT</h1>
				<a href="#" data-icon="info" data-iconpos="notext" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Help">Help</a>
			</div>
			<div data-role="content" class="section-4">				
				<h2>About you.....</h2>	
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
				<input type="hidden" value="<?=$driverid;?>" id="driver-select" name="driver-select" />
				
				<a href="#three" class="prev" data-inline="true" data-role="button" data-icon="back" data-transition="flip" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Back</a>
				<button type="submit" class="next" data-inline="true" data-icon="gear" aria-disabled="false">Log App-cident</button>
			</div><!-- /content -->
			<div data-role="footer" data-position="fixed" class="footer">
				<div class="prev logo"></div>
				<a class="next" href="/logout.php" data-role="button" data-icon="back" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Logout</a>
			</div><!-- /footer -->
		</div><!-- /page -->
		
	</form>

	<?} else {?>	
	
	<div data-role="page" id="login">
		<div data-role="header">	
			<a href="#" data-icon="home" data-transition="flip" data-iconpos="notext" data-direction="reverse" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Home">Home</a>
			<h1>APP-CIDENT</h1>
			<a href="#" data-icon="info" data-iconpos="notext" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Help">Help</a>
		</div>
		<div data-role="content">	
			<h2>Login</h2>
			<form action="/authlogin.php" method="post">
				<label for="username">Username: </label>			
				<input type="text" name="username" id="basic" value=""  />			
				<label for="password">Password: </label>
				<input type="password" name="password" id="password" value="" />
				<input type="submit" value="Log in"/>

				<div class="error-message">			
				<?				
				if(isset($_GET['error']) && $_GET['error']==1) {	
					echo "**Your username or password is incorrect, please try again";	
				}			
				?>			
				</div>
			</form>
		</div><!-- /content -->		
	</div><!-- /page -->
	<?}?>	
</body>
</html>