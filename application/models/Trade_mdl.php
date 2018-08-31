<?php


class Trade_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_trade';
	var $table_standard = 'ls_standard';
	var $table_logis = 'ls_logistics';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

	public function total_amount($where = '')
	{
		if(!empty($where)){
			//$total_sql = 'select SUM(amount) as total,p_sn from '.$this->table_name.' where '.$where;
			$total_sql = "select SUM(trade.amount) as total,trade.p_sn from ".$this->table_name." as trade left join ".$this->table_standard." as stan on(stan.dev_sn = trade.p_sn) where ".$where;
		}else{
			//$total_sql = 'select SUM(amount) as total,p_sn from '.$this->table_name;
			$total_sql = "select SUM(trade.amount) as total,trade.p_sn from ".$this->table_name." as trade left join ".$this->table_standard." as stan on(stan.dev_sn = trade.p_sn) ";
		}
		
		$ret = $this->db->query($total_sql);
		$row = $ret->row_array();
		
		return $row;
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
									trade.*,stan.user_id,stan.admin_name,stan.chuhuo_time')
					->from($this->table_name.' trade')
					->join($this->table_standard.' as stan','stan.dev_sn=trade.p_sn','left')
					->get()->result_array();
					
		return $list;
	}



	public function get_count_by_join($config=array())
	{
		if(!empty($config['where'])){
            $this->db->where($config['where']);
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
									trade.*,stan.user_id,stan.admin_name,stan.chuhuo_time')
					->from($this->table_name.' trade')
					->join($this->table_standard.' as stan','stan.dev_sn=trade.p_sn','left')
					->count_all_results();
					
		return $count;
	}


	//查询交易金额
	public function get_list_by_logis($config=array())
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
									trade.*,logis.admin_name,logis.phone,logis.address,logis.uid,logis.realname')
					->from($this->table_name.' trade')
					->join($this->table_logis.' as logis','logis.dev_sn=trade.p_sn','left')
					->get()->result_array();
					
		return $list;
	}



	public function get_count_by_logis($config=array())
	{
		if(!empty($config['where'])){
            $this->db->where($config['where']);
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
									trade.*,logis.admin_name,logis.uid,logis.realname')
					->from($this->table_name.' trade')
					->join($this->table_logis.' as logis','logis.dev_sn=trade.p_sn','left')
					->count_all_results();
					
		return $count;
	}



	
}