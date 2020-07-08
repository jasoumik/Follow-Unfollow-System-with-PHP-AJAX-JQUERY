<?php
include('db_connection.php');
session_start();
$message='';
if(isset($_SESSION['user_id'])){
    header('Location:index.php');
}
if(isset($_POST['register'])){
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $check_query="
    SELECT * FROM user_table WHERE username = :username
    ";
    $statement = $connect->prepare($check_query);
    $check_data = array(
        ':username'   => $username
    );
    if($statement->execute($check_data)){
        if($statement->rowCount()>0){
            $message .='<p><label for="">Username is already used</label></p>';
        }
        else {
            if(empty($username)){
                $message .='<p><label for="">Username is required</label></p>';
            }
            if(empty($password)){
                $message .='<p><label for="">Password is required</label></p>';
            }
            else {
                if($password != $_POST["confirm_password"]){
                    $message .='<p><label for="">Password doesnt match</label></p>';
                }
            }
            if($message == ''){
                $data=array(
                    ':username' => $username,
                    ':password' => password_hash($password,PASSWORD_DEFAULT)
                 );
                 $pass = password_hash($password,PASSWORD_DEFAULT);
                $query = "INSERT INTO
	                  user_table
                SET
	                 username = '$username',
	                 password = '$pass',
	                 follower_number = 0
                ";

                $statement = $connect->prepare($query);

                if($statement->execute($data)){
                    $message = '<label for="">Registration Successful</label>';
                   
                }
            }

        }
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body style="background-image:url('socialmedia.jpg')">
    <div class="container">
    <br>
    <h1 align="center" style="color:white;"><b> #myPostBook</b></h1>
    <br><br>
    <div class="panel panel-default">
        <div class="panel-heading">Register</div>
        <div class="panel-body">
            <form action="" method="post">
                <span class="text-danger"><?php echo $message; ?></span>
                <div class="form-group">
                    <label for="">Enter Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Enter Password</label>
                    <input type="text" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Re-enter Password</label>
                    <input type="text" id="confirm_password"
                     name="confirm_password" class="form-control">
                </div>
                <div class="form-group">
                    <!-- <label for="">Enter Username</label> -->
                    <input type="submit" name="register" class="btn btn-info" 
                    value="Register">
                </div>
                <div align="center">
                  <a href="login.php">Login</a>
                  <br><br>
                  <hr>
                  DM : www.jasoumik.com
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>