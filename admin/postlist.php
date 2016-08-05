<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>

        <div class="block">  
            <table class="data display datatable" id="example">
                <thead>
                    <tr>    
                        <th width="5%">No</th>
                        <th width="15%">Post Title</th>
                        <th widhth="15%">Description</th>
                        <th width="10%">Category</th>
                        <th width="10%">Image</th>
                        <th width="10%">Author</th>
                        <th width="10%">Tags</th>
                        <th width="10%">Date</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $query = "select tbl_post.*,tbl_category.name from tbl_post inner join tbl_category "
                            . "on tbl_post.cat=tbl_category.id order by tbl_post.id desc";
                    $post = $db->select($query);
                    if ($post) {
                        $i = 0;
                        while ($presult = $post->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $presult['title']; ?></td>
                                <td><?php echo $fm->textshorten($presult['body'], 50); ?></td>
                                <td><?php echo $presult['name']; ?></td>
                                <td><img src="<?php echo $presult['image']; ?>" width="60px" height="40px"></td>
                                <td><?php echo $presult['author']; ?></td>
                                <td><?php echo $presult['tags']; ?></td>
                                <td> <?php echo $fm->formatedate($presult['date']); ?></td>
                                <td><a href="viewpost.php?postid=<?php echo $presult['id'] ?>">View</a> 
                                    <?php if (Session::get('userID') == $presult['userid'] || (Session::get('userRole')) == '0') { ?>
                                        ||
                                        <a href="editpost.php?postid=<?php echo $presult['id'] ?>">Edit</a> 
                                        ||
                                        <a onclick="return confirm('are you sure to delete');" href="deletepost.php?delpostid=<?php echo $presult['id'] ?>">Delete</a></td>
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


