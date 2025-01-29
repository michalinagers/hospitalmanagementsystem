<?php

function patientLogin()
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare and bind
        $stmt = $db->prepare('SELECT * FROM patients WHERE patient_email = :email');
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);

        // Execute
        $result = $stmt->execute();

        // Fetch
        $user = $result->fetchArray();

        // Verify user
        if ($user && password_verify($password, $user['patient_password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: patientSuccess.php');
        } else {
            $error = 'Invalid email or password.';
        }
    }
}

function database()

{
// Connect to the SQLite database
$db = new PDO('sqlite:F:/xampp/htdocs/hospital_database.db');

// Get the form data
$email = $_POST['patient_email'];
$password = password_hash($_POST['patient_password'], PASSWORD_DEFAULT);

// Insert the data into the profiles table
$stmt = $db->prepare("INSERT INTO patients (patient_email, patient_password) VALUES (?, ?)");
$stmt->execute([$email, $password]);

// Redirect the user back to the homepage
header('Location: patientSuccess.php');
exit;

}
?>

<?php

function getPatients()
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    $sql = "SELECT * FROM patients";
    $result = $db->query($sql);

    $arrayResult = array();

    while ($row = $result->fetchArray()) {
        $arrayResult[] = $row;
    }

    return $arrayResult;
}

?>

<?php
function getEquip()
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    $sql = "SELECT equipment.equipment_id, equipment.equipment_name, equipment.quantity, equipment.availability, location.location_id, location.location_name, location.location_number FROM equipment
    INNER JOIN location ON (location.location_id = equipment.location_id);";



    $result = $db->query($sql);

    $arrayResult = array();

    while ($row = $result->fetchArray()) {
        $arrayResult[] = $row;
    }

    return $arrayResult;
}

?>

<?php
function updateEquipment()
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    if (isset($_POST['submit'])) {
        try {
            $stmt = $db->prepare("UPDATE equipment SET equipment_name = :equipname, location_id = :loc, quantity = :quan, availability = :avail  WHERE equipment_id = :equipid");

            $stmt->bindParam(':equipid', $_GET['uid'], SQLITE3_TEXT);
            $stmt->bindParam(':equipname', $_POST['equipname'], SQLITE3_TEXT);
            $stmt->bindParam(':loc', $_POST['location'], SQLITE3_TEXT);
            $stmt->bindParam(':quan', $_POST['quantity'], SQLITE3_TEXT);
            $stmt->bindParam(':avail', $_POST['availability'], SQLITE3_TEXT);

            $success = $stmt->execute();

            // Check if the UPDATE operation was successful
            if ($success) {
                echo "Equipment updated successfully!";
            } else {
                echo "Failed to update equipment.";
            }

            // Redirect to equipment page
            header('Location: hospitalEquip.php');
            exit();
        } catch (Exception $e) {
            echo "Error updating equipment: " . $e->getMessage();
        }
    } else {
        try {
            $arrayResult = [];
            $stmt = $db->prepare("SELECT * FROM equipment WHERE equipment_id=:equipid");
            $stmt->bindParam(':equipid', $_GET['uid'], SQLITE3_TEXT);
            $result = $stmt->execute();

            while ($row = $result->fetchArray(SQLITE3_NUM)) {
                $arrayResult[] = $row;
            }
        } catch (Exception $e) {
            echo "Error retrieving equipment details: " . $e->getMessage();
        }

        return $arrayResult;
    }
}
?>

