<?php

include '../lib/Session.php';
Session::checkSession();
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php' ?>
<?php include '../helpers/format.php' ?>

<?php

$db = new Database();
$fm = new format();
?>

<?php

if (!isset($_GET['delpostid']) || $_GET['delpostid'] == NULL) {
    echo "<script> window.location='postlist.php'</script>";
} else {

    $id = $_GET['delpostid'];
    $query = "select * from tbl_post where id='$id'";
    $getdata = $db->select($query);
    if ($getdata) {
        while ($delimage = $getdata->fetch_assoc()) {
            $dellink = $delimage['image'];
            unlink($dellink);
        }
    }
    $query = "delete from tbl_post where id='$id'";
    $delquery = $db->delete($query);
    if ($delquery) {
        echo "<script> alert('data deleted successfully');"
        . "window.location='postlist.php';"
        . "</script>";
    } else {
        echo "<script> alert('data not deleted!!);</script>";
        echo "<script> window.location='postlist.php';</script>";
    }
}
?>

