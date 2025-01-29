<?php
require("NavBar.html");
include_once("functions.php");
$patient_id = isset($_GET['patient_id']) ? (int)$_GET['patient_id'] : 0;

$patientapp = viewPatientApp($patient_id);
?>

<div class="mainPatients">
<link rel="stylesheet" href="patientApps.css"/>

        <h1><img src="https://i.postimg.cc/yNWfDNy3/user-128.png" alt="Profile" class="patientImage" width="200" height="200"></h1>
        <?php if (empty($patientapp)): ?>
        <h1 class = "patientinfoo">No appointments found for the given patient.</h1>
    <?php else: ?>
        <h1 class="patientinfoo"><?php echo $patientapp[0][1], ' ', $patientapp[0][2], ' ', $patientapp[0][3]; ?></h1>
        
        <br>
        <br>
        
    <?php endif; ?>
</div>
<button type="button" class="backBut" onclick="location.href='staffPatients.php'">Back</button>