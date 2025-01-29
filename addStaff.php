<?php

function addNewStaff()
{
    // Check if the required form fields are set
    if (!empty($_POST['hfname']) && !empty($_POST['hdob']) && !empty($_POST['hpass'])) {
        try {
            $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
            
            //SQL statement
            $sql = 'INSERT INTO hospitalstaff(hstaff_id, hstaff_fname, hstaff_mname, hstaff_lname, address_id, hstaff_phone, hstaff_email, password, hstaff_dob, job_id) 
                    VALUES (:hstaffid, :hfname, :hmname, :hlname, :addressid, :hphoneno, :hemail, :hpass, :hdob, :jobid)';
            //Execute statement
            $stmt = $db->prepare($sql);
            
            //Bind parameters
            $stmt->bindParam(':hstaffid', $_POST['hstaffid'], SQLITE3_TEXT);
            $stmt->bindParam(':hfname', $_POST['hfname'], SQLITE3_TEXT);
            $stmt->bindParam(':hmname', $_POST['hmname'], SQLITE3_TEXT);
            $stmt->bindParam(':hlname', $_POST['hlname'], SQLITE3_TEXT);
            $stmt->bindParam(':addressid', $_POST['addressid'], SQLITE3_TEXT);
            $stmt->bindParam(':hphoneno', $_POST['hphoneno'], SQLITE3_TEXT);
            $stmt->bindParam(':hemail', $_POST['hemail'], SQLITE3_TEXT);
            $stmt->bindParam(':hpass', $_POST['hpass'], SQLITE3_TEXT);
            $stmt->bindParam(':hdob', $_POST['hdob'], SQLITE3_TEXT);
            $stmt->bindParam(':jobid', $_POST['jobid'], SQLITE3_TEXT);
            
           
            $success = $stmt->execute();
            
            if ($success) {
           
                header('Location: addStaffSummary.php');
                exit;
            } else {
             
                echo "Failed to insert data into the database.";
            }
        } catch (Exception $e) {
          
            echo "An error occurred: " . $e->getMessage();
        } finally {
           
            $db->close();
        }
    } else {
    
        echo "Please fill in all required fields.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    addNewStaff();
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
            <h1 class="title">Add new staff</h1>
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
                    <label>Employee Name :</label>
                    <input type="text" id="add" name="hfname">
                    <br>
                    <br>
                    <label>Employee Middle Name :</label>
                    <input type="text" id="add" name="hmname">
                    <br>
                    <br>
                    <label>Employee Last Name :</label>
                    <input type="text" id="add" name="hlname">
                    <br>
                    <br>
                    <label>Address ID :</label>
                    <input type="text" id="add" name="addressid">
                    <br>
                    <br>
                    <label>Phone Number :</label>
                    <input type="text" id="add" name="hphoneno">
                    <br>
                    <br>
                    <label>Email :</label>
                    <input type="text" id="add" name="hemail">
                    <br>
                    <br>
                    <label>Password :</label>
                    <input type="password" id="add" name="hpass">
                    <br>
                    <br>
                    <label>DOB :</label>
                    <input type="text" id="add" name="hdob">
                    <br>
                    <br>
                    <label>Job ID :</label>
                    <input type="text" id="add" name="jobid">
                    <br>
                    <br>
                    <input type="submit" value="Submit">
                    <br>
                    <br>
                    
                </form>
            </div>
        </main>
    </div>
</body>
</html>