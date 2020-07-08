<?php
include('db_connection.php');

session_start();


// if(isset($_SESSION['user_id'])){
//     header('location:index.php');
// }
$message ='';
if(isset($_POST["login"])){
    $data=array(
        ':username' => $_POST['username']
        
    );
    $query ="SELECT * FROM user_table WHERE username=:username
    ";
    $statement = $connect->prepare($query);
    if($statement->execute($data)){
    $count = $statement->rowCount();
    if($count>0){
     $result = $statement->fetchAll();
     foreach($result as $row){
         if(password_verify($_POST['password'],$row['password'])){
          $_SESSION['user_id']=$row['user_id'];
          $_SESSION['username']=$row['username'];
          header('location:index.php');
         }
         else{
            $message = '<label for="">Wrong Password</label>'; 
         }
     }
    }
    else{
        $message = '<label for="">Wrong Username</label>';
    }
}
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
</head>
<body style="background-image:url('socialmedia.jpg')">
<div class="container" style="margin-top:10%;">
    <br>
    <h1 align="center" style="color:white;"><b> #myPostBook</b></h1>
    <br><br>
    <div class="panel panel-default">
        <div class="panel-heading" align="center">Login to #myPostBook</div>
        <div class="panel-body">
            <form method="post">
                <span class="text-danger"><?php echo $message;?></span>
                <div class="form-group">
                    <label for="">Enter Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Enter Password</label>
                    <input type="password" name="password"  
                    class="form-control" required>
                </div>
            
                <div class="form-group">
                    <!-- <label for="">Enter Username</label> -->
                    <input type="submit" name="login" class="btn btn-info" 
                    value="Login">
                </div>
                <div align="center">
                  <a href="register.php">Register</a>
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