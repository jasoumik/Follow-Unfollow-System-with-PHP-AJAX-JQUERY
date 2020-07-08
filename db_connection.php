<?php
$connect = new PDO("mysql:host=localhost;dbname=jasmedia","root","root");
function create_follow_button($connect,$sender_id,$receiver_id){
    $query ="
    SELECT * FROM follow_table WHERE sender_id='".$sender_id."' 
    AND receiver_id='".$receiver_id."'
    ";
    $statement=$connect->prepare($query);
    $statement->execute();
    $total_row=$statement->rowCount();
    $output='';
    if ($total_row>0) {
        $output ='
        <button type="button" name="follow_button" 
        class="btn btn-warning action_button" data-action="unfollow" data-sender_id="'
        .$sender_id.'">Following
        </button>
        ';
      
    } else {
        $output ='
        <button type="button" name="follow_button" 
        class="btn btn-warning action_button" data-action="follow" data-sender_id="'
        .$sender_id.'"><i class="glyphicon glyphicon-plus"></i>Follow
        </button>
        ';
      
    }
    return $output;
    
 }
 function count_comment($connect,$post_id){
   $query ="
   SELECT * FROM comment_table WHERE post_id ='".$post_id."'
   ";  
   $statement=$connect->prepare($query);
   $statement->execute();
   return $statement->rowCount();
 }
 function count_repost($connect,$post_id){
    $query ="
    SELECT * FROM repost_table WHERE post_id ='".$post_id."'
    ";  
    $statement=$connect->prepare($query);
    $statement->execute();
    return $statement->rowCount();
  }
  function count_like($connect,$post_id){
    $query ="
    SELECT * FROM like_table WHERE post_id ='".$post_id."'
    ";  
    $statement=$connect->prepare($query);
    $statement->execute();
    return $statement->rowCount();
  }

  function get_username($connect,$user_id){
    $query = "
    SELECT username FROM user_table WHERE user_id = '".$user_id."'
    ";
    $statement=$connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row){
      return $row["username"];
    }
  }

  function count_ntf($connect,$receiver_id){
     $query ="
     SELECT COUNT(ntf_id) as total
     FROM ntf_table WHERE ntf_rcv_id ='".$receiver_id."'
     AND read_ntf ='no'
     ";
     $statement=$connect->prepare($query);
     $statement->execute();
     $result = $statement->fetchAll();
    foreach($result as $row){
      return $row["total"];
    }
  }
  function load_ntf($connect,$receiver_id){
    $query ="
    SELECT * FROM ntf_table WHERE ntf_rcv_id ='".$receiver_id."'
    ORDER BY ntf_id DESC
    ";
    $statement=$connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row =$statement->rowCount();
    $output ='';
    if($total_row>0){
      foreach($result as $row){
       
        $output .='<li><a href="#">'.$row["ntf_text"].'</a></li>';
      }
    }
    return $output;
 }
  function get_user_id($connect,$username){
    $query ="
    SELECT user_id FROM user_table WHERE username= '".$username."'
    ";
    $statement=$connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row){
       
      return $row["user_id"];
    }
  }
?>