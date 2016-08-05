<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
    echo "<script> window.location='inbox.php';  </script>";

    //header('Location:catlist.php');
} else {
    $id = $_GET['msgid'];
}
?> 

<div class="grid_10">

    <div class="box round first grid">
        <h2>view message</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $to = $fm->validation($_POST['toEmail']);
            $from = $fm->validation($_POST['fromEmail']);
            $subject = $fm->validation($_POST['subject']);
            $message = $fm->validation($_POST['message']);
            $sendmail = mail($to, $subject, $message, $from);

            if ($sendmail) {
                echo "<span class='success'>Message sent successfully</span>";
            } else {
                echo "<span class='error'>something is wrong</span>";
            }
        }
        ?>
        <div class="block">               
            <form action="" method="post">
                <?php
                $query = "select * from tbl_contact where id='$id' ";
                $msg = $db->select($query);
                if ($msg) {
                    $i = 0;
                    while ($result = $msg->fetch_assoc()) {
                        $i++;
                        ?>
                        <table class="form">

                            <tr>
                                <td>
                                    <label>TO</label>
                                </td>
                                <td>
                                    <input type="text" readonly name="toEmail" value="<?php echo $result['email'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>FROM</label>
                                </td>
                                <td>
                                    <input type="text"  name="fromEmail" placeholder="Enter your email..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>SUBJECT</label>
                                </td>
                                <td>
                                    <input type="text"  name="subject" placeholder="enter your subject..." class="medium" />
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <label>Message</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="message"></textarea>
                                </td>
                            </tr>



                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Send" />
                                </td>
                            </tr>
                        </table>
                    <?php
                    }
                }
                ?>
            </form>
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
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        setSidebarHeight();
    });
</script>
<!-- /TinyMCE -->
<style type="text/css">
    #tinymce{font-size:15px !important;}
</style>
<?php include 'inc/footer.php'; ?>





