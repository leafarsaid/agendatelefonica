<?php

include '../../models/Tag.php';

class ControllerTag {

    public $tag;

    public function __construct(){
        $this->tag = new Tag();
    }
	public function insert($obj){
		return $this->tag->insert($obj);
	}
	public function delete($id){
		return $this->tag->delete($id);
	}
	public function listAll($txt = null){
		return $this->tag->listAll($txt);
	}
}
?>