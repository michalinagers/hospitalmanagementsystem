<?php
require("NavBar.html");

if (isset($_POST['submit'])) {
    $newfname = $_POST['fname'];
    $newmname = $_POST['mname'];
    $newlname = $_POST['lname'];
    $newemail = $_POST['email'];
    $newphone = $_POST['phone'];
    $newdob = $_POST['dob'];
    $newpassword = $_POST['pwd'];

    //Checks if there is an address ID which has been set
    $newaddress = isset($_POST['add']) ? intval($_POST['add']) : null;

    //if address ID is null, gets the next available ID in database
    if ($newaddress === null) {
        $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
        $newaddress = getNextAddressIdWithLock($db);
    }

    $result = createProfile($newfname, $newmname, $newlname, $newemail, $newphone, $newdob, $newpassword, $newaddress);

    //If successful, get a message but also notify user if not successful
    if ($result) {
        echo "<script>alert('Profile created successfully! You can now log in.');</script>";
        echo "<script>window.location.href='patientLogin2.php';</script>";
    } else {
        echo "<script>alert('Error creating profile. Please try again.');</script>";
    }
}

function createProfile($newfname, $newmname, $newlname, $newemail, $newphone, $newdob, $newpassword, $newaddress) {

  //Database connection
  $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

  //SQL statement
  $stmt = $db->prepare('INSERT INTO patients (patient_fname, patient_mname, patient_lname, patient_email, patient_phone, patient_dob, patient_password, address_id) VALUES (:patfname, :patmname, :patlname, :patemail, :patphone, :patdob, :patpassword, :pataddress)');

  //Bind parameters
  $stmt->bindParam(':patfname', $newfname, SQLITE3_TEXT);
  $stmt->bindParam(':patmname', $newmname, SQLITE3_TEXT);
  $stmt->bindParam(':patlname', $newlname, SQLITE3_TEXT);
  $stmt->bindParam(':patemail', $newemail, SQLITE3_TEXT);
  $stmt->bindParam(':patphone', $newphone, SQLITE3_TEXT);
  $stmt->bindParam(':patdob', $newdob, SQLITE3_TEXT);
  $stmt->bindParam(':patpassword', $newpassword, SQLITE3_TEXT);
  $stmt->bindParam(':pataddress', $newaddress, SQLITE3_INTEGER);

  $result = $stmt->execute();
  
  //Checks if there are errors
  if ($result) {
      return true;
  } else {
      return false;
  }
}

function getNextAddressIdWithLock($db) {
  $db->exec("BEGIN EXCLUSIVE TRANSACTION");
  $stmt = $db->prepare("SELECT IFNULL(MAX(address_id), 0) + 1 AS next_id FROM address");
  $result = $stmt->execute();
  $row = $result->fetchArray(SQLITE3_ASSOC);
  $next_id = $row['next_id'];
  $db->exec("END TRANSACTION");
  return $next_id;
}

?>


<h1><img src="https://i.postimg.cc/15tpqdV5/Project-2.jpg" alt="Hospital" width="80" height="80"></h1>
<p class="titleProfile">Create Profile</p>

<div class="mainlogin">
    
</div>

<div class="createprofileform">
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <label for="fname">First Name <span class="required">*</span></label><br>
  <input type="fname" id="fname" name="fname" required><br>
  <label for="mname">Middle Name </label><br>
  <input type="mname" id="mname" name="mname" required><br>
  <label for="lname">Last Name <span class="required">*</span></label><br>
  <input type="lname" id="lname" name="lname" required><br>
    <label for="email">Email <span class="required">*</span></label><br>
    <input type="email" id="email" name="email" required><br>
    <label for="phone">Phone Number <span class="required">*</span></label><br>
    <input type="phone" id="phone" name="phone" required><br>
    <label for="dob">Date of Birth (DD/MM/YY) <span class="required">*</span></label><br>
    <input type="dob" id="dob" name="dob" required><br>
    <label for="pwd">Password <span class="required">*</span></label><br>
    <input type="password" id="pwd" name="pwd" required><br>



    <input type="submit" value="Create" name="submit">

    <button type="button" class="backProfile1" onclick="location.href='Home.php'">Back</button>
  </form>
</div>

