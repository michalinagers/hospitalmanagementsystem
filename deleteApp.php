<?php require("NavBar.html");


session_start();

    if (isset($_GET['appointmentid'])) {
        
        //Retrieve appointment ID
        $appid = $_GET['appointmentid'];

        //Database connection
        $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

        //SQL statement to delete the given appointment
        $stmt = "DELETE FROM appointments WHERE appointment_id = :appointmentid";

        $sql = $db->prepare($stmt);

        //Bind parameters
        $sql->bindParam(':appointmentid', $appid, SQLITE3_INTEGER);

        //If successful, redirect user
        if ($sql->execute()) {

            header("Location:deleteApp.php?deleted=true");

            exit();
            
        //If not, get an error message
        } else {

            echo "Error executing SQL query: " . $db->lastErrorMsg();

            echo "SQL query: " . $sql->queryString;

        }


    }



?>
<link rel="stylesheet" href="deleteApp.css"/>
<h1> Appointment has been cancelled successfully!</h1>

<button type="button" class="bookApps" onclick="location.href='patientApp.php'">Back</button>