<?php


class Quan extends BaseController
{
	


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Lottery_mdl','lottery');
		$this->load->model('Quan_mdl','quan');
	}

	public function index()
	{

		$userinfo = $this->userinfo;
		$id = $this->input->get('id');
		//$id = 5;
		$data['id'] = $id;
		//用户订单
	
		$where['where']['q.act_id'] = $id;
		$where['where']['q.phone'] = $userinfo['phone'];
		$list = array();
		$list = $this->quan->get_list_by_join($where);
		
		$data['q'] = $list;

		$this->tpl('quan_tpl',$data);
	}

}