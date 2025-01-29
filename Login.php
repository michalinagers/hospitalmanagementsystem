<?php require("NavBar.html");
include_once("functions.php");
$login = userLogin();
?>

<div class="container">
	<main role="main">

		<style>


		</style>
		<div class="login">


			<form action="EnigmaMenu.php" method="post">

				<h1><img src="https://i.postimg.cc/Gm1BB3gW/Login-5.jpg" alt="EnigmaEmployee"></h1>

				<input type="text" placeholder="e-mail">

				<input type="password" placeholder="password">

				<input type="submit" value="Login">


			</form>

		</div>
	</main>


	<?php require("Footer.html"); ?>