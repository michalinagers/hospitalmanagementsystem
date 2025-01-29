<?php require("NavBar.html");?>


<?php
if (isset($_SESSION["success_message"])) {
	echo "<p>" . $_SESSION["success_message"] . "</p>";
	unset($_SESSION["success_message"]);
}
?>

		
		<h1><img src="https://i.postimg.cc/15tpqdV5/Project-2.jpg" alt="Hospital"></h1>

		<p class="title">Hospital Management System</p>


<div class="mainlogin">

<button type="button" class="loginCreate" onclick="location.href='createProfile.php'">Create Profile</button>
<button type="button" class="loginCreate" onclick="location.href='patientLogin2.php'">Patient Login</button>
<button type="button" class="loginCreate" onclick="location.href='hstaffLogin.php'">Staff Login</button>
<button type="button" class="loginCreate" onclick="location.href='staffLogin2.php'">Clinician Login</button>
<button type="button" class="loginCreate" onclick="location.href='adminLogin.php'">Admin Login</button>






</div>


<?php require("Footer.html"); ?>