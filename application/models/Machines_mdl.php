<?php


class Machines_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_machines';


	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}


	
}