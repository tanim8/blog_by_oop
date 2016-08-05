<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if (!Session::get('userRole') == '0') {
    echo "<script>window.location='index.php';</script>";
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock"> 

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $fm->validation($_POST['username']);
                $password = $fm->validation(md5($_POST['password']));
                $email = $fm->validation($_POST['email']);
                $role = $fm->validation($_POST['role']);
                $username = mysqli_real_escape_string($db->link, $username);
                $password = mysqli_real_escape_string($db->link, $password);
                 $email = mysqli_real_escape_string($db->link, $email);
                $role = mysqli_real_escape_string($db->link, $role);
                if (empty($username) || empty($password)|| empty($email) || empty($role)) {
                    echo "<span class='error'> field must not be empty!!</span>";
                } else { 
                    $query="select * from tbl_user where email='$email' limit 1";
                    $mailcheck=$db->select($query);
                    if($mailcheck!=FALSE){
                        echo "<span class='error'> mail already exit </span>";
                    } else{
                    $query = "insert into tbl_user(username,password,email,role) values('$username','$password','$email','$role')";
                    $userinsert = $db->insert($query);
                    if ($userinsert) {
                        echo "<span class='success'> user created successfully </span>";
                    } else {
                        echo "<span class='error'> user is not created </span>";
                    }
                }
            }
            
                    }
            ?>
            <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <label>username</label>
                        </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter Username..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>password</label>
                        </td>
                        <td>
                            <input type="text" name="password" placeholder="Enter password..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>email</label>
                        </td>
                        <td>
                            <input type="email" name="email" placeholder="Enter email..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>User role</label>
                        </td>
                        <td>
                            <select id="select" name="role">
                                <option> select user role </option>
                                <option value="0"> Admin </option>
                                <option value="1"> Author </option>
                                <option value="2"> Editor</option>


                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Create" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>
