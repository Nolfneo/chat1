<?php
class Model_index extends Model
{
	
	public $title;
	public $description;
	public $keywords;
	public $data;

    public function __construct($title = '1',$description = '',$keywords = '') 
	{
        $this->title = $title;
    }
    public function view()
	{
		$this->data['post'] = $this->query("SELECT * FROM `Task` WHERE 1");
	}

}