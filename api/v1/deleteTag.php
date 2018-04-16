<?php
include '../../controllers/ControllerTag.php';
 
$data = file_get_contents('php://input');
$obj =  json_decode($data);

$id = $obj->id;
if(!empty($data)){	
    $ControllerTag = new ControllerTag();
    $ControllerTag->delete($id);
    header('Location:listTag.php');
}
?>