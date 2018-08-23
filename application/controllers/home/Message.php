<?php

class Message extends Zrjoboa
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Smsapi','smsapi');
		$this->load->model('Message_log_mdl','message_log');

	}


	public function index()
	{
		$userinfo = $this->userinfo;
		$check_role = $this->userlib->check_role('send_msg');
		$this->tpl('home/message_tpl',$data);
		
	}


	public function send_message()
	{
		$userinfo = $this->userinfo;

		$phone = $this->input->post('phone');
		$msg = $this->input->post('msg');

    	if(!empty($phone)){

    		$data['phone'] = $phone;
    		$data['msg'] = $msg;
			$ret = $this->smsapi->send_msg($data);

			if($ret['code'] == '0'){
	    		//记录短信
	    		$phone_arr = explode(',', $phone);
	    		for($i=0;$i<count($phone_arr);$i++){
	    			$add['phone'] = $phone_arr[$i];
	    			$add['msg'] = $msg;
	    			$add['channel_id'] = $userinfo['channel_id'];
	    			$add['user_id'] = $userinfo['id'];
	    			$add['addtime'] = time();
	    			$this->message_log->add($add);
	    		}

	    		$msg = array(
	    			'code'=>'0',
	    			'msg'=>'短信发送成功!'
	    		);

			}else{
				  $msg = array(
	    			'code'=>'1',
	    			'msg'=>'发送失败:'.$ret['msg']
	    		);
			}

	    	echo json_encode($msg);
	    	exit;

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

