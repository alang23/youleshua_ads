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
		$pid = isset($_GET['pid']) ? $_GET['pid'] : 0;

		$kwid = '1010';
		$ctvid = '2005';
		$pid = '7070';
		$pos_id = '9';

		if(empty($redirect) || empty($aid) || empty($pos_id)){
			exit();
		}

		$data['aid'] = $aid;
		$data['pos_id'] = $pos_id;
		$this->proccess($data);
		$data['pid'] = $pid;


		if($aid=='51' || $aid == '52' || $aid=='50' || $aid=='18' || $aid=='19' || $aid=='13' || $aid == '45'){
			$url = 'http://app.1chuanqi.com/defaults/index?frm='.$aid.'&pos_id='.$pos_id.'&b_no=10003&pid='.$pid;
			redirect($url);
			exit;
		}
		
		//新分配方式
		$source_user_where['where']['parent_id'] = '0';
		$source_user = $this->user_channel->getList($source_user_where);
		//百度关键字处理
		$param_str = '';
		if($pos_id == '9'){

			if(!empty($kwid) && !empty($ctvid)){

				$bd['kwid'] = $kwid;
				$bd['ctvid'] = $ctvid;
				$bd['pid'] = $pid;
				$bd['pos_id'] = $pos_id;
				$bd['kw'] = 'test';
				$this->ads_baidu->kw_baidu($bd);
				$param_str .= '&kwid='.$kwid.'&ctvid='.$ctvid.'&pid='.$pid;
				
			}
		}

		//判断账号是否开启
		$ids = array();
		if(!empty($source_user)){

			foreach($source_user as $k => $v){
				$_tmp[$v['channel_id']] = $v['show_url'];
				$_ids[] = $v['channel_id'];
			}

			if($aid != '22'){
				$_tmp['10003'] = 'http://app.1chuanqi.com/lakala/index';
			}
			
			//队列
			$queue_where['where']['pos_id'] = $pos_id;
			$queue_info = $this->queues->get_one_by_where($queue_where);
			$channel_arr = explode('|',$queue_info['info']);

			if($channel_arr[0] == '10003' && $aid == '22'){

				$c_id = $channel_arr[1];	

			}else{

				$c_id = $channel_arr[0];		

			}
			//$c_id = $channel_arr[0];		
			$url = isset($_tmp[$c_id]) ? $_tmp[$c_id] : 'http://app.1chuanqi.com/defaults/index';
				
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

			$url = 'http://app.1chuanqi.com/defaults/index?frm='.$aid.'&pos_id='.$pos_id.'&b_no=10003&pid='.$pid.$param_str;
			
		}

		echo $url;
		exit;
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




}