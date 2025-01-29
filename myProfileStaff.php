<?php
session_start();
if (!isset($_SESSION['staff_id'])) {
    header('Location: staffLogin.php');
    exit;
}

require("NavBar.html");

?>
<?php
function getStaffById($staffid)
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    $stmt = $db->prepare("SELECT staff.staff_id, staff.staff_fname, staff.staff_mname, staff.staff_lname, address.address_id, staff.staff_phone, staff.staff_email, address.house_num, address.postcode, address.county, address.city, staff.staff_dob  FROM staff
    INNER JOIN address ON (address.address_id = staff.address_id) WHERE staff.staff_id = :staffid");
    $stmt->bindParam(':staffid', $staffid, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $userstaff = $result->fetchArray();
    return $userstaff;
}

$userstaff = getStaffById($_SESSION['staff_id']);
?>
<div class="mainlogin">
<link rel="stylesheet" href="profileStaff.css"/>
    <h1><img src="https://i.postimg.cc/RVjzqQzb/user-128.png" alt="Profile" class="profile-image" width="120"
            height="120"></h1>
    <div class="myProfile2">
        <h1>Welcome,
            <?php echo $userstaff['staff_fname'] . ' ' . $userstaff['staff_mname'] . ' ' . $userstaff['staff_lname']; ?>
        </h1>
    </div>
    <div class="myProfile">
        </br>
        <p class="Myprofile3">Email:</p>


        <p class="Myprofile3">Phone:</p>

        <p class="Myprofile3">Address:</p>

        <p class="Myprofile3">Phone Number:</p>

    </div>

    <div class="staffInfo">
        <p>
            <?php echo $userstaff['staff_email']; ?>
        </p>
        </br>
        <p>
            <?php echo $userstaff['staff_phone']; ?>
        </p>
        </br>
        <p>
            <?php echo $userstaff['house_num'] . ', ' . $userstaff['postcode'] . ', ' . $userstaff['county'] . ', ' . $userstaff['city']; ?>
        </p>
        </br>
        <p>
            <?php echo $userstaff['staff_dob']; ?>
        </p>
</div>

    <button type="button" class="backProfile" onclick="location.href='staffMainpage.php'">Back</button>

