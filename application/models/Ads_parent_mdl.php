<?php


class Ads_parent_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_ads_parent';


	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}


	
}