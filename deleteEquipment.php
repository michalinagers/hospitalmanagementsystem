<?php require ("NavBar.html");
include_once ("functions.php");
$arrayResult = deleteEquipment();
?>

    
<div class="menu">
<link rel="stylesheet" href="deleteEquip.css"/>

        <h1>Delete Equipment</h1>
        <h2>Are you sure you want to delete this equipment?</h2>
        <button type="button" class="backUpdates" onclick="location.href='hospitalEquipAdmin.php'">Back</button>
        <div class="update">
            <label>Equipment Name:</label>
            <?php echo $arrayResult[0][1] ?>
            <br>
            <br>
            <label>Location:</label>
            <?php echo $arrayResult[0][2] ?>
            <br>
            <br>
            <label>Quantity:</label>
            <?php echo $arrayResult[0][3] ?>
            <br>
            <br>
            <label>Availability:</label>
            <?php echo $arrayResult[0][4] ?>

            <form method="post">

                <input type="hidden" name="uid" value="<?php echo $_GET['uid'] ?>">
                <br>
                <input type="submit" value="Delete" name="delete">
                <br>
                <br>
            

            </form>
    </main>
</div>
