<?php


class Defaults extends BaseController
{
	


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Business_mdl','business');
		$this->load->model('Role_mdl','role');
		$this->load->model('Account_mdl','admin');
		$this->load->library('Messagelib','messagelib');

	}

	public function index()
	{
		
		//$this->tpl('youleshua/defaults_tpl');
	}

	public function setp1_save()
	{
		
		$add['realname'] = $this->input->post('realname');
		$add['phone'] = $this->input->post('phone');
		$vcode = $this->input->post('vcode');
		$add['address'] = $this->input->post('address');
		$add['addtime'] = time();

		if(empty($add['realname'])){
			$msg = array(
				'code'=>'1',
				'msg'=>'请填写姓名'
				);
			echo json_encode($msg);
			exit;
		}

		if(empty($add['phone'])){
			$msg = array(
				'code'=>'2',
				'msg'=>'手机号不能为空'
				);
			echo json_encode($msg);
			exit;
		}

		if(empty($vcode)){
			$msg = array(
				'code'=>'3',
				'msg'=>'验证码不能为空'
				);
			echo json_encode($msg);
			exit;
		}

		if(empty($add['address'])){
			$msg = array(
				'code'=>'4',
				'msg'=>'收货地址不能为空'
				);
			echo json_encode($msg);
			exit;
		}

		//角色ID
		$where_roleId['where']['id'] = '11';
		$role_list = $this->role->get_one_by_where($where_roleId);
		$role_id   = $role_list['id'];
		//电销组成员
		$where_user['where']['role'] = $role_id; 
		$where_user['where']['status'] = '1'; 
		$user_list = $this->admin->getList($where_user);
		foreach ($user_list as $v) {
			$user_info[] = $v;
			$count_num_list = array_column($user_info, 'count_num'); 
		}
		$min_num = min($count_num_list);
		$where_user_min['where']['role'] = '11';
		$where_user_min['where']['count_num'] = $min_num;
		$user_info = $this->admin->get_one_by_where($where_user_min);
		$user_id = $user_info['id'];
		$add['user_id'] = $user_id;
		

		if($this->business->add($add)){

			$add_where['where']['id'] = $user_id;
			$users_info = $this->admin->get_one_by_where($add_where);
			$count_num = $users_info['count_num']+1;
			$update_where = array('id'=>$user_id);
			$update_count_num['count_num'] = $count_num;
			$this->admin->update($update_where,$update_count_num);

			$id = $this->business->insert_id();

			$this->session->set_userdata('setp1',json_encode($add));
			$msg = array(
				'code'=>'0',
				'msg'=>'提交成功',
				'data'=>$id
				);
			echo json_encode($msg);
			exit;

		}else{
			$msg = array(
				'code'=>'4',
				'msg'=>'系统繁忙，请稍后再试'
				);
			echo json_encode($msg);
			exit;
		}

		
	}

	public function setp2()
	{

		$id = $this->input->get('id');
		$data['id'] = $id;

		$this->tpl('youleshua/setp2_tpl',$data);
		
	}


	public function setp2_save()
	{

		$street = $this->input->post('street');
		$id = $this->input->post('id');
		if(empty($street)){
			$msg = array(
				'code'=>'1',
				'msg'=>'收货地址不能为空'
				);
			echo json_encode($msg);
			exit;
		}

		$update_config = array('id'=>$id);
		$update_data['street'] = $street;
		$this->business->update($update_config,$update_data);
		$this->session->set_userdata('setp2',json_encode($update_data));
		$msg = array(
			'code'=>0,
			'msg'=>'提交成功',
			'data'=>$id
			);
		echo json_encode($msg);
		exit;

	}



	public function setp3()
	{

		$id = $this->input->get('id');
		$where['where'] = array('id'=>$id);
		$info = $this->business->get_one_by_where($where);
		$data['info'] = $info;

	
		$this->tpl('youleshua/setp3_tpl',$data);
	}


	public function setp3_save()
	{
		$realname = $this->input->post('realname');
		$card_no = $this->input->post('card_no');
		$access = $this->input->post('access');
		$phone = $this->input->post('phone');

		// $realname = '蓝黎滨';
		// $card_no = '452201198309190017';
		// $access = '6226200600641071';
		// $phone = '15814073945';

		if(empty($realname)){
			$msg = array(
				'code'=>'1',
				'msg'=>'请填写姓名'
				);
			echo json_encode($msg);
			exit;
		}

		if(empty($card_no)){
			$msg = array(
				'code'=>'2',
				'msg'=>'请填写身份证号'
				);
			echo json_encode($msg);
			exit;
		}

		if(empty($access)){
			$msg = array(
				'code'=>'3',
				'msg'=>'请填写银行卡账号'
				);
			echo json_encode($msg);
			exit;
		}


		//检验四要素
		$data['phone'] = $phone;
		$data['realname'] = $realname;
		$data['access'] = $access;
		$data['card_no'] = $card_no;
		$ret = jisubank4($data);
		if($ret['status'] != '0'){
			$msg = array(
				'code'=>'4',
				'msg'=>'银行信息有误'
				);
			echo json_encode($msg);
			exit;
		}

		$id = $this->input->post('id');
		$update_config = array('id'=>$id);
		$update_data['card_no'] = $card_no;
		$update_data['access'] = $access;

		if($this->business->update($update_config,$update_data)){
			$msg = array(
				'code'=>'0',
				'msg'=>'提交成功',
				'data'=>$id
				);

		}else{
			$msg = array(
				'code'=>'5',
				'msg'=>'系统繁忙，请稍后再试'
				);
		}


		echo json_encode($msg);
		exit;



	}

	public function setp4()
	{

		$id = $this->input->get('id');
		$where['where'] = array('id'=>$id);
		$info = $this->business->get_one_by_where($where);
		$data['info'] = $info;

	
		$this->tpl('youleshua/setp4_tpl',$data);
	}


	public function user_login()
	{
		$phone = $this->input->post('phone');
		$data['phone'] = trim($phone);
		//$phone = '13510278144';
		$where['where'] = array('phone'=>$phone);
		$list = $this->trade->get_one_by_where($where);
		$acode = $this->input->post('acode');
		$_acode = $this->session->userdata('auth_code');

		if($acode != $_acode){
			$msg = array(
				'code'=>'2',
				'msg'=>'验证码错误',
				'data'=>'1'
				);
			echo json_encode($msg);
			exit;
		}

		if(empty($list)){

			$msg = array(
				'code'=>'1',
				'msg'=>'抱歉，您还没参加过活动呢',
				'data'=>'1'.$phone
				);
			echo json_encode($msg);
			exit;
		}

		$this->userlib->guest_user_login($data);

		$msg = array(
			'code'=>0,
			'msg'=>'ok',
			'data'=>'2'.$phone
			);
		echo json_encode($msg);
		exit;
	}

	public function getauthcode()
    {
        echo  $this->authcode->show();

    }


    public function send_msg()
    {
    	$phone = $this->input->post('phone');
    	if(!empty($phone)){
    		$data['phone'] = $phone;
    		$this->messagelib->send_msg($data);
    	}else{
    		$msg = array(
    			'code'=>'6',
    			'msg'=>'手机号不能为空'
    		);
	    	echo json_encode($msg);
	    	exit;
    	}

    }



}