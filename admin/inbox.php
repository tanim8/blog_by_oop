<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>

        <?php
        if (isset($_GET['msgid'])) {
            $seenid = $_GET['msgid'];

            $query = "update tbl_contact set status='1' where id='$seenid'";
            $catupdate = $db->update($query);
            if ($catupdate) {
                echo "<span class='success'> message sent in the seen box!!</span>";
            } else {
                echo "<span class='error'> something went wrong </span>";
            }
        }
        ?>

        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "select * from tbl_contact where status='0' order by id desc";
                    $msg = $db->select($query);
                    if ($msg) {
                        $i = 0;
                        while ($result = $msg->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['firstname'] . '' . $result['lastname']; ?></td>
                                <td><?php echo $result['email'] ?></td>
                                <td><?php echo $fm->textshorten($result['body'], 30) ?></td>
                                <td><?php echo $fm->formatedate($result['date']) ?></td>
                                <td><a href="viewmsg.php?msgid=<?php echo $result['id'] ?>">View</a> || 
                                    <a href="replymsg.php?msgid=<?php echo $result['id'] ?>">Reply</a> || 
                                    <a onclick="return confirm('are you sure to move ?')" href="?msgid=<?php echo $result['id'] ?>">Seen</a>
                                </td>
                            </tr>

                        <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="box round first grid">
        <h2>seen message</h2>
        <?php
        if (isset($_GET['delid'])) {
            $id = $_GET['delid'];
            $query = "delete from tbl_contact where id='$id'";
            $delquery = $db->delete($query);
            if ($delquery) {
                echo "<span class='success'> Message is successfully deleted!!</span>";
            } else {
                echo "<span class='error'> something is wrong </span>";
            }
        }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "select * from tbl_contact where status='1' order by id desc";
                    $msg = $db->select($query);
                    if ($msg) {
                        $i = 0;
                        while ($result = $msg->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['firstname'] . '' . $result['lastname']; ?></td>
                                <td><?php echo $result['email'] ?></td>
                                <td><?php echo $fm->textshorten($result['body'], 30) ?></td>
                                <td><?php echo $fm->formatedate($result['date']) ?></td>
                                <td>
                                    <a href="viewmsg.php?msgid=<?php echo $result['id'] ?>">View</a> ||
                                    <a onclick="return confirm('are you sure to delete ?')" href="?delid=<?php echo $result['id'] ?>">Delete</a>  

                                </td>
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