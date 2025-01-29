<?php require("NavBar.html");
include_once("functions.php");
$patientupdate = updatePatient();
$arrayResult = $patientupdate;
?>

<div class="menu">
<link rel="stylesheet" href="updateDetails.css"/>

<h1><img src="https://i.postimg.cc/RVjzqQzb/user-128.png" alt="Profile" class="profile-image" width="120" height="120"></h1>

   
			
<div class="updates">
            <form method="post" action="updateEmployee.php?uid=<?php echo $_GET['uid']; ?>">
            <label class="control-label labelFont">First Name:</label>
                 <input class="form-control" type="text" name="fname"
                    value="<?php echo !empty($arrayResult) ? $arrayResult[0][1] : ''; ?>">
                    <br>
                    <label class="control-label labelFont">Middle Name:</label>
                    <input class="form-control" type="text" name="mname"
                    value="<?php echo !empty($arrayResult) ? $arrayResult[0][2] : ''; ?>">
                    <br>
                    <label class="control-label labelFont">Last Name:</label>
                <input class="form-control" type="text" name="lname"
                    value="<?php echo !empty($arrayResult) ? $arrayResult[0][3] : ''; ?>">
                    <br>
                    <label class="control-label labelFont">Phone Number:</label>
                <input class="form-control" type="text" name="phone"
                    value="<?php echo !empty($arrayResult) ? $arrayResult[0][5] : ''; ?>">
                    <br>
                    <label class="control-label labelFont">Email:</label>
                <input class="form-control" type="text" name="email"
                    value="<?php echo !empty($arrayResult) ? $arrayResult[0][6] : ''; ?>">

            

            

<button type="button" class="backPat" onclick="location.href='updatePatientSummary.php'">Update</button>
<button type="button" class="backPat" onclick="location.href='staffPatients.php'">Back</button>
</div>
</div>

            