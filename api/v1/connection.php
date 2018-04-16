<?php

class Connection {
    private static $inst;

	public static function getInstance(){
		if(!isset(self::$inst)){
			try {
				self::$inst = new PDO('sqlite:contacts.db');
				self::$inst->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$inst->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
		return self::$inst;
	}
 	
	public static function prepare($sql){
		return self::getInstance()->prepare($sql);
	}
}

?>