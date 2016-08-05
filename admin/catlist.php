<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php
        if (isset($_GET['catid'])) {
            $id = $_GET['catid'];
            $query = "delete from tbl_category where id='$id'";
            $delquery = $db->delete($query);
            if ($delquery) {
                echo "<span class='success'> Category is successfully deleted!!</span>";
            } else {
                echo "<span class='error'> category is not successfully deleted </span>";
            }
        }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "select * from tbl_category order by id desc";
                    $catgory = $db->select($query);
                    if ($catgory) {
                        $i = 0;
                        while ($result = $catgory->fetch_assoc()) {
                            $i++;
                            ?>

                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td>
                                    <a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a>
                                    || <a onclick="return confirm('are you sure to delete');" href="?catid=<?php echo $result['id']; ?>">Delete</a></td>
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


