<?php include 'config/config.php'; ?>
<?php include 'lib/Database.php' ?>
<?php include 'helpers/format.php' ?>

<?php
$db = new Database();
$fm = new format();
?>


<!DOCTYPE html>
<html>
    <head>
        <?php
        if (isset($_GET['pageid'])) {
            $id = $_GET['pageid'];
            $query = "select * from tbl_page where id='$id'";
            $pagetitle = $db->select($query);
            if ($pagetitle) {
                while ($titleresule = $pagetitle->fetch_assoc()) {
                    ?>
                    <title><?php echo $titleresule['name'] ?>-<?php echo TITLE; ?></title>

                    <?php
                }
            }
        } elseif (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "select * from tbl_post where id='$id'";
            $pagetitle = $db->select($query);
            if ($pagetitle) {
                while ($titleresule = $pagetitle->fetch_assoc()) {
                    ?>
                    <title><?php echo $titleresule['title'] ?>-<?php echo TITLE; ?></title>
                    <?php
                }
            }
        } else {
            ?>
            <title><?php echo $fm->title(); ?>-<?php echo TITLE; ?></title>
        <?php } ?> 
       <?php include 'scripts/meta.php';?>
        <?php include 'scripts/css.php';?>
        <?php include 'scripts/js.php';?>
    </head>

    <body>
        <div class="headersection templete clear">
            <a href="#">
                <div class="logo">
                    <?php
                    $query = "select * from title_slogan where id='1'";
                    $blog_title = $db->select($query);
                    if ($blog_title) {
                        while ($result = $blog_title->fetch_assoc()) {
                            ?>
                            <img src="admin/<?php echo $result['logo'] ?>" alt="Logo"/>
                            <h2><?php echo $result['title'] ?></h2>
                            <p><?php echo $result['slogan']; ?></p>
                        <?php
                        }
                    }
                    ?>
                </div>
            </a>
            <div class="social clear">
                <div class="icon clear">
                    <?php
                    $query = "select * from tbl_social where id='1'";
                    $social_media = $db->select($query);
                    if ($social_media) {
                        while ($result = $social_media->fetch_assoc()) {
                            ?> 
                            <a href="<?php echo $result['fb'] ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="<?php echo $result['tw'] ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="<?php echo $result['ln'] ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                            <a href="<?php echo $result['gp'] ?>" target="_blank"><i class="fa fa-google-plus"></i></a>

                        <?php
                        }
                    }
                    ?>
                </div>
                <div class="searchbtn clear">
                    <form action="search.php" method="get">
                        <input type="text" name="search" placeholder="Search keyword..."/>
                        <input type="submit" name="submit" value="Search"/>
                    </form>
                </div>
            </div>
        </div>
        <div class="navsection templete">
            <?php
            $path = $_SERVER['SCRIPT_FILENAME'];
            $current_page = basename($path, '.php');
            ?>

            <ul>
                <li><a <?php
                    if ($current_page == 'index') {
                        echo "id='active'";
                    }
                    ?> href="index.php">Home</a></li>
                    <?php
                    $query = "select * from tbl_page";
                    $page = $db->select($query);
                    while ($pageresult = $page->fetch_assoc()) {
                        ?>
                    <li><a <?php
                        if (isset($_GET['pageid']) && $_GET['pageid'] == $pageresult['id']) {
                            echo "id='active'";
                        }
                        ?>

                            href="page.php?pageid=<?php echo $pageresult['id']; ?>"><?php echo $pageresult['name']; ?></a></li>	
                    <?php } ?>
                <li><a <?php
                    if ($current_page == 'contact') {
                        echo "id='active'";
                    }
                    ?> href="contact.php">Contact</a></li>
            </ul>
        </div>