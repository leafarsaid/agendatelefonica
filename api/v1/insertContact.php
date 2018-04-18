<?php
include '../../controllers/ControllerContact.php';
 
$data = file_get_contents('php://input');
$obj =  json_decode($data);

if(!empty($data)){	
    $ControllerContact = new ControllerContact();
    $return = $ControllerContact->insert($obj);
    exit($return);
}
?>