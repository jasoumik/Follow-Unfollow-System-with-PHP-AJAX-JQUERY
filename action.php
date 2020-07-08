<?php

include('db_connection.php');

session_start();
$output='';
if(isset($_POST['action'])){
    
    if($_POST['action']=="insert"){
        $data=array(
           ':user_id'    => $_SESSION["user_id"],
           ':post_content' => $_POST["post_content"],
           ':post_datetime' => date("Y-m-d") . ' ' . date("H:i:s",strtotime(date('h:i:sa')))
        );
        $query ="INSERT INTO post_table(user_id,post_content,post_datetime)
        VALUES(:user_id,:post_content,:post_datetime)
        ";
        $statement = $connect->prepare($query);
        $statement->execute($data);

        $ntf_query = "
        SELECT receiver_id FROM follow_table 
        WHERE sender_id = '".$_SESSION["user_id"]."'
        ";
        $statement = $connect->prepare($ntf_query);
        $statement->execute();
        $ntf_result =$statement->fetchAll();
        foreach($ntf_result as $ntf_row){
            $ntf_text =' <b>'.get_username($connect,$_SESSION["user_id"]).'</b> has shared new Post';
            $insert_query ="
            INSERT INTO ntf_table(ntf_rcv_id,ntf_text,read_ntf)
            VALUES('".$ntf_row["receiver_id"]."','".$ntf_text."','no')
            ";
            $statement = $connect->prepare($insert_query);
              $statement->execute();
        }
    }

    if($_POST['action']=='fetch_post'){
        $query ="SELECT * FROM post_table 
        INNER JOIN user_table ON user_table.user_id = post_table.user_id
        LEFT JOIN follow_table ON follow_table.sender_id=post_table.user_id
        WHERE follow_table.receiver_id = '".$_SESSION["user_id"]."' OR post_table.user_id=
        '".$_SESSION["user_id"]."'
        GROUP BY post_table.post_id
        ORDER BY post_table.post_id DESC ";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $total_row = $statement->rowCount();
        if($total_row >0){
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
        }
        else{
            $output ='<h4>No Post Found</h4>';
        }
        echo $output;
    }
    if($_POST['action']=='fetch_user'){
        $query ="SELECT * FROM user_table WHERE user_id !='".$_SESSION["user_id"]."'
        ORDER BY user_id DESC
        ";
        $statement =$connect->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
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
            $output .='
            <div class="row">
            <div class="col-md-4">
              '.$profile_image.'
            </div>
            <div class="col-md-8">
            <h4><b>@'.$row["username"].'</b></h4>
            '.create_follow_button($connect,$row["user_id"],$_SESSION["user_id"]).'
            <span class="label label-success">
            '.$row["follower_number"].'
            Followers</span>
            </div>
            </div>
            <hr>
            ';
            
        }
        echo $output;
    }
   
     if($_POST['action']=='follow'){
         $query = "
         INSERT INTO follow_table(sender_id,receiver_id)
         VALUES('".$_POST["sender_id"]."','".$_SESSION["user_id"]."')
         ";
         $statement = $connect->prepare($query);
         if($statement->execute()){
             $sub_query = "
             UPDATE user_table SET follower_number=follower_number+1 WHERE user_id
             ='".$_POST["sender_id"]."'
             ";
             $statement=$connect->prepare($sub_query);
             $statement->execute();
             $ntf_text ='<b>'.get_username($connect,$_SESSION["user_id"]).'</b> has 
             followed you';
             $insert_query ="
           INSERT INTO ntf_table(ntf_rcv_id,ntf_text,read_ntf)
           VALUES('".$_POST["sender_id"]."','".$ntf_text."','no')
                            ";
                            $statement = $connect->prepare($insert_query);
                              $statement->execute();
         }
     }
       if($_POST['action']=='unfollow'){
           $query="
           DELETE FROM follow_table WHERE sender_id ='".$_POST["sender_id"]."'
           AND receiver_id='".$_SESSION["user_id"]."'
           ";
           $statement = $connect->prepare($query);
           if($statement->execute()){
            $sub_query = "UPDATE user_table SET follower_number=follower_number-1 WHERE user_id
            ='".$_POST["sender_id"]."'
            ";
            $statement=$connect->prepare($sub_query);
            $statement->execute();
           }
       }

       if($_POST["action"]=='submit_comment'){
           $data=array(
            ':post_id'    => $_POST["post_id"],
            ':user_id'    => $_SESSION["user_id"],
            ':comment' => $_POST["comment"],
            ':timestamp' => date("Y-m-d") . ' ' . date("H:i:s",strtotime(date('h:i:sa')))
           );
           $query="INSERT INTO comment_table (post_id,user_id,comment,timestamp) 
           VALUES(:post_id,:user_id,:comment,:timestamp)
           ";
           $statement=$connect->prepare($query);
           $statement->execute($data);

           $ntf_query="
           SELECT user_id,post_content FROM post_table
           WHERE post_id = '".$_POST["post_id"]."'
           ";
           $statement = $connect->prepare($ntf_query);
           $statement->execute();
           $ntf_result =$statement->fetchAll();
           foreach($ntf_result as $ntf_row){
               $ntf_text ='<b>'.get_username($connect,$_SESSION["user_id"]).'</b> has 
               commented on your Post- "'.strip_tags(substr($ntf_row["post_content"],0,30)).'..."';
               $insert_query ="
               INSERT INTO ntf_table(ntf_rcv_id,ntf_text,read_ntf)
               VALUES('".$ntf_row["user_id"]."','".$ntf_text."','no')
               ";
               $statement = $connect->prepare($insert_query);
                 $statement->execute();
           }

       }

       if($_POST["action"]=="fetch_comment"){
           $query = "SELECT * FROM comment_table INNER JOIN user_table
           ON user_table.user_id = comment_table.user_id
           WHERE post_id = '".$_POST["post_id"]."'
           ORDER BY comment_id ASC
           ";
           $statement=$connect->prepare($query);
           $output='';
           if($statement->execute()){
              $result= $statement->fetchAll();
              foreach($result as $row){
                $profile_image='';
                if($row['profile_image']!=''){
                   $profile_image= '<img src="images/'.$row["profile_image"].'" 
                   class="img-thumbnail img-responsive img-circle">'; 
                }
                else{
                    $profile_image ='<img src="images/user.jpg" 
                    class="img-thumbnail img-responsive img-circle">'; 
                }
                $output .= '
                <div class="row">
                <div class="col-md-2">
                '.$profile_image.'
                </div>
                <div class="col-md-10" style="margin-top:16px;
                padding-left:0">
                <small><b>@'.$row["username"].'</b><br>
                '.$row["comment"].'
                </small>
                </div>
                </div>
                ';
               
              }
           }
           echo $output;
       }

       if($_POST['action']=='repost'){
           $query="
           SELECT * FROM repost_table WHERE post_id = '".$_POST["post_id"]."'
           AND user_id = '".$_SESSION["user_id"]."'
           ";
           $statement = $connect->prepare($query);
           $statement->execute();
           $total_row = $statement->rowCount();
           if($total_row>0){
               echo 'You have already repost this';

           }
           else{
              $query0="
              INSERT INTO repost_table(post_id,user_id) 
              VALUES('".$_POST["post_id"]."','".$_SESSION["user_id"]."')
              ";
              $statement = $connect->prepare($query0);
              if($statement->execute()){
                  $query1="
                  SELECT * FROM post_table WHERE post_id ='".$_POST["post_id"]."'
                  ";
                  $statement = $connect->prepare($query1);
                  if($statement->execute()){
                      $result=$statement->fetchAll();
                      $post_content ='';
                      foreach($result as $row){
                          $post_content = $row['post_content'];
                      }
                      $query2="
                      INSERT INTO post_table(user_id,post_content,post_datetime) 
                      VALUES('".$_SESSION["user_id"]."',
                      '".$post_content."','".date("Y-m-d") . ' ' . date("H:i:s",strtotime(date('h:i:sa')))."')
                      ";
                      $statement = $connect->prepare($query2);
                      if($statement->execute()){
                        $ntf_query="
                        SELECT user_id,post_content FROM post_table
                        WHERE post_id = '".$_POST["post_id"]."'
                        ";
                        $statement = $connect->prepare($ntf_query);
                        $statement->execute();
                        $ntf_result =$statement->fetchAll();
                        foreach($ntf_result as $ntf_row){
                            $ntf_text ='<b>'.get_username($connect,$_SESSION["user_id"]).'</b> has 
                            has reposted your Post-
                             "'.strip_tags(substr($ntf_row["post_content"],0,30)).'..."';
                            $insert_query ="
                            INSERT INTO ntf_table(ntf_rcv_id,ntf_text,read_ntf)
                            VALUES('".$ntf_row["user_id"]."','".$ntf_text."','no')
                            ";
                            $statement = $connect->prepare($insert_query);
                              $statement->execute();
                        }
                          echo 'Repost Done Successfully';
                      }
                  }
              }
            }
       }
       if($_POST["action"]== 'like'){
        $query="SELECT * FROM like_table WHERE post_id = '".$_POST["post_id"]."'
        AND user_id = '".$_SESSION["user_id"]."'
        ";
        $statement = $connect->prepare($query);
        $statement->execute(); 
        $total_row = $statement->rowCount();
       
       if ($total_row>0) {
           echo 'You have already like this Post';
       } else {
        $queryInsert="
        INSERT INTO like_table(post_id,user_id) 
        VALUES('".$_POST["post_id"]."','".$_SESSION["user_id"]."')
        ";
        $statement = $connect->prepare($queryInsert);
        $statement->execute();
        $ntf_query="
        SELECT user_id,post_content FROM post_table
        WHERE post_id = '".$_POST["post_id"]."'
        ";
        $statement = $connect->prepare($ntf_query);
        $statement->execute();
        $ntf_result =$statement->fetchAll();
        foreach($ntf_result as $ntf_row){
            $ntf_text ='<b>'.get_username($connect,$_SESSION["user_id"]).'</b> has 
            liked your Post- "'.strip_tags(substr($ntf_row["post_content"],0,30)).'..."';
            $insert_query ="
            INSERT INTO ntf_table(ntf_rcv_id,ntf_text,read_ntf)
            VALUES('".$ntf_row["user_id"]."','".$ntf_text."','no')
            ";
            $statement = $connect->prepare($insert_query);
              $statement->execute();
        }
        echo 'Liked by you';
       }
    }
       if($_POST["action"]=='user_like_list'){
           $query= "SELECT * FROM like_table INNER JOIN
           user_table ON user_table.user_id = like_table.user_id
           WHERE like_table.post_id ='".$_POST["post_id"]."'
           ";
           $statement = $connect->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        foreach($result as $row){
            $output .='<p>@'.$row["username"].'</p>';
        }
        echo $output;
       }
       if($_POST["action"]== "fetch_link_content"){
           echo file_get_contents($_POST["url"][0]);
       }
    if($_POST["action"]=="update_ntf_sts"){
        $query="
        UPDATE ntf_table SET read_ntf='yes'
        WHERE ntf_rcv_id ='".$_SESSION["user_id"]."'
        ";
        $statement = $connect->prepare($query);
        $statement->execute();
        
    }

    if($_POST["action"]=="search_user"){
        $query ="
        SELECT username,profile_image FROM user_table
        WHERE username LIKE '%".$_POST["query"]."%'
        AND user_id != '".$_SESSION["user_id"]."'
        ";
        $statement =$connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row){
            $data[] = $row["username"];
        }
        echo json_encode($data);
    }
}

?>