<?php


class Standard_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_standard';
	var $table_logistics = 'ls_logistics';
    var $table_business = 'ls_business';
    var $table_admin = 'ls_admin';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

		    //联表查询
    public function get_list_by_join($config = array())
    {

		// if(!empty($config['where'])){
  //           $this->db->where($config['where']);
  //       }

  //       if(!empty($config['page'])){
  //           $this->db->limit(intval($config['limit']));
  //           $this->db->offset(intval($config['offset']));
  //       }

  //       if(!empty($config['order'])){
  //           $this->db->order_by($config['order']['key'],$config['order']['value']);
  //       }

  //       if(!empty($config['like'])){
  //           $this->db->like($config['like']['key'],$config['like']['value']);
  //       }
     
  //       if(!empty($config['where_in'])){
  //           $this->db->where_in($config['where_in']['key'], $config['where_in']['value']);
           
  //       }

  //       if(!empty($config['or_like'])){
  //           $this->db->or_like($config['or_like']['key'], $config['or_like']['value']);
          
  //       }

        /*
		$info = array();
		$info = $this->db->select('stan.*,logis.realname,logis.phone,admin.realname as a_realname')
					->from($this->table_name.' as stan')
					->join($this->table_logistics.' as logis','stan.dev_sn=logis.dev_sn','left')
                    ->join($this->table_business.' as bus','bus.phone = logis.phone','left')
                    ->join($this->table_admin.' as admin','admin.id = bus.user_id','left')
					->get()->result_array();
                    */

        $sql = "select stan.*,logis.phone,admin.realname as a_realname,admin.id as uid from ls_standard as stan 
            left join (select * from ls_logistics GROUP BY dev_sn) as logis on (logis.dev_sn=stan.dev_sn) 
            left join(select phone,user_id from ls_business GROUP BY phone) as bus on(bus.phone=logis.phone)
            left join(select realname,id from ls_admin) as admin on(admin.id=bus.user_id) where 1=1 "
            .$config['where'].' order by logis.id desc';

        $query = $this->db->query($sql);
        $list = $query->result_array();

		return $list;

    }

                //联表查询
    public function get_count_by_join($config = array())
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
        $sql = "select stan.* from ls_standard as stan 
            left join (select * from ls_logistics GROUP BY dev_sn) as logis on (logis.dev_sn=stan.dev_sn) 
            left join(select phone,user_id from ls_business GROUP BY phone) as bus on(bus.phone=logis.phone)
            left join(select realname,id from ls_admin) as admin on(admin.id=bus.user_id) where 1=1 "
            .$config['where'];

        $query = $this->db->query($sql);
        $list = $query->result_array();

        return count($list);

    }





	
}