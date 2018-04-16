<?php
include '../../controllers/ControllerContact.php';
 
$data = file_get_contents('php://input');
$obj =  json_decode($data);

$id = $obj->id;
if(!empty($data)){	
    $ControllerContact = new ControllerContact();
    $ControllerContact->delete($id);
    header('Location:listContact.php');
}
?>