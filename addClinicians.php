<?php

function addClinic()
{
    // Check if the required form fields are set
    if (!empty($_POST['fname']) && !empty($_POST['DOB']) && !empty($_POST['pass'])) {
        try {
            // Establish database connection 
            $db = new SQLite3("F:\\xampp\\htdocs\\hospital_database.db");
            
            //SQL Statement
            $sql = 'INSERT INTO staff(staff_id, staff_fname, staff_mname, staff_lname, address_id, staff_phone, staff_email, staff_password, staff_dob, job_id) 
                    VALUES (:staffid, :fname, :mname, :lname, :addressid, :phoneno, :email, :pass, :dob, :jobid)';

            // Execute the statement
            $stmt = $db->prepare($sql);
            
            //Bind Parameters
            $stmt->bindParam(':staffid', $_POST['staffid'], SQLITE3_TEXT);
            $stmt->bindParam(':fname', $_POST['fname'], SQLITE3_TEXT);
            $stmt->bindParam(':mname', $_POST['mname'], SQLITE3_TEXT);
            $stmt->bindParam(':lname', $_POST['lname'], SQLITE3_TEXT);
            $stmt->bindParam(':addressid', $_POST['addressid'], SQLITE3_TEXT);
            $stmt->bindParam(':phoneno', $_POST['phone'], SQLITE3_TEXT);
            $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
            $stmt->bindParam(':pass', $_POST['pass'], SQLITE3_TEXT);
            $stmt->bindParam(':dob', $_POST['DOB'], SQLITE3_TEXT);
            $stmt->bindParam(':jobid', $_POST['jobid'], SQLITE3_TEXT);
            
           
            $success = $stmt->execute();
            
            if ($success) {
           
                header('Location: addCliniciansSummary.php');
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
    addClinic();
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
            <button type="button" class="backUpdates" onclick="location.href='Clinicians.php'">Back</button>
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
                    <input type="text" id="add" name="fname">
                    <br>
                    <br>
                    <label>Employee Middle Name :</label>
                    <input type="text" id="add" name="mname">
                    <br>
                    <br>
                    <label>Employee Last Name :</label>
                    <input type="text" id="add" name="lname">
                    <br>
                    <br>
                    <label>Phone Number :</label>
                    <input type="text" id="add" name="phone">
                    <br>
                    <br>
                    <label>Email :</label>
                    <input type="text" id="add" name="email">
                    <br>
                    <br>
                    <label>Password :</label>
                    <input type="password" id="add" name="pass">
                    <br>
                    <br>
                    <label>DOB :</label>
                    <input type="text" id="add" name="DOB">
                    <br>
                    <br>
                    <label>Job ID :</label>
                    <input type="text" id="add" name="jobid">
                    <br>
                    <br>
                    <label>Address ID :</label>
                    <input type="text" id="add" name="addressid">
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