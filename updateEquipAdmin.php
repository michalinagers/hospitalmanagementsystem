<?php 
require("NavBar.html");
include_once("functions.php");
$updateEquipAdmin = updateEquipmentAdmin();
?>

<div class="menu">
    <link rel="stylesheet" href="updateEquip.css"/>

    <h1 class="updateEquip">Update Equipment</h1>

    <div class="updates">
        <form method="post" action="updateEquipAdmin.php?uid=<?php echo $_GET['uid']; ?>">
            <label class="control-label labelFont">Equipment Name:</label><br><br>
            <input class="form-control updateBox" type="text" name="equipname"
                   value="<?php echo !empty($updateEquipAdmin) ? $updateEquipAdmin[0][1] : ''; ?>"><br><br>

            <label class="control-label labelFont">Location:</label><br><br>
            <input class="form-control updateBox" type="text" name="location"
                   value="<?php echo !empty($updateEquipAdmin) ? $updateEquipAdmin[0][2] : ''; ?>"><br><br>

            <label class="control-label labelFont">Quantity:</label><br><br>
            <input class="form-control updateBox" type="text" name="quantity"
                   value="<?php echo !empty($updateEquipAdmin) ? $updateEquipAdmin[0][3] : ''; ?>"><br><br>

            <label class="control-label labelFont">Availability:</label><br><br>
            <input class="form-control updateBox" type="text" name="availability"
                   value="<?php echo !empty($updateEquipAdmin) ? $updateEquipAdmin[0][4] : ''; ?>"><br><br>

            <input type="submit" class="submitEquip" name="submit" value="Update"></input>
        </form>
        <button type="button" class="backEquip" onclick="location.href='hospitalEquipAdmin.php'">Back</button>
    </div>
</div>



