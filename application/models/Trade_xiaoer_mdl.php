<?php


class Trade_xiaoer_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_trade_xiaoer';
	var $table_standard = 'ls_standard';
	var $table_logis = 'ls_logistics';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}


	
}