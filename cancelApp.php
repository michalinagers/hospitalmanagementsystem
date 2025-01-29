<?php require ("NavBar.html");

// Start session to access session variables
session_start();
$patient_id = $_SESSION['patient_id'];

// Connect to database
$db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

// SQL statement to retrieve appointments for the logged-in patient
$stmt = $db->prepare('SELECT appointments.appointment_id, appointments.date_app, appointments.time_app, location.location_name, location.location_number, staff.staff_fname, staff.staff_mname, staff.staff_lname FROM appointments 
INNER JOIN location ON (location.location_id = appointments.location_id)
INNER JOIN staff on (staff.staff_id = appointments.staff_id) 
WHERE appointments.patient_id=:patientid');
$stmt->bindParam(':patientid', $patient_id, SQLITE3_INTEGER);

// Execute SQL statement
$result = $stmt->execute();

function deleteApp($appid)
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
    $arrayResult = [];
    // SQL statement to get appointment details
    $sql = "SELECT appointment_id, date_app, time_app, location_id, staff_id, patient_id FROM appointments WHERE appointment_id = :appointmentid";

    // Prepare SQL statement
    $stmt = $db->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':appointmentid', $appid, SQLITE3_INTEGER);

    $result = $stmt->execute();

    $arrayResult = [];

        // Fetch appointment details into an array
    while ($row = $result->fetchArray(SQLITE3_NUM)) {

        $arrayResult[] = $row;
    }

    if (isset($_GET['appointmentid'])) { // Check for the appointmentid parameter in the GET request

        $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

        // SQL statement to delete appointment
        $stmt = "DELETE FROM appointments WHERE appointment_id = :appointmentid";

        $sql = $db->prepare($stmt);

        $sql->bindParam(':appointmentid', $_GET['appointmentid'], SQLITE3_INTEGER);

        $sql->execute();

        // Redirect to deleteApp.php if successful
        header("Location:deleteApp.php?deleted=true");

        exit();
    }
    
    // Return array of appointment details
    return $arrayResult;
}
?>

<div class="menu">

    <h1>Cancel an appointment</h1>
    <link rel="stylesheet" href="cancelApp.css"/>

    <div class="appReason">
        <p>Choose appointment to cancel:</p>

        <br>

        <table>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Staff</th>
                <th>Location</th>
                <th>Location Number</th>
                <th>Cancel</th>

            </tr>
            <?php
            while ($row = $result->fetchArray()) {
                echo "<tr>";
                echo "<td>" . $row['date_app'] . "</td>";
                echo "<td>" . $row['time_app'] . "</td>";
                echo "<td>" . $row['staff_fname'] . " " . $row['staff_mname'] . " " . $row['staff_lname'] . "</td>";
                echo "<td>" . $row['location_name'] . "</td>";
                echo "<td>" . $row['location_number'] . "</td>";
                echo "<td><a href='deleteApp.php?appointmentid=" . $row['appointment_id'] . "'>Cancel</a></td>";
                echo "</tr>";
            }

            ?>
        </table>



        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <button type="button" class="backAppointment" onclick="location.href='patientMainpage.php'">Back</button>

    </div>



</div>