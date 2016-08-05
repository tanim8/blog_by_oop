<?php
include '../lib/Session.php';
Session::checkLogin();
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php' ?>
<?php include '../helpers/format.php' ?>

<?php
$db = new Database();
$fm = new format();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Password Recovery</title>
        <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
    </head>
    <body>
        <div class="container">
            <section id="content">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $email = $fm->validation($_POST['email']);
                    $email = mysqli_real_escape_string($db->link, $email);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo "<span style='color:red; font size=16px;'>Invalid Email!!</span>";
                    } else {
                        $query = "select * from tbl_user where email='$email' limit 1";
                        $mailcheck = $db->select($query);
                        if ($mailcheck != FALSE) {
                            while($value=$mailcheck->fetch_assoc()){
                                $userid=$value['id'];
                                $username=$value['username'];
                            }
                            
                         $text=  substr($email,3,0);
                         $rand=  rand(10000, 99999);
                         $newpass="$text$rand";
                         $password=  md5($newpass);
                         $updatequery="update tbl_user set password='$password' where id='$userid'";
                         $updated_row=$db->update($updatequery);
                         $to="$email";
                         $from="sajanpoddar98@gmail.com";
                         $headers="From: $from\n";
                       $headers .= 'MIME-Version: 1.0' . "\r\n";
                       $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                       $subject="For password";
                       $message="Your username is".$username."and password is".$newpass."please visit website to login!!";
                         $sendmail=mail($to,$subject,$message,$headers);
                         if($sendmail){
                             echo "<span style='color:green; font size=16px;'>please check your email for new password</span>";
                         }
                         else {
                             echo "<span style='color:red; font size=16px;'>Email not sent</span>";
                         }
                        } else {
                            echo "<span style='color:red; font size=16px;'>Email not exist</span>";
                        }
                    }
                }
                ?>

                <form action="forgetpass.php" method="post">
                    <h1>Recovery Password</h1>
                    <div>
                        <input type="text" placeholder="Enter yout valid email" required="" name="email"/>
                    </div>

                    <div>
                        <input type="submit" value="Send mail" />
                    </div>
                </form><!-- form -->
                <div class="button">
                    <a href="login.php"> Login</a>
                </div><!-- button -->
                <div class="button">
                    <a href="#"> Blog by oop</a>
                </div><!-- button -->
            </section><!-- content -->
        </div><!-- container -->
    </body>
</html>



