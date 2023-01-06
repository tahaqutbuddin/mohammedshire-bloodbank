<?php

use PHPMailer\PHPMailer\PHPMailer;
require 'mail/vendor/phpmailer/phpmailer/src/Exception.php';
require 'mail/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'mail/vendor/phpmailer/phpmailer/src/SMTP.php';
require_once 'class.database.php';


class Login 
{
    private $conn;

    public function __construct()
    {
        $this->username = $this->password = $this->fullname  = $this->password =  NULL;
    }

    // Site login Function
    public function login($email , $password)
    {
        $obj = new Database;
        $this->conn = $obj->connect();
        $username_query = $this->conn->prepare("SELECT * FROM `users` WHERE `email` = :user and `is_active` = 1;");
        $username_query->bindParam(':user' , $email,PDO::PARAM_STR);
        $username_query->execute();
        if($username_query->rowCount() > 0)
        {
            $result = $username_query->fetchAll(PDO::FETCH_ASSOC);
            $password = hash('sha512' , $result[0]["firstName"].'#$@cdh#$'.$password);
            $query = $this->conn->prepare("SELECT * FROM `users` WHERE `email`= :user AND `password`= :pass and `is_active` = 1 ;");
            $query->bindParam(':user' , $email,PDO::PARAM_STR);
            $query->bindParam(':pass' , $password,PDO::PARAM_STR);
            $query->execute();
            if($query->rowCount() > 0)
            {
                $result1 = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach($result1 as $row) 
                {
                    if($this->updateLoginTime($row["user_id"]))
                    {
                        $crypt = $this->AES("encrypt",$row['user_id']);
                        setcookie('crypt', $crypt , strtotime('+21 days'), '/');    
                        $obj->closeConnection();
                        if($row["role"]=="user")
                        {
                            $_SESSION["userid"] = $row["user_id"];
                        }else if($row["role"]=="admin")
                        {   
                            $_SESSION["adminid"] = $row["user_id"];
                        }
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
        $query = "UPDATE `users` SET `last_login` = NOW() where `user_id` = :id and `is_active`=1";
        $sql = $this->conn->prepare($query); 
        $sql->bindParam(':id' , $user_id,PDO::PARAM_INT);
        $sql->execute();
        if($sql->rowCount() > 0 ) { return true;}else { return false; }
    }


    public function forgotPassword($email,$username)
    {
        $obj = new Database;
        $this->conn = $obj->connect();
        $query1 = $this->conn->prepare("SELECT * FROM `users` WHERE `email` = :em AND `username` = :user  LIMIT 1");
        $query1->bindParam(":em",$email,PDO::PARAM_STR);
        $query1->bindParam(":user",$username,PDO::PARAM_STR);
        $query1->execute();
        if($query1->rowCount() > 0)
        {
            $to = $email;
            $result = $query1->fetchAll(PDO::FETCH_ASSOC);
            $fullname =  ucfirst($result[0]["fullname"]);
            $subject = "Account Recovery";
            $hash = hash("SHA512","Taajbook2153".$email.$username."Taajbook2153");
            $hashed_ip = hash("SHA512",$_SERVER['REMOTE_ADDR']);
            $link = $_SERVER["SERVER_NAME"] . "/changepassword.php?authorize=$hash&record=".base64_encode($email)."&geo=".$hashed_ip;
            $msg = "<div>You are receiving this mail because you requested for Forget Password. <br/> Here is the link that you can visit to Change your password <br/><br/> $link .</div><br/><br/>Thank You for Using our Services<br/><br/>Yours Truly,<br/>Taajbook.com";
            if($this->send_mail($to,$fullname,$subject,$msg)===true)
            {
                return 1;
            }
        } 
    }

    public function changePassword($email, $pass)
    {
        $obj = new Database;
        $this->conn = $obj->connect();
        $query1 = $this->conn->prepare("SELECT username FROM `users` WHERE `email` = :em  LIMIT 1");
        $query1->bindParam(":em",$email,PDO::PARAM_STR);
        $query1->execute();
        if($query1->rowCount() > 0)
        {
            $username = NULL;
            $result = $query1->fetchAll(PDO::FETCH_ASSOC);
            $username =  $result[0]["username"];
            $hash_password = hash('sha512' , $username.'#$@cdh#$'.$pass);
            $query = "UPDATE `users` SET `password` = :p where `username` = :u and `email`=:em ";
            $sql = $this->conn->prepare($query); 
            $sql->bindParam(':p' , $hash_password,PDO::PARAM_STR);
            $sql->bindParam(':u' , $username,PDO::PARAM_STR);
            $sql->bindParam(':em' , $email,PDO::PARAM_STR);
            $sql->execute();
            if($sql->rowCount() > 0 ) { return true;}else { return false; }
        }
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

    private function send_mail($to,$fullname,$sub,$body)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.titan.email";
        $mail->Username   = "support@taajbook.com";
        $mail->Password   = "IweiSAdmBS";
        
        $mail->IsHTML(true);
        $mail->AddAddress($to, $fullname);
        $mail->SetFrom("support@taajbook.com", "Taajbook Support");
        $mail->Subject = $sub;
        $content = $body;


        $mail->MsgHTML($content); 
        if(!$mail->Send()) {
          echo "Error while sending Email.";
          var_dump($mail);
        } else {
          echo "Email sent successfully";
        }
    }
    
}


?>