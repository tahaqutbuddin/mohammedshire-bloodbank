<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once './Models/class.login.php';

if (isset($_POST["loginUser"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ( (strlen($email) > 0 ) && ( strlen($password) > 0) ) {
        $loginObject = new login;
        $result = $loginObject->login($email , $password);
        if( (is_bool($result) && ($result == true)) )
        {
            header('Location: index.php');
        }else
        {
            echo $result;
        }
    }
    else
    {
        echo "Error in username and password";
    }
}else if (isset($_POST["resetUser"]))
{
    $email = htmlentities($_POST["email"]);
    $username = htmlentities($_POST["username"]);

    if ( (strlen($email) > 1 ) && (strlen($username) > 1 ) ) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $loginObject = new login;
            $result = $loginObject->forgotPassword($email , $username);
            if( (is_bool($result) && ($result == true)) )
            {
                echo 'Email sent successfully. Check you email for further action.';
            }else
            {
                echo $result;
            }
        }else
        {
            echo "Please enter valid email address.";
        }
    }
    else
    {
        echo "Please enter email address.";
    }
}
else if (isset($_POST["changePass"]))
{
    $email = htmlentities($_POST["email"]);
    $newPass = htmlentities($_POST["newPass"]);
    $confPass = htmlentities($_POST["confPass"]);

    if ( (strlen($email) > 1 ) && (strlen($newPass) > 1 ) && (strlen($confPass) > 1 ) ) {
        if ($newPass == $confPass ) {

            $loginObject = new login;
            $result = $loginObject->changePassword($email , $newPass);
            if( (is_bool($result) && ($result == true)) )
            {
                header('Location:login.php');
            }else
            {
                echo $result;
            }
        }else
        {
            echo "Password does not match.";
        }
    }
    else
    {
        echo "Please enter complete details.";
    }
}

$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$first_part = $components[count($components)-1];

if ($first_part == "logout.php")
{
    $Obj = new Login;
    if($Obj->logout() == true)
    {
        header("Location: ./login.php");
    }
}
