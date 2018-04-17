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
		$return = $query->execute();
		if($return){
			return '1';
		} else{
			return '0';
		}
	}
	public function delete($id = null){

		$sql1 =  "DELETE FROM tag WHERE id = :id";
		$query1 = $this->conn->prepare($sql1);
		$query1->bindValue('id',$id);
		$return1 = $query1->execute();

		$sql2 =  "DELETE FROM contacts_tags WHERE idtag = :id";
		$query2 = $this->conn->prepare($sql2);
		$query2->bindValue('id',$id);
		$return2 = $query2->execute();

		if($return1 && $return2){
			return '1';
		} else {
			return '0';
		}
	}
	public function listAll($txt = null){
        $sql = "SELECT * FROM tag";
        $query = $this->conn->prepare($sql);
		$query->execute();
        return $query->fetchAll();
	}
}
?>