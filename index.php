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
	$weatherresult = mysql_query("SELECT * FROM weather_types");	
	
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
	
	<!-- favicons -->
	<link rel="icon" type="image/png" href="/img/branding/favicon-16.png" />	
	<!-- Apple touch icon: -->
	<link rel="apple-touch-icon-precomposed" href="/img/branding/favicon-57.png">	
	<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
	<link rel="apple-touch-icon-precomposed" href="/img/branding/favicon-57.png">
	<!-- For first- and second-generation iPad: -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/branding/favicon-72.png">
	<!-- For iPhone with high-resolution Retina display: -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/branding/favicon-114.png">
	<!-- For third-generation iPad with high-resolution Retina display: -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/img/branding/favicon-144.png">
	
	
	
  <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script> 
	<script src="/js/main.js"></script>
  <script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
</head> 
<body>
	
	<? if(isset($_SESSION["username"])) {?>

	<form id="sendMail" action="action.php" method="post" data-ajax="false" enctype="multipart/form-data">	
	
		<div data-role="page" id="one">			
			<div data-role="header">
				<a href="#one" class="home" data-icon="home" data-transition="none" data-iconpos="notext" data-direction="reverse" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Home">Home</a>			
				<h1>App-cident</h1>
				<a href="http://app-cident.com/help.php" target="_blank" data-icon="info" data-iconpos="notext" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Help">Help</a>
			</div>
			<div data-role="content" class="section-1">				
				<h2>1/4 - About third party.....</h2>
				<p>
					<a href="#" class="refresh" data-role="button" data-icon="refresh" data-iconpos="notext">Refresh</a>					
					<em>Click refresh to retrieve your last session.</em>
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
				<a href="#two" class="next data-store" data-inline="true" data-role="button" data-icon="forward" data-transition="none" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Next</a>
			</div><!-- /content -->			
			<div data-role="footer" data-position="fixed" class="footer">
				<div class="prev logo"></div>
				<a class="next" href="/logout.php" data-role="button" data-icon="back" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Logout</a>
			</div><!-- /footer -->			
		</div><!-- /page -->
		
		<div data-role="page" id="two">
			<div data-role="header">
				<a href="#one" class="home" data-icon="home" data-transition="none" data-iconpos="notext" data-direction="reverse" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Home">Home</a>
				<h1>App-cident</h1>
				<a href="http://app-cident.com/help.php" target="_blank" data-icon="info" data-iconpos="notext" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Help">Help</a>
			</div>
			<div data-role="content" class="section-2">
				<h2>2/4 - About the accident.....</h2>
				<p>
					<em>Please upload photo(s) of accident here.</em>
				</p>
				<input type="file" name="file[]" id="file0" value="">				
				<a href="#" class="add-photo" data-role="button" data-icon="add" data-iconpos="notext">Add</a>
				<a href="#" class="remove-photo" style="display:none;" data-role="button" data-icon="minus" data-iconpos="notext">Minus</a>
				<label for="message">Give a description here of exactly how the accident occurred:</label>
				<textarea name="message" id="message"></textarea>				
				<a href="#one" class="prev data-store" data-inline="true" data-role="button" data-icon="back" data-transition="none" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Back</a>
				<a href="#three" class="next data-store" data-inline="true" data-role="button" data-icon="forward" data-transition="none" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Next</a>
			</div><!-- /content -->
			<div data-role="footer" data-position="fixed" class="footer">
				<div class="prev logo"></div>
				<a class="next" href="/logout.php" data-role="button" data-icon="back" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Logout</a>
			</div><!-- /footer -->
		</div><!-- /page -->		
		
		<div data-role="page" id="three">
			<div data-role="header">
				<a href="#one" class="home" data-icon="home" data-transition="none" data-iconpos="notext" data-direction="reverse" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Home">Home</a>
				<h1>App-cident</h1>
				<a href="http://app-cident.com/help.php" target="_blank" data-icon="info" data-iconpos="notext" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Help">Help</a>
			</div>
			<div data-role="content" class="section-3">	
				<h2>3/4 - Checklist.....</h2>
				<label><input type="checkbox" name="takenPhotograph" id="takenPhotograph" /> Take photographs </label>
				<label><input type="checkbox" name="check3rdPartyId" id="check3rdPartyId" /> Check 3rd party id </label>		
				<label><input type="checkbox" name="checkInjuries" id="checkInjuries" /> Check for injuries to 3rd party </label>
				<label><input type="checkbox" name="checkPhotos" id="checkPhotos" /> Take photos of damage to both vehicles </label>
				<label><input type="checkbox" name="checkInteriorPhotos" id="checkInteriorPhotos" /> Take photos of 3rd party interior </label>
				<label><input type="checkbox" name="checkTpPhotos" id="checkTpPhotos" /> Take photos of 3rd party </label>
				<label><input type="checkbox" name="checkPolice" id="checkPolice" /> Report the incident to the police </label>	
				<a href="#two" class="prev data-store" data-inline="true" data-role="button" data-icon="back" data-transition="none" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Back</a>
				<a href="#four" class="next data-store" data-inline="true" data-role="button" data-icon="forward" data-transition="none" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Next</a>
			</div><!-- /content -->
			<div data-role="footer" data-position="fixed" class="footer">
				<div class="prev logo"></div>
				<a class="next" href="/logout.php" data-role="button" data-icon="back" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Logout</a>
			</div><!-- /footer -->
		</div><!-- /page -->
		
		<div data-role="page" id="four">
			<!-- loading gif -->
			<div class="ui-icon-loading"></div>
			<div data-role="header">
				<a href="#one" class="home" data-icon="home" data-transition="none" data-iconpos="notext" data-direction="reverse" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Home">Home</a>
				<h1>App-cident</h1>
				<a href="http://app-cident.com/help.php" target="_blank" data-icon="info" data-iconpos="notext" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Help">Help</a>
			</div>
			<div data-role="content" class="section-4">				
				<h2>4/4 - About you.....</h2>	
				<select id="vehicle-select" name="vehicle-select">
					<option selected="selected" value="0">Please choose your license plate from this list...</option>
					<?
					while($row = mysql_fetch_array($vehicleresult)) {
						$licenseplate = str_replace(' ', '', $row['licenseplate']); 
						echo "<option value=". $licenseplate .">". $row['licenseplate'] ."</option>";
					}
					?>
				</select>
				
				<h3 class="geo-fail">If you see this, it's because we couldn't get your location.....</h3>				
				<select id="weather-select" name="weather-select">
					<option selected="selected" value="0">Please choose weather type...</option>
					<?
					while($row = mysql_fetch_array($weatherresult)) {						
						echo "<option value=". $row['type'] .">". $row['type'] ."</option>";
					}
					?>
				</select>
				
				<label for="streetName" class="geo-fail">Enter street name:</label>
				<input type="text" name="streetName" id="streetName" value="" data-mini="true" />
				<label for="townName" class="geo-fail">Enter town/city:</label>
				<input type="text" name="townName" id="townName" value="" data-mini="true" />
				
				<select id="country-select" name="country-select">
					<option selected="selected" value="0">Select Country</option>
					<option value="United Kingdom">United Kingdom</option> 
					<option value="United States">United States</option>					
					<option value="Afghanistan">Afghanistan</option> 
					<option value="Albania">Albania</option> 
					<option value="Algeria">Algeria</option> 
					<option value="American Samoa">American Samoa</option> 
					<option value="Andorra">Andorra</option> 
					<option value="Angola">Angola</option> 
					<option value="Anguilla">Anguilla</option> 
					<option value="Antarctica">Antarctica</option> 
					<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
					<option value="Argentina">Argentina</option> 
					<option value="Armenia">Armenia</option> 
					<option value="Aruba">Aruba</option> 
					<option value="Australia">Australia</option> 
					<option value="Austria">Austria</option> 
					<option value="Azerbaijan">Azerbaijan</option> 
					<option value="Bahamas">Bahamas</option> 
					<option value="Bahrain">Bahrain</option> 
					<option value="Bangladesh">Bangladesh</option> 
					<option value="Barbados">Barbados</option> 
					<option value="Belarus">Belarus</option> 
					<option value="Belgium">Belgium</option> 
					<option value="Belize">Belize</option> 
					<option value="Benin">Benin</option> 
					<option value="Bermuda">Bermuda</option> 
					<option value="Bhutan">Bhutan</option> 
					<option value="Bolivia">Bolivia</option> 
					<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
					<option value="Botswana">Botswana</option> 
					<option value="Bouvet Island">Bouvet Island</option> 
					<option value="Brazil">Brazil</option> 
					<option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
					<option value="Brunei Darussalam">Brunei Darussalam</option> 
					<option value="Bulgaria">Bulgaria</option> 
					<option value="Burkina Faso">Burkina Faso</option> 
					<option value="Burundi">Burundi</option> 
					<option value="Cambodia">Cambodia</option> 
					<option value="Cameroon">Cameroon</option> 
					<option value="Canada">Canada</option> 
					<option value="Cape Verde">Cape Verde</option> 
					<option value="Cayman Islands">Cayman Islands</option> 
					<option value="Central African Republic">Central African Republic</option> 
					<option value="Chad">Chad</option> 
					<option value="Chile">Chile</option> 
					<option value="China">China</option> 
					<option value="Christmas Island">Christmas Island</option> 
					<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
					<option value="Colombia">Colombia</option> 
					<option value="Comoros">Comoros</option> 
					<option value="Congo">Congo</option> 
					<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
					<option value="Cook Islands">Cook Islands</option> 
					<option value="Costa Rica">Costa Rica</option> 
					<option value="Cote D'ivoire">Cote D'ivoire</option> 
					<option value="Croatia">Croatia</option> 
					<option value="Cuba">Cuba</option> 
					<option value="Cyprus">Cyprus</option> 
					<option value="Czech Republic">Czech Republic</option> 
					<option value="Denmark">Denmark</option> 
					<option value="Djibouti">Djibouti</option> 
					<option value="Dominica">Dominica</option> 
					<option value="Dominican Republic">Dominican Republic</option> 
					<option value="Ecuador">Ecuador</option> 
					<option value="Egypt">Egypt</option> 
					<option value="El Salvador">El Salvador</option> 
					<option value="Equatorial Guinea">Equatorial Guinea</option> 
					<option value="Eritrea">Eritrea</option> 
					<option value="Estonia">Estonia</option> 
					<option value="Ethiopia">Ethiopia</option> 
					<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
					<option value="Faroe Islands">Faroe Islands</option> 
					<option value="Fiji">Fiji</option> 
					<option value="Finland">Finland</option> 
					<option value="France">France</option> 
					<option value="French Guiana">French Guiana</option> 
					<option value="French Polynesia">French Polynesia</option> 
					<option value="French Southern Territories">French Southern Territories</option> 
					<option value="Gabon">Gabon</option> 
					<option value="Gambia">Gambia</option> 
					<option value="Georgia">Georgia</option> 
					<option value="Germany">Germany</option> 
					<option value="Ghana">Ghana</option> 
					<option value="Gibraltar">Gibraltar</option> 
					<option value="Greece">Greece</option> 
					<option value="Greenland">Greenland</option> 
					<option value="Grenada">Grenada</option> 
					<option value="Guadeloupe">Guadeloupe</option> 
					<option value="Guam">Guam</option> 
					<option value="Guatemala">Guatemala</option> 
					<option value="Guinea">Guinea</option> 
					<option value="Guinea-bissau">Guinea-bissau</option> 
					<option value="Guyana">Guyana</option> 
					<option value="Haiti">Haiti</option> 
					<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
					<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
					<option value="Honduras">Honduras</option> 
					<option value="Hong Kong">Hong Kong</option> 
					<option value="Hungary">Hungary</option> 
					<option value="Iceland">Iceland</option> 
					<option value="India">India</option> 
					<option value="Indonesia">Indonesia</option> 
					<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
					<option value="Iraq">Iraq</option> 
					<option value="Ireland">Ireland</option> 
					<option value="Israel">Israel</option> 
					<option value="Italy">Italy</option> 
					<option value="Jamaica">Jamaica</option> 
					<option value="Japan">Japan</option> 
					<option value="Jordan">Jordan</option> 
					<option value="Kazakhstan">Kazakhstan</option> 
					<option value="Kenya">Kenya</option> 
					<option value="Kiribati">Kiribati</option> 
					<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
					<option value="Korea, Republic of">Korea, Republic of</option> 
					<option value="Kuwait">Kuwait</option> 
					<option value="Kyrgyzstan">Kyrgyzstan</option> 
					<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
					<option value="Latvia">Latvia</option> 
					<option value="Lebanon">Lebanon</option> 
					<option value="Lesotho">Lesotho</option> 
					<option value="Liberia">Liberia</option> 
					<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
					<option value="Liechtenstein">Liechtenstein</option> 
					<option value="Lithuania">Lithuania</option> 
					<option value="Luxembourg">Luxembourg</option> 
					<option value="Macao">Macao</option> 
					<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
					<option value="Madagascar">Madagascar</option> 
					<option value="Malawi">Malawi</option> 
					<option value="Malaysia">Malaysia</option> 
					<option value="Maldives">Maldives</option> 
					<option value="Mali">Mali</option> 
					<option value="Malta">Malta</option> 
					<option value="Marshall Islands">Marshall Islands</option> 
					<option value="Martinique">Martinique</option> 
					<option value="Mauritania">Mauritania</option> 
					<option value="Mauritius">Mauritius</option> 
					<option value="Mayotte">Mayotte</option> 
					<option value="Mexico">Mexico</option> 
					<option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
					<option value="Moldova, Republic of">Moldova, Republic of</option> 
					<option value="Monaco">Monaco</option> 
					<option value="Mongolia">Mongolia</option> 
					<option value="Montserrat">Montserrat</option> 
					<option value="Morocco">Morocco</option> 
					<option value="Mozambique">Mozambique</option> 
					<option value="Myanmar">Myanmar</option> 
					<option value="Namibia">Namibia</option> 
					<option value="Nauru">Nauru</option> 
					<option value="Nepal">Nepal</option> 
					<option value="Netherlands">Netherlands</option> 
					<option value="Netherlands Antilles">Netherlands Antilles</option> 
					<option value="New Caledonia">New Caledonia</option> 
					<option value="New Zealand">New Zealand</option> 
					<option value="Nicaragua">Nicaragua</option> 
					<option value="Niger">Niger</option> 
					<option value="Nigeria">Nigeria</option> 
					<option value="Niue">Niue</option> 
					<option value="Norfolk Island">Norfolk Island</option> 
					<option value="Northern Mariana Islands">Northern Mariana Islands</option> 
					<option value="Norway">Norway</option> 
					<option value="Oman">Oman</option> 
					<option value="Pakistan">Pakistan</option> 
					<option value="Palau">Palau</option> 
					<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
					<option value="Panama">Panama</option> 
					<option value="Papua New Guinea">Papua New Guinea</option> 
					<option value="Paraguay">Paraguay</option> 
					<option value="Peru">Peru</option> 
					<option value="Philippines">Philippines</option> 
					<option value="Pitcairn">Pitcairn</option> 
					<option value="Poland">Poland</option> 
					<option value="Portugal">Portugal</option> 
					<option value="Puerto Rico">Puerto Rico</option> 
					<option value="Qatar">Qatar</option> 
					<option value="Reunion">Reunion</option> 
					<option value="Romania">Romania</option> 
					<option value="Russian Federation">Russian Federation</option> 
					<option value="Rwanda">Rwanda</option> 
					<option value="Saint Helena">Saint Helena</option> 
					<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
					<option value="Saint Lucia">Saint Lucia</option> 
					<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
					<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
					<option value="Samoa">Samoa</option> 
					<option value="San Marino">San Marino</option> 
					<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
					<option value="Saudi Arabia">Saudi Arabia</option> 
					<option value="Senegal">Senegal</option> 
					<option value="Serbia and Montenegro">Serbia and Montenegro</option> 
					<option value="Seychelles">Seychelles</option> 
					<option value="Sierra Leone">Sierra Leone</option> 
					<option value="Singapore">Singapore</option> 
					<option value="Slovakia">Slovakia</option> 
					<option value="Slovenia">Slovenia</option> 
					<option value="Solomon Islands">Solomon Islands</option> 
					<option value="Somalia">Somalia</option> 
					<option value="South Africa">South Africa</option> 
					<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
					<option value="Spain">Spain</option> 
					<option value="Sri Lanka">Sri Lanka</option> 
					<option value="Sudan">Sudan</option> 
					<option value="Suriname">Suriname</option> 
					<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
					<option value="Swaziland">Swaziland</option> 
					<option value="Sweden">Sweden</option> 
					<option value="Switzerland">Switzerland</option> 
					<option value="Syrian Arab Republic">Syrian Arab Republic</option> 
					<option value="Taiwan, Province of China">Taiwan, Province of China</option> 
					<option value="Tajikistan">Tajikistan</option> 
					<option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
					<option value="Thailand">Thailand</option> 
					<option value="Timor-leste">Timor-leste</option> 
					<option value="Togo">Togo</option> 
					<option value="Tokelau">Tokelau</option> 
					<option value="Tonga">Tonga</option> 
					<option value="Trinidad and Tobago">Trinidad and Tobago</option> 
					<option value="Tunisia">Tunisia</option> 
					<option value="Turkey">Turkey</option> 
					<option value="Turkmenistan">Turkmenistan</option> 
					<option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
					<option value="Tuvalu">Tuvalu</option> 
					<option value="Uganda">Uganda</option> 
					<option value="Ukraine">Ukraine</option> 
					<option value="United Arab Emirates">United Arab Emirates</option> 
					<option value="United Kingdom">United Kingdom</option> 
					<option value="United States">United States</option> 
					<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
					<option value="Uruguay">Uruguay</option> 
					<option value="Uzbekistan">Uzbekistan</option> 
					<option value="Vanuatu">Vanuatu</option> 
					<option value="Venezuela">Venezuela</option> 
					<option value="Viet Nam">Viet Nam</option> 
					<option value="Virgin Islands, British">Virgin Islands, British</option> 
					<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
					<option value="Wallis and Futuna">Wallis and Futuna</option> 
					<option value="Western Sahara">Western Sahara</option> 
					<option value="Yemen">Yemen</option> 
					<option value="Zambia">Zambia</option> 
					<option value="Zimbabwe">Zimbabwe</option>
				</select>
				
				<input type="hidden" value="" id="location-status" name="location-status" />
				<input type="hidden" value="" id="geolocation" name="geolocation" />
				<input type="hidden" value="" id="weather-status" name="weather-status" />
				<input type="hidden" value="" id="temperature" name="temperature" />				
				<input type="hidden" value="" id="weather" name="weather" />
				<input type="hidden" value="" id="wind" name="wind" />
				<input type="hidden" value="" id="visibility" name="visibility" />
				<input type="hidden" value="" id="image" name="image" />
				<input type="hidden" value="" id="imagealt" name="imagealt" />
				<input type="hidden" value="<?=$companyid;?>" id="companyid" name="companyid" />	
				<input type="hidden" value="<?=$driverid;?>" id="driver-select" name="driver-select" />
				
				<a href="#three" class="prev data-store" data-inline="true" data-role="button" data-icon="back" data-transition="none" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span">Back</a>
				<button type="submit" class="next data-store" data-inline="true" data-icon="gear" aria-disabled="false">Log App-cident</button>
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
			<a href="#" class="home" data-icon="home" data-transition="none" data-iconpos="notext" data-direction="reverse" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Home">Home</a>
			<h1>App-cident</h1>
			<a href="http://app-cident.com/help.php" target="_blank" data-icon="info" data-iconpos="notext" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" title="Help">Help</a>
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