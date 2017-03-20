<?php
class commonData {
    public function getCountries(){
        $sql = "SELECT country_id, country_name FROM countries";
        $query = mysql_query($sql);
        if(mysql_num_rows($query)){
            while($row = mysql_fetch_assoc($query)){
                $returnData[] = $row;
            }
        }
        return $returnData;
    }
}