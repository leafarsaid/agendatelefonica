<?php
include '../../controllers/ControllerTag.php';

$controllerTag = new ControllerTag();

header('Content-Type: application/json');
echo json_encode($controllerTag->listAll());

?>