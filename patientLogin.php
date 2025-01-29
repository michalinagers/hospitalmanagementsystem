<?php require("NavBar.html");
include_once("functions.php");
require_once("checkPatientLogin.php");
$nameErr = $pwderr = $invalidMesg = "";



if (isset($_POST['submit'])) {

  if ($_POST["pemail"] == "") {
    $nameErr = "Email is required";
  }

  if ($_POST["ppasword"] == null) {
    $pwderr = "Password is required";
  }

  if ($_POST['pemail'] != null && $_POST["ppasword"] != null) {
    $array_user = verifyUsers(); //calling this function from SelectUser.php. The function returns an array
    if ($array_user != null) {


      if ($array_user[0]['Role'] == "patients") {
        session_start();
        $_SESSION['name'] = $array_user[0]['patient_fname'];
        $_SESSION['stdID'] = $array_user[0]['patient_id'];

        header("Location: userIndex.php");
        exit();
      }

      if ($array_user[0]['Role'] == "staff") //if the user is admin, this message will be prompted
      {
        $invalidMesg = "This page is for staff login";
      }
    } else {
      $invalidMesg = "Invalid email and password!";
    }
  }
}
?>

<h1><img src="https://i.postimg.cc/15tpqdV5/Project-2.jpg" alt="Hospital"></h1>
<p class="title">Login as Patient</p>

<div class="mainlogin">
</div>

<div class="loginform">



  <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
    <label for="email">Email <span class="required">*</span></label><br>
    <input type="email" id="email" name="email" required><br>
    <label for="pwd">Password <span class="required">*</span></label><br>
    <input type="password" id="pwd" name="pwd" required><br>
    <input type="submit" value="Login">
  </form>
</div>

<?php require("Footer.html"); ?>