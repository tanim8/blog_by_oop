<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
if (!isset($_GET['postid']) || $_GET['postid'] == NULL) {
    echo "<script> window.location='postlist.php';  </script>";

    //header('Location:catlist.php');
} else {
    $id = $_GET['postid'];
}
?>    


<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<script> window.location='postlist.php';  </script>";
        }
        ?>



        <div class="block">   

            <?php
            $query = "select tbl_post.*,tbl_category.name from tbl_post inner join tbl_category on tbl_post.cat=tbl_category.id  where tbl_post.id='$id' ";
            $category = $db->select($query);

            while ($result = $category->fetch_assoc()) {
                ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['title']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" readonly  >
                                    <option value="<?php echo $result['cat']; ?>"><?php echo $result['name'] ?></option>

                                </select>
                            </td>
                        </tr>


            <!--                    <tr>
                                    <td>
                                        <label>Date Picker</label>
                                    </td>
                                    <td>
                                        <input type="text" id="date-picker" />
                                    </td>
                                </tr>-->
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $result['image'] ?>" width='200px' height='100px' />

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
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['tags']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>

                                <input type="text" readonly value="<?php echo $result['author']; ?>" class="medium" />

                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="ok" />
                            </td>
                        </tr>
                    </table>
                </form>
            <?php } ?>

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
<!--<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        setSidebarHeight();
    });
</script>-->
<!-- /TinyMCE -->
<style type="text/css">
    #tinymce{font-size:15px !important;}
</style>
<?php include 'inc/footer.php'; ?>

