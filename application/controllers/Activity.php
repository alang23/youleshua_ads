<?php


class Activity extends BaseController
{
	


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Activity_mdl','activity');
		$this->load->model('Trade_mdl','trade');
	}

	public function index()
	{

		$userinfo = $this->userinfo;
		$data['userinfo'] = $userinfo;
		//print_r($userinfo);
		$where = array();
		$products = $this->activity->getList($where);


		foreach($products as $k => $v){
			$list[$v['month']][] = $v;
		}

		$data['list'] = $list;
		//print_r($list);
		
		$this->tpl('activity_tpl',$data);
	}
}