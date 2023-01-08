<?php
require_once __DIR__.'/class.database.php';
class Login 
{
    private $conn;
    // Site login Function
    public function login($email , $password)
    {
        $obj = new Database;
        $this->conn = $obj->connect();
        $username_query = $this->conn->prepare("SELECT * FROM `admins` WHERE `username` = :user and `is_active` = 1;");
        $username_query->bindParam(':user' , $email,PDO::PARAM_STR);
        $username_query->execute();
        if($username_query->rowCount() > 0)
        {
            $result = $username_query->fetchAll(PDO::FETCH_ASSOC);
            $password = hash('sha512' , $result[0]["username"].'#$@cdh#$'.$password);
            $query = $this->conn->prepare("SELECT * FROM `admins` WHERE `username`= :user AND `password`= :pass and `is_active` = 1 ;");
            $query->bindParam(':user' , $email,PDO::PARAM_STR);
            $query->bindParam(':pass' , $password,PDO::PARAM_STR);
            $query->execute();
            if($query->rowCount() > 0)
            {
                $result1 = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach($result1 as $row) 
                {
                    if($this->updateLoginTime($row["id"]))
                    {
                        $crypt = $this->AES("encrypt",$row['id']);
                        setcookie('crypt', $crypt , strtotime('+21 days'), '/');    
                        $obj->closeConnection();
                        $_SESSION["adminid"] = $row["id"];
                        return true;
                    } 
                }
            }else { return "Incorrect Credentials"; }
        }else
        {
            return "No Record Exists";
        }
    }

    //Site Logout functionality
    public function logout()
    {
        session_unset();
        session_destroy();
        unset($_COOKIE['crypt']);
        setcookie('crypt', '', time() - 1000, '/');
        return true;
    }

    public function updateLoginTime($user_id)
    {
        $query = "UPDATE `admins` SET `last_login` = NOW() where `id` = :id and `is_active`=1";
        $sql = $this->conn->prepare($query); 
        $sql->bindParam(':id' , $user_id,PDO::PARAM_INT);
        $sql->execute();
        if($sql->rowCount() > 0 ) { return true;}else { return false; }
    }

    private function AES($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'myencrypt';
        $secret_iv = 'encyptaes';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}


?>