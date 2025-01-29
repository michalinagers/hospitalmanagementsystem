<?php require("NavBar.html");
include("session2.php");
$path = checkSession();

$path = "patientLogin.php"; //this path is to pass to checkSession function from session.php 

session_start(); //must start a session in order to use session in this page.
if (!isset($_SESSION['name'])){
session_unset();
session_destroy();
header("Location:".$path);//return to the login page }
$user = $_SESSION['patient_fname']; //this value is obtained from the login page when the user is verified
$userID = $_SESSION['patient_id']; //this value is obtained from the login page when the user is verified
checkSession ($path); //calling the function from session.php
}
?>
