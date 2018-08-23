<?php


class Channel_source_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_channel_source';
	var $table_channel = 'ls_user_channel';


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
									source.*,channel.title,channel.channel_id as c_id,channel.show_url,channel.status')
					->from($this->table_name.' source')
					->join($this->table_channel.' as channel','channel.channel_id=source.channel_id','left')
					->get()->result_array();
					
		return $list;
	}

	//取得数据
	public function get_channel_total($where = '')
	{
		// $sql = 'select channel.title,channel.status,channel.types,channel.count_num,channel.channel_id,IFNULL(bus.total,0) as total,channel.show_url from ls_channel_source as source 
  //            left join ls_user_channel as channel on(channel.channel_id=source.channel_id) 
		// 	 left join (select channel_id, count(channel_id) as total from ls_business GROUP BY channel_id)  as bus on(bus.channel_id=source.channel_id)'.' '.$where;

		$sql = 'select tmp.* from (
		    select channel.title,channel.status,channel.types,channel.count_num,channel.channel_id,IFNULL(bus.bus_total,0) as bus_total,channel.show_url 
			    from ls_channel_source as source 
			    left join ls_user_channel as channel on(channel.channel_id=source.channel_id) 
			    left join (select channel_id, count(channel_id) as bus_total from ls_business GROUP BY channel_id) as bus on(bus.channel_id=source.channel_id) 
			     '.$where.' ) as tmp where tmp.bus_total < tmp.count_num';

		//echo $sql;
		$query = $this->db->query($sql);
		$arr = $query->result_array();
		return $arr;
	}



	
}

