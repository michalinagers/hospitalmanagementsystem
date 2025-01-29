<?php 
require("NavBar.html");
include_once("functions.php");

// Check if patient is logged in
if(isset($_SESSION['patient_id'])) {
    $patient_id = $_SESSION['patient_id'];
    
    // Establish database connection
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    // Get health records for the logged-in patient, excluding patient_id
    $sql = "SELECT healthrecords_id, note FROM healthrecords WHERE patient_id = :patient_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':patient_id', $patient_id, SQLITE3_TEXT);
    $result = $stmt->execute();

    // Display health records in a table
    echo "<div class='health-records-table'>";
    echo "<table>";
    echo "<tr><th>Health Records ID</th><th>Note</th></tr>";
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['healthrecords_id'] . "</td>";
        echo "<td>" . $row['note'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    // Redirect to login page if patient is not logged in
    header('Location: patientLogin2.php'); // 
    exit;
}

?>

<link rel="stylesheet" href="meeting.css"/>
<div class="menu">
<h1>Health Records</h1>
</div>

<link rel="stylesheet" href="meeting.css"/>
<div class="menu">
<h1>Health Records</h1>
<button type="button" class="backButton" onclick="location.href='patientMainPage.php'">Back</button>