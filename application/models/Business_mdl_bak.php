<?php


class Business_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_business';
	var $table_ads = 'ls_ads';
	var $table_admin = 'ls_admin';
	var $table_user_channel = 'ls_user_channel';
	var $table_logis = 'ls_logistics';
	var $table_standard = 'ls_standard';


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
									n.*,a.ad_name as adname,admin.realname as admin_name,stan.dabiao_time_int')
					->from($this->table_name.' as n')
					->join($this->table_ads.' as a','n.frm=a.id','left')
					->join($this->table_admin.' as admin','admin.id=n.user_id','left')
					->join($this->table_logis.' as logis','logis.phone=n.phone','left')
					->join($this->table_standard.' as stan','stan.dev_sn=logis.dev_sn','left')
					->get()->result_array();
					
		return $list;
	}


	public function get_count_by_join($config=array())
	{
		if(!empty($config['where'])){
            $this->db->where($config['where']);
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
									n.*,a.ad_name as adname,admin.realname as admin_name,stan.dabiao_time_int')
					->from($this->table_name.' as n')
					->join($this->table_ads.' as a','n.frm=a.id','left')
					->join($this->table_admin.' as admin','admin.id=n.user_id','left')
					->join($this->table_logis.' as logis','logis.phone=n.phone','left')
					->join($this->table_standard.' as stan','stan.dev_sn=logis.dev_sn','left')
					->count_all_results();
					
		return $list;
	}

	public function get_agent_list_by_join($config=array())
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
									n.*,a.ad_name as adname,admin.title as admin_name')
					->from($this->table_name.' as n')
					->join($this->table_ads.' as a','n.frm=a.id','left')
					->join($this->table_user_channel.' as admin','admin.id=n.user_id','left')
					->get()->result_array();
					
		return $list;
	}


	public function get_agent_count_by_join($config=array())
	{
		if(!empty($config['where'])){
            $this->db->where($config['where']);
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
									n.*,a.ad_name as adname,admin.title as admin_name')
					->from($this->table_name.' as n')
					->join($this->table_ads.' as a','n.frm=a.id','left')
					->join($this->table_user_channel.' as admin','admin.id=n.user_id','left')
					->count_all_results();
					
		return $list;
	}
	
}