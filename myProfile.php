<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header('Location: patientLogin.php');
    exit;
}

require ("NavBar.html");

?>
<?php
function getUserById($id)
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    $stmt = $db->prepare("SELECT patients.patient_id, patients.patient_fname, patients.patient_mname, patients.patient_lname, address.address_id, patients.patient_phone, patients.patient_email, address.house_num, address.postcode, address.county, address.city, patients.patient_dob  FROM patients 
    INNER JOIN address ON (address.address_id = patients.address_id) WHERE patients.patient_id = :patientid");
    $stmt->bindParam(':patientid', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $user = $result->fetchArray();
    return $user;
    
}

$user = getUserById($_SESSION['patient_id']);
?>

<div class="mainlogin">
<link rel="stylesheet" href="profile.css"/>
    <h1><img src="https://i.postimg.cc/RVjzqQzb/user-128.png" alt="Profile" class="profile-image" width="120"
            height="120"></h1>
    <div class="myProfile2">
        <h1>Welcome,
            <?php echo $user['patient_fname'] . ' ' . $user['patient_mname'] . ' ' . $user['patient_lname']; ?>
        </h1>
    </div>
    <div class="myProfile">
        </br>
        <p class="Myprofile3">Email:</p>


        <p class="Myprofile3">Phone Number:</p>

        <p class="Myprofile3">Address:</p>

        <p class="Myprofile3">DOB (DD-MM-YY):</p>

    </div>

    <div class="patientInfo">
        <p>
            <?php echo $user['patient_email']; ?>
        </p>
        </br>
        <p>
            <?php echo $user['patient_phone']; ?>
        </p>
        </br>
        <p>
            <?php echo $user['house_num'] . ', ' . $user['postcode'] . ', ' . $user['county'] . ', ' . $user['city']; ?>
        </p>
        </br>
        <p>
            <?php echo $user['patient_dob']; ?>
        </p>
</div>
<!--
<button type="button" class="backProfile" onclick="location.href='myProfileUpdate.php'">Update</button>
-->
    <button type="button" class="backProfile" onclick="location.href='patientMainpage.php'">Back</button>
  


