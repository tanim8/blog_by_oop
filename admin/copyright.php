<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Copyright Text</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $note = mysqli_real_escape_string($db->link, $fm->validation($_POST['note']));


            if ($note == '') {
                echo "<span class='error'> field must not be empty!!</span>";
            } else {
                $query = "update tbl_footer set  note='$note' where id='1' ";

                $updated_rows = $db->update($query);
                if ($updated_rows) {
                    echo "<span class='success'>Data updated Successfully.</span>";
                } else {
                    echo "<span class='error'>Data Not updated !</span>";
                }
            }
        }
        ?>

        <div class="block copyblock"> 
            <?php
            $query = "select * from tbl_footer where id='1'";
            $footer = $db->select($query);
            if ($footer) {
                while ($result = $footer->fetch_assoc()) {
                    ?> 
                    <form action="copyright.php" method="post">
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['note'] ?>" name="note" class="large" />
                                </td>
                            </tr>

                            <tr> 
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
                <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>

