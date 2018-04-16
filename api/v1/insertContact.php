<?php
include '../../controllers/ControllerContact.php';
 
$data = file_get_contents('php://input');
$obj =  json_decode($data);

if(!empty($data)){	
    $ControllerContact = new ControllerContact();
    $ControllerContact->insert($obj);
    header('Location:listContact.php');
}
?>