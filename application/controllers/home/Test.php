<?php

class Test extends Zrjoboa
{
	

	public function __construct()
	{
		parent::__construct();
		// $this->load->library('Smsapi','smsapi');
		$this->load->model('Standard_mdl','standard');
		$this->load->library('My_excel','my_excel');
	}


	public function index()
	{

		$sql = "select p_name,p_mobile,p_sn,update_time from ls_deal where update_time>=1519833600 and update_time<=1522512000  and status=3 ";
		$query = $this->db->query($sql);
		$arr = $query->result_array();
		foreach($arr as $k => $v){
			$_tmp['name'] = $v['p_name'];
			$_tmp['phone'] = $v['p_mobile'];
			$_tmp['cbc'] = $v['p_sn'];
			$_tmp['update_time'] = date("Y-m-d H:i:s",$v['update_time']);
			$list[] = $_tmp;
		}
		$this->my_excel->export_deal($list,'deal.xlsx');
		//print_r($arr);

	}
}