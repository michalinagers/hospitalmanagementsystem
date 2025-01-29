<?php
require ("NavBar.html");
session_start();

$db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

function deleteMeeting($meetid)
{

    // Connect to database
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    // Check if meeting ID is set
    if (isset($meetid)) {
        // SQL statement to delete meeting
        $stmt = $db->prepare("DELETE FROM staffmeet WHERE meeting_id = :meetid");
        $stmt->bindParam(':meetid', $meetid, SQLITE3_INTEGER);

        // Execute SQL statement
        $stmt->execute();
        // Redirect to cancelMeeting.php if successful
        header("Location: cancelMeeting.php?deleted=true");
        exit();
    }
}

if (isset($_GET['meetid'])) {
    deleteMeeting($_GET['meetid']);
}

$stmt = $db->prepare('SELECT meeting_id, location_id, date_meeting, time_meeting FROM staffmeet');
$result = $stmt->execute();
?>

<div class="menu">

    <h1>Cancel Meetings</h1>
    <link rel="stylesheet" href="cancelApp.css"/>


    <div class="appReason">
        <p>Choose meeting to cancel:</p>
        <br>
        <table>
            <tr>
                <th>Location</th>
                <th>Date</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
            <?php
            while ($row = $result->fetchArray()) {
                echo "<tr>";
                echo "<td>" . $row['location_id'] . "</td>";
                echo "<td>" . $row['date_meeting'] . "</td>";
                echo "<td>" . $row['time_meeting'] . "</td>";

                echo "<td><a href='cancelMeeting.php?meetid=" . $row['meeting_id'] . "'>Cancel</a></td>";
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
        <button type="button" class="backAppointment2" onclick="location.href='meetingsAdmin.php'">Back</button>
    </div>
</div>