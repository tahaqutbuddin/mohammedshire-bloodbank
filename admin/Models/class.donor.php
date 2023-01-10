<?php

use function PHPSTORM_META\elementType;

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

    public function deleteDonor($id)
    {
        $obj = new Database;
        $conn = $obj->connect();
        $query = "DELETE from `donors` where user_id = :cli";
        $sql = $conn->prepare($query);
        $sql->bindParam(':cli',$id,PDO::PARAM_INT);
        $result = $sql->execute();
        if($result)
        {
            return true;
        }
        return false;
    }

    public function getLatestClientID()
    {
        $obj = new Database;
        $conn = $obj->connect();
        $query = "SELECT user_id FROM `donors` order by user_id desc limit 1;";
        $sql = $conn->query($query);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row)
            {
                $obj->closeConnection();
                return $row["user_id"];
            }
        }
        return false;
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

    public function getValueOfDonor($col,$id)
    {
        $obj = new Database;
        $conn = $obj->connect();
        $query = "SELECT $col FROM `donors` do inner join districts di on do.user_id=di.id where do.user_id = :don";
        $sql = $conn->prepare($query);
        $sql->bindParam(':don',$id,PDO::PARAM_INT);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row)
            {
                $obj->closeConnection();
                return $row[$col];
            }
        }
    }

    public function updateDonor($id , $arr = array())
    {
        try{
            $obj = new Database;
            $conn  = $obj->connect();
            $query = "UPDATE `donors` SET ";
            foreach($arr as $key=>$val)
            {
                $query .= " `$key` = :$key ,";
            }
            $query = rtrim($query, ",");
            $query .= 'where user_id = :cli';
            $sql = $conn->prepare($query);
            foreach($arr as $key=>$val)
            {
                if(is_int($val))
                {
                    $sql->bindParam(':'.$key,$arr[$key],PDO::PARAM_INT);
                }else if(is_string($val))
                {
                    $sql->bindParam(':'.$key,$arr[$key],PDO::PARAM_STR);
                }
            }
            $sql->bindParam(':cli',$id,PDO::PARAM_INT);
            $res = $sql->execute();
            if ($res) {
                return true;
            }else
            {
                return false;
            }   
        }catch(PDOException $ex)
        {
            echo "Error: ".$ex->getMessage();
        }
    }

    public function updateDonorImage($id , $path)
    {
        if($this->deleteOldImage($id))
        {
            $obj = new Database;
            $conn  = $obj->connect();
            $query = "UPDATE donors SET picture = :pth where user_id = :uid";
            $sql = $conn->prepare($query);
            $sql->bindParam(':pth',$path,PDO::PARAM_STR);
            $sql->bindParam(':uid',$id,PDO::PARAM_INT);
            $res = $sql->execute();
            if($res)
            {
                return true;
            }
        }
        return false;
    }
    
    public function deleteOldImage($id)
    {
        $obj = new Database;
        $conn  = $obj->connect();
        $query = "SELECT picture from donors where user_id = :uid";
        $sql = $conn->prepare($query);
        $sql->bindParam(':uid',$id,PDO::PARAM_INT);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            $filename = $result[0]["picture"];
            if( ($filename != NULL) && (strlen($filename) > 0) )
            {
                if (file_exists($filename)) {
                unlink($filename);
                echo 'File '.$filename.' has been deleted';
                return true;
                } else {
                echo 'Could not delete '.$filename.', file does not exist';
                return true;
                }
            }else
            {
                return true;
            }            
        }else
        {
            return false;
        }
    }
}


?>