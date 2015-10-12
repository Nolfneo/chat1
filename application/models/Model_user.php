<?php
class Model_user extends Model
{
	
	public $title;
	public $description;
	public $keywords;
	public $data;
	public $user_id;
	public $rank;
	public $login;

    public function __construct($title = '1',$description = '',$keywords = '') 
	{
        $this->title = $title;
    }
    public function login()
	{
		$login = mysqli_real_escape_string($this->mysql(),$_POST['login']);
		$password = md5( md5($_POST['password']) . "solt");

 		$result = $this->query(" SELECT `User`.`Id`,`User`.`Password_md5`,`User`.`Rank`  FROM `User` WHERE `Login` = '$login' ");

		if($result[0]['Password_md5']==$password) 
		{
			$this->user_id = $result[0]['Id'];
			$this->rank = $result[0]['Rank'];
			$this->login = $login;
			return true;
		} else {
			return false;
		}
	}

    public function new_user()
	{
		$login = mysqli_real_escape_string($this->mysql(),$_POST['login']);
		$password = md5( md5($_POST['password']) . "solt");
		$re_password = md5( md5($_POST['re_password']) . "solt");

		if( $password == $re_password ){

			$result = $this->query(" SELECT `User`.`Id` FROM `User` WHERE `Login` = '$login' ");

			if(empty($result[0]['Id'])){
				
 				$this->insert(" INSERT INTO `User`(`Id`,`Login`,`Password_md5`,`Rank`) VALUES (NULL,'$login','$password','2') ");
				return true;
			}else{
				return false;
			}

		}else{
			return false;
		}

	}
}