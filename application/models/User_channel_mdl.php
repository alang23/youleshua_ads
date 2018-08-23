<?php


class User_channel_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_user_channel';


	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

	//今日流量
	public function date_count()
	{
		$theday = date("Y-m-d");
		$tomorrow = mktime(0,0,0,date("m"),date("d")+1,date("Y"));
		$thedaytime = strtotime($theday);

		$sql = "select count(channel_id) as total,channel_id from ls_business where channel_id<>'' and addtime > ".$thedaytime." and addtime < ".$tomorrow." group by channel_id";
		$query = $this->db->query($sql);
		$arr = $query->result_array();

		return $arr;
	}


	
}