<?php include 'inc/header.php'; ?>
<?php
if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
    echo "<script> window.location='404.php';  </script>";

    //header('Location:catlist.php');
} else {
    $id = $_GET['pageid'];
}
?>  

<?php
$query = "select * from tbl_page where id='$id'";
$page = $db->select($query);
if ($page) {
    while ($pageresult = $page->fetch_assoc()) {
        ?>
        <div class="contentsection contemplete clear">
            <div class="maincontent clear">
                <div class="about">

                    <h2><?php echo $pageresult['name']; ?></h2>

                    <p>
                        <?php echo $pageresult['body']; ?>
                    </p>


                </div>
            </div>

            <?php
        }
    } else {
        header('Location:404.php');
    }
    ?>
    <?php include 'inc/sidebar.php'; ?>
    <?php include 'inc/footer.php'; ?>