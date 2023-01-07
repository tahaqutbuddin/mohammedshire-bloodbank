<?php
require_once 'class.database.php';
class Donor
{

    public function insertDonor($arr = array())
    {
        $uid = $this->checkDonorExists('email',$arr["email"]);
        if(!$uid)
        {
            $hash_password = hash('sha512' , $arr["firstName"].'#$@cdh#$'.$arr["password"]);
            $arr["password"] = $hash_password;
            $conn = new Database;
            $conn = $conn->connect();
            $arr_keys =  array_keys($arr) ;
            if (count($arr) > 0) {
                $columns = '`' . implode('`,`', $arr_keys).'`';
                $values = ":" . implode(",:", $arr_keys);
            }
            $query = "INSERT INTO `donors`($columns) VALUES ($values)";
            $sql = $conn->prepare($query);
            foreach($arr as $key => $val)
            {
                $sql->bindValue(":". $key , $val);
            }
            $sql->execute();
            if($sql->rowCount() > 0) { return $conn->lastInsertId();}else{ return false;}
        }else
        {
            return $uid;
        }
    }

    public function checkDonorExists($col , $val)
    {
        $conn = new Database;
        $conn = $conn->connect();
        $lower_val = strtolower($val);
        $sql = "select * from `donors` where `$col` = :cn and `is_active`=1 ;";
        $query = $conn->prepare($sql);
        $query->bindParam(':cn',$lower_val,PDO::PARAM_STR);
        $query->execute();
        if($query->rowCount() > 0)
        {
            $conn = NULL;
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row)
            {
                return $row["user_id"];
            }
        }else
        {
            return false;
        }
    }

    public function getAllDonors($arr=array())
    {
        $conn = new Database;
        $conn = $conn->connect();
        $arr = '`'.implode('`,`',$arr).'`';
        $sql = "select $arr from `donors` u inner join `districts` d on u.`district` = d.`id` where u.`is_active`=1 ;";
        $query = $conn->query($sql);
        if($query->rowCount() > 0)
        {
            $conn = NULL;
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }else
        {
            return false;
        }
    }

    
    public function getAllDonorsData($search, $limit_start , $limit_end)
    {
        $obj = new Database;
        $conn = $obj->connect();
        $search_query = '';
        $flag = false;
        $cols = 'do.user_id, do.firstName , do.lastName , do.picture, do.phone , do.bloodtype , di.id as district, di.name as district_name ';
        if($search != NULL){
            $search_query .= 'where (';
            foreach($search as $key=>$val)
            {
                if($val!='' || $val!=NULL)
                {
                    $search_query .= "$key LIKE '%".str_replace(' ', '%', $val)."%' and ";
                    $flag = true;
                }
            }
            if($flag)
            {
                $search_query = substr($search_query , 0 ,-4) . ')';
            }else { $search_query = substr($search_query , 0 ,-7); }


            if ( ($limit_start==0) && ($limit_end==0) )
                $query = "SELECT $cols FROM `donors` do inner join `districts` di on do.district = di.id $search_query order by do.user_id ASC;";
            else
                $query = "SELECT $cols FROM `donors` do inner join `districts` di on do.district = di.id $search_query order by do.user_id ASC limit $limit_start,$limit_end; ";
        }else{
            if ( ($limit_start==0) && ($limit_end==0) )
                $query = "SELECT $cols FROM `donors` do inner join `districts` di on do.district = di.id order by do.user_id ASC ";
            else
                $query = "SELECT $cols FROM `donors` do inner join `districts` di on do.district = di.id order by do.user_id ASC limit $limit_start,$limit_end;";
        }
        $sql = $conn->query($query);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $result = $sql;
            $obj->closeConnection();
            return $result;
        }
    }
}


?>