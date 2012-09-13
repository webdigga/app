<?php
session_start();
session_destroy(); //Delete session
header("location:index.php");
?>