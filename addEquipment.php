<?php
function addEquipment()
{

        $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
        $sql = 'INSERT INTO equipment(equipment_id, equipment_name, location_id, quantity, availability) VALUES (:equipid, :equipname, :locid, :quan, :available)';
        $stmt = $db->prepare($sql);

        //Bind parameters
        $stmt->bindParam(':equipname', $_POST['equipname'], SQLITE3_TEXT);
        $stmt->bindParam(':locid', $_POST['locid'], SQLITE3_TEXT);
        $stmt->bindParam(':quan', $_POST['quan'], SQLITE3_TEXT);
        $stmt->bindParam(':available', $_POST['available'], SQLITE3_TEXT);
        $success = $stmt->execute();

        //If successful, redirect user to this page
        if ($success) {
            header('Location: addEquipmentSummary.php');
            exit;
        } else {
            // Handle failure if needed
            echo "Failed to add equipment.";
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        addEquipment();
    }
    
    require("NavBar.html");
    ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add new staff</title>
    <link rel="stylesheet" href="stylesheet1.css"/>
</head>
<body>
    <div class="menu">
        <main role="main">
            <h1 class="title">Add new equipment</h1>
            <button type="button" class="backUpdates" onclick="location.href='adminMainPage.php'">Back</button>
            <div class="add">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

                <form method="post">
                    <label>Equipment Name :</label>
                    <input type="text" id="add" name="equipname">
                    <br>
                    <br>
                    <label>Location ID :</label>
                    <input type="text" id="add" name="locid">
                    <br>
                    <br>
                    <label>Quantity :</label>
                    <input type="text" id="add" name="quan">
                    <br>
                    <br>
                    <label>Availability :</label>
                    <input type="text" id="add" name="available">
                    <br>
                    <br>
                    <input type="submit" value="Add">
                    <br>
                    <br>
                    
                </form>
            </div>
        </main>
    </div>
</body>
</html>