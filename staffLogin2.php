<?php
session_start();
require("NavBar.html");


function verifyUsersStaff($staffemail, $staffpassword) {
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    $stmt = $db->prepare('SELECT * FROM staff WHERE staff_email=:staffemail AND staff_password=:staffpassword');
    $stmt->bindParam(':staffemail', $staffemail, SQLITE3_TEXT);
    $stmt->bindParam(':staffpassword', $staffpassword, SQLITE3_TEXT);

    $result = $stmt->execute();

    $rows_array = [];
    while ($row = $result->fetchArray()) {
        $rows_array[] = $row;
    }
    return $rows_array;
}

function checkSessionStaff($path) {
    $expireAfter = 1; //this value is in minutes

    if (isset($_SESSION['last_action'])) {
        $secondsInactive = time() - $_SESSION['last_action'];
        $expireAfterSeconds = $expireAfter * 60;

        if ($secondsInactive >= $expireAfterSeconds) {
            session_unset();
            session_destroy();
            header("Location: " . $path); //return to the login page
        }
    }
    $_SESSION['last_action'] = time();
    $url = $_SERVER['REQUEST_URI']; //to obtain the current page
    $timeOut = ($expireAfter * 60) + 1; //1 second after the max session allowed.
    header("Refresh: $timeOut; URL=$url"); //refresh the screen
}

if (isset($_POST['stafflogin'])) {
    $staffemail = $_POST['staffemail'];
    $staffpassword = $_POST['staffpwd'];

    $userStaffData = verifyUsersStaff($staffemail, $staffpassword);

    if (count($userStaffData) == 0) {
        $invalidMesg = "Invalid email and password!";
        echo "<script>document.getElementById('error-message').innerHTML = '$invalidMesg';</script>";
    } else {
        $_SESSION['staffname'] = $userStaffData[0]['staff_fname'];
        $_SESSION['staff_id'] = $userStaffData[0]['staff_id'];
        header("Location: staffMainpage.php"); //redirect to the dashboard page
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Login as Staff</title>
    <link rel="stylesheet" href="error.css"/>
</head>
<body>
    <h1><img src="https://i.postimg.cc/15tpqdV5/Project-2.jpg" alt="Hospital"></h1>
    <p class="title">Login as Clinician</p>

    <div class="mainlogin">
    </div>

    <div class="loginform">
        <div id="error-message" class="error-message"></div>

        <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
        <script>
    // Get the error message element
    const errorMessage = document.getElementById('error-message');

    // Check if the error message is set
    if (<?php echo $invalidMesg !== "" ? "true" : "false"; ?>) {
        // Set the text content of the error message element
        errorMessage.textContent = "<?php echo $invalidMesg; ?>";

        // Add a CSS class to style the error message
        errorMessage.classList.add('error');
    }
</script>
        <label for="email">Email <span class="required">*</span></label><br>
        <input type="email" id="email" name="staffemail" required><br>
        <label for="pwd">Password <span class="required">*</span></label><br>
        <input type="password" id="pwd" name="staffpwd" required><br>
        <input type="submit" value="Login" name="stafflogin">
      </form>
    </div>

    <button type="button" class="backProfile2" onclick="location.href='Home.php'">Back</button>
</body>
</html>