<?php
function updateEquipmentAdmin()
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    if (isset($_POST['submit'])) {
        try {
            $stmt = $db->prepare("UPDATE equipment SET equipment_name = :equipname, location_id = :loc, quantity = :quan, availability = :avail  WHERE equipment_id = :equipid");

            $stmt->bindParam(':equipid', $_GET['uid'], SQLITE3_TEXT);
            $stmt->bindParam(':equipname', $_POST['equipname'], SQLITE3_TEXT);
            $stmt->bindParam(':loc', $_POST['location'], SQLITE3_TEXT);
            $stmt->bindParam(':quan', $_POST['quantity'], SQLITE3_TEXT);
            $stmt->bindParam(':avail', $_POST['availability'], SQLITE3_TEXT);

            $success = $stmt->execute();

            // Check if the UPDATE operation was successful
            if ($success) {
                echo "Equipment updated successfully!";
            } else {
                echo "Failed to update equipment.";
            }

            // Redirect to equipment page
            header('Location: hospitalEquipAdmin.php');
            exit();
        } catch (Exception $e) {
            echo "Error updating equipment: " . $e->getMessage();
        }
    } else {
        try {
            $arrayResult = [];
            $stmt = $db->prepare("SELECT * FROM equipment WHERE equipment_id=:equipid");
            $stmt->bindParam(':equipid', $_GET['uid'], SQLITE3_TEXT);
            $result = $stmt->execute();

            while ($row = $result->fetchArray(SQLITE3_NUM)) {
                $arrayResult[] = $row;
            }
        } catch (Exception $e) {
            echo "Error retrieving equipment details: " . $e->getMessage();
        }

        return $arrayResult;
    }
}
?>

<?php


function viewPatients()
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    $arrayResult = [];

    $sql = "SELECT patients.patient_id, patients.patient_fname, patients.patient_mname, patients.patient_lname, address.address_id, patients.patient_phone, patients.patient_email, address.house_num, address.postcode, address.county, address.city, patients.patient_dob  FROM patients 
    INNER JOIN address ON (address.address_id = patients.address_id) WHERE patients.patient_id = :patientid;";

    $stmt = $db->prepare($sql);

    $stmt->bindParam(':patientid', $_GET['patientid'], SQLITE3_TEXT);

    $result = $stmt->execute();

    while ($row = $result->fetchArray(SQLITE3_NUM)) {

        $arrayResult[] = $row;
    }

    return $arrayResult;
}
?>

<?php
function updatePatient()
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    // Initialize $arrayResult
    $arrayResult = [];

    if (isset($_POST['submit'])) {
        $sql = "UPDATE patients SET patient_fname = :fname, patient_mname = :mname, patient_lname = :lname, patient_phone = :phone, patient_email = :email WHERE patient_id = :patientid";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':patientid', $_GET['uid'], SQLITE3_TEXT);
        $stmt->bindParam(':fname', $_POST['fname'], SQLITE3_TEXT);
        $stmt->bindParam(':mname', $_POST['mname'], SQLITE3_TEXT);
        $stmt->bindParam(':lname', $_POST['lname'], SQLITE3_TEXT);
        $stmt->bindParam(':phone', $_POST['phone'], SQLITE3_TEXT);
        $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);

        $stmt->execute();

        // Redirect after update
        header('Location: staffPatients.php');
        exit();
    } else {
        // Fetch patient details if not submitting
        $sql = "SELECT * FROM patients WHERE patient_id=:patientid";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':patientid', $_GET['uid'], SQLITE3_TEXT);
        $result = $stmt->execute();

        while ($row = $result->fetchArray(SQLITE3_NUM)) {
            $arrayResult[] = $row;
        }
    }

    // Return the arrayResult
    return $arrayResult;
}


?>

<?php
session_start();

function verifyUsers($email, $password) {
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    $stmt = $db->prepare('SELECT * FROM patients WHERE patient_email=:patemail AND patient_password=:patpassword');
    $stmt->bindParam(':patemail', $email, SQLITE3_TEXT);
    $stmt->bindParam(':patpassword', $password, SQLITE3_TEXT);

    $result = $stmt->execute();

    $rows_array = [];
    while ($row = $result->fetchArray()) {
        $rows_array[] = $row;
    }
    return $rows_array;
}
?>

<?php
function checkSession($path) {
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

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    $userData = verifyUsers($email, $password);

    if (count($userData) == 1) {
        $_SESSION['name'] = $userData[0]['patient_fname'];
        $_SESSION['patient_id'] = $userData[0]['patient_id'];
        header("Location: patientDashboard.php"); //redirect to the dashboard page
    } else {
        $invalidMesg = "Invalid email and password!";
    }
}
?>

<?php
function verifyStaff($staffemail, $staffpassword) {
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    $stmt = $db->prepare('SELECT * FROM staff WHERE staff_email=:staffemail');
    $stmt->bindParam(':staffemail', $staffemail, SQLITE3_TEXT);

    $result = $stmt->execute();

    $rows_array = [];
    while ($row = $result->fetchArray()) {
        $rows_array[] = $row;
    }
    return $rows_array;
}
?>

