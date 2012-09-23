<?php

// includes
include('dbconnect.php');
require_once('class.phpmailer.php');
include("class.smtp.php");

/*
echo '<pre>';
print_r($_FILES);
echo  '</pre>';

echo '<pre>';
print_r($_POST);
echo  '</pre>';
*/

//files
$uploaded = 0;
$message = array();  
foreach ($_FILES['file']['name'] as $i => $name) {
	if ($_FILES['file']['error'][$i] == 4) {
		continue; 
	}   
	if ($_FILES['file']['error'][$i] == 0) {	   
		if ($_FILES['file']['size'][$i] > 99439443) {		
			$message[] = "$name exceeded file limit.";
			continue;  
		}	
	//* Check File Extension
	if (($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/pjpeg")) {
		$message[] = "Incorrect File Type.";
		continue;
	}	
	//* Move  File           
	move_uploaded_file($_FILES["file"]["tmp_name"][$uploaded], "images/appcidents/" . date('Y_m_d_H_i_s_').  $uploaded . $_FILES["file"]["name"][$uploaded]); 		
		$uploaded++;
	}
}
//echo $uploaded . ' files uploaded.';
foreach ($message as $error) {
  echo $error;
}

// set the variables
$name=$_POST['driver-select'];
$name=ucwords($name);
$nameresult = mysql_query("SELECT * FROM driver WHERE id = $name");
while($row = mysql_fetch_array($nameresult)) {
	$name=$row['name'];
	$phoneNumber=$row['phonenumber'];
}
$licensePlateNumber=$_POST['vehicle-select'];
$message=$_POST['message'];
$message = stripslashes($message);
$message = mysql_real_escape_string($message);
$tpName=$_POST['tpName'];
$tpPneNumber=$_POST['tpPneNumber'];
$tpLicensePlateNumber=$_POST['tpLicensePlateNumber'];
$tpMake=$_POST['tpMake'];
$tpModel=$_POST['tpModel'];
$driverid=$_POST['driver-select'];
$vehicleid=$_POST['vehicle-select'];
$geolocation=$_POST['geolocation'];
$temperature=$_POST['temperature'];
$weather=$_POST['weather'];
$wind=$_POST['wind'];
$visibility=$_POST['visibility'];
$image=$_POST['image'];
$imagealt=$_POST['imagealt'];
$companyid=$_POST['companyid'];

// prepare the mail
$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSMTP(); // telling the class to use SMTP

try {
  $mail->Host       = "mail.yourdomain.com"; // SMTP server
  $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "webdigga42@gmail.com";  // GMAIL username
  $mail->Password   = "answer42assasin";            // GMAIL password
  $mail->AddReplyTo('webdigga42@gmail.com', 'Appcident Info');
  $mail->AddAddress('webdigga42@gmail.com', 'David White');
	$mail->AddAddress('adam.coogan@gmail.com', 'Adam Coogan');
	$mail->AddAddress('jonnyrowse@hotmail.com', 'Jonny Rowse');
  $mail->SetFrom('webdigga42@gmail.com', 'Appcident Info');
  $mail->AddReplyTo('webdigga42@gmail.com', 'Appcident Info');
  $mail->Subject = 'Appcident info';  
  $mail->Body = "Dear Appcident Admin,\r\n\r\nAn accident has been logged by ".$name.", driving vehicle registered:- ".$licensePlateNumber.".\r\nThe driver can be contacted on:- ".$phoneNumber.".\r\nBelow are the details of the accident.\r\n\r\nEvent:- ".$message."\r\n\r\nThird Party Details:-\r\n\r\nName: ".$tpName."\r\nPhone Number: ".$tpPneNumber."\r\nLicense Plate Number: ".$tpLicensePlateNumber."\r\nMake: ".$tpMake."\r\nModel: ".$tpModel."\r\n\r\n";
  
	
	// DO THE INSERTS
	// insert 3rd party details
  mysql_query("INSERT INTO thirdparty (name, phonenumber) VALUES ('$tpName', '$tpPneNumber')");
  $tpdriverid = mysql_insert_id();
  // insert 3rd party vehicle
  mysql_query("INSERT INTO thirdpartyvehicle (id, licenseplate, make, model) VALUES ('$tpdriverid', '$tpLicensePlateNumber', '$tpMake', '$tpModel')");
  $tpvehicleid = mysql_insert_id(); 
  // insert accident details
  $accidentSql = "INSERT INTO accident (driverid, thirdpartyid, vehiclelicenseplate, thirdpartylicenseplate, location, description, companyid) VALUES ('$driverid', '$tpdriverid', '$vehicleid', '$tpLicensePlateNumber', '$geolocation', '$message', $companyid)";	
	mysql_query($accidentSql);
  $accidentid = mysql_insert_id();
  // insert images details and attach
	$uploaded = 0;
	foreach ($_FILES['file']['name'] as $i => $name) {  
		$imageSource = "images/appcidents/" . date('Y_m_d_H_i_s_'). $uploaded . $_FILES["file"]["name"][$uploaded]; 
		$mail->AddAttachment($imageSource);
		mysql_query("INSERT INTO images (accidentid, imagelocation) VALUES ('$accidentid', '$imageSource')");
		$uploaded++;
	} 
  // insert further action record ready for adding notes
  mysql_query("INSERT INTO furtheraction (accidentid, statusid) VALUES ('$accidentid', '1')");  
  // insert weather details
  mysql_query("INSERT INTO weather (id, temperature, weather, wind, visibility, image, imagealt) VALUES ('$accidentid', '$temperature', '$weather', '$wind', '$visibility', '$image', '$imagealt')");
  
	// send the mail
  $mail->Send();

// output any error messages
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
?>

<!DOCTYPE html> 
<html> 
	<head> 
	<title>App-cident</title> 
	<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/main.css" />		
	<link rel="stylesheet" href="/css/dhl.css" />
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile.structure-1.1.1.min.css" /> 
  <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script> 
	<script src="/js/main.js"></script>
  <script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
</head> 
<body>	
	<div data-role="page" id="login">
		<div data-role="header">			
			<h1>APP-CIDENT</h1>			
		</div>
		<div data-role="content">	
			<h2>Accident has been logged.....</h2>
			<p>You have successfully logged an accident with <?=$uploaded;?> files uploaded. The accident id is <?=$accidentid;?></p>
			<h3>Next Steps.....</h3>
			<ul>
				<li>Note down the accident id above</li>
				<li>Report into base at the earliest convenience to discuss the accident</li>
			</ul>
		</div>
	</div>
</body>
</html>