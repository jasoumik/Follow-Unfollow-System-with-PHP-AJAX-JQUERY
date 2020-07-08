<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body> -->
<br>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="index.php" class="navbar-brand">#myPostBook</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <input type="text" name="search_user" id="search_user" class="form-control input-sm"
                placeholder="Search User" autocomplete="on" style="margin-top: 10px;
                 width:400px; margin-right:180px;">
            </li>
        <li class="dropdown">
        <a class=" dropdown-toggle" id="view_ntf" href="#" 
        data-toggle="dropdown">
        Notification <?php 
        $total_ntf= count_ntf($connect,$_SESSION["user_id"]);

        if($total_ntf>0){
            echo '<span class="label label-danger" id="total_ntf">'.$total_ntf.'</span>';
        }
        ?>
       <span class="caret"></span></a>
       <ul class="dropdown-menu">
        <?php 
        echo load_ntf($connect,$_SESSION["user_id"]);
        ?>
       </ul>
      </li>
        <li class="dropdown">
        <a class=" dropdown-toggle" href="#" 
        data-toggle="dropdown">
        <?php echo $_SESSION['username']; ?>
       <span class="caret"></span></a>
       <ul class="dropdown-menu">
        <li><a href="profile.php">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
       </ul>
      </li>
     </ul>
    </div>
   </nav>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
    $('#search_user').typeahead({
        source : function(query,result){
            $('.typeahead').css('position','absolute');
            var action = 'search_user';
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{query:query,action:action},
                dataType:"json",
                success:function(data){
                    result($.map(data,function(item){
                        return item;
                    }));
                }
            })
        }
    });
    $(document).on('click','.typeahead li',function(){
      var search_query = $(this).text();
      window.location.href="wall.php?data="+search_query;
    });
});
</script>
