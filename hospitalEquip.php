<?php
include("NavBar.html");
include_once("functions.php");
$equip = getEquip();

?>

<div class="title">
<p>Equipment List</p>
<link rel="stylesheet" href="hospitalEquip.css"/>
</div>
<button type="button" class="backList" onclick="location.href='staffMainpage.php'">Back</button>
<?php if (isset($_GET['deleted'])): ?>

<p>Hospital equipment has been deleted successfully.</p>

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

                <td><a href="updateEquip.php?uid=<?php echo $equip[$i]['equipment_id']; ?>">Update</a></td>




            </tr>

        <?php endfor; ?>

    </table>

    </main>


