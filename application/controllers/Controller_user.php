<?php
class Controller_user extends Controller {

    function __construct() {
        
    }
	
	public function Action_sing_in()
	{
		if( !$this->login() ){
			$model = new Model_user('Форма входа',' ',' ');
			$view = new View();
			$view->generate("sing_in", $model);
		}else{
			header('Location: /chat');
		}
	}

	public function Action_sing_up()
	{
		$model = new Model_user('Форма регистрации',' ',' ');
		$view = new View();
		$view->generate("sing_up", $model);
	}

	public function Action_login()
	{
		if(!$this->login()){
			$model = new Model_user(' ',' ',' ');
			if( $model->login() )
			{
				$_SESSION['id'] = $model->user_id;
				$_SESSION['rank'] = $model->rank;
				$_SESSION['login'] = $model->login;
				header('Location: /chat');
			} else {
				header('Location: /user/sing_in');
			}
		}else{
			header('Location: /chat');	
		}
	}

	public function Action_logout()
	{
		if($this->login()){
			session_destroy();
			unset($_SESSION);
		}
		header('Location: /');
	}

	public function Action_register()
	{
		if(!$this->login()){
			$model = new Model_user(' ',' ',' ');
			if( $model->new_user() ){
				header('Location: /user/sing_in');
			} else {
				header('Location: /user/sing_up');
			}	
		}else{
			header('Location: /');
		}

	}
}