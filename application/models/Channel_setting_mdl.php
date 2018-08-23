<?php


class Channel_setting_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_channel_setting';


	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}


	
}