<?php
class Model_chat extends Model
{
	
	public $title;
	public $description;
	public $keywords;
	public $data;

    public function __construct($title = '1',$description = '',$keywords = '') 
	{
        $this->title = $title;
    }
    public function view($rank)
	{
		$user_id = (int) $_SESSION['id'];
		$this->rank = $rank;
		if($rank==1){
			$this->data['room'] = $this->query(" SELECT * FROM `Room` WHERE 1");	
		}else{
			$this->data['room'] = $this->query(" SELECT * FROM `Room` INNER JOIN `User_in_room` ON `Room`.`Id`=`User_in_room`.`Id_room` WHERE `User_in_room`.`Id_user` = '$user_id' ");
			foreach ($this->data['room'] as $key => $value) {
				$id_room = $value['Id_room'];
				$res = $this->query(" SELECT COUNT(Id) as `Count` FROM `New_message` WHERE `Id_reader` = '$user_id' AND `Id_room` = '$id_room' ");
				$this->data['room'][$key]['Count'] = $res[0]['Count'];
			}
			unset($res);
		}
	}
	public function ajax_post($rank){
		$id_room = (int) $_POST['id_room'];
		$id_user = (int) $_SESSION['id'];
		$this->rank = $rank;
		if($rank == 1 ){
			$result = $this->query(" SELECT `User`.`Id` as `User_id`, `User`.`Login`, `Message`.`Text`, `Message`.`Id`, `Message`.`Date` FROM `Message` INNER JOIN `User` ON `Message`.`Id_author` = `User`.`Id` WHERE `Id_room` = '$id_room' ");
		}else{
			$result = $this->query(" SELECT `User`.`Id` as `User_id`, `User`.`Login`, `Message`.`Private`, `Message`.`Text`, `Message`.`Id`, `Message`.`Date` FROM `Message` INNER JOIN `User` ON `Message`.`Id_author` = `User`.`Id` WHERE `Id_room` = '$id_room' AND (`Private` = '0' OR (`Private` = '1' AND `Id_reader` = '$id_user') ) ");
		}
		$post = '';
		if($rank == 1 ){
			foreach ($result as $key => $value) {
				$post.= '<div class="alert alert-success"><a hre="#" onClick="send_to('. $value['User_id'] .', \''. $value['Login'] .'\')">'. $value['Login'] .'</a>: '. $value['Text'] .'<span class="del-post" onClick="del_post('. $value['Id'] .')"> X </span><span>'. date('Y-m-d H:i:s', $value['Date']) .'</span></div>';
			}
		}else{
			foreach ($result as $key => $value) {
				if($value['Private']){
					$post.= '<div class="alert alert-danger"><a hre="#" onClick="send_to('. $value['User_id'] .',\''. $value['Login'] .'\')">'. $value['Login'] .'</a>: '. $value['Text'] .'<span>'. date('Y-m-d H:i:s', $value['Date']) .'</span></div>';
				}else{
					$post.= '<div class="alert alert-success"><a hre="#" onClick="send_to('. $value['User_id'] .',\''. $value['Login'] .'\')">'. $value['Login'] .'</a>: '. $value['Text'] .'<span>'. date('Y-m-d H:i:s', $value['Date']) .'</span></div>';
				}
			}
		}	
		echo $post;
	}

	public function ajax_add_post(){
		$id_room = (int) $_POST['id_room'];
		$id_author = (int) $_SESSION['id'];
		$message = $_POST['message'];
		$reader = $_POST['reader'];
		$date = time();
		if($reader>0){
			$this->insert(" INSERT INTO `Message`(`Id`, `Id_room`, `Id_author`, `Text`, `Private`, `Id_reader`, `Date`) VALUES (NULL,'$id_room', '$id_author','$message', '1', '$reader', '$date') ");
		}else{
			$this->insert(" INSERT INTO `Message`(`Id`, `Id_room`, `Id_author`, `Text`, `Private`, `Id_reader`, `Date`) VALUES (NULL,'$id_room', '$id_author','$message', '0', '0', '$date') ");
		}
	}

	public function ajax_new_post(){
		$id_room = (int) $_POST['id_room'];
		$id_user = (int) $_SESSION['id'];

		$result = $this->query(" SELECT * FROM `Room` INNER JOIN `User_in_room` ON `Room`.`Id`=`User_in_room`.`Id_room` WHERE `User_in_room`.`Id_user` = '$id_user' AND `User_in_room`.`Id_room`<>'$id_room' ");
		foreach ($result as $key => $value) {
			$id_room = $value['Id_room'];
			$res = $this->query(" SELECT COUNT(Id) as `Count` FROM `New_message` WHERE `Id_reader` = '$id_user' AND `Id_room` = '$id_room' ");
			$result[$key]['Count'] = $res[0]['Count'];
		}
		echo json_encode($result);
	}
	public function delete_room( $id_room ){
		return $this->del(" DELETE FROM `Room` WHERE `Id` = '$id_room' ");
	}
	public function ajax_delete_post( ){
		$id_post = (int) $_POST['id_post'];
		return $this->del(" DELETE FROM `Message` WHERE `Id` = '$id_post' ");
	}
	public function new_room(){
		$this->data['users'] = $this->query(" SELECT * FROM `User` WHERE `Rank` = '2'");
	}
	public function create_room(){
		$name = $_POST['name'];
		$id_admin = $_SESSION['id'];
		$id_user = $_POST['id_user'];
		$id_user[] = $id_admin;
		$result = $this->insert(" INSERT INTO `Room`(`id`, `Name`) VALUES (NULL, '$name') ");
		$id_room = $result['last_id'];
		foreach ($id_user as $key => $value) {
			$this->insert(" INSERT INTO `User_in_room`(`Id`, `Id_user`, `Id_room`) VALUES (NULL, '$value', '$id_room') ");
		}
	}
}