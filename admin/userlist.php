<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
        <?php
        if (isset($_GET['deluser'])) {
            $id = $_GET['deluser'];
            $query = "delete from tbl_user where id='$id'";
            $delquery = $db->delete($query);
            if ($delquery) {
                echo "<span class='success'> User is successfully deleted!!</span>";
            } else {
                echo "<span class='error'> user is not deleted </span>";
            }
        }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th> Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Details</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "select * from tbl_user order by id desc";
                    $alluser = $db->select($query);
                    if ($alluser) {
                        $i = 0;
                        while ($result = $alluser->fetch_assoc()) {
                            $i++;
                            ?>

                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td><?php echo $result['username']; ?></td>
                                <td><?php echo $result['email']; ?></td>
                                <td><?php echo $fm->textshorten($result['details'], 30); ?></td>
                                <td><?php
                                    if ($result['role'] == '0') {
                                        echo "admin";
                                    } elseif ($result['role'] == '1') {
                                        echo "author";
                                    } elseif ($result['role'] == '2') {
                                        echo "editor";
                                    } else {
                                        echo "no role";
                                    }
                                    ?></td>
                                <td>
                                    <a href="viewuser.php?userid=<?php echo $result['id']; ?>">view</a>
                                    <?php if (Session::get('userRole') == '0') { ?>
                                        || <a onclick="return confirm('are you sure to delete');" href="?deluser=<?php echo $result['id']; ?>">Delete</a></td>
                                <?php } ?>
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


