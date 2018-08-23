<?php


class Deal_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_deal';
	var $table_logistics = 'ls_logistics';


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
									deal.*,logis.types,logis.status as logis_status')
					->from($this->table_name.' deal')
					->join($this->table_logistics.' as logis','deal.p_sn=logis.dev_sn','left')
					->get()->result_array();
					
		return $list;
	}


	public function get_list_by_where_str($where)
	{

			$sql = "select deal.* ,logis.types,logis.logis_status from ls_deal as deal  
						left join (select types, max(id) as logis_id,dev_sn,status as logis_status
						            from ls_logistics group by dev_sn) as logis
					on deal.p_sn = logis.dev_sn where 1=1 ".$where['where']. ' limit '.$where['offset'].' ,'.$where['limit'];
			//echo $sql;
			$query = $this->db->query($sql);
			$list = $query->result_array();

			return $list;

	}

	public function get_count_by_where_str($where)
	{

			$sql = "select deal.* ,logis.types,logis.logis_status from ls_deal as deal  
						left join (select types, max(id) as logis_id,dev_sn ,status as logis_status 
						            from ls_logistics group by dev_sn) as logis
					on deal.p_sn = logis.dev_sn where 1=1 ".$where['where'];
			//echo $sql;
			$query = $this->db->query($sql);
			$list = $query->result_array();

			return count($list);

	}


	public function get_list($where=array())
	{
		$sql = "select 
					deal.id as id,deal.p_name as p_name,deal.p_mobile as p_mobile,deal.p_sn as p_sn,deal.p_pay as p_pay
						,deal.p_zhifubao as p_zhifubao,deal.p_img as p_img,deal.p_bank as p_bank,deal.p_card as p_card,deal.addtime as addtime,lo.types as types,deal.status as status,p_name as p_name,deal.update_time
					,lo.types as logis_type ,stan.dabiao
				from  ls_deal as deal left join (
					select logis2.dev_sn as dev_sn,logis2.types as types from (
						select count(dev_sn) as total,max(id) as id,dev_sn from ls_logistics where merchant_id='2' group by dev_sn
					) as tmp left join ls_logistics as  logis2 on(tmp.id=logis2.id)
				) as lo on(deal.p_sn=lo.dev_sn)
				 left join ls_standard as stan on(stan.dev_sn=deal.p_sn) where  ".$where['where'].' limit '.$where['offset'].' ,'.$where['limit'].'';

			$query = $this->db->query($sql);
			$list = $query->result_array();
			//echo $this->db->last_query();
			return $list;
	}

	public function get_list_count($where=array())
	{
		// $sql = "select 
		// 			deal.id as id,deal.p_name as p_name,deal.p_mobile as p_mobile,deal.p_sn as p_sn,deal.p_pay as p_pay
		// 				,deal.p_zhifubao as p_zhifubao,deal.p_img as p_img,deal.p_bank as p_bank,deal.p_card as p_card,deal.addtime as addtime,lo.types as types,deal.status as status,p_name as p_name,deal.update_time
		// 			,lo.types as logis_type 
		// 		from  ls_deal as deal left join (
		// 			select logis2.dev_sn as dev_sn,logis2.types as types from (
		// 				select count(dev_sn) as total,max(id) as id,dev_sn from ls_logistics where merchant_id='2' group by dev_sn
		// 			) as tmp left join ls_logistics as  logis2 on(tmp.id=logis2.id)
		// 		) as lo on(deal.p_sn=lo.dev_sn) where  ".$where['where'];

				$sql = "select 
					deal.id as id,deal.p_name as p_name,deal.p_mobile as p_mobile,deal.p_sn as p_sn,deal.p_pay as p_pay
						,deal.p_zhifubao as p_zhifubao,deal.p_img as p_img,deal.p_bank as p_bank,deal.p_card as p_card,deal.addtime as addtime,lo.types as types,deal.status as status,p_name as p_name,deal.update_time
					,lo.types as logis_type ,stan.dabiao
				from  ls_deal as deal left join (
					select logis2.dev_sn as dev_sn,logis2.types as types from (
						select count(dev_sn) as total,max(id) as id,dev_sn from ls_logistics where merchant_id='2' group by dev_sn
					) as tmp left join ls_logistics as  logis2 on(tmp.id=logis2.id)
				) as lo on(deal.p_sn=lo.dev_sn)
				 left join ls_standard as stan on(stan.dev_sn=deal.p_sn) where  ".$where['where'];

			$query = $this->db->query($sql);
			$list = $query->result_array();

			return count($list);
	}


	
}