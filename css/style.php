<? 
header("Content-type: text/css; charset: UTF-8");
session_start();
include('../dbconnect.php');
$sessusercss = $_SESSION['username'];
$companyidresultcss = mysql_query("SELECT companyid FROM users WHERE username = '$sessusercss'");

while($rowcss = mysql_fetch_array($companyidresultcss)) {
	$companyidcss = $rowcss['companyid'];
	switch ($companyidcss) {		
		case 2:
			$cssImport = "@import url(\"dhl.css\");";
			break;
		case 3:
			$cssImport = "@import url(\"demo.css\");";
			break;	
	}	
}
echo $cssImport;
?>




article, aside, details, figcaption, figure, footer, header, hgroup, nav, section { display: block; }
audio, canvas, video { display: inline-block; *display: inline; *zoom: 1; }
audio:not([controls]) { display: none; }
[hidden] { display: none; }
html { font-size: 100%; overflow-y: scroll; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
body { margin: 0; font-size: 13px; line-height: 1.231; }
body, button, input, select, textarea { font-family: trebuchet ms; }
::-moz-selection { background: #fe57a1; color: #fff; text-shadow: none; }
::selection { background: #fe57a1; color: #fff; text-shadow: none; }
a { color: #00e; }
a:visited { color: #551a8b; }
a:hover { color: #06e; }
a:focus { outline: thin dotted; }
a:hover, a:active { outline: 0; }
abbr[title] { border-bottom: 1px dotted; }
b, strong { font-weight: bold; }
blockquote { margin: 1em 40px; }
dfn { font-style: italic; }
hr { display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0; }
ins { background: #ff9; color: #000; text-decoration: none; }
mark { background: #ff0; color: #000; font-style: italic; font-weight: bold; }
pre, code, kbd, samp { font-family: monospace, serif; _font-family: 'courier new', monospace; font-size: 1em; }
pre { white-space: pre; white-space: pre-wrap; word-wrap: break-word; }
q { quotes: none; }
q:before, q:after { content: ""; content: none; }
small { font-size: 85%; }
sub, sup { font-size: 75%; line-height: 0; position: relative; vertical-align: baseline; }
sup { top: -0.5em; }
sub { bottom: -0.25em; }
ul, ol { margin: 1em 0; padding: 0 0 0 40px; }
dd { margin: 0 0 0 40px; }
nav ul, nav ol { list-style: none; list-style-image: none; margin: 0; padding: 0; }
img { border: 0; -ms-interpolation-mode: bicubic; vertical-align: middle; }
svg:not(:root) { overflow: hidden; }
figure { margin: 0; }
form { margin: 0; }
fieldset { border: 0; margin: 0; padding: 0; }
legend { border: 0; *margin-left: -7px; padding: 0; }
button, input, select, textarea { font-size: 100%; margin: 0; vertical-align: baseline; *vertical-align: middle; }
button, input { line-height: normal; *overflow: visible; }
table button, table input { *overflow: auto; }
button, input[type="button"], input[type="reset"], input[type="submit"], [role="button"] { cursor: pointer; -webkit-appearance: button; }
input[type="checkbox"], input[type="radio"] { box-sizing: border-box; padding: 0; }
input[type="search"] { -webkit-appearance: textfield; -moz-box-sizing: content-box; -webkit-box-sizing: content-box; box-sizing: content-box; }
input[type="search"]::-webkit-search-decoration { -webkit-appearance: none; }
button::-moz-focus-inner, input::-moz-focus-inner { border: 0; padding: 0; }
textarea { overflow: auto; vertical-align: top; resize: vertical; }
input:valid, textarea:valid {  }
input:invalid, textarea:invalid { background-color: #f0dddd; }
table { border-collapse: collapse; border-spacing: 0; }
td { vertical-align: top; }
@media only screen and (min-width: 800px) {

}/*/mediaquery*/
@media
only screen and (-webkit-min-device-pixel-ratio: 1.5),
only screen and (-o-min-device-pixel-ratio: 3/2),
only screen and (min--moz-device-pixel-ratio: 1.5),
only screen and (min-device-pixel-ratio: 1.5) {
}
.nocallout {-webkit-touch-callout: none;}
.ellipsis {
 text-overflow: ellipsis;
 overflow: hidden;
 white-space: nowrap;
}
textarea[contenteditable] {-webkit-appearance: none;}
.gifhidden {position: absolute; left: -100%;}
.ir { display: block; border: 0; text-indent: -999em; overflow: hidden; background-color: transparent; background-repeat: no-repeat; text-align: left; direction: ltr; }
.ir br { display: none; }
.hidden { display: none !important; visibility: hidden; }
.visuallyhidden { border: 0; clip: rect(0 0 0 0); height: 1px; margin: -1px; overflow: hidden; padding: 0; position: absolute; width: 1px; }
.visuallyhidden.focusable:active, .visuallyhidden.focusable:focus { clip: auto; height: auto; margin: 0; overflow: visible; position: static; width: auto; }
.invisible { visibility: hidden; }
.clearfix:before, .clearfix:after { content: ""; display: table; }
.clearfix:after { clear: both; }
.clearfix { *zoom: 1; }
@media print {
* { background: transparent !important; color: black !important; text-shadow: none !important; filter:none !important; -ms-filter: none !important; } /* Black prints faster: h5bp.com/s */
a, a:visited { text-decoration: underline; }
a[href]:after { content: " (" attr(href) ")"; }
abbr[title]:after { content: " (" attr(title) ")"; }
.ir a:after, a[href^="javascript:"]:after, a[href^="#"]:after { content: ""; }  
pre, blockquote { border: 1px solid #999; page-break-inside: avoid; }
thead { display: table-header-group; } 
tr, img { page-break-inside: avoid; }
img { max-width: 100% !important; }
@page { margin: 0.5cm; }
p, h2, h3 { orphans: 3; widows: 3; }
h2, h3 { page-break-after: avoid; }
}
body {
 overflow:hidden;
}
#container {
 width: 400%; 
 margin: 10px auto;
 padding: 10px 0; 
 border: 1px solid #e1e1e1;
 position: relative;
 -moz-box-shadow: 0px 0px 8px #444;
 -webkit-box-shadow: 0px 0px 8px #444; 
 filter:  progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#013066', endColorstr='#076EA9'); /* IE6 & IE7 */
 -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#013066', endColorstr='#076EA9')"; 
}
#container select {
 width:100%;
 margin-bottom:10px;
 color:#000;
}
#container header img {
 float:right;
}
#main {
 clear:left; 
}
h1 { 
 text-align: left;  
 width: auto;
 height:50px;
 float:left;
 width:50%;
}
h2 {
 font-size: 1em; 
 text-transform: uppercase;
 text-align: left; 
 margin: 0 0 18px; 
}
.formSectionOne label, .formSectionTwo label, .formSectionFour label { 
 clear: left; 
 margin: 0; 
 width: 100%;
 text-align: left; 
 font-size: 1em; 
 color: #445668; 
 text-transform: uppercase; 
 text-shadow: 0px 1px 0px #f2f2f2;
 /* switch off labels */
 display:none;
}
.formSectionThree label {
 display: block;
 float: left;
 height: 20px;
 line-height: 1.5em; 
}
input:not([type=file]) {
 width: 100%; 
 height: 30px; 
 margin: 0 0 5px; 
 background: #fff;
 border-radius: 5px; -moz-border-radius: 5px; 
 -webkit-border-radius: 5px; 
 font-size: 0.9em; 
 text-transform: uppercase;
 text-indent: 5px;
 color:#000;
}
input[type=checkbox] {
 clear: left;
 float: left;
 height: 20px;
 width: 50px;
}
input[type=checkbox].error + label {
 color:red;
}
textarea {
 width: 100%; 
 height: 170px; 
 margin: 0 0 5px; 
 background: #fff; 
 border-radius: 5px; -moz-border-radius: 5px; 
 -webkit-border-radius: 5px; 
 font-size: 0.9em; 
 text-transform: uppercase;
 text-indent: 5px;
 line-height: 2.5em;
 color:#000;
}
textarea.error::-webkit-input-placeholder  {
 color:red !important;  
}
textarea.error:-moz-placeholder {
 color:red !important;  
}
.error { 
 border: 2px solid red !important; 
}
input:focus, textarea:focus {
 background:#e0e0e0;
 color:#000;
}
.mailSubmit {
 width: 100px;  
 float: right; 
 padding: 5px 5px; 
 margin: 10px 0;
 -moz-box-shadow: 0px 0px 5px #999;
 -webkit-box-shadow: 0px 0px 5px #999;
 border: 1px solid #556f8c; 
 cursor: pointer;
 text-align:center;
 text-transform:uppercase; 
}
input[type=submit] { 
 text-indent: 0;
 width: auto;
}
input[type=file] {
 margin-bottom: 10px;
 -moz-box-shadow: 0px 0px 5px #999;
 -webkit-box-shadow: 0px 0px 5px #999;
 border: 1px solid #556f8c;
 background: #fff;
 color:#000;
 float:left;
 clear:left;
}
footer {	
	text-align:right; 
	color: black;	
	clear: left;
	margin: 3px auto;	
	font-style: italic;	
}
.error::-webkit-input-placeholder  {
 color:red !important;  
}
.error:-moz-placeholder {
 color:red !important;  
}
.formSectionOne, .formSectionTwo, .formSectionThree, .formSectionFour, .formSectionFive {
 margin: 0 auto;
 width: 25%;
 float: left;
 position:relative;
}
.container-padding {
 padding: 0 5%;
}
.add-photo, .remove-photo {
 padding-left:10px;
 font-size:1.5em;
 cursor:pointer;
}
.photo-upload-note {
 margin-bottom:5px;
}
.formSection img {
 position: absolute;
 top: -70px;
 right: 10px;
}
.formSectionFive img {
 position: absolute;
 top: -13px;
 right: 10px;
}
.ui-select div > .ui-btn-inner, .ui-submit .ui-btn-inner {
 display: none;
}
.photo-alert {
 margin-bottom:5px;
}

/* traffic lights */
.traffic-lights { 
 overflow: hidden;
 padding: 5px;
 width: 112px;
 border-radius: 5px;
 -moz-border-radius: 5px; 
 background-color: #545252; 
 position: absolute;
 top: -62px;
 left: 10px;
}
.light-holder {
 width:20px;
 height:20px;
 margin: 0 2px;
 float:left;
 -moz-border-radius: 15px;
 border-radius: 15px;
 border: 2px solid #3B3B3E;
 position:relative; 
}
.red {
 background-color:red;
}
.green {
 background-color:#5de755;
}
.amber {
 background-color:#fdd704;
}
.light {
 background-position: 70% 30%; 
 background-repeat: no-repeat;
 position: absolute;
 left: 0;
 top: 0;
 width: 20px;
 height: 20px;
 -moz-border-radius: 15px;
 border-radius: 15px;
 text-align: center;
 line-height: 1.6em;
 font-weight: bold;
 color: black;
}
.red-light {
 background: -webkit-gradient(radial, 70% 30%, 0, 80% 40%, 100, from(white), to(red));
 background: -webkit-radial-gradient(70% 30%, closest-corner, white, red);
 background: -moz-radial-gradient(70% 30%, closest-corner, white, red);
 background: -ms-radial-gradient(70% 30%, closest-corner, white, white);
}
.green-light {
 background: -webkit-gradient(radial, 70% 30%, 0, 80% 40%, 100, from(white), to(#5de755));
 background: -webkit-radial-gradient(70% 30%, closest-corner, white, #5de755);
 background: -moz-radial-gradient(70% 30%, closest-corner, white, #5de755);
 background: -ms-radial-gradient(70% 30%, closest-corner, white, #5de755); 
}
.amber-light { 
 background: -webkit-gradient(radial, 70% 30%, 0, 80% 40%, 100, from(white), to(#fdd704));
 background: -webkit-radial-gradient(70% 30%, closest-corner, white, #fdd704);
 background: -moz-radial-gradient(70% 30%, closest-corner, white, #fdd704);
 background: -ms-radial-gradient(70% 30%, closest-corner, white, #fdd704); 
}
.steps {
 text-align: center;
 font-style: italic;
 line-height: 25px;
 height: 10px;
 clear: left;
}
.light-selected {
 border: 2px solid #fff;
}

/* success page */
.success-message {
	overflow:hidden;
}

/* login */
#login-container {
	margin: 0 auto;
	padding-top: 30px;
	width: 100%;
	color: black;
}
#login {
	border: 1px solid #CCC;
	height: 250px;
	overflow: hidden;
	position: relative;
	width: 100%;
	border-radius: 10px;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;	
}
.alpha-layer {
	background: none repeat scroll 0 0 black;
	height: 250px;
	opacity: 0.25;
	width: 100%;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
}
#login form {
	left: 1%;
	position: absolute;
	top: 12%;
	width: 97%;
}
#login-container + footer {
 color:#000;
 width:600px;
}
#login input[type="submit"] {
	float: right;
	margin-right: 9px !important;
	width: 50%;
}

#login form input[type="submit"], .register form input[type="submit"], .add-driver form input[type="submit"] {
 margin:20px 0;
}
#login form .error-message, .register form .error-message, .add-driver form .error-message {
 color:red;
 clear:both;
}
#login label, #login input { 
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border: 2px solid transparent;
}

/* logout */
.logout {
	float: right;
	font-size: 1.5em;
}