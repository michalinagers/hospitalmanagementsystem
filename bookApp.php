<?php
require("NavBar.html");

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    if (isset($_POST['date_app']) && isset($_POST['time_app'])) {
        $appdate = $_POST['date_app'];
        $apptime = $_POST['time_app'];
        $patient_id = $_SESSION['patient_id']; // Get the patient ID from the session

        $sql = "INSERT INTO appointments (appointment_id, patient_id, date_app, time_app, location_id, staff_id)
                 VALUES (NULL, :patient_id, :appdate, :apptime, (SELECT location_id FROM location ORDER BY RANDOM() LIMIT 1), (SELECT staff_id FROM staff ORDER BY RANDOM() LIMIT 1))";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':patient_id', $patient_id, SQLITE3_INTEGER);
        $stmt->bindParam(':appdate', $appdate, SQLITE3_TEXT);
        $stmt->bindParam(':apptime', $apptime, SQLITE3_TEXT);

        $success = $stmt->execute();

        if ($success) {
            header('Location: appBookSuccess.php');
            exit;
        }
    }
}
?>

<div class="menu">
    <h1>Book an appointment</h1>
    <link rel="stylesheet" href="bookApp.css"/>
    <h1 class="AppImage"><img src="https://i.postimg.cc/rsMW5wLs/b068d8210a360b9ab1de1ac221fff608.png" alt="Appointments"></h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="appReason">
            <p>Appointment reason: </p>
            <input type="text" id="user-appointment" name="appointment_reason" required><br>
            <br>
            <p>Choose appointment date and time:</p>
            <select name="date_app" required>
    <option value="">Choose date</option>
    <option value="27/07/2024">27/07/2024</option>
    <option value="28/07/2024">28/07/2024</option>
    <option value="29/07/2024">29/07/2024</option>
    <option value="30/07/2024">30/07/2024</option>
    <option value="31/07/2024">31/07/2024</option>
</select>
           
            <select name="time_app" required>
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
            <p>Is medical assistance required?</p>
            <select id="selection" name="medical_assistance">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
            <button type="submit" class="bookApps">Book</button>
            <button type="button" class="bookApps" onclick="location.href='patientApp.php'">Back</button>
        </div>
    </form>
</div>

   

</div>

