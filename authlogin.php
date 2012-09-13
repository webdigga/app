<?

include('dbconnect.php');
session_start();

if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE username='".$_POST["username"]."' and password='".$_POST["password"]."'"))==1){
   $_SESSION['username'] = $_POST["username"]; //Create the session
   $_SESSION['company'] = $_POST["company"];
   header("location:/index.php");
}
else {		
	header("location:/index.php?error=1");
}

?>