<?php
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

?>

<?php
function validateLogin($staffemail, $staffpassword) {
    $userData = verifyStaff($staffemail);

    if (count($userData) == 0) {
        return false;
    } else {
        if (password_verify($staffpassword, $userData[0]['staff_password'])) {
            $_SESSION['name'] = $userData[0]['staff_fname'];
            $_SESSION['staff_id'] = $userData[0]['staff_id'];
            return true;
        } else {
            return false;
        }
    }
}
?>


<?php

function generateAppointmentTimes($selectedDate, $startTime, $endTime, $timeInterval) {
    $appointmentTimes = array();
    $current = strtotime($startTime, strtotime($selectedDate));
    $end = strtotime($endTime, strtotime($selectedDate));

    while ($current < $end) {
        $time = date("H:i", $current);
        array_push($appointmentTimes, $time);
        $current = strtotime('+' . $timeInterval . ' minutes', $current);
    }

    return $appointmentTimes;
}

?>

<?php 


function viewHealthRecords($healthrecord) {
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    $arrayResult = [];
    $sql = "SELECT healthrecords_id, note, patient_id FROM healthrecords
    WHERE healthrecords_id = :healthrecordsid";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':healthrecord', $healthrecord, SQLITE3_TEXT);
    $result = $stmt->execute();
    while ($row = $result->fetchArray(SQLITE3_NUM)) {
        $arrayResult[] = $row;
    }
    return $arrayResult;
}

?>
<?php

