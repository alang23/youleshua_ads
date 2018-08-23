<?php

/**
*
*@dec 短信中心
*
*
**/

class Csmsapi extends ApiController
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Message_mdl','message');
		$this->load->library('Smsapi','smsapi');
		$this->load->model('Message_log_mdl','message_log');


	}

	public function index()
	{
		echo __CLASS__;
	}


	//注册短信接口
	public function register_msg()
	{

		$data['phone'] = '15814073945';
		$phone = $data['phone'];

		$this->check_msg($phone);
		$rand = mt_rand(1000,9999);
		$add_log['phone'] = $phone;
		$add_log['vcode'] = $rand;
		$add_log['addtime'] = time();
		$msg = '【拉卡拉支付】您的验证码：'.$rand.',十分钟内有效!';
		$ret = $this->smsapi->sendSMS($phone, $msg);
		
		if($ret['result'] == '1'){

			$this->message->add($add_log);
			$arr = array(
				'code'=>'0',
				'msg'=>'发送成功'
				);
			echo json_encode($arr);
			exit;

		}else{

			$arr = array(
				'code'=>'1',
				'msg'=>$ret['message']
				);
			echo json_encode($arr);
			exit;

		}

	}
	//批量发送短信

		//检查
	public function check_msg($phone)
	{
		$where['where'] = array('phone'=>$phone);
		$where['order'] = array('key'=>'id','value'=>'DESC');
		$info = $this->message->get_one_by_where($where);
		if(!empty($info)){
			if((time()-$info['addtime']) < 60){
				$arr = array(
						'code'=>'3',
						'msg'=>'发送失败，请求过于频繁'
						);
				echo json_encode($arr);
				exit;
			}
		}
	}



	public function send_message($data=array())
	{

		$phone = $data['phone'];
		$msg = $data['msg'];
		$phone = '15814073945';
		$msg = '【拉卡拉支付】您的验证码：';
		$data['channel_id'] = '10003';
		$data['user_id'] = '16';

    	if(!empty($phone)){

    		$mdata['phone'] = $phone;
    		$mdata['msg'] = $msg; 		

			$ret = $this->smsapi->send_msg($mdata);

			if($ret['code'] == '0'){
	    		//记录短信
	    		$phone_arr = explode(',', $phone);
	    		for($i=0;$i<count($phone_arr);$i++){
	    			$add['phone'] = $phone_arr[$i];
	    			$add['msg'] = $msg;
	    			$add['channel_id'] = $data['channel_id'];
	    			$add['user_id'] = $data['user_id'];
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