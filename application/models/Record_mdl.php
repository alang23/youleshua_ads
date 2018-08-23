<?php


class Record_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_record';
	var $table_business = 'ls_business';
	var $table_admin = 'ls_admin';



	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

	public function get_list_join_customer($config = array())
	{

		
		if(!empty($config['where'])){
            $this->db->where($config['where']);
        }

        if(!empty($config['page'])){
            $this->db->limit(intval($config['limit']));
            $this->db->offset(intval($config['offset']));
        }

        if(!empty($config['order'])){
            $this->db->order_by($config['order']['key'],$config['order']['value']);
        }

        if(!empty($config['like'])){
            $this->db->like($config['like']['key'],$config['like']['value']);
        }
     
        if(!empty($config['where_in'])){
            $this->db->where_in($config['where_in']['key'], $config['where_in']['value']);
           
        }

        if(!empty($config['or_like'])){
            $this->db->or_like($config['or_like']['key'], $config['or_like']['value']);
          
        }

		$list = array();
		$list = $this->db->select('
									b.realname,a.username,r.*')
					->from($this->table_name.' as r')
					->join($this->table_business.' as b','r.uid=b.id','left')
					->join($this->table_admin.' as a','r.sever_id=a.id','left')
					->get()->result_array();
					//echo $this->db->last_query();
					


		return $list;
	}
	
}