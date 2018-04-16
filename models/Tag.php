<?php

include 'connection.php';

class Tag {
    private $conn;

    public function __construct(){
        $this->conn = new Connection;
    }
    public function insert($obj){
    	$sql = "INSERT INTO tag(tagname) VALUES (:tagname)";
    	$query = $this->conn->prepare($sql);
        $query->bindValue('tagname',  $obj->tagname);
    	return $query->execute();
	}
	public function delete($id = null){
		$sql =  "DELETE FROM tag WHERE id = :id";
		$query = $this->conn->prepare($sql);
		$query->bindValue('id',$id);
		$query->execute();
	}
	public function listAll($txt = null){
        $sql = "SELECT * FROM tag";
        $query = $this->conn->prepare($sql);
		$query->execute();
        return $query->fetchAll();
	}
}
?>