<?php


class Products extends BaseController
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
		$userinfo['phone'] = '15889724231';
		$trade = $this->trade->get_list_group_actid($userinfo['phone']);
		$ids = array();

		foreach($trade as $k => $v){
			$_ids[] = $v['act_id'];
		}


		$data['products'] = array();
		if(count($_ids) > 0){
			$where['where_in'] = array('key'=>'id','value'=>$_ids);
			$products = $this->activity->getList($where);

		}

		foreach($products as $k => $v){
			$list[$v['month']][] = $v;
		}

		$data['list'] = $list;
		//print_r($list);
		
		$this->tpl('products_tpl',$data);
	}
}