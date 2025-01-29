<?php require("NavBar.html");
include_once("functions.php");
$addressDelete = deleteAddress();
?>

<div class="container">"
	<main role="main">
		<h1><img src="https://i.postimg.cc/mk2WNqnR/Update-Address-9.jpg" alt="Enigma"></h1>
		<h2>Are you sure you want to delete this address?</h2>

		<div class="update">
			<label>House Number:</label>
			<?php echo $addressDelete[0][0] ?>
			<br>
			<br>
			<label>Postcode:</label>
			<?php echo $addressDelete[0][1] ?>
			<br>
			<br>
			<label>County:</label>
			<?php echo $addressDelete[0][2] ?>
			<br>
			<br>
			<label>City:</label>
			<?php echo $addressDelete[0][3] ?>

			<form method="post">

				<form method="post">
					<input type="hidden" name="address_id" value="<?php echo $_GET['address_id'] ?>">
					<br>
					<input type="submit" value="Delete" name="delete">
					<br>
					<br>
					<div class="updatebutton"><a href="viewEmployees.php">Back</a>
				</form>
	</main>
</div>

<?php require("Footer.html"); ?>