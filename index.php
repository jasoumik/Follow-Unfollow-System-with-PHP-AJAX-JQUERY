<?php
include('db_connection.php');

session_start();
if(!isset($_SESSION['user_id'])){
   header('location:login.php'); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <!-- <script src="index.js"></script> -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>

.main_division
{
    position: auto;
    width: 100%;
    height: auto;
    background-color: #FFF;
    border: 1px solid #CCC;
    border-radius: 3px;
}
#sub_division
{
    width: 100%;
    height: auto;
    min-height: 80px;
    overflow: auto;
    padding:6px 24px 6px 12px;
}
.image_upload
{
    position: absolute;
    top:0px;
    right:16px;
}
.image_upload > form > input
{
    display: none;
}

.image_upload img
{
    width: 40px;
    cursor: pointer;
}

</style>
        
</head>

<body style="background-image:url('socialmedia.jpg')">
    <div class="container">
      <?php
      include('menu.php');
      ?>
      <div class="row">
        <div class="col-md-8">


          <div class="panel panel-default">
            <div class="panel-heading">
            <div class="row">
            <div class="col-md-8">
            
          <h3 class="panel-title">
            
            Start Writing Here
          </h3>
          </div>
          <div class="col-md-4">
            <div class="image_upload">
              <form  method="post" id="uploadImage" action="upload.php">
                <label for="uploadFile">
                <img src="upload.png">
                </label>
                <input type="file" name="uploadFile" id="uploadFile" 
                accept=" .jpg, .png, .mp4, .JPG">
              </form>
            </div>
          </div>
          </div>
          </div>
          <div class="panel-body">
            <form  id="post_form" method="post">
              <div class="form-group" id="dynamic_field">
                <textarea name="post_content" id="post_content" 
                maxlength="160" placeholder="Write Your Short Story" 
                class="form-control"></textarea>
              </div>
              <div id="link_content"></div>
              <div class="form-group">
                <input type="hidden" name="action" value="insert">
                <input type="hidden" name="post_type" id="post_type" value="text">
                <input type="submit" name="share_post" id="share_post" class="
                btn btn-primary" value="Share">
              </div>
            </form>
          </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading">
          <h3 class="panel-title">
            Trending now
          </h3>
          </div>
          <div class="panel-body">
            <div id="post_list">
              
            </div>
          </div>
          </div>

        </div>

        <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
          <h3 class="panel-title">
            User List
          </h3>
          </div>
          <div class="panel-body">
            <div id="user_list">

            </div>
          </div>
          </div>
        </div>
        
      </div>
    </div>
</body>
</html>
<?php

include('jquery.php');

?>