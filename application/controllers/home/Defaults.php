<?php


class Defaults extends Zrjoboa
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Statistics_mdl','statistics');
		$this->load->model('Adsense_mdl','adsense');
		$this->load->model('Ads_mdl','ads');
		$this->load->library('Smsapi','smsapi');
		$this->load->model('User_channel_mdl','user_channel');
		$this->load->model('Common_mdl','common');
	}


	public function index()
	{


		$userinfo = $this->userinfo;
		$data['userinfo'] = $userinfo;
		$roleinfo = $this->userlib->check_hidden('');
		$list =array();
		foreach ($roleinfo as $k => $v) {
			$list[] = $v['role_tag'];
		}
		$data['list'] = $list;
		
		// print_r($list);
		// exit;
		$ismobile = isMobile();
		if(!$ismobile){

			$this->tpl('home/defaults_tpl',$data);

		}else{

			$userinfo = $this->userinfo;
			$data['userinfo'] = $userinfo;
			
			//短信剩余
			$ret = $this->smsapi->queryBalance();
			$data['message'] = $ret;

			//代理商注册情况
			$agent_list_data = $this->user_channel->date_count();
			$data['agent_list_data'] = $agent_list_data;

			//代理商
			$agent_where['where']['parent_id'] = '0';
			$agent_where['where']['types'] = 1;
			$agent_list = $this->user_channel->getList($agent_where);
			foreach($agent_list as $alistk =>$alistv){
				$agent[$alistv['channel_id']] = $alistv;
			}
			$agent['10003'] = array('title'=>'力活科技','status'=>1);
			$data['agent'] = $agent;

			//短信
			$agent_msg = $this->common->get_agent_msg();
			$data['agent_msg'] = $agent_msg;

			//广告注册数
			//select count(frm) as total,bus.id,bus.phone,bus.frm ,ads.id as aid,ads.ad_name from ls_business as bus left join ls_ads as ads on(ads.id=bus.frm) group by frm
			$ads = array();
			$ads = $this->ads->date_count();
			$data['ads'] = $ads;

			$this->tpl('home/defaults_tpl',$data);
		}

		//$this->tpl('home/defaults_tpl',$data);

	}
}