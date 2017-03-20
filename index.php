<?php
require_once 'config/db.php';
require_once 'class/common.cls.php';
require_once 'class/user.cls.php';
$userObj = new User();
$getTotalUsers = $userObj->getTotalUsers();
$totalRecords = $getTotalUsers['total_records'];
$recordsPerPage = 5;
$totalPages = ceil($totalRecords / $recordsPerPage);
$pageNo = $_GET['page'];
if($pageNo == ''){
    $pageNo = 0;
}
$limit['pageNo'] = $pageNo * $recordsPerPage;
$limit['recordsPerPage'] = $recordsPerPage;
$getUserList = $userObj->getUserList($limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tekdi Assignment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
  <!--<link rel="stylesheet" href="css/template.css" type="text/css"/>-->
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/bootbox.min.js"></script>
  <script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
  <script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>

<div class="container">
  <h2>Tekdi Assignment</h2>  
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="add_user">Add User</button>
  <div class="clearfix"></div>
  <p>List of users</p>            
  <table class="table">
    <thead>
      <tr>
        <!--<th>Sr.No.</th>-->
        <th>Name</th>
        <th>Country</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>About</th>
        <th>Birthday</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="user_list">
      <?php
      if(!empty($getUserList)){
        foreach($getUserList as $userList){
            ?>
            <tr>
                <td><?php echo $userList['name']; ?></td>
                <td><?php echo $userList['country_name']; ?></td>
                <td><?php echo $userList['email']; ?></td>
                <td><?php echo $userList['mobile']; ?></td>
                <td><?php echo $userList['about']; ?></td>
                <td><?php echo $userList['birthday']; ?></td>
                <td>
                <a data-toggle="modal" data-target="#myModal" href="javascript:void(0);" onclick="editUser('<?php echo $userList['user_id']; ?>')">
                  <img src="images/edit.png" style="width: 25px;" />
                </a>
                </td>        
              </tr>
            <?php
        }
      }
      else{
        echo '<tr><td colspan="7" align="center">No data found.</td></tr>';
      }
      ?>     
    </tbody>
  </table>
  
<ul class="pager">
  <?php
  if($pageNo > 0){
    ?>
    <li><a href="?page=<?php echo $pageNo - 1; ?>">Previous</a></li>
    <?php
  }
  ?> 
  <?php
  if($totalPages - $pageNo != 1){
    ?>
    <li><a href="?page=<?php echo $pageNo + 1; ?>">Next</a></li>
    <?php
  }
  ?>  
</ul>

  <!-- Modal Start -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" id="ModalContainer">
    
      
    </div>
  </div>
  <!-- Modal End -->

</div>

</body>
</html>

<script type="text/javascript">
$(document).ready(function(){
    
   $(document).on("click", "#add_user", function(){
        var action = 'newUser';
        $.ajax({
           url : 'ajax/user.php',
           type : 'POST',
           data : {action : action},
           success : function(result){
                $('#ModalContainer').html(result);
           }
        });
   });
   
   //Add user
   $(document).on("click", "#sub_add_user_button", function(){
        $('#sub_add_user').on('submit', function (e) {

          e.preventDefault();          
          if($("#sub_add_user").validationEngine('validate') == true){                
                $.ajax({
                type: 'post',
                url: 'ajax/user.php',
                data: $('#sub_add_user').serialize(),
                success: function (result) {
                  result = result.trim();
                  if(result == '0'){
                    bootbox.alert('<div class="alert alert-danger">Email already exist.</div>');
                  }
                  else if(result == '1'){
                    bootbox.alert('<div class="alert alert-success">User added successfully.</div>', function(){
                        //Refresh user list.
                        getUserList('add');
                    });                    
                  }
                  else if(result == '00'){
                    bootbox.alert('<div class="alert alert-danger">Error occured.Please try again after sometime.</div>');
                  }
                }
              });
          }

        });
   });  
   
   //Edit user
   $(document).on("click", "#sub_edit_user_button", function(){
        $('#sub_edit_user').on('submit', function (e) {

          e.preventDefault();          
          if($("#sub_edit_user").validationEngine('validate') == true){                
                $.ajax({
                type: 'post',
                url: 'ajax/user.php',
                data: $('#sub_edit_user').serialize(),
                success: function (result) {
                  result = result.trim();
                  if(result == '0'){
                    bootbox.alert('<div class="alert alert-danger">Email already exist.</div>');
                  }
                  else if(result == '1'){
                    bootbox.alert('<div class="alert alert-success">User updated successfully.</div>', function(){
                        //Refresh user list.
                        getUserList('edit');
                    });                    
                  }
                  else if(result == '00'){
                    bootbox.alert('<div class="alert alert-danger">Error occured.Please try again after sometime.</div>');
                  }
                }
              });
          }

        });
   }); 
   
});

function editUser(user){
    var action = 'editUser', user_id = user;
    $.ajax({
       url : 'ajax/user.php',
       type : 'POST',
       data : {action : action, user_id : user_id},
       success : function(result){
            $('#ModalContainer').html(result);
       }
    });
   }
   
function getUserList(mode){
    $('#myModal').modal('toggle');
    var action = 'getUserList',
    pageNo = '<?php echo $limit['pageNo']; ?>',
    recordsPerPage = '<?php echo $limit['recordsPerPage']; ?>',
    mode = mode;
    if(mode == 'add'){        
        document.location.href = 'http://localhost/tekdi/';
    }
    $.ajax({
       url : 'ajax/user.php',
       type : 'POST',
       data : {action : action, pageNo : pageNo, recordsPerPage : recordsPerPage, mode : mode},
       success : function(result){
            $('#user_list').html(result);
       }
    });
   }   
</script>