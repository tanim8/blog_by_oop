<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock"> 

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $name = mysqli_real_escape_string($db->link, $name);
                if (empty($name)) {
                    echo "<span class='error'> field must not be empty!!</span>";
                } else {
                    $query = "insert into tbl_category(name) values('$name')";
                    $catinsert = $db->insert($query);
                    if ($catinsert) {
                        echo "<span class='success'> Category is successfully inserted!!</span>";
                    } else {
                        echo "<span class='error'> category is not successfully inserted </span>";
                    }
                }
            }
            ?>
            <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>

