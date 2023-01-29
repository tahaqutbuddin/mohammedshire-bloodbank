<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__.'/../Models/class.login.php';

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
        header("Location: ./index.php");
    }
}
