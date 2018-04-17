<?php

include '../../models/Contact.php';

class ControllerContact {

    public $contact;

    public function __construct(){
        $this->contact = new Contact();
    }
	public function insert($obj){
		return $this->contact->insert($obj);
	}
	public function update($obj,$id){
		return $this->contact->update($obj,$id);
	}
	public function delete($id){
		return $this->contact->delete($id);
	}
	public function listAll($txt = null, $id = null, $idtag = null){
		return $this->contact->listAll($txt, $id, $idtag);
	}
}
?>
