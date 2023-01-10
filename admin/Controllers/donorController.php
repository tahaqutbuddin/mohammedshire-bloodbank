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
            $message = '<div class="alert alert-danger alert-dismissible>This donor already exists.</div>';
        }else
        {
            unset($insertObj);
            unset($_POST);
            header("Location: ./allDonors.php");
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


//for saving edited info of donor
if(isset($_POST["saveDonor"]))
{
    $message = '';
    $id = base64_decode($_GET["record"]);
    unset($_POST["saveDonor"]);
    foreach ($_POST as $key => $val)
    {
        if(strlen($val)>0)
            $_POST[$key] = htmlentities($val);
    }
    $updateObj = new Donor;
    if(strlen($_FILES["image"]['tmp_name']) > 0)
    {
        $imgPath = savePicture($_FILES);
        $updateObj->updateDonorImage($id,$imgPath);
    }

    if(!$updateObj->updateDonor($id , $_POST))
    {
        $message = '<div class="alert alert-danger alert-dismissible" role="alert">Unable to update Data</div><br/>';
    }
    unset($updateObj);
    unset($_POST);
    // header("Location:allDonors.php");
}


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
else if($first_part == "addDonor.php")
{
    $Obj = new Donor;
    $result = $Obj->getLatestClientID();
    if( !$result ) 
        $id = "10001";
    else{
        $id =  (int) ++$result;
    }
    unset($Obj);
}
else if($first_part == 'editDonor.php')
{
    $Obj = new Donor;
    $donor_id = base64_decode($_GET["record"]);
    $firstName = $Obj->getValueOfDonor("firstName",$donor_id);
    $lastName = $Obj->getValueOfDonor("lastName",$donor_id);
    $email = $Obj->getValueOfDonor("email",$donor_id);
    $gender = $Obj->getValueOfDonor("gender",$donor_id);
    $phone = $Obj->getValueOfDonor("phone",$donor_id);
    $picture = $Obj->getValueOfDonor("picture",$donor_id);
    $bloodtype = $Obj->getValueOfDonor("bloodtype",$donor_id);
    $district_val = $Obj->getValueOfDonor("district",$donor_id);
    $status = $Obj->getValueOfDonor("is_active",$donor_id);  
    unset($Obj);
}



function getAllDonors( $search, $limit_start , $limit_end)
{
    $Obj = new Donor;
    $result = $Obj->getAllDonorsData($search, $limit_start , $limit_end);
    unset($Obj);
    return $result;
}




?>