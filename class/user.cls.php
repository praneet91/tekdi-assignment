<?php
class User extends commonData {
    public function getUserList($limit){
        $sql = "SELECT u.user_id, u.name, u.email, u.mobile, u.about, u.birthday, c.country_name
                FROM users u 
                INNER JOIN countries c ON u.country = c.country_id
                ORDER BY u.user_id
                LIMIT ".$limit['pageNo'].", ".$limit['recordsPerPage']."
                ";
        $query = mysql_query($sql);
        if(mysql_num_rows($query)){
            while($row = mysql_fetch_assoc($query)){
                $returnData[] = $row;
            }
        }
        return $returnData;
    }
    
    public function getTotalUsers(){
        $sql = "SELECT count(u.user_id) as total_records
                FROM users u 
                INNER JOIN countries c ON u.country = c.country_id
                ORDER BY u.user_id
                ";
        $query = mysql_query($sql);
        if(mysql_num_rows($query)){
            $returnData = mysql_fetch_assoc($query);
        }
        return $returnData;
    }
    
    public function getUserDetails($user_id){
        $sql = "SELECT u.user_id, u.country, u.name, u.email, u.mobile, u.about, u.birthday, c.country_name
                FROM users u 
                INNER JOIN countries c ON u.country = c.country_id
                WHERE u.user_id = '".$user_id."'
                ";
        $query = mysql_query($sql);
        if(mysql_num_rows($query)){
            $returnData = mysql_fetch_assoc($query);
        }
        return $returnData;
    }
    
    public function checkUserExist($email){
        $sql = "SELECT user_id FROM users WHERE email = '".$email."' ";
        $query = mysql_query($sql);
        if(mysql_num_rows($query)){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function checkUserExistWhileEditing($arrData){
        $sql = "SELECT user_id FROM users WHERE email = '".$arrData['email']."' AND user_id <> '".$arrData['user_id']."' ";
        $query = mysql_query($sql);
        if(mysql_num_rows($query)){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function addUser($arrData){
        $sql = " INSERT INTO users ( name, country, email, mobile, about, birthday ) 
                 VALUES ( '".$arrData['name']."', '".$arrData['country']."', '".$arrData['email']."', 
                        '".$arrData['mobile']."', '".$arrData['about']."', '".$arrData['birthday']."' )   
               ";
        if(mysql_query($sql)){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function editUser($arrData){
        $sql = " UPDATE users SET name = '".$arrData['name']."', country = '".$arrData['country']."', email = '".$arrData['email']."', 
                    mobile = '".$arrData['mobile']."', about = '".$arrData['about']."', birthday = '".$arrData['birthday']."'
                 WHERE user_id = '".$arrData['user_id']."'                    
               ";
        if(mysql_query($sql)){
            return true;
        }
        else{
            return false;
        }      
    }
}