<?php 
require("NavBar.html");
include_once("functions.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Database connection
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    // Check if the required form fields are set
    if (isset($_POST['healthrecordsid']) && isset($_POST['note']) && isset($_POST['patient_id'])) {
        // Retrieve form data
        $healthrecordsid = $_POST['healthrecordsid'];
        $note = $_POST['note'];
        $patientid = $_POST['patient_id'];

        // Prepare SQL statement
        $sql = "INSERT INTO healthrecords (healthrecords_id, note, patient_id) VALUES (:healthrecordsid, :note, :patientid)";
        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':healthrecordsid', $healthrecordsid, SQLITE3_INTEGER);
        $stmt->bindParam(':note', $note, SQLITE3_TEXT);
        $stmt->bindParam(':patientid', $patientid, SQLITE3_TEXT);

        // Execute the statement
        $success = $stmt->execute();

        // Check if insertion was successful
        if ($success) {
            // Redirect to success page
            header('Location: addResultsSuccess.php');
            exit;
        } else {
            // Error handling
            echo "Error: Unable to insert health record.";
        }
    } else {
        // If required form fields are not set, handle the error
        echo "Error: Missing required form data.";
    }
}
?>


<div class="mainlogin">
    <h1><img src="https://i.postimg.cc/RVjzqQzb/user-128.png" alt="Profile" class="profile-image" width="120" height="120"></h1>
    <link rel="stylesheet" href="results.css"/>
</div>

<div class="resultsText">
    <form method="POST" action="">
        <label for="patient_id">Patient ID:</label>
        <input type="text" id="patient_id" name="patient_id" required><br><br>
        <label for="healthrecordsid">Health Records ID:</label><br>
        <input type="text" id="healthrecordsid" name="healthrecordsid" required><br><br>
        <label for="note">Note:</label><br>
        <input type="text" id="note" name="note" required><br><br>
        <button type="submit" name="submit">Submit</button>
    </form>
    <button type="button" class="backBut" onclick="location.href='staffMainpage.php'">Back</button>
</div>