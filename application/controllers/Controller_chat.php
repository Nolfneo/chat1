<?php
class Controller_chat extends Controller {

    function __construct() {
        
    }
	
	public function Action_index()
	{
		if($this->login()){
			$model = new Model_chat('Chat 1.0',' ',' ');
			$model->view( $this->rank() );
			$view = new View();
			$view->generate("chat", $model);
		}else{
			header('Location: /');
		}

	}
	public function Action_ajax_post()
	{
		if($this->login()){
			$model = new Model_chat('Chat 1.0',' ',' ');
			$model->ajax_post( $this->rank() );/*
			$view = new View();
			$view->generate("chat", $model);*/
		}else{
			header('Location: /');
		}

	}
	public function Action_ajax_add_post()
	{
		if($this->login()){
			$model = new Model_chat('Chat 1.0',' ',' ');
			$model->ajax_add_post();/*
			$view = new View();
			$view->generate("chat", $model);*/
		}else{
			header('Location: /');
		}

	}
	public function Action_ajax_new_post()
	{
		if($this->login()){
			$model = new Model_chat('Chat 1.0',' ',' ');
			$model->ajax_new_post();
		}else{
			header('Location: /');
		}

	}
	public function Action_delete_room($param){
		if( $this->login() && $this->rank()==1 ){
			$model = new Model_chat('Chat 1.0',' ',' ');
			if( $model->delete_room( $param[0] ) )
				header('Location: /chat');
		}else{
			header('Location: /');
		}
	}
	public function Action_ajax_delete_post(){
		if( $this->login() && $this->rank()==1 ){
			$model = new Model_chat('Chat 1.0',' ',' ');
			$model->ajax_delete_post();
		}else{
			header('Location: /');
		}
	}
	public function Action_new(){
		if( $this->login() && $this->rank()==1 ){
			$model = new Model_chat('Chat 1.0',' ',' ');
			$model->new_room();
			$view = new View();
			$view->generate("new_room", $model);
		}else{
			header('Location: /');
		}
	}
	public function Action_create(){
		if( $this->login() && $this->rank()==1 ){
			$model = new Model_chat('Chat 1.0',' ',' ');
			$model->create_room();
			header('Location: /chat');
		}else{
			header('Location: /');
		}
	}
}