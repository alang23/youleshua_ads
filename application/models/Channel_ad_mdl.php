<?php


class Channel_ad_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_channel_ad';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

	
}