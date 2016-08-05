<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <?php
        if (isset($_GET['delsliderid'])) {
            $id = $_GET['delsliderid'];
             $query = "select * from tbl_slider where id='$id'";
    $getdata = $db->select($query);
    if ($getdata) {
        while ($delimage = $getdata->fetch_assoc()) {
            $dellink = $delimage['image'];
            unlink($dellink);
        }
    }
            $query = "delete from tbl_slider where id='$id'";
            $delquery = $db->delete($query);
            if ($delquery) {
                echo "<span class='success'> Slider is successfully deleted!!</span>";
            } else {
                echo "<span class='error'> Slider is not successfully deleted </span>";
            }
        }
        ?>

        <div class="block">  
            <table class="data display datatable" id="example">
                <thead>
                    <tr>    
                        <th>No</th>
                        <th> Title</th>
                         <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $query = "select * from tbl_slider";
                    $post = $db->select($query);
                    if ($post) {
                        $i = 0;
                        while ($presult = $post->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $presult['title']; ?></td>
                               
                                <td><img src="<?php echo $presult['image']; ?>" width="60px" height="40px"></td>
                               
                                <td>
                                       <a href="editslider.php?sliderid=<?php echo $presult['id'] ?>">Edit</a> 
                                        ||
                                        <a onclick="return confirm('are you sure to delete');" href="?delsliderid=<?php echo $presult['id'] ?>">Delete</a></td>
                              
                            </tr>
                        <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>



