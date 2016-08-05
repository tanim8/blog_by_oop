﻿<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
    echo "<script> window.location='index.php';  </script>";

    //header('Location:catlist.php');
} else {
    $id = $_GET['pageid'];
}
?>   
<style>
    .actiondel{
        margin-left: 10px;
    } 
    .actiondel a{
        border: 1px solid #ddd;
        color: #444;
        cursor: pointer;
        font-size: 20px;
        font-weight: normal;
        padding: 2px 10px;
        background: #f0f0f0;
    }

</style>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Page</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);


            if ($name == '' || $body == '') {
                echo "<span class='error'> field must not be empty!!</span>";
            } else {

                $query = "update tbl_page set name='$name', body='$body' where id='$id' ";
                $updated_rows = $db->update($query);
                if ($updated_rows) {
                    echo "<span class='success'>Data Updated Successfully.</span>";
                } else {
                    echo "<span class='error'>Data Not Updated !</span>";
                }
            }
        }
        ?>
        <div class="block">   

            <?php
            $query = "select * from tbl_page where id='$id'";
            $page = $db->select($query);
            if ($page) {
                while ($result = $page->fetch_assoc()) {
                    ?>
                    <form action=" " method="post">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                                </td>
                            </tr>


                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body"><?php echo $result['body']; ?></textarea>
                                </td>
                            </tr>



                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                    <span class="actiondel"><a onclick="return confirm('are you sure to delete?')" href="delpage.php?pageid=<?php echo $result['id']; ?>">Delete</a></span>
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

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
                                $(document).ready(function() {
                                    setupTinyMCE();
                                    setDatePicker('date-picker');
                                    $('input[type="checkbox"]').fancybutton();
                                    $('input[type="radio"]').fancybutton();
                                });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        setSidebarHeight();
    });
</script>
<!-- /TinyMCE -->
<style type="text/css">
    #tinymce{font-size:15px !important;}
</style>
<?php include 'inc/footer.php'; ?>


