<?php


class Statistics_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_statistics';
	var $table_ads = 'ls_ads';


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
									l.*,a.ad_name')
					->from($this->table_name.' as l')
					->join($this->table_ads.' as a','l.aid=a.id','left')
					->get()->result_array();
					
		return $list;
	}


	public function get_count_by_join($config=array())
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
									l.*,a.ad_name')
					->from($this->table_name.' as l')
					->join($this->table_ads.' as a','l.aid=a.id','left')
					->count_all_results();
					
		return $list;
	}
	
}