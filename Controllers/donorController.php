<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ .'/../Includes/functions.php';
require __DIR__ .'/../Models/class.donor.php';
require __DIR__ .'/../Models/class.login.php';

// For Adding new users
if(isset($_POST["insertDonor"]))
{
    $message = '';
    unset($_POST["insertDonor"]);
    $pass = $_POST["password"];
    $cpass = $_POST["cpassword"];
    if($pass == $cpass)
    {
        unset($_POST["cpassword"]);
        foreach ($_POST as $key => $val)
        {
            if(strlen($val)>0)
                if($key == "email")
                    $_POST[$key] = htmlentities(filter_var($val, FILTER_SANITIZE_EMAIL));
                else
                    $_POST[$key] = htmlentities($val);
        }
        $insertObj = new Donor;
        $imgPath = savePicture($_FILES);
        $_POST["picture"] = $imgPath;
        $result = $insertObj->insertDonor($_POST);
        if(is_int($result))
        {
            unset($insertObj);
            $message = '<div class="alert alert-danger alert-dismissible>This user already exists.</div>';
        }else
        {
            unset($insertObj);
            unset($_POST);
            header("Location: ./index.php");
        }
    }else
    {
        echo "Incorrect Password";
    }
    
}

if(isset($_GET["allDonors"]))
{
    $user = new Donor;
    echo json_encode($user->getAllDonors(["firstName","lastName","phone","picture","bloodtype"]) );
}




$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$first_part = $components[count($components)-1];


if($first_part == 'search-donors.php')
{
    $obj = new Donor;
    $result = $obj->getAllDonorsData(array('user_id'), $search=NULL, $limit_start = 0, $limit_end = 0);
    $allDonorsCount = $result->rowCount();
    unset($userObj);
}

function getAllDonors( $search, $limit_start , $limit_end)
{
    $Obj = new Donor;
    $result = $Obj->getAllDonorsData($search, $limit_start , $limit_end);
    unset($Obj);
    return $result;
}




?>