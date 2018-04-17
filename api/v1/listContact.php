<?php
$txt = (strlen($_GET['txt'])) ? $_GET['txt'] : null;
$id = (strlen($_GET['id'])) ? $_GET['id'] : null;
$idtag = (strlen($_GET['idtag'])) ? $_GET['idtag'] : null;
include '../../controllers/ControllerContact.php';

$controllerContact = new ControllerContact();

header('Content-Type: application/json');
echo json_encode($controllerContact->listAll($txt, $id, $idtag));

?>