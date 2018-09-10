<?php


class Main extends Zrjoboa
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
		$this->load->model('Notepad_mdl','notepad');
		$this->load->model('Account_mdl','account');


	}


	public function index()
	{

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

		//客服
		$_users = array();
		$_users = $this->account->getList();
		foreach($_users as $uk => $uv){
			$users[$uv['id']] = $uv['realname']; 
		}
		$data['users'] = $users;

		//短信
		$agent_msg = $this->common->get_agent_msg();
		$data['agent_msg'] = $agent_msg;
		//当日短信
		$_agent_msg_day = array();
		$agent_msg_day = $this->common->get_agent_msg_day();
		foreach($agent_msg_day as $amdk => $amdv){
			$_agent_msg_day[$amdv['channel_id']] = $amdv['total'];
		}
		$data['agent_msg_day'] = $_agent_msg_day;


		$user_msg_where['channel_id'] = '10003';
		$users_msg = $this->common->get_users_msg($user_msg_where);
		$data['users_msg'] = $users_msg;
		
				//每日
		$_user_day = array();
		$_user_day = $this->common->get_users_msg_theday($user_msg_where);
		foreach($_user_day as $udk => $udv){
			$user_day[$udv['user_id']] = $udv['total'];
		}
		$data['user_day'] = $user_day;

		$ads = array();
		$ads = $this->ads->date_count();
		$data['ads'] = $ads;

		if($userinfo['role'] != '13'){

			$n_where['where']['user_id'] = $userinfo['id'];

			$note = array();
			$n_where['order'] = array('key'=>'id','value'=>'DESC');
			$note = $this->notepad->getList($n_where);
			$data['note'] = $note;
			
			$this->tpl('home/main_kefu_tpl',$data);

		}else{

			$this->tpl('home/main_tpl',$data);
		}
	

	}

	public function add_note()
	{
		$userinfo = $this->userinfo;

		$title = $this->input->post('title');
		$grade = $this->input->post('grade');
		$content = $this->input->post('content');

		if(empty($title) || empty($content)){
			$ret = array(
				'code'=>'1',
				'msg'=>'请填写标题和内容'
				);
		}else{
			$add['title'] = $title;
			$add['grade'] = $grade;
			$add['content'] = $content;
			$add['addtime'] = time();
			$add['user_id'] = $userinfo['id'];
			if($this->notepad->add($add)){
				$ret = array(
					'code'=>'0',
					'msg'=>'添加成功'
					);
			}else{
				$ret = array(
					'code'=>'2',
					'msg'=>'添加失败,请重试'
					);
			}
		}

		responseData($ret);
	}

	public function check_status()
	{
		$userinfo = $this->userinfo;

		$id = $this->input->post('id');
		$update_config['user_id'] = $userinfo['id'];
		$update_config['id'] = $id;

		$update_data['status'] = 1;
		if($this->notepad->update($update_config,$update_data)){
			$ret = array(
				'code'=>'0',
				'msg'=>'修改成功'
				);
		}else{
			$ret = array(
				'code'=>'1',
				'msg'=>'修改失败，请重试'
				);
		}

		responseData($ret);

	}

	public function reg_detail()
	{
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
		$type = isset($_GET['type']) ? $_GET['type'] : '';
		$year = isset($_GET['year_time']) ? $_GET['year_time'] : '';
		$month = isset($_GET['month_time']) ? $_GET['month_time'] : '';
		$day = isset($_GET['day_time']) ? $_GET['day_time'] : '';
		//print_r($_GET);

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';

        $reg_list =array();
		if(!empty($type) && $type == 'year'){
			$where['where']['year'] = $year;
			$count_where['year'] = $year;
		}

		if(!empty($type) && $type == 'month'){
			$where['where']['year'] = $year;
			$where['where']['month'] = $month;
			$count_where['year'] = $year;
			$count_where['month'] = $month;
			//var_dump($type);
		}

		if(!empty($type) && $type == 'day'){
			$where['where']['year'] = $year;
			$where['where']['month'] = $month;
			$where['where']['days'] = $day;
			$count_where['year'] = $year;
			$count_where['month'] = $month;
			$count_where['days'] = $day;
		}
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'dates','value'=>'desc');
     
        $count = $this->statistics->get_count($count_where);
        $data['count'] = $count;
        $pageconfig['base_url'] = base_url('/home/main/reg_detail?type='.$type.'&year_time='.$year.'&month_time='.$month.'&day_time='.$day);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$reg_list = $this->statistics->get_list_by_join($where);
		//print_r($pageconfig['base_url']);
		//echo $this->db->last_query($reg_list);
		$data['reg_list'] = $reg_list;

		$this->tpl('home/reg_detail_tpl',$data);
	}

	public function adsense_detail(){
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$where['where']['pos_id'] = $id;
		$list = $this->adsense->get_list_by_join($where);
		$data['list'] = $list;
		$this->tpl('home/adsense_detail_tpl',$data);
	}


}