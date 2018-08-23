<?php


class App_page_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_app_page';


	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}


	
}