function viewPatientApp($patient_id) {
    
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    $stmt = $db->prepare('SELECT appointments.appointment_id, appointments.date_app, appointments.time_app, location.location_name, location.location_number, staff.staff_fname, staff.staff_mname, staff.staff_lname, appointments.patient_id FROM appointments 
    INNER JOIN location ON (location.location_id = appointments.location_id)
    INNER JOIN staff on (staff.staff_id = appointments.staff_id) 
    INNER JOIN patients on (patients.patient_id = appointments.patient_id)
    WHERE appointments.patient_id=:patientid');
    $stmt->bindParam(':patientid', $patient_id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $arrayResult = array();
    while ($row = $result->fetchArray(SQLITE3_NUM)) {
        $arrayResult[] = $row;
    }
    return $arrayResult;
}

?>

<?php
function viewClincians() {

    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    $stmt = $db->prepare('SELECT staff.staff_id, staff.staff_fname, staff.staff_mname, staff.staff_lname, staff.staff_phone, staff.staff_email, staff.staff_dob, jobs.job_id, jobs.job_class, jobs.chg_hour, address.address_id, address.house_num, address.postcode, address.county, address.city FROM staff 
    INNER JOIN jobs ON (jobs.job_id = staff.job_id)
    INNER JOIN address on (address.address_id = staff.address_id)');
    $stmt->bindParam(':staffid', $clinician, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $arrayResult = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $arrayResult[] = $row;
    }
    return $arrayResult;
}

?>

<?php
function viewStaff() {

    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    $stmt = $db->prepare('SELECT hospitalstaff.hstaff_id, hospitalstaff.hstaff_fname, hospitalstaff.hstaff_mname, hospitalstaff.hstaff_lname, hospitalstaff.hstaff_phone, hospitalstaff.hstaff_email, hospitalstaff.hstaff_dob, jobs.job_id, jobs.job_class, jobs.chg_hour, address.address_id, address.house_num, address.postcode, address.county, address.city FROM hospitalstaff 
    INNER JOIN jobs ON (jobs.job_id = hospitalstaff.job_id)
    INNER JOIN address on (address.address_id = hospitalstaff.address_id)');
    $stmt->bindParam(':hstaffid', $hospitalstaff, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $arrayResult = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $arrayResult[] = $row;
    }
    return $arrayResult;
}

?>

<?php

function addClinician()
{
    if (!empty($_POST['fname']) &&!empty($_POST['dob'])) {
        $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
        $sql = 'INSERT INTO staff(staff_id, staff_fname, staff_mname, staff_lname, address_id, staff_phone, staff_email, staff_password, staff_dob, job_id) VALUES (:staffid, :fname, :mname, :lname, :addressid, :phoneno, :email, :pass, :dob, :jobid)';
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':staffid', $_POST['staffid'], SQLITE3_TEXT);
        $stmt->bindParam(':fname', $_POST['fname'], SQLITE3_TEXT);
        $stmt->bindParam(':mname', $_POST['mname'], SQLITE3_TEXT);
        $stmt->bindParam(':lname', $_POST['lname'], SQLITE3_TEXT);
        $stmt->bindParam(':addressid', $_POST['addressid'], SQLITE3_TEXT);
        $stmt->bindParam(':phoneno', $_POST['phone'], SQLITE3_TEXT);
        $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
        $stmt->bindParam(':pass', $_POST['pass'], SQLITE3_TEXT);
        $stmt->bindParam(':dob', $_POST['dob'], SQLITE3_TEXT);
        $stmt->bindParam(':jobid', $_POST['jobid'], SQLITE3_TEXT);

        $success = $stmt->execute();

        if ($success) {
            header('Location: addCliniciansSummary.php');
            exit;

            return false;
        }
    }
}
?>

<?php

function addEquipment()
{
    if (!empty($_POST['fname']) &&!empty($_POST['dob'])) {
        $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
        $sql = 'INSERT INTO equipment(equipment_id, equipment_name, location_id, quantity, availability) VALUES (:equipid, :equipname, :locid, :quan, :available)';
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':equipid', $_POST['equipid'], SQLITE3_TEXT);
        $stmt->bindParam(':equipname', $_POST['equipname'], SQLITE3_TEXT);
        $stmt->bindParam(':locid', $_POST['locid'], SQLITE3_TEXT);
        $stmt->bindParam(':quan', $_POST['quan'], SQLITE3_TEXT);
        $stmt->bindParam(':available', $_POST['available'], SQLITE3_TEXT);
        $success = $stmt->execute();

        if ($success) {
            header('Location: addEquipmentSummary.php');
            exit;

            return false;
        }
    }
}
?>

<?php

function deleteEquipment() {
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    $arrayResult = [];

  
    $sql = "SELECT equipment_id, equipment_name, location_id, quantity, availability FROM equipment WHERE equipment_id=:equipid";

    $stmt = $db->prepare($sql);

    
    if(isset($_GET['uid'])) {
        $stmt->bindParam(':equipid', $_GET['uid'], SQLITE3_TEXT);
    }

    $result = $stmt->execute();

   
    while ($row = $result->fetchArray(SQLITE3_NUM)) {
        $arrayResult[] = $row;
    }

  
    if (isset($_POST['delete'])) {
    
        $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    
        $stmt = $db->prepare("DELETE FROM equipment WHERE equipment_id = :equipid");

     
        if(isset($_POST['uid'])) {
            $stmt->bindParam(':equipid', $_POST['uid'], SQLITE3_TEXT);
        }

    
        $stmt->execute();

    
        header("Location: hospitalEquipAdmin.php?deleted=true");
        exit();
    }

    return $arrayResult;
}

?>

<?php

function updateMyProfile()
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    if (isset($_POST['submit'])) {
        $stmt = $db->prepare("UPDATE patients SET patient_phone = :phone, patient_email = :email, patient_password = :password,  patient_dob = :dob  WHERE patient_id = :patient_id");

        $stmt->bindParam(':patientid', $_GET['uid'], SQLITE3_TEXT);
        $stmt->bindParam(':phone', $_POST['phone'], SQLITE3_TEXT);
        $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
        $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);
        $stmt->bindParam(':dob', $_POST['dob'], SQLITE3_TEXT);

        $stmt->execute();

        header('Location: hospitalEquip.php');
        exit();
    } else {
        $arrayResult = [];
        $stmt = $db->prepare("SELECT * FROM patients WHERE patient_id=:patient_id");
        $stmt->bindParam(':patientid', $_GET['uid'], SQLITE3_TEXT);
        $result = $stmt->execute();

        while ($row = $result->fetchArray(SQLITE3_NUM)) {
            $arrayResult[] = $row;
        }

        return $arrayResult;
    }
}

?>

