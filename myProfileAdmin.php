<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: adminLogin.php');
    exit;
}

require("NavBar.html");

?>
<?php
function getUserById($id)
{
    //Database connection
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    
    //SQL statement to get admin details
    $stmt = $db->prepare("SELECT admin.admin_id, admin.admin_fname, admin.admin_mname, admin.admin_lname, address.address_id, admin.admin_phone, admin.admin_email, address.house_num, address.postcode, address.county, address.city, admin.admin_dob  FROM admin
    INNER JOIN address ON (address.address_id = admin.address_id) WHERE admin.admin_id = :adminid");
    $stmt->bindParam(':adminid', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $user = $result->fetchArray();
    return $user;
}
//Takes the admin_id that is logged in and displays their details 
$user = getUserById($_SESSION['admin_id']);
?>

<div class="mainlogin">
<link rel="stylesheet" href="profileAdmin.css"/>
    <h1><img src="https://i.postimg.cc/RVjzqQzb/user-128.png" alt="Profile" class="profile-image" width="120"
            height="120"></h1>
    <div class="myProfile2">
        <h1>Welcome,
            <?php echo $user['admin_fname'] . ' ' . $user['admin_mname'] . ' ' . $user['admin_lname']; ?>
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
            <?php echo $user['admin_email']; ?>
        </p>
        </br>
        <p>
            <?php echo $user['admin_phone']; ?>
        </p>
        </br>
        <p>
            <?php echo $user['house_num'] . ', ' . $user['postcode'] . ', ' . $user['county'] . ', ' . $user['city']; ?>
        </p>
        </br>
        <p>
            <?php echo $user['admin_dob']; ?>
        </p>
</div>

    <button type="button" class="backProfile" onclick="location.href='adminMainpage.php'">Back</button>

