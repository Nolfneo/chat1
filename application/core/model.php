<?php

class Model {

    function __construct() {
        
    }

    public function mysql(){
    	global $mysqli;
		return $mysqli;
	}

	public function query($sql){

		global $mysqli;
		
		$row = $mysqli->query($sql);
		
		if(!empty( $row ))
			{	$result = array();
				while($rows = $row->fetch_assoc()){
					$result[] = $rows;
				}

				return $result;
			}else{
			
				return false;
			
			}
	
	}
	
	public function insert($sql){

		global $mysqli;
		
		$mysqli->query($sql);
		
		$row['last_id'] = $mysqli->insert_id;
		
		return $row;

	}
	
	public function update($sql){

		global $mysqli;
		
		$row = $mysqli->query($sql);

	}
	public function del($sql){

		global $mysqli;
		
		return $mysqli->query($sql);

	}
	public function real_escape_string($string){

		global $mysqli;
		
		return $mysqli->real_escape_string($string);

	}

}