<?php


class Logistics_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_logistics';
	var $table_business = 'ls_business';
    var $table_admin = 'ls_admin';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

		    //联表查询
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
									logis.*,business.user_id,admin.realname as admin_name')
					->from($this->table_name.' as logis')
					->join($this->table_business.' as business','business.phone=logis.phone','left')
                    ->join($this->table_admin.' as admin','admin.id=business.user_id','left')
					->get()->result_array();

		return $list;

	}

		    //联表查询
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

		$count = 0;
		$count = $this->db->select('
									logis.*,business.user_id,admin.realname as admin_name')
					->from($this->table_name.' as logis')
					->join($this->table_business.' as business','business.phone=logis.phone','left')
                    ->join($this->table_admin.' as admin','admin.id=business.user_id','left')

					->count_all_results();
					
		return $count;

	}



    public function get_list($where = array())
    {

  

            //     $sql = "select logis.*,admin.realname as admin_name from ls_logistics as logis 
            // left join (select phone,user_id from ls_business group by phone) as bus on(bus.phone=logis.phone)
            // left join ls_admin as admin on(bus.user_id=admin.id)
            // where 1=1 ".$where['where'].' order by logis.id desc'.' limit '.$where['offset'].','.$where['limit'];

            $sql = "select logis.*,admin.realname as admin_name from ls_logistics as logis 
            left join ls_business as bus on(bus.phone=logis.phone)
            left join ls_admin as admin on(bus.user_id=admin.id)
            where 1=1 ".$where['where'].' order by logis.id desc'.' limit '.$where['offset'].','.$where['limit'];
            
        $query = $this->db->query($sql);
        $list = $query->result_array();

        return $list;
    }


    public function get_list_count($where = array())
    {


        // $sql = "select logis.*,admin.realname as admin_name from ls_logistics as logis 
        //     left join (select phone,user_id from ls_business group by phone) as bus on(bus.phone=logis.phone)
        //     left join ls_admin as admin on(bus.user_id=admin.id)
        //     where 1=1 ".$where['where'];

                $sql = "select logis.*,admin.realname as admin_name from ls_logistics as logis 
            left join ls_business as bus on(bus.phone=logis.phone)
            left join ls_admin as admin on(bus.user_id=admin.id)
            where 1=1 ".$where['where'];

        $query = $this->db->query($sql);
        $list = $query->result_array();

        return count($list);
    }

	
}