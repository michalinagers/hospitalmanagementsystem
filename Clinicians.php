<?php
include ("NavBar.html");
include_once ("functions.php");
$clinician = viewClincians();
$clinicianList = clinicianSearchBar();

// Checks if form is submitted
if (isset($_POST['submit']) && $_POST['submit'] == 'filter') {

    // Check if field is not empty
    if (!empty($_POST['filterClinicians'])) {
        $clinicianList = clinicianSearchBar();
    } else {
        // If filterClinicians field is empty, display all clinicians
        $clinicianList = viewClincians();
    }
} else {

    $clinicianList = viewClincians();
}

?>

<div class="title">
<p>Clinician List</p>
<link rel="stylesheet" href="clinicians.css"/>
</div>
<button type="button" class="backList" onclick="location.href='adminMainPage.php'">Back</button>
<button type="button" class="addRemove" onclick="location.href='addClinicians.php'">Add</button>
<form method="post">
    <label for="filterClinicians" style="color: white;">Filter by Clinician ID:</label>
    <input type="text" id="filterClinicians" name="filterClinicians" class="form-control" style="width: 60px; height: 20px;" value="<?php echo isset($_POST['filterClinicians']) ? $_POST['filterClinicians'] : ''; ?>">
    <br>
    <br>
    <button type="submit" name="submit" value="filter">Filter</button>
</form>
<br>
<div class="row">

    <table class="table table-striped">
        <thead class="table-dark">
            <td>Clinician ID</td>
            <td>Name</td>
            <td>Phone Number</td>
            <td>Email</td>
            <td>D.O.B</td>
            <td>Job</td>
            <td>Address</td>
        </thead>

        <?php foreach ($clinicianList as $clinicians): ?>
                    <tr>
                        <td><?php echo $clinicians['staff_id']; ?></td>
                        <td><?php echo $clinicians['staff_fname'] . ' ' . $clinicians['staff_mname'] . ' ' . $clinicians['staff_lname']; ?></td>
                        <td><?php echo $clinicians['staff_phone']; ?></td>
                        <td><?php echo $clinicians['staff_email']; ?></td>
                        <td><?php echo $clinicians['staff_dob']; ?></td>
                        <td><?php echo $clinicians['job_class']; ?></td>
                        <td><?php echo $clinicians['house_num'] . ', ' . $clinicians['postcode'] . ',  ' . $clinicians['county'] . ', ' . $clinicians['city'] ?> </td>
                
                    </tr>
        <?php endforeach; ?>

    </table>

    </main>
