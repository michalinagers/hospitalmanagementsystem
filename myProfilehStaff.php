<?php
session_start();
if (!isset($_SESSION['hstaff_id'])) {
    header('Location: hstaffLogin.php');
    exit;
}

require("NavBar.html");

?>
<?php
function getUserById($id)
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    //SQL statement to get staff details
    $stmt = $db->prepare("SELECT hospitalstaff.hstaff_id, hospitalstaff.hstaff_fname, hospitalstaff.hstaff_mname, hospitalstaff.hstaff_lname, address.address_id, hospitalstaff.hstaff_phone, hospitalstaff.hstaff_email, address.house_num, address.postcode, address.county, address.city, hospitalstaff.hstaff_dob  FROM hospitalstaff 
    INNER JOIN address ON (address.address_id = hospitalstaff.address_id) WHERE hospitalstaff.hstaff_id = :hstaffid");
    $stmt->bindParam(':hstaffid', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $user = $result->fetchArray();
    return $user;
}
//Takes the hstaff_id that is logged in and displays their details 
$user = getUserById($_SESSION['hstaff_id']);
?>

<div class="mainlogin">
<link rel="stylesheet" href="profileHStaff.css"/>
    <h1><img src="https://i.postimg.cc/RVjzqQzb/user-128.png" alt="Profile" class="profile-image" width="120"
            height="120"></h1>
    <div class="myProfile2">
        <h1>Welcome,
            <?php echo $user['hstaff_fname'] . ' ' . $user['hstaff_mname'] . ' ' . $user['hstaff_lname']; ?>
        </h1>
    </div>
    <div class="myProfile">
        </br>
        <p class="Myprofile3">Email:</p>


        <p class="Myprofile3">Phone:</p>

        <p class="Myprofile3">Address:</p>

        <p class="Myprofile3">Phone Number:</p>

    </div>

    <div class="patientInfo">
        <p>
            <?php echo $user['hstaff_email']; ?>
        </p>
        </br>
        <p>
            <?php echo $user['hstaff_phone']; ?>
        </p>
        </br>
        <p>
            <?php echo $user['house_num'] . ', ' . $user['postcode'] . ', ' . $user['county'] . ', ' . $user['city']; ?>
        </p>
        </br>
        <p>
            <?php echo $user['hstaff_dob']; ?>
        </p>
</div>

    <button type="button" class="backProfile" onclick="location.href='hstaffMainpage.php'">Back</button>

