<?php


class Quan_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_quan';
	var $table_activity = 'ls_activity';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

	public function get_list_by_join($config=array())
	{
		if(!empty($config['where'])){
            $this->db->where($config['where']);
        }


		$info = array();
		$info = $this->db->select('q.*,a.rounds,a.start_time,a.price,a.end_time,a.quan_logo')
					->from($this->table_name.' as q')
					->join($this->table_activity.' as a','a.id=q.act_id','left')
					->get()->result_array();

		return $info;
	}


	
}