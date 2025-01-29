<?php require("NavBar.html");
$appointments = viewAppointments();
function viewAppointments()
{
    $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");

    //Array to store data in
    $arrayResult = [];

    //SQL to get appointments with patient details such as their ID, location name, staff name, id
    $sql = "SELECT appointments.appointment_id, appointments.date_app, appointments.time_app, appointments.location_id, appointments.staff_id, appointments.patient_id, 
            patients.patient_fname, patients.patient_mname, patients.patient_lname, staff.staff_fname, staff.staff_mname, staff.staff_lname, location.location_name, location.location_number
            FROM appointments 
            INNER JOIN patients ON (appointments.patient_id = patients.patient_id)
            INNER JOIN location ON (appointments.location_id = location.location_id)
            INNER JOIN staff ON (appointments.staff_id = staff.staff_id);";

    $stmt = $db->prepare($sql);

    $result = $stmt->execute();

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {

        //Store data in an array
        $arrayResult[] = $row;
    }

    return $arrayResult;
    
}
?>

<div class="title">
    <p>Appointment List</p>
    <link rel="stylesheet" href="appsAdmin.css"/>

</div>

<table>
    <tr>
        <th>Appointment ID</th>
        <th>Date</th>
        <th>Time</th>
        <th>Location</th>
        <th>Patient ID</th>
        <th>Patient Name</th>
        <th>Staff Name</th>
    </tr>
    <?php foreach ($appointments as $appointment): ?>
        <tr>
            <td><?php echo $appointment['appointment_id']; ?></td>
            <td><?php echo $appointment['date_app']; ?></td>
            <td><?php echo $appointment['time_app']; ?></td>
            <td><?php echo $appointment['location_name'] . ', ' . $appointment['location_number'] ; ?></td>
            <td><?php echo $appointment['patient_id']; ?></td>
            <td><?php echo $appointment['patient_fname'] . ' ' . $appointment['patient_mname'] . ' ' . $appointment['patient_lname']; ?></td>
            <td><?php echo $appointment['staff_fname'] . ' ' . $appointment['staff_mname'] . ' ' . $appointment['staff_lname']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<button type="button" class="backList" onclick="location.href='adminMainPage.php'">Back</button>
