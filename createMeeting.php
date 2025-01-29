<?php
require ("NavBar.html");

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    if (isset($_POST['meetdate']) && isset($_POST['meettime']) && isset($_POST['location_id'])) {


        $location_id = $_POST['location_id'];
        $meetdate = $_POST['meetdate'];
        $meettime = $_POST['meettime'];
        
        // Takes the next available meeting_id as a new meeting ID when meeting is created
        $maxMeetingIdQuery = "SELECT MAX(meeting_id) as max_id FROM staffmeet";
        $result = $db->query($maxMeetingIdQuery);
        $row = $result->fetchArray(SQLITE3_ASSOC);
        $nextMeetingId = $row['max_id'] + 1;

       //SQL statement which adds data into staffmeet
        $sql = "INSERT INTO staffmeet (meeting_id, location_id, date_meeting, time_meeting)
                 VALUES (:meeting_id, :location_id, :meetdate, :meettime)";
        $stmt = $db->prepare($sql);

        //Bind parameters
        $stmt->bindParam(':meeting_id', $nextMeetingId, SQLITE3_INTEGER);
        $stmt->bindParam(':location_id', $location_id, SQLITE3_INTEGER);
        $stmt->bindParam(':meetdate', $meetdate, SQLITE3_TEXT);
        $stmt->bindParam(':meettime', $meettime, SQLITE3_TEXT);

       
        $success = $stmt->execute();

        //If successful, redirect user to the given page or if not successful, display error
        if ($success) {
            header('Location: meetingCreateSuccess.php');
            exit;
        } else {
            echo "Error executing statement.";
        }
    } else {
        echo "One or more form fields are missing.";
    }
}
?>

<div class="menu">
    <h1>Create Meetings</h1>
    <link rel="stylesheet" href="addMeet.css"/>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="appReason">
            <br>
            <p>Choose meeting details:</p>
            <select name="meetdate" required>
                <br>
    <option value="">Choose date</option>
    <option value="27/07/2024">27/07/2024</option>
    <option value="28/07/2024">28/07/2024</option>
    <option value="29/07/2024">29/07/2024</option>
    <option value="30/07/2024">30/07/2024</option>
    <option value="31/07/2024">31/07/2024</option>
</select>
           
            <select name="meettime" required>
    <option value="">Choose time</option>
    <option value="09:10">09:10</option>
    <option value="09:40">09:40</option>
    <option value="10:20">10:20</option>
    <option value="11:15">11:15</option>
    <option value="12:00">12:00</option>
    <option value="12:25">12:25</option>
    <option value="12:55">12:55</option>
    <option value="13:15">13:15</option>
    <option value="13:40">13:40</option>
</select>

<select name="location_id" required>
    <option value="">Choose location</option>
    <option value="6">Meeting Room 1</option>
    <option value="7">Meeting Room 2</option>
    <option value="8">Meeting Room 3</option>
    <option value="9">Meeting Room 4</option>

</select>


            <button type="submit" class="bookApps">Create</button>
            <button type="button" class="bookApps" onclick="location.href='meetingsAdmin.php'">Back</button>
        </div>
    </form>
</div>

   

</div>

