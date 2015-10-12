<?php

class Controller {

    function __construct() {
        
    }
    public function login(){
    	if( isset($_SESSION['id']) && !empty($_SESSION['id']) )
    		return true;
    	else
    		return false;
    }

    public function rank(){
    	return $_SESSION['rank'];
    }

}