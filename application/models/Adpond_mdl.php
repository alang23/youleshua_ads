<?php


class Adpond_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_adpond';


	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}


	
}