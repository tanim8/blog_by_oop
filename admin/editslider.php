<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
if (!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL) {
    echo "<script> window.location='sliderlist.php';  </script>";

    //header('Location:catlist.php');
} else {
    $id = $_GET['sliderid'];
}
?>    


<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            
//             $image=$_POST['image'];
            $title = mysqli_real_escape_string($db->link, $title);
           
            /* upload image */
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/slider/" . $unique_image;

            if ($title == '') {
                echo "<span class='error'> field must not be empty!!</span>";
            } else {
                if (!empty($file_name)) {
                    if ($file_size > 1048567) {
                        echo "<span class='error'>Image Size should be less then 1MB!</span>";
                    } elseif (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can upload only:-" . implode(', ', $permited) . "</span>";
                    } else {
                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "update tbl_slider set  title='$title',  image='$uploaded_image' where id='$id' ";

                        $updated_rows = $db->update($query);
                        if ($updated_rows) {
                            echo "<span class='success'>Data updated Successfully.</span>";
                        } else {
                            echo "<span class='error'>Data Not updated !</span>";
                        }
                    }
                } else {
                    $query = "update tbl_slider set  title='$title' where id='$id' ";

                    $updated_rows = $db->update($query);
                    if ($updated_rows) {
                        echo "<span class='success'>Data updated Successfully.</span>";
                    } else {
                        echo "<span class='error'>Data Not updated !</span>";
                    }
                }
            }
        }
        ?>



        <div class="block">   

            <?php
            $query = "select * from tbl_slider where id='$id' ";
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
                                <input type="text" name="title" value="<?php echo $result['title']; ?>" class="medium" />
                            </td>
                        </tr>

                       
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $result['image'] ?>" width='200px' height='100px' />
                                <input type="file" name="image"/>
                            </td>
                        </tr>
                        

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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

