<?php
include 'msg_sdk/mns-autoloader.php';

use Dysmsapi\Request\V20170525\QuerySendDetailsRequest;

class Messagelib
{


	public static $_ci;

	public function __construct()
	{
		self::$_ci = & get_instance();//php 5.3中self改为static
		self::$_ci->load->model('Message_mdl','message');


	}



	//用户登陆
	public function send_msg($data)
	{

		$phone = $data['phone'];

		$this->check_msg($phone);

		$rand = mt_rand(1000,9999);
		$add_log['phone'] = $phone;
		$add_log['vcode'] = $rand;
		$add_log['addtime'] = time();
		
		$host = "http://sms.market.alicloudapi.com";
		$path = "/singleSendSms";
		$method = "GET";
		$appcode = "adf49c034cc942778d0c801ab2d52ca4";
		$headers = array();
		array_push($headers, "Authorization:APPCODE " . $appcode);
		$querys = "ParamString={'number':'".$rand."'}&RecNum=".$phone."&SignName=优乐富&TemplateCode=SMS_74315014";
		$bodys = "";
		$url = $host . $path . "?" . $querys;

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_FAILONERROR, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		if (1 == strpos("$".$host, "https://"))
		{
		    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		}

		$ret = curl_exec($curl);

		$result = json_decode($ret,true);
		
		if($result['success'] == true){

			self::$_ci->message->add($add_log);
			$arr = array(
				'code'=>'0',
				'msg'=>'发送成功'
				);
			echo json_encode($arr);
			exit;

		}else{

			$arr = array(
				'code'=>'1',
				'msg'=>$result['message']
				);
			echo json_encode($arr);
			exit;

		}


	}

	//检查
	public function check_msg($phone)
	{
		$where['where'] = array('phone'=>$phone);
		$where['order'] = array('key'=>'id','value'=>'DESC');
		$info = self::$_ci->message->get_one_by_where($where);
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


	public function check_code($data)
	{

		$where['where'] = array('phone'=>$data['phone'],'vcode'=>$data['vcode']);
		$where['order'] = array('key'=>'id','value'=>'DESC');
		$info = self::$_ci->message->get_one_by_where($where);
		if(!empty($info)){
			if((time()-$info['addtime']) > 3600){
				$arr = array(
						'code'=>'3',
						'msg'=>'验证码过期'
						);
				return json_encode($arr);
				exit;
			}else{
				$arr = array(
						'code'=>'0',
						'msg'=>'验证码正确'
						);
				return json_encode($arr);
				exit;
			}
		}else{
				$arr = array(
						'code'=>'4',
						'msg'=>'无效的验证码'
						);
				return json_encode($arr);
				exit;
		}

	}


}