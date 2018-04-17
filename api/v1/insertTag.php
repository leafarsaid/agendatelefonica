<?php
include '../../controllers/ControllerTag.php';
 
$data = file_get_contents('php://input');
$obj =  json_decode($data);

if(!empty($data)){	
    $ControllerTag = new ControllerTag();
    $return = $ControllerTag->insert($obj);
    exit($return);
}
?>