<?php
class Controller_index extends Controller {

    function __construct() {
        
    }
	
	public function Action_index(){
		if(!$this->login()){
			$model = new Model_index('Главная',' ',' ');
			$model->view();
			$view = new View();
			$view->generate("index", $model);
		}else{
			header('Location: /chat');
		}
	}

}