<?php
function patientIDsearchBar()
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    $info = [];

    if (!isset($_POST['filterPatientID'])) {
        $sql = "SELECT * FROM patients";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute();

        while ($row = $result->fetchArray(SQLITE3_NUM)) {
            $info[] = $row;
        }
    } else {
        if ($_POST['filterPatientID'] != 'All') {
            $id = intval($_POST['filterPatientID']);
            $sql = "SELECT * FROM patients WHERE patient_id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, SQLITE3_INTEGER); 
            $results = $stmt->execute();
            $info = [];
            while ($row = $results->fetchArray()) {
                $info[] = $row;
            }
        } else {
            $sql = "SELECT * FROM patients";
            $stmt = $db->prepare($sql);
            $result = $stmt->execute();

            while ($row = $result->fetchArray(SQLITE3_NUM)) {
                $info[] = $row;
            }
        }
    }

    return $info;
}

?>

<?php
function clinicianSearchBar()
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    $info = [];

    if (!isset($_POST['filterClinicians'])) {
        $sql = "SELECT * FROM staff 
                INNER JOIN jobs ON (jobs.job_id = staff.job_id)
                INNER JOIN address ON (address.address_id = staff.address_id)";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute();

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $info[] = $row;
        }
    } else {
        if ($_POST['filterClinicians'] != 'All') {
            $id = intval($_POST['filterClinicians']);
            $sql = "SELECT * FROM staff 
                    INNER JOIN jobs ON (jobs.job_id = staff.job_id)
                    INNER JOIN address ON (address.address_id = staff.address_id)
                    WHERE staff.staff_id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, SQLITE3_INTEGER); 
            $results = $stmt->execute();
            $info = [];
            while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
                $info[] = $row;
            }
        } else {
            $sql = "SELECT * FROM staff 
                    INNER JOIN jobs ON (jobs.job_id = staff.job_id)
                    INNER JOIN address ON (address.address_id = staff.address_id)";
            $stmt = $db->prepare($sql);
            $result = $stmt->execute();

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $info[] = $row;
            }
        }
    }

    return $info;
}

?>

<?php
function staffSearchBar()
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    $info = [];

    if (!isset($_POST['filterStaff'])) {
        $sql = "SELECT * FROM hospitalstaff 
                INNER JOIN jobs ON (jobs.job_id = hospitalstaff.job_id)
                INNER JOIN address ON (address.address_id = hospitalstaff.address_id)";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute();

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $info[] = $row;
        }
    } else {
        if ($_POST['filterStaff'] != 'All') {
            $id = intval($_POST['filterStaff']);
            $sql = "SELECT * FROM hospitalstaff 
                    INNER JOIN jobs ON (jobs.job_id = hospitalstaff.job_id)
                    INNER JOIN address ON (address.address_id = hospitalstaff.address_id)
                    WHERE hospitalstaff.hstaff_id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, SQLITE3_INTEGER); 
            $results = $stmt->execute();
            $info = [];
            while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
                $info[] = $row;
            }
        } else {
            $sql = "SELECT * FROM hospitalstaff 
                    INNER JOIN jobs ON (jobs.job_id = hstaff_id.job_id)
                    INNER JOIN address ON (address.address_id = hstaff_id.address_id)";
            $stmt = $db->prepare($sql);
            $result = $stmt->execute();

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $info[] = $row;
            }
        }
    }

    return $info;
}

?>

<?php
function getPatientDetails($patient_id) {
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    
    // Prepare the SQL statement to fetch patient details based on patient_id
    $stmt = $db->prepare("SELECT * FROM patients WHERE patient_id = :patient_id");
    $stmt->bindParam(':patient_id', $patient_id, SQLITE3_TEXT);
    
    // Execute the statement
    $result = $stmt->execute();
    
    // Fetch the patient details
    $patientDetails = $result->fetchArray(SQLITE3_ASSOC);
    
    return $patientDetails;
}

?>

<?php
function getHealthRecordsForPatient($patientid) {
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    
    // Prepare the SQL statement to fetch health records for the specified patientid
    $stmt = $db->prepare("SELECT * FROM healthrecords WHERE patient_id = :patient_id");
    $stmt->bindParam(':patient_id', $patientid, SQLITE3_TEXT);
    
    // Execute the statement
    $result = $stmt->execute();
    
    // Fetch the health records
    $healthRecords = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $healthRecords[] = $row;
    }
    
    return $healthRecords;
}

?>