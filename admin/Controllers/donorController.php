<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__.'/../Includes/functions.php';
require __DIR__.'/../Models/class.donor.php';
require __DIR__.'/../Models/class.admin.php';

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
else if(isset($_POST["deleteDonor"]))
{
    // if( (isset($_GET["record"])))
    // {
    //     $Obj = new Donor;
    //     $client_id = base64_decode($_GET["record"]);
    //     if($Obj->deleteDonor($client_id))
    //     { 
    //         unset($Obj);
    //         header("Location: ./defaulters.php"); 
    //     }
    // }else 
    if( (isset($_POST["donor_id"],$_POST["deleteDonor"])))
    {
        $Obj = new Donor;
        $id = base64_decode($_POST["donor_id"]);
        if($Obj->deleteDonor($id))
        { 
            unset($Obj);
            header("Location: allDonors.php"); 
        }
    }
}

// if(isset($_GET["allDonors"]))
// {
//     $user = new Donor;
//     echo json_encode($user->getAllDonors(["firstName","lastName","phone","picture","bloodtype"]) );
// }




$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$first_part = $components[count($components)-1];

if($first_part == 'index.php')
{
    $obj = new Donor;
    $result = $obj->getAllDonorsData($search=NULL, $limit_start = 0, $limit_end = 0);
    $totalDonors = $result->rowCount();
    unset($userObj);
}
else if($first_part == 'allDonors.php')
{
    $obj = new Donor;
    $result = $obj->getAllDonorsData($search=NULL, $limit_start = 0, $limit_end = 0);
    $totalDonors = $result->rowCount();
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