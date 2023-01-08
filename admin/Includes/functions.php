<?php
require_once  __DIR__.'/../Models/class.database.php';

function getAllDistrictsData($columns=array())
{
    $obj = new Database;
    $conn = $obj->connect();
    $query = "SELECT ".  "`".implode('`,`',$columns)."`"  ."FROM `districts` order by name";
    $sql = $conn->query($query);
    $sql->execute();
    if ($sql->rowCount() > 0) {
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $obj->closeConnection();
        return $result;
    }
}

function savePicture($arr)
{
    if (empty($arr['image']))
      throw new Exception('Image file is missing');

    $image = $_FILES['image'];

    if ($image['error'] !== 0) {
        if ($image['error'] === 1) 
           throw new Exception('Max upload size exceeded');
     
        throw new Exception('Image uploading error: INI Error');
    }

    if (!file_exists($image['tmp_name']))
    throw new Exception('Image file is missing in the server');


    $maxFileSize = 4 * 10e6; // = 2 000 000 bytes = 2MB
    if ($image['size'] > $maxFileSize)
        throw new Exception('Max size limit exceeded. Only image less than 4MB is allowed'); 

    $imageData = getimagesize($image['tmp_name']);
    if (!$imageData) 
    throw new Exception('Invalid image');

    $mimeType = $imageData['mime'];
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    if (!in_array($mimeType, $allowedMimeTypes)) 
       throw new Exception('Only JPG, JPEG, PNG and GIFs are allowed');



    $banner = $image['name']; 
    $expbanner = explode('.',$banner);
    $bannerexptype = $expbanner[1];
    $date = date('m/d/Yh:i:sa', time());
    $rand = rand(10000,99999);
    $encname = $date.$rand;
    $bannername = md5($encname).'.'.$bannerexptype;
    $bannerpath="./assets/img/profilePictures/".$bannername;
    if(move_uploaded_file($_FILES["image"]["tmp_name"],$bannerpath))
    {
        return $bannerpath;
    }
    return false;
}


?>