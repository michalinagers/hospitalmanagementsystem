
<?php
require("NavBar.html");
include_once("functions.php");
$healthrecord = isset($_GET['healthrecord']) ? $_GET['healthrecord'] : '';
$viewRecords = viewHealthRecords($healthrecord);
?>


<div class="mainPatients">
<link rel="stylesheet" href="healthrecords.css"/>

        <h1><img src="https://i.postimg.cc/yNWfDNy3/user-128.png" alt="Profile" class="patientImage" width="200" height="200"></h1>
        <?php if (empty($viewRecords)): ?>
        <h1 class = "patientinfoo">No records found for the given patient.</h1>
    <?php else: ?>
        <h1 class="patientinfoo"><?php echo $viewRecords[0][1], ' ', $viewRecords[0][2], ' ', $viewRecords[0][3]; ?></h1>
        
        <br>
        <br>
        
    <?php endif; ?>
</div>
<button type="button" class="backBut" onclick="location.href='staffPatients.php'">Back</button>