<?php


class Trade_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_trade';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

	public function total_amount()
	{
		$total_sql = 'select SUM(amount) as total from '.$this->table_name;
		$ret = $this->db->query($total_sql);
		$row = $ret->row_array();
		
		return $row;
	}



	
}