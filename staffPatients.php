<?php
include ("NavBar.html");
include_once ("functions.php");
$patients = getPatients();
$viewpatients = viewPatients();
$arrayResult = $viewpatients;
$filterPatients = patientIDsearchBar();

if(isset($_POST['submit']) && $_POST['submit'] == 'filter') {

    if(!empty($_POST['filterPatientID'])) {
        $filterPatients = patientIDsearchBar();
    } else {
      
        $filterPatients = getPatients();
    }
} else {
  
    $filterPatients = getPatients();
}
?>


<div class="title">
<link rel="stylesheet" href="staffPatients.css"/>

<p>Patient List</p>
</div>
<button type="button" class="backList" onclick="location.href='staffMainpage.php'">Back</button>

<form method="post">
    <label for="filterPatientID" style="color: white;">Filter by Patient ID:</label>
    <input type="text" id="filterPatientID" name="filterPatientID" class="form-control" style="width: 60px; height: 20px;" value="<?php echo isset($_POST['filterPatientID']) ? $_POST['filterPatientID'] : ''; ?>">
    <br>
    <br>
    <button type="submit" name="submit" value="filter">Filter</button>
</form>
<br>
<div class="row">
    <table class="table table-striped">
        <thead class="table-dark">
            <td>Patient ID</td>
            <td>Patient Name</td>
            <td>Actions</td>
        </thead>
        <?php foreach ($filterPatients as $patient): ?>
                <tr>
                    <td><?php echo $patient['patient_id']; ?></td>
                    <td><?php echo $patient['patient_fname'] . ' ' . $patient['patient_mname'] . ' ' . $patient['patient_lname']; ?></td>
                    <td><a href="viewPatient.php?patientid=<?php echo $patient['patient_id']; ?>">View</a> | <a href="updatePatient.php?patientid=<?php echo $patient['patient_id']; ?>">Update</a></td>
                </tr>
        <?php endforeach; ?>
    </table>
</div>



