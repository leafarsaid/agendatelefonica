<?php

include 'connection.php';

class Contact {
    private $conn;

    public function __construct(){
        $this->conn = new Connection;
    }
    public function insert($obj){
    	$sql = "INSERT INTO contact(title,firstname,lastname,nickname,countrycode,phonenumber) VALUES (:title,:firstname,:lastname,:nickname,:countrycode,:phonenumber)";
    	$query = $this->conn->prepare($sql);
        $query->bindValue('title',  $obj->title);
        $query->bindValue('firstname', $obj->firstname);
        $query->bindValue('lastname' , $obj->lastname);
        $query->bindValue('nickname' , $obj->nickname);
        $query->bindValue('countrycode' , $obj->countrycode);
        $query->bindValue('phonenumber' , $obj->phonenumber);
    	return $query->execute();
	}
	public function update($obj,$id = null){
		$sql = "UPDATE contact SET title = :title, firstname = :firstname,lastname = :lastname, nickname = :nickname,countrycode =:countrycode, phonenumber = :phonenumber WHERE id = :id ";
		$query = $this->conn->prepare($sql);
		$query->bindValue('title', $obj->title);
		$query->bindValue('firstname', $obj->firstname);
		$query->bindValue('lastname' , $obj->lastname);
		$query->bindValue('nickname', $obj->nickname);
		$query->bindValue('countrycode' , $obj->countrycode);
		$query->bindValue('phonenumber' , $obj->phonenumber);
		$query->bindValue('id', $id);
		return $query->execute();
	}
	public function delete($id = null){
		$sql =  "DELETE FROM contact WHERE id = :id";
		$query = $this->conn->prepare($sql);
		$query->bindValue('id',$id);
		$query->execute();
	}
	public function listAll($txt = null, $id = null){
        $sql = "SELECT * FROM contact WHERE firstname like '%$txt%' OR lastname like '%$txt%' OR nickname like '%$txt%' OR phonenumber like '%$txt%'";
        $query = $this->conn->prepare($sql);
		$query->execute();
        return $query->fetchAll();
	}
}
?>