<?php
require_once '../config/db.php';
require_once '../class/common.cls.php';
require_once '../class/user.cls.php';
$userObj = new User();
$getCountryList = $userObj->getCountries();
$action = mysql_real_escape_string($_POST['action']);
if($action == 'newUser'){
    ?>
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add User</h4>
        </div>
        <div class="modal-body">
          
          <form class="form-horizontal" id="sub_add_user" method="POST" action="#" autocomplete="off">
          
          <div class="form-group">
              <label class="control-label col-sm-2" for="name">Name:</label>
              <div class="col-sm-10">
                <input type="text" class="validate[required] form-control" name="name" id="name" placeholder="Enter name">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-2" for="country">Country:</label>
              <div class="col-sm-10">
                <select class="validate[required] form-control" id="country" name="country">
                <option value="">Select country</option>
                <?php
                    if(!empty($getCountryList)){
                        foreach($getCountryList as $countries){
                            ?>
                            <option value="<?php echo $countries['country_id']; ?>"><?php echo $countries['country_name']; ?></option>
                            <?php
                        }
                    }
                ?>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Email:</label>
              <div class="col-sm-10">
                <input type="email" class="validate[required,custom[email]] form-control" id="email" name="email" placeholder="Enter email">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="mobile">Mobile:</label>
              <div class="col-sm-10">          
                <input type="text" class="validate[required,custom[integer],minSize[10],maxSize[10]] form-control" id="mobile" name="mobile" placeholder="Enter mobile number" maxlength="10">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-2" for="about">About:</label>
              <div class="col-sm-10">          
                <textarea class="validate[required,maxSize[255]] form-control" id="about" name="about" maxlength="255"></textarea>
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-2" for="birthday">Birthday:</label>
              <div class="col-sm-10">          
                <input type="text" class="validate[required] form-control" id="birthday" name="birthday" placeholder="Enter birthday">
                <input type="hidden" name="action" value="add_new_user" />
              </div>
            </div>
            
            <div class="form-group">        
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" id="sub_add_user_button">Submit</button>
              </div>
            </div>
          </form>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>      
      <script type="text/javascript">
        $(document).ready(function(){
            
           $("#sub_add_user").validationEngine('attach', {promptPosition : "centerRight", scroll: false});
           
           $( "#birthday" ).datepicker({
              changeMonth: true,
              changeYear: true,
              dateFormat: 'yy-mm-dd',
              yearRange: '1945:'+(new Date).getFullYear()
           });           
            
        });
        </script>
    <?php
}

elseif($action == 'add_new_user'){    
    $arrData['email'] = mysql_real_escape_string($_POST['email']);
    $checkEmailExist = $userObj->checkUserExist($arrData['email']);
    if($checkEmailExist){
        echo '0';//Email already exists. 
        exit;       
    }    
    $arrData['name'] = mysql_real_escape_string($_POST['name']);
    $arrData['country'] = mysql_real_escape_string($_POST['country']);
    $arrData['mobile'] = mysql_real_escape_string($_POST['mobile']);
    $arrData['about'] = mysql_real_escape_string($_POST['about']);
    $arrData['birthday'] = $_POST['birthday'];
    
    $addUser = $userObj->addUser($arrData);
    if($addUser){
        echo '1';//User added successfully.
    }
    else{
        echo '00';//Error occured.
    }
    
    exit;
}

elseif($action == 'editUser'){
    $user_id = mysql_real_escape_string($_POST['user_id']);
    if($user_id != ''){
        $userDetails = $userObj->getUserDetails($user_id);
        ?>
        <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit User</h4>
            </div>
            <div class="modal-body">
              
              <form class="form-horizontal" id="sub_edit_user" method="POST" action="#" autocomplete="off">
              
              <div class="form-group">
                  <label class="control-label col-sm-2" for="name">Name:</label>
                  <div class="col-sm-10">
                    <input type="text" class="validate[required] form-control" name="name" id="name" placeholder="Enter name" value="<?php echo $userDetails['name']; ?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-label col-sm-2" for="country">Country:</label>
                  <div class="col-sm-10">
                    <select class="validate[required] form-control" id="country" name="country">
                    <option value="">Select country</option>
                    <?php
                        if(!empty($getCountryList)){
                            foreach($getCountryList as $countries){
                                ?>
                                <option <?php if($userDetails['country'] == $countries['country_id']) { echo 'selected="selected"'; } ?> value="<?php echo $countries['country_id']; ?>"><?php echo $countries['country_name']; ?></option>
                                <?php
                            }
                        }
                    ?>
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Email:</label>
                  <div class="col-sm-10">
                    <input type="email" class="validate[required,custom[email]] form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $userDetails['email']; ?>" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="mobile">Mobile:</label>
                  <div class="col-sm-10">          
                    <input type="text" class="validate[required,custom[integer],minSize[10],maxSize[10]] form-control" id="mobile" name="mobile" placeholder="Enter mobile number" maxlength="10" value="<?php echo $userDetails['mobile']; ?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-label col-sm-2" for="about">About:</label>
                  <div class="col-sm-10">          
                    <textarea class="validate[required,maxSize[255]] form-control" id="about" name="about" maxlength="255"><?php echo $userDetails['about']; ?></textarea>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-label col-sm-2" for="birthday">Birthday:</label>
                  <div class="col-sm-10">          
                    <input type="text" class="validate[required] form-control" id="birthday" name="birthday" placeholder="Enter birthday" value="<?php echo $userDetails['birthday']; ?>">
                    <input type="hidden" name="action" value="edit_user_details" />
                    <input type="hidden" name="user_id" value="<?php echo $userDetails['user_id']; ?>" />
                  </div>
                </div>
                
                <div class="form-group">        
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" id="sub_edit_user_button">Submit</button>
                  </div>
                </div>
              </form>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>      
          <script type="text/javascript">
            $(document).ready(function(){
                
               $("#sub_edit_user").validationEngine('attach', {promptPosition : "centerRight", scroll: false});
               
               $( "#birthday" ).datepicker({
                  changeMonth: true,
                  changeYear: true,
                  dateFormat: 'yy-mm-dd',
                  yearRange: '1945:'+(new Date).getFullYear()
               });           
                
            });
            </script>
        <?php
    }
}

elseif($action == 'edit_user_details'){    
    $arrData['email'] = mysql_real_escape_string($_POST['email']);
    $arrData['user_id'] = mysql_real_escape_string($_POST['user_id']);
    $checkUserExistWhileEditing = $userObj->checkUserExistWhileEditing($arrData);
    if($checkUserExistWhileEditing){
        echo '0';//Email already exists. 
        exit;       
    }    
    $arrData['name'] = mysql_real_escape_string($_POST['name']);
    $arrData['country'] = mysql_real_escape_string($_POST['country']);
    $arrData['mobile'] = mysql_real_escape_string($_POST['mobile']);
    $arrData['about'] = mysql_real_escape_string($_POST['about']);
    $arrData['birthday'] = $_POST['birthday'];
    
    $editUser = $userObj->editUser($arrData);
    if($editUser){
        echo '1';//User updated successfully.
    }
    else{
        echo '00';//Error occured.
    }
    
    exit;
}

elseif($action == 'getUserList'){
    $limit['pageNo'] = $_POST['pageNo'];
    $limit['recordsPerPage'] = $_POST['recordsPerPage'];
    $mode = $_POST['mode'];
    if($mode == 'add'){
        $limit['pageNo'] = 0;
    }
    $getUserList = $userObj->getUserList($limit);
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
}
