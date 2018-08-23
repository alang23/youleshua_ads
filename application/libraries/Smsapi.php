<?php
/* *
 * 类名：ChuanglanSmsApi
 * 功能：创蓝接口请求类
 * 详细：构造创蓝短信接口请求，获取远程HTTP数据
 * 版本：1.3
 * 日期：2014-07-16
 * 说明：
 * 以下代码只是为了方便客户测试而提供的样例代码，客户可以根据自己网站的需要，按照技术文档自行编写,并非一定要使用该代码。
 * 该代码仅供学习和研究创蓝接口使用，只是提供一个参考。
 */
require_once("msn/ChuanglanSmsHelper/chuanglan_config.php");

class smsapi {


	 public static $_ci;


	 public function __construct()
	 {
	 	self::$_ci = & get_instance();//php 5.3中self改为static
	 	self::$_ci->load->model('Message_mdl','message');

	 }


	/**
	 * 发送短信
	 *
	 * @param string $mobile 手机号码
	 * @param string $msg 短信内容
	 * @param string $needstatus 是否需要状态报告
	 * @param string $extno   扩展码，可选
	 */
	public function sendSMS( $mobile, $msg, $needstatus = 'false', $extno = '') {
		//global $chuanglan_config;
		//创蓝接口参数
		/*
        $postArr = array (
			'account'  =>  self::$_ci->config->item('api_account'),
			'password' => self::$_ci->config->item('api_password'),
			'msg' => urlencode($msg),
			'phone' => $mobile,
			'report' => $needstatus
        );

		$postresult = $this->curlPost( self::$_ci->config->item('api_send_url'), $postArr);

		$result = array();
		$result = $this->execResult($postresult);


		return $result;
		*/

		    $host = "http://43.254.52.253:8088/websms/smsService";
	        $method = "GET";
	       	$qian=array(" ","　","\t","\n","\r");$hou=array("","","","","");
    		$msg = str_replace($qian,$hou,$msg); 
	        $headers = array();
	        $pawd = '52285782';
	        $querys = "action=sendsms&userId=szlhhyhy&md5password=".md5($pawd)."&content=$msg&mobile=$mobile";
	        $bodys = "";
	        $url = $host . "?" . $querys;
	        //echo $url;

	        $curl = curl_init();
	        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
	        curl_setopt($curl, CURLOPT_URL, $url);
	        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	        curl_setopt($curl, CURLOPT_FAILONERROR, false);
	        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($curl, CURLOPT_HEADER, false);
	        if (1 == strpos("$".$host, "https://"))
	        {
	            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	        }
	        $ret = curl_exec($curl);
	      
	        //$result = json_decode($ret,true);
	        $_result = explode(';', $ret);
	        $result['result'] = 0;
	        $result['msg'] = '发送失败';
	        if($_result[0] == 'success'){
	        	$result['result'] = 1;
	        	$result['msg'] = '发送成功';
	        }else{
	        	$result['result'] = 0;
	        	$result['msg'] = $_result[1];
	        }
	        //var_dump($result);
	        return $result;
	}
	
	/**
	 * 查询额度
	 *
	 *  查询地址
	 */
	public function queryBalance() {


			$data['host'] = "http://43.254.52.253:8088/websms/smsService";
	        $data['method'] = "GET";	       
	        $data['headers'] = array();
	        $pawd = '52285782';
	        $querys = "action=getbalance&userId=szlhhyhy&md5password=".md5($pawd);
	        $data['url'] = $data['host'] . "?" . $querys;
	        $ret = $this->do_http($data);

	        $_result = explode(';', $ret);
	        $result['num'] = $_result[1];
	      
	        return $result;
	}

	public function do_http($data)
	{

	        $curl = curl_init();
	        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $data['method']);
	        curl_setopt($curl, CURLOPT_URL, $data['url']);
	        curl_setopt($curl, CURLOPT_HTTPHEADER, $data['headers']);
	        curl_setopt($curl, CURLOPT_FAILONERROR, false);
	        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($curl, CURLOPT_HEADER, false);
	        if (1 == strpos("$".$data['host'], "https://"))
	        {
	            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	        }
	        $ret = curl_exec($curl);

	        return $ret;
	      
	}

	/**
	 * 处理返回值
	 * 
	 */
	public function execResult($result){
		$result=preg_split("/[,\r\n]/",$result);
		return $result;
	}
	/**
	 * 通过CURL发送HTTP请求
	 * @param string $url  //请求URL
	 * @param array $postFields //请求参数 
	 * @return mixed
	 */
	private function curlPost($url,$postFields){
		$postFields = json_encode($postFields);
		$ch = curl_init ();
		curl_setopt( $ch, CURLOPT_URL, $url ); 
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json; charset=utf-8'
			)
		);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt( $ch, CURLOPT_TIMEOUT,1); 
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
		$ret = curl_exec ( $ch );
        if (false == $ret) {
            $result = curl_error(  $ch);
        } else {
            $rsp = curl_getinfo( $ch, CURLINFO_HTTP_CODE);
            if (200 != $rsp) {
                $result = "请求状态 ". $rsp . " " . curl_error($ch);
            } else {
                $result = $ret;
            }
        }
		curl_close ( $ch );
		return $result;
	}


	//检测发短信
	public function send_msg($data)
	{


		$phone = $data['phone'];
		//$this->check_msg($phone);

		$rand = mt_rand(1000,9999);
		$add_log['phone'] = $phone;
		$add_log['vcode'] = $rand;
		$add_log['addtime'] = time();
		//$msg = '您的验证码：'.$rand.',十分钟内有效!';
		$msg = $data['msg'];
		
		$ret = $this->sendSMS($phone, $msg);

		//$json_str = implode(',', $ret);
			
		//$json_arr = json_decode($json_str,true);
		
		//if($json_arr['code'] == '0'){
		if($ret['result'] == '1'){

			self::$_ci->message->add($add_log);
			$arr = array(
				'code'=>'0',
				'msg'=>'发送成功'
				);
			

		}else{

			$arr = array(
				'code'=>'1',
				'msg'=>$ret['message']
				);
		

		}

		return $arr;

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
				echo  json_encode($arr);
				exit;
			}
		}else{
				$arr = array(
						'code'=>'4',
						'msg'=>'无效的验证码'
						);
				echo json_encode($arr);
				exit;
		}

	}


		//获取状态
	public function getsendreport()
	{
		$url = 'http://43.254.52.253:8088/websms/smsService';
		
	}

	
	//魔术获取
	public function __get($name){
		return $this->$name;
	}
	
	//魔术设置
	public function __set($name,$value){
		$this->$name=$value;
	}
}
?>