<?php
include("NavBar.html");
include_once("functions.php");
$equip = getEquip();

?>

<div class="title">
<p>Equipment List</p>
<link rel="stylesheet" href="hospitalEquipAdmin.css"/>
</div>
<button type="button" class="backList" onclick="location.href='adminMainPage.php'">Back</button>
<button type="button" class="addRemove" onclick="location.href='addEquipment.php'">Add</button>
<?php if (isset($_GET['deleted'])): ?>


<p class="userNotify">Equipment has been deleted successfully.</p>


</div>

<?php endif; ?>

<div class="row">

    <table class="table table-striped">

        <thead class="table-dark">

            <td>Equipment Name</td>

            <td>Location</td>

            <td>Quantity</td>

            <td>Availability</td>

            <td>Action</td>

        </thead>


        <?php for ($i = 0; $i < count($equip); $i++): ?>


            <tr>

                <td>
                    <?php echo $equip[$i]['equipment_name'] ?>
                </td>

                <td>
                    <?php echo $equip[$i]['location_name'] . ', ' . $equip[$i]['location_number']?>
                </td>

                <td>
                    <?php echo $equip[$i]['quantity'] ?>
                </td>

                <td>
                    <?php echo $equip[$i]['availability'] ?>
                </td>

                <td><a href="updateEquipAdmin.php?uid=<?php echo $equip[$i]['equipment_id']; ?>">Update</a> | <a href="deleteEquipment.php?uid=<?php echo $equip[$i]['equipment_id']; ?>">Delete</a></td>




            </tr>

        <?php endfor; ?>

    </table>

    </main>


