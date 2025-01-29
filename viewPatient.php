<?php require("NavBar.html");
include_once("functions.php");
$viewpatients = viewPatients();
$arrayResult = $viewpatients;

 ?>

<div class="mainlogin">
<link rel="stylesheet" href="viewPatient.css"/>
<h1><img src="https://i.postimg.cc/RVjzqQzb/user-128.png" alt="Profile" class="profile-image" width="120" height="120"></h1>

   
			
			<h1 class="patient"><?php echo $arrayResult[0][1], ' ', $arrayResult[0][2], ' ', $arrayResult[0][3]; ?></h1>
            <br>
            <br>
            <div class="view">
			<label class="bold">Patient ID:</label>
			<?php echo $arrayResult[0][4] ?>
			<br>
			<br>
			<label class="bold">Patient Phone Number:</label>
			<?php echo $arrayResult[0][5] ?>
            <br>
			<br>
            </div>
            <div class="view2">
            <label class="bold">Patient Email:</label>
            <?php echo $arrayResult[0][6] ?>
            <br>
			<br>
            <label class="bold">Patient Address:</label>
            <?php echo $arrayResult[0][7], ', ', $arrayResult[0][8], ', ', $arrayResult[0][9], ', ', $arrayResult[0][10]  ?>
            
</div>
</div>
</div>
<button type="button" class="backBut" onclick="location.href='staffPatients.php'">Back</button>

<button type="button" class="patientprof" onclick="location.href='healthRecordsPatient.php'">Health Records</button>
            <button type="button" class="patientprof" onclick="location.href='patientsAppointments.php'">Appointments</button>