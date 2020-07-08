<?php
include('db_connection.php');
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}
$output='';
$query="
SELECT * FROM post_table
INNER JOIN user_table ON user_table.user_id = post_table.user_id
WHERE user_table.username = '".$_GET["data"]."'
GROUP BY post_table.post_id
ORDER BY post_table.post_id DESC
";
$statement = $connect->prepare($query);
$statement->execute();
$total_row = $statement->rowCount();
$user_id= get_user_id($connect,$_GET["data"])
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Follow Unfollow System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
</head>
<body style="background-image:url('socialmedia.jpg')">
    <div class="container">
    <?php
         include('menu.php');
           ?> 
        <div class="row">
        <?php
         if($total_row > 0){
             $result = $statement->fetchAll();
         
           ?> 
           <div class="col-md-9">
               <div class="panel panel-default">
                   <div class="panel-heading">
                       <div class="row">
                           <div class="col-md-6">
                               <h3 class="panel-title">
                               <?php
                         echo '<b>'.$_GET["data"].'</b>';
                                ?>  Post Details
                               </h3>
                           </div>
                           <div class="col-md-6" align="right">
                           <?php
                         if($user_id != $_SESSION["user_id"]){
                             echo create_follow_button($connect,$user_id,$_SESSION["user_id"]);
                         }
                                ?>
                           </div>
                       </div>
                   </div>
                   <div class="panel-body">
                   <?php
                  foreach($result as $row){
                    $profile_image='';
                    if($row['profile_image']!=''){
                       $profile_image= '<img src="images/'.$row["profile_image"].'" 
                       class="img-thumbnail img-responsive">'; 
                    }
                    else{
                       $profile_image ='<img src="images/user.jpg" 
                       class="img-thumbnail img-responsive">'; 
                    }
                    $repost='disabled';
                    if($row['user_id'] != $_SESSION['user_id']){
                        $repost='';
                    }
                    
                    $output .='<div class="jumbotron" syle="padding:24px 30px 24px 30px">
                    <div class="row">
                    <div class="col-md-2">
                    '.$profile_image.'
                    </div>
                    <div class="col-md-8">
                    <h3><b>@'.$row["username"].'</b></h3>
                    <p>'.$row["post_content"].'
                    <button type="button" class="btn btn-link post_comment"
                    id="'.$row["post_id"].'" data-user_id="'.$row["user_id"].'"
                    >'.count_comment($connect,$row["post_id"]). ' Comment</button>
                    <button type="button" class="btn btn-danger repost" 
                    data-post_id="'.$row["post_id"].'" '.$repost.'>
                    <span class="glyphicon glyphicon-retweet"></span>&nbsp;&nbsp;
                    '.count_repost($connect,$row["post_id"]).'
                    </button>
                    <button type="button" class="btn btn-link like_button" 
                    data-post_id="'.$row["post_id"].'">
                    <span class="glyphicon glyphicon-thumbs-up"> Like</span>&nbsp;
                    '.count_like($connect,$row["post_id"]).'
                    </button>
                    </p>
                    <div id="comment_form'.$row["post_id"].'"
                    style="display:none;">
                    <span id="old_comment'.$row["post_id"].'">
                    </span>
                    <div class="form-group">
                    <textarea name="comment" class="form-control" id="comment'
                    .$row["post_id"].'">
                    </textarea>
                    </div>
                    <div class="form-group" align="right">
                    <button type="button" name="submit_comment" class="btn btn-primary
                     btn-xs submit_comment">Comment
                    </button>
                    </div>
                    </div>
                    </div>
                    </div></div>';
                    
                }
                echo $output;
            
                    ?> 
                   </div>
               </div>
           </div>

           <div class="col-md-3">
               <div class="panel-default">
                   <div class="panel-heading">
                       <h3 class="panel-title"> <?php
                         echo '<b>'.$_GET["data"].'</b>';
                                ?>  Followers</h3>
                   </div>
                   <div class="panel-body">
                    <?php
                    $follower_query ="
                    SELECT * FROM user_table INNER JOIN follow_table ON
                    follow_table.receiver_id = user_table.user_id
                    WHERE follow_table.sender_id = '".$user_id."'
                    ";
                    $statement = $connect->prepare($follower_query);
                    $statement->execute();
                    $follower_result = $statement->fetchAll();
                    foreach($follower_result as $follower_row){
                        $profile_image='';
                    if($follower_row['profile_image']!=''){
                       $profile_image= '<img src="images/'.$follower_row["profile_image"].'" 
                       class="img-thumbnail img-responsive">'; 
                    }
                    else{
                       $profile_image ='<img src="images/user.jpg" 
                       class="img-thumbnail img-responsive">'; 
                    }
                    echo '<div class="row">
                    <div class="col-md-4">
                    '.$profile_image.'</div>
                    <div class="col-md-8">
                    <h4><b>@<a href="wall.php?data='.$follower_row["username"].'">'.
                    $follower_row["username"].'</b></h4>
                    </div>
                    </div>
                    <hr>';
                    }
                    ?>
                   </div>
               </div>

           </div>
          <?php
           }
          else{
            echo '<h3 align="center">No Post Found</h3>';
        }
        
          ?>

        </div>
    </div>
</body>
</html>
<?php

include('jquery.php');

?>