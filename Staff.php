<?php
include("NavBar.html");
include_once("functions.php");
$hospitalstaff = viewStaff();
$staffList = staffSearchBar();

if(isset($_POST['submit']) && $_POST['submit'] == 'filter') {

    if(!empty($_POST['filterStaff'])) {
        $staffList = staffSearchBar();
    } else {
      //If staff is not filtered using the staff ID then display all staff
        $staffList = viewStaff();
    }
} else {
  
    $staffList = viewStaff();
}

?>

<div class="title">
<link rel="stylesheet" href="staff.css"/>
<p>Staff List</p>
</div>
<button type="button" class="backList" onclick="location.href='adminMainPage.php'">Back</button>
<button type="button" class="addRemove" onclick="location.href='addStaff.php'">Add</button>
<form method="post">
    <label for="filterStaff" style="color: white;">Filter by Staff ID:</label>
    <input type="text" id="filterStaff" name="filterStaff" class="form-control" style="width: 60px; height: 20px;" value="<?php echo isset($_POST['filterStaff']) ? $_POST['filterStaff'] : ''; ?>">
    <br>
    <br>
    <button type="submit" name="submit" value="filter">Filter</button>
</form>
<br>
<?php
if(isset($_GET['success']) && $_GET['success'] == 1) {
    // If so, display the success message
    echo '<div class="success-message"><p>New staff has been added.</p></div>';
}
    ?>
<div class="row">

<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>Staff ID</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>D.O.B</th>
            <th>Job</th>
            <th>Address</th>
           
        </tr> 
    </thead>
    <tbody> 
        <?php foreach ($staffList as $staff): ?>
            <tr>
                <td><?php echo $staff['hstaff_id']; ?></td>
                <td><?php echo $staff['hstaff_fname'] . ' ' . $staff['hstaff_mname'] . ' ' . $staff['hstaff_lname']; ?></td>
                <td><?php echo $staff['hstaff_phone']; ?></td>
                <td><?php echo $staff['hstaff_email']; ?></td>
                <td><?php echo $staff['hstaff_dob']; ?></td>
                <td><?php echo $staff['job_class']; ?></td>
                <td><?php echo $staff['house_num'] . ', ' . $staff['postcode'] . ',  ' . $staff['county'] . ', ' . $staff['city']?> </td>
            </tr>
        <?php endforeach; ?>
    </tbody> 
</table>