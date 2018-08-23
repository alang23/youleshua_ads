<?php


class Ads_baidu_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_ads_baidu';


	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

	//百度关键字处理
	public function kw_baidu($data = array())
	{

		//检查当日数据是否已经存在
		$theday = date("Y-m-d");
		$year = date("Y");
		$month = date("m");
		$days = date("d");
		$check_data['where']['kwid'] = $data['kwid'];
		$check_data['where']['dates'] = $theday;

		$_check = $this->get_one_by_where($check_data);
		if(empty($_check)){
			$add['year'] = $year;
			$add['dates'] = $theday;
			$add['dates_time'] = strtotime($theday);
			$add['month'] = $month;
			$add['days'] = $days;
			$add['pid'] = $data['pid'];
			$add['pos_id'] = $data['pos_id'];
			$add['kwid'] = $data['kwid'];
			$add['ctvid'] = $data['ctvid'];
			$add['kw'] = $data['kw'];
			$add['v_num'] = 1;
			$this->add($add);

		}else{
			//更新浏览数
			$sql = "UPDATE `{$this->table_name}` SET  `v_num`=`v_num`+1 WHERE  `kwid`='{$data['kwid']}'  AND `dates`='{$theday}';";
			$this->db->query($sql);
		}

	}


	
}