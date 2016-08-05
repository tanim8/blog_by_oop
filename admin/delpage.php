<?php

include '../lib/Session.php';
Session::checkSession();
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php' ?>


<?php

$db = new Database();
?>

<?php

if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
    echo "<script> window.location='index.php'</script>";
} else {

    $id = $_GET['pageid'];

    $query = "delete from tbl_page where id='$id'";
    $delquery = $db->delete($query);
    if ($delquery) {
        echo "<script> alert('data deleted successfully');"
        . "window.location='index.php';"
        . "</script>";
    } else {
        echo "<script> alert('data not deleted!!);</script>";
        echo "<script> window.location='index.php';</script>";
    }
}
?>



