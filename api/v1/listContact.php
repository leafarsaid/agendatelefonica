<?php
$txt = $_GET['txt'];
include '../../controllers/ControllerContact.php';

$controllerContact = new ControllerContact();

header('Content-Type: application/json');
echo json_encode($controllerContact->listAll($txt));

?>