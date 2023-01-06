<?php
if(!isset($_SESSION["userid"]))
{       
    header('Location:login.php');
}

require_once './Controllers/loginController.php';

?>