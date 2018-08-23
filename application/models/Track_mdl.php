<?php


class Track_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_track_log';


	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}


	
}