<?php
session_start();

// Redirect to login page if patient is not logged in
if (!isset($_SESSION['patient_id'])) {
    header('Location: patientLogin.php');
    exit;
}

require("NavBar.html");

// Function to update patient profile
function updateMyProfile()
{
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Establish database connection
        $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

        // Prepare SQL statement for updating profile
        $stmt = $db->prepare("UPDATE patients SET patient_phone = :phone, patient_email = :email, patient_password = :password WHERE patient_id = :patient_id");

        // Bind parameters
        $stmt->bindParam(':patient_id', $_SESSION['patient_id'], SQLITE3_INTEGER);
        $stmt->bindParam(':phone', $_POST['phone'], SQLITE3_TEXT);
        $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);

        // Hash the password
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashed_password, SQLITE3_TEXT); 

        // Execute the statement
        if ($stmt->execute()) {
            // Check if any rows were affected
            if ($stmt->changes() > 0) {
                // Redirect to profile update summary page if update successful
                header('Location: myProfileUpdateSummary.php');
                exit();
            } else {
                // Redirect back to profile page if no rows were affected
                header('Location: myProfile.php');
                exit();
            }
        } else {
            // Display error if execution fails
            echo "Error updating profile.";
        }
    }
}

// Call function to update profile
updateMyProfile();

// Get user information by ID
function getUserById($id)
{
    // database connection
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    //SQL statement to get user information
    $stmt = $db->prepare("SELECT patients.patient_id, patients.patient_fname, patients.patient_mname, patients.patient_lname, address.address_id, patients.patient_phone, patients.patient_email, address.house_num, address.postcode, address.county, address.city, patients.patient_dob  FROM patients 
    INNER JOIN address ON (address.address_id = patients.address_id) WHERE patients.patient_id = :patientid");

    // Bind parameter
    $stmt->bindParam(':patientid', $id, SQLITE3_INTEGER);

    // Execute the statement
    $result = $stmt->execute();

    // Fetch user data
    $user = $result->fetchArray();

    return $user;
}

// Get user information by ID
$user = getUserById($_SESSION['patient_id']);
?>

<div class="update">
<link rel="stylesheet" href="profileUpdate.css"/>
<h1 class="up2">Phone Number:</h1>
<h1 class="up2">Email:</h1>
<h1 class="up2">Password:</h1>


</div>
<div class="patientName">
<?php echo $user['patient_fname'] . ' ' . $user['patient_mname'] . ' ' . $user['patient_lname']; ?>
</div>
<div class="mainlogin">
<h1><img src="https://i.postimg.cc/RVjzqQzb/user-128.png" alt="Profile" class="profile-image" width="220" height="220"></h1>

   
            
    
<form method="post" action="myProfile.php<?php echo isset($_GET['uid']) ? '?uid=' . $_GET['uid'] : ''; ?>">

<input class="form-control" type="text" name="phone" value="">
    <br>
    <br>
    <input class="form-control" type="text" name="email" value="">
    <br>
    <br>
    <input class="form-control" type="password" name="password" value="">

    <input type="submit" class="submitButton" name="submit" value="Update">
</form>
            

            

</div>
</div>
<button type="button" class="backPat" onclick="location.href='patientMainpage.php'">Back</button>

            