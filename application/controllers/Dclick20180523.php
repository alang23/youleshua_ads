<?php
/**
*
* @desc 点击中转
*
**/

class Dclick extends BaseController
{


	//var $defaults_url = 'http://app.1chuanqi.com/defaults/index';


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Ads_mdl','ads');
		$this->load->model('Business_mdl','business');
		$this->load->model('Lunxun_mdl','lunxun');
		$this->load->model('Channel_source_mdl','channel_source');
		$this->load->model('Queues_mdl','queues');
		$this->load->model('User_channel_mdl','user_channel');
		$this->load->model('Ads_parent_mdl','ads_parent');
		$this->load->model('Ads_baidu_mdl','ads_baidu');

	}


	public function index()
	{

	}

	//跳转
	public function dredirect()
	{


		$redirect = $this->input->get('redirect');
		$aid = $this->input->get('aid');
		$pos_id = $this->input->get('pos_id');
		$pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
		$kwid = isset($_GET['kwid']) ? $_GET['kwid'] : '';
		$ctvid = isset($_GET['ctvid']) ? $_GET['ctvid'] : '';

		if(empty($redirect) || empty($aid) || empty($pos_id)){
			exit();
		}

		$data['aid'] = $aid;
		$data['pos_id'] = $pos_id;
		$this->proccess($data);
		$data['pid'] = $pid;

				//百度关键字处理
		$param_str = '';
		if($pos_id == '8'){
			$referer = $_SERVER['HTTP_REFERER'];
			$parant = $this->get_parant($referer);
			if(!empty($kwid) && !empty($ctvid)){

				$bd['kwid'] = $kwid;
				$bd['ctvid'] = $ctvid;
				$bd['pid'] = $pid;
				$bd['pos_id'] = $pos_id;
				$bd['kw'] = isset($parant['word']) ? urldecode($parant['word']) : urldecode($parant['kw']);
				$this->ads_baidu->kw_baidu($bd);
				$param_str .= '&kwid='.$kwid.'&ctvid='.$ctvid.'&pid='.$pid;
				
			}
		}

		if($aid == '73'){
			$url = "http://xinyongka.1chuanqi.com/lihuo/index?a_code=lhwx";
			redirect($url);
			exit;
		}


		// if($aid=='51' || $aid == '52' || $aid=='50' || $aid=='18' || $aid=='19' || $aid=='13' || $aid == '45'){
		// 	$url = 'http://app.1chuanqi.com/defaults/index?frm='.$aid.'&pos_id='.$pos_id.'&b_no=10003&pid='.$pid.$param_str;
		// 	redirect($url);
		// 	exit;
		// }
		//独享
		$along_id = array('13','18','19');
		if(in_array($aid,$along_id)){
			$url = 'http://app.1chuanqi.com/defaults/index?frm='.$aid.'&pos_id='.$pos_id.'&b_no=10003&pid='.$pid.$param_str;
			redirect($url);
			exit;
		}
		
		//新分配方式
		$source_user_where['where']['parent_id'] = '0';
		$source_user_where['where']['types'] = '1';
		$source_user = $this->user_channel->getList($source_user_where);

		//判断账号是否开启
		//判断账号是否开启
		$ids = array();

		//代理商总注册数
		$arr_count = $this->user_channel->date_count();
		
		foreach($arr_count as $ack => $acv){
				$_tmp_ac[$acv['channel_id']] = $acv['total'];
		}

		if(!empty($source_user)){

			foreach($source_user as $k => $v){
					$_tmp[$v['channel_id']] = $v['show_url'];
					$_tmp_count[$v['channel_id']] = isset($_tmp_ac[$v['channel_id']]) ? $_tmp_ac[$v['channel_id']] : 0;
					$_tmp_allow[$v['channel_id']] = $v['total'];
					$_ids[$v['channel_id']] = $v;
			}

			// if($aid != '22' || $aid != '57' || $aid == '46'){
			// 	$_tmp['10003'] = 'http://app.1chuanqi.com/lakala/index';
			// }
			
			//队列
			$queue_where['where']['pos_id'] = $pos_id;
			$queue_info = $this->queues->get_one_by_where($queue_where);
			$channel_arr = explode('|',$queue_info['info']);

			
			$share_id = array('13','18','19');
			if(!in_array($aid,$share_id)){
				foreach($channel_arr as $kkk => $vvv){
					if($vvv == '10003'){
						unset($channel_arr[$kkk]);
					}
				}
			}
			

			//百度控制
			$allow_baidu = array('8');
			if(in_array($pos_id,$allow_baidu)){
				foreach($channel_arr as $kkk => $vvv){
					if($vvv == '10003'){
						unset($channel_arr[$kkk]);
					}
				}
			}
			/*
			$allow_sel_no = array('22','20');
			if(in_array($aid,$allow_sel_no)){
				foreach($channel_arr as $kkk => $vvv){
					if($vvv == '10003'){
						unset($channel_arr[$kkk]);
					}
				}
			}
			*/
			

			//=======做比较
			$allow_id = array();
			foreach($channel_arr as $cak => $cav){
					
				if( ($_tmp_count[$cav] < $_tmp_allow[$cav]) && $_ids[$cav]['status'] == '1' ){
					$allow_id[] = $cav;
				}
					
			}
				
			$c_id = $allow_id[0];

			// if($allow_id[0] == '10003' && $aid == '22'){

			// 	$c_id = $allow_id[1];	

			// }else{

			// 	$c_id = $allow_id[0];		

			// }
			if($aid == '69' || $aid == '70'){

				$url = 'http://app.1chuanqi.com/kuaishua/index';

			}else{

				$url = 'http://app.1chuanqi.com/defaults/index';

			}

			$new_aid = array('20','21','22','46','29','35','37','61','60','50','74','75','76','77','78','79','80','81','82','83','84','85','39','44','45','54','55','56');
			if(in_array($aid,$new_aid)){
				$url = 'http://app.1chuanqi.com/defaults2/index';
			}
			/*
			$ad_id = array('20','21','22','46');
			if(in_array($aid,$ad_id)){
				$url = 'http://app.1chuanqi.com/sanyaosu/index';
			}
			*/
			//简版
			
			// if($aid == '60'){
			// 	$url = 'http://app.1chuanqi.com/lakala/index';
			// }
			
			 
			if(!in_array('10003',$channel_arr)){
				//重新组
				$channel_arr[] = '10003';
			}

			foreach($channel_arr as $kk => $vv){
				if($vv != $c_id){
					$_tmp_id[] = $vv;
				}
			}
				
			$_tmp_id[] = $c_id;
				
			$update_config['pos_id'] = $pos_id;
			$queues_str = implode('|', $_tmp_id);
				
			$update_data['info'] = $queues_str;
			$update_data['update_time'] = time();
			$this->queues->update($update_config,$update_data);
			//}
			$url = $url.'?frm='.$aid.'&pos_id='.$pos_id.'&b_no='.$c_id.'&pid='.$pid.$param_str;
			
		}else{

			$url =  $url.'?frm='.$aid.'&pos_id='.$pos_id.'&b_no=10003&pid='.$pid.$param_str;
			
		}


		redirect($url);
		exit;


	}



		//跳转
	public function test()
	{


		$redirect = $this->input->get('redirect');
		$aid = $this->input->get('aid');
		$pos_id = $this->input->get('pos_id');
		$pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
		$kwid = isset($_GET['kwid']) ? $_GET['kwid'] : '';
		$ctvid = isset($_GET['ctvid']) ? $_GET['ctvid'] : '';

		if(empty($redirect) || empty($aid) || empty($pos_id)){
			exit();
		}

		$data['aid'] = $aid;
		$data['pos_id'] = $pos_id;
		$this->proccess($data);
		$data['pid'] = $pid;

				//百度关键字处理
		$param_str = '';
		if($pos_id == '8'){
			$referer = $_SERVER['HTTP_REFERER'];
			$parant = $this->get_parant($referer);
			if(!empty($kwid) && !empty($ctvid)){

				$bd['kwid'] = $kwid;
				$bd['ctvid'] = $ctvid;
				$bd['pid'] = $pid;
				$bd['pos_id'] = $pos_id;
				$bd['kw'] = isset($parant['word']) ? urldecode($parant['word']) : urldecode($parant['kw']);
				$this->ads_baidu->kw_baidu($bd);
				$param_str .= '&kwid='.$kwid.'&ctvid='.$ctvid.'&pid='.$pid;
				
			}
		}


		// if($aid=='51' || $aid == '52' || $aid=='50' || $aid=='18' || $aid=='19' || $aid=='13' || $aid == '45'){
		// 	$url = 'http://app.1chuanqi.com/defaults/index?frm='.$aid.'&pos_id='.$pos_id.'&b_no=10003&pid='.$pid.$param_str;
		// 	redirect($url);
		// 	exit;
		// }

		if($aid=='13' || $aid == '14' || $aid=='15' || $aid=='18' || $aid=='19'){
			$url = 'http://app.1chuanqi.com/defaults/index?frm='.$aid.'&pos_id='.$pos_id.'&b_no=10003&pid='.$pid.$param_str;
			redirect($url);
			exit;
		}
		
		//新分配方式
		$source_user_where['where']['parent_id'] = '0';
		$source_user_where['where']['types'] = '1';
		$source_user = $this->user_channel->getList($source_user_where);

		//判断账号是否开启
		//判断账号是否开启
		$ids = array();

		//代理商总注册数
		$arr_count = $this->user_channel->date_count();
		
		foreach($arr_count as $ack => $acv){
				$_tmp_ac[$acv['channel_id']] = $acv['total'];
		}

		if(!empty($source_user)){

			foreach($source_user as $k => $v){
					$_tmp[$v['channel_id']] = $v['show_url'];
					$_tmp_count[$v['channel_id']] = isset($_tmp_ac[$v['channel_id']]) ? $_tmp_ac[$v['channel_id']] : 0;
					$_tmp_allow[$v['channel_id']] = $v['total'];
					$_ids[$v['channel_id']] = $v;
			}

		
			
			//队列
			$queue_where['where']['pos_id'] = $pos_id;
			$queue_info = $this->queues->get_one_by_where($queue_where);
			$channel_arr = explode('|',$queue_info['info']);

			foreach($channel_arr as $kkk => $vvv){
				if($vvv == '10003'){
					unset($channel_arr[$kkk]);
				}
			}

			//=======做比较
			$allow_id = array();
			foreach($channel_arr as $cak => $cav){
				
				if( ($_tmp_count[$cav] < $_tmp_allow[$cav]) && $_ids[$cav]['status'] == '1' ){
					$allow_id[] = $cav;
				}


					
			}

			$c_id = $allow_id[0];

			// if($allow_id[0] == '10003' && $aid == '22'){

			// 	$c_id = $allow_id[1];	

			// }else{

			// 	$c_id = $allow_id[0];		

			// }
			if($aid == '69' || $aid == '70'){

				$url = 'http://app.1chuanqi.com/kuaishua/index';

			}else{

				$url = 'http://app.1chuanqi.com/defaults/index';

			}

			//简版
			if($aid == '39' || $aid == '54' || $aid == '55' || $aid == '56'){
				$url = 'http://app.1chuanqi.com/lakala/index';
			}
			 
				
				//重新组
			foreach($channel_arr as $kk => $vv){
				if($vv != $c_id){
					$_tmp_id[] = $vv;
				}
			}
				
			$_tmp_id[] = $c_id;
				
			$update_config['pos_id'] = $pos_id;
			$queues_str = implode('|', $_tmp_id);
				
			$update_data['info'] = $queues_str;
			$update_data['update_time'] = time();
			$this->queues->update($update_config,$update_data);
			//}
			$url = $url.'?frm='.$aid.'&pos_id='.$pos_id.'&b_no='.$c_id.'&pid='.$pid.$param_str;
			
		}else{

			$url =  $url.'?frm='.$aid.'&pos_id='.$pos_id.'&b_no=10003&pid='.$pid.$param_str;
			
		}


		redirect($url);
		exit;


	}



	//处理点击
	public function proccess($data)
	{

		$c_data['days'] = date("d");
		$c_data['month'] = date("m");
		$c_data['hours'] = date("H");
		$c_data['dates']  = date("Y-m-d");
		$c_data['aid'] = $data['aid'];
		$c_data['pos_id'] = intval($data['pos_id']);
		$c_data['year'] = date('Y');
		$c_data['field'] = 'h_'.date("H");
		$c_data['ip'] = get_ip();
		
		$this->ads->proccess($c_data);

	}


	public function get_parant($url)
	{

		$pos = strpos($url, '?');
		$str = substr($url,$pos+1,strlen($url));
		$arr = explode('&', $str);
		$_url = array();
		foreach($arr as $k => $v){
			$_arr = explode('=', $v);
			$_url[$_arr[0]] = $_arr[1];
		}
		
		return $_url;

	}




}