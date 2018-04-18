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
		$return = $query->execute();
		if($return) {
			return '1';
		} else{
			return '0';
		}
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
		$return = $query->execute();
		if($return) {
			return '1';
		} else{
			return '0';
		}
	}
	public function delete($id = null){
		$sql =  "DELETE FROM contact WHERE id = :id";
		$query = $this->conn->prepare($sql);
		$query->bindValue('id',$id);
		$return = $query->execute();
		if($return) {
			return '1';
		} else{
			return '0';
		}
	}
	public function listAll($txt = null, $id = null, $idtag = null){
		if ($idtag === '-1'){
			$idtag = null;
		}
		if (strlen($id)>0){
			$sql = "SELECT contact.*, group_concat(contacts_tags.idtag, ',') AS tags
					FROM contact
					INNER JOIN contacts_tags ON contacts_tags.idcontact = contact.id
					WHERE id = $id";
		} elseif (strlen($txt)>0){
			$sql = "SELECT * FROM contact 
					WHERE firstname like '%$txt%' 
					OR lastname like '%$txt%' 
					OR nickname like '%$txt%' 
					OR phonenumber like '%$txt%' 
					ORDER BY firstname, lastname";
		} elseif (strlen($idtag)){
			$sql = "SELECT * FROM contact 
					INNER JOIN contacts_tags ON contacts_tags.idcontact = contact.id
					WHERE contacts_tags.idtag = $idtag
					ORDER BY firstname, lastname";
		} else{
			$sql = "SELECT * FROM contact ORDER BY firstname, lastname";
		}
        $query = $this->conn->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}
}
?>