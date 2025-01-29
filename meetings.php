<?php
require ("NavBar.html");
session_start();

$db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

function deleteMeeting($meetid)
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    if (isset($meetid)) {

        //SQL to delete a meeting
        $stmt = $db->prepare("DELETE FROM staffmeet WHERE meeting_id = :meetid");
        //Bind parameter
        $stmt->bindParam(':meetid', $meetid, SQLITE3_INTEGER);
        $stmt->execute();
        // Redirect to cancelMeeting.php if success
        header("Location: cancelMeeting.php?deleted=true");
        exit();
    }
}

// Check if meetid parameter is set

if (isset($_GET['meetid'])) {
    deleteMeeting($_GET['meetid']);
}
$stmt = $db->prepare('SELECT meeting_id, location_id, date_meeting, time_meeting FROM staffmeet');
$result = $stmt->execute();
?>
<link rel="stylesheet" href="meeting.css"/>
<div class="menu">

    <h1>Meetings</h1>

    <div class="appReason">
        <table>
            <tr>
                <th>Location</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            <?php
            while ($row = $result->fetchArray()) {
                echo "<tr>";
                echo "<td>" . $row['location_id'] . "</td>";
                echo "<td>" . $row['date_meeting'] . "</td>";
                echo "<td>" . $row['time_meeting'] . "</td>";
            }
            ?>
        </table>

        <button type="button" class="backAppointment" onclick="location.href='staffMainPage.php'">Back</button>
    </div>
</div>