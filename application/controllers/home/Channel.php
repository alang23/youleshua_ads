<?php
/**
*
*@渠道管理
*
**/

class Channel extends Zrjoboa
{
		

		public function __construct()
		{
			parent::__construct();
			$this->load->model('User_channel_mdl','user_channel');
			$this->load->model('Channel_ad_mdl','channel_ad');
			$this->load->model('Ads_mdl','ads');
			$this->load->model('Brand_mdl','brand');
			$this->load->model('Channel_setting_mdl','channel_setting');
			$this->load->model('Adsense_mdl','adsense');
			$this->load->model('Channel_source_mdl','channel_source');
			$this->load->model('Channel_msg_mdl','channel_msg');
			$this->load->model('Queues_mdl','queues');
			$this->load->model('Business_mdl','business');


		}


		public function index()
		{

			$userinfo = $this->userinfo;

			$page = isset($_GET['page']) ? $_GET['page'] : 0;
	        $page = ($page && is_numeric($page)) ? intval($page) : 1;        
			$ad_name = isset($_GET['ad_name']) ? $_GET['ad_name'] : '';
			$data['ad_name'] = $ad_name;
			$types = $this->input->get('types');
			$data['types'] = $types;

	        $limit = 20;
	        $offset = ($page - 1) * $limit;
	        $pagination = '';
	        $count_where['types'] = $types;
	        $count_where['parent_id'] = '0';
	                
	        $count = $this->user_channel->get_count($count_where);
	        $data['count'] = $count;

	        $pageconfig['base_url'] = base_url('/home/channel/index?types='.$types);
	        $pageconfig['count'] = $count;
	        $pageconfig['limit'] = $limit;
	        $data['page'] = home_page($pageconfig);

			$list = array();
			$where['page'] = true;
	        $where['limit'] = $limit;
	        $where['offset'] = $offset;
	        $where['order'] = array('key'=>'id','value'=>'desc');
	        $where['where']['types'] = $types;
	        $where['where']['parent_id'] = '0';

			$list = $this->user_channel->getList($where);	
			$data['list'] = $list;

			$ismobile = isMobile();
			if($ismobile){
				$this->tpl('mobile/user_channel_tpl',$data);
			}else{
				$this->tpl('home/user_channel_tpl',$data);
			}

			

		}

		public function parent()
		{
			$parent_id = $this->input->get('parent_id');
			$channel_id = $this->input->get('channel_id');
			//$where['where']['parent_id'] = $parent_id;
			$where['where']['channel_id'] = $channel_id;
			$count_num = 0;
			//$count_where['parent_id'] = $parent_id;
			$count_where['channel_id'] = $channel_id;
			$count_num = $this->user_channel->get_count($count_where);
			$data['count'] = $count_num;

			$list = $this->user_channel->getList($where);
			$data['list'] = $list;

			$this->tpl('home/channel_parent_tpl',$data);
			
		}


		//添加账户
		public function add()
		{

			if(!empty($_POST)){

				$add['title'] = $this->input->post('title');
				$add['username'] = $this->input->post('username');
				$add['pawd'] = $this->input->post('pawd');
				$add['title'] = $this->input->post('title');
				$add['remark'] = $this->input->post('remark');
				$add['channel_id'] = $this->input->post('channel_id');
				$add['types'] = $this->input->post('types');
				$add['addtime'] = time();
				$add['parent_id'] = $this->input->post('parent_id');

				//判断用户名是否已经存在
				$where['where'] = array('username'=>$add['username']);
				$info = $this->user_channel->get_one_by_where($where);
				if(!empty($info)){
					exit('用户名已经存在');
				}

				//检查渠道号
				$where_channel['where']['channel_id'] = $add['channel_id'];
				$info_channel = $this->user_channel->get_one_by_where($where_channel);
				if(!empty($info_channel)){
					exit('渠道号已经存在');
				}

				$add['pawd'] = md5($add['pawd']);
				if($this->user_channel->add($add)){

					 $id = $this->user_channel->insert_id();
					 $update_config['id'] = $id;
					 $update_data['group_id'] = $id;
					 $this->user_channel->update($update_config,$update_data);


					redirect('home/channel/index?types='.$add['types']);


				}


			}else{

				$types = $this->input->get('types');
				$data['types'] = $types;

				$ads = array();
				$ads = $this->ads->getList();
				$data['ads'] = $ads;

				$channel_where['where']['types'] = '1';
				$channel_where['where']['parent_id'] = '0';
				$channel = $this->user_channel->getList($channel_where);
				$data['channel'] = $channel;

				//brand
				$brand = $this->brand->getList();
				$data['brand'] = $brand;

				$this->tpl('home/user_channel_add_tpl',$data);


			}

		}

				//添加账户
		public function edit()
		{

			if(!empty($_POST)){

				$add['title'] = $this->input->post('title');
				$add['username'] = $this->input->post('username');
				$add['pawd'] = $this->input->post('pawd');
				$add['title'] = $this->input->post('title');
				$add['remark'] = $this->input->post('remark');
				$add['channel_id'] = $this->input->post('channel_id');
				$add['types'] = $this->input->post('types');
				//$ad_id = $this->input->post('ad_id');
				$id = $this->input->post('id');

				//判断用户名是否已经存在
				// $where['where'] = array('username'=>$add['username']);
				// $info = $this->user_channel->get_one_by_where($where);
				// if(!empty($info)){
				// 	exit('用户名已经存在');
				// }

				$update_config['id'] = $id;
				if(!empty($add['pawd'])){
					$add['pawd'] = md5($add['pawd']);
				}
				$this->user_channel->update($update_config,$add);


					// if(count($ad_id) > 0){
					// 	//先删除
					// 	$del_where['channel_id'] = $id;
					// 	$this->channel_ad->del($del_where);
					// 	for($i=0;$i<count($ad_id);$i++){

					// 		$ad_add['channel_id'] = $id;
					// 		$ad_add['ad_id'] = $ad_id[$i];
					// 		$ad_add['addtime'] = time();
					// 		$this->channel_ad->add($ad_add);

					// 	}

					// }


				redirect('home/channel/index?types='.$add['types']);

					
			


			}else{

				$ads = array();
				$ads = $this->ads->getList();
				$data['ads'] = $ads;

				$id = $this->input->get('id');
				$info = array();
				$where['where'] = array('id'=>$id);
				$info = $this->user_channel->get_one_by_where($where);
				$data['info'] = $info;
	
				$this->tpl('home/user_channel_edit_tpl',$data);


			}

		}

		public function del()
		{
			$id = $this->input->get('id');
			$types = $this->input->get('types');
			$config['id'] = $id;
			//if($this->user_channel->del($config)){
			redirect('home/channel/index?types='.$types);
			//}
		}


	public function open()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$types = isset($_GET['types']) ? $_GET['types'] : '1';

		$update_config = array('id'=>$id);
		$update_data['status'] = '1';
		if($this->user_channel->update($update_config,$update_data)){
			$msg['title'] = '开启成功';
			$msg['msg'] = '<a href="'.base_url().'home/channel/index?types='.$types.'">返回列表</a> ';
			
					$this->tpl('msg/msg_success',$msg);				
			}else{
				$msg['title'] = '开启失败';
				$msg['msg'] = '<a href="'.base_url().'home/channel/index?types='.$types.'">返回列表</a> ';
					$this->tpl('msg/msg_errors',$msg);		
		}
	}

	public function close()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$types = isset($_GET['types']) ? $_GET['types'] : '1';
		$update_config = array('id'=>$id);
		$update_data['status'] = '0';
		if($this->user_channel->update($update_config,$update_data)){
			$msg['title'] = '关闭成功';
			$msg['msg'] = '<a href="'.base_url().'home/channel/index?types='.$types.'">返回列表</a> ';
					$this->tpl('msg/msg_success',$msg);				
			}else{
				$msg['title'] = '关闭失败';
				$msg['msg'] = '<a href="'.base_url().'home/channel/index?types='.$types.'">返回列表</a> ';
					$this->tpl('msg/msg_errors',$msg);		
		}
	}

	//参数配置
	public function setting()
	{

		$id = $this->input->get('id');
		$where['where']['id'] = $id;
		$info = $this->user_channel->get_one_by_where($where);
		$data['info'] = $info;

		$setting_where['where']['channel_id'] = $info['channel_id'];
		$_setting_info = $this->channel_setting->get_one_by_where($setting_where);
		$setting_info = json_decode($_setting_info['sys_info'],true);
		$data['setting_info'] = $setting_info;

		$adsense = $this->adsense->getList();
		$data['adsense'] = $adsense;

		//流量
		if($info['types'] == '1'){
			$ad_source = array();
			$ad_source_id = array();
			$ad_source_where['where']['channel_id'] = $info['channel_id'];
			$ad_source = $this->channel_source->getList($ad_source_where);
			foreach($ad_source as $k => $v){
				$ad_source_id[] = $v['pos_id'];
			}
			$data['ad_source_id'] = $ad_source_id;
			//短信
			$msg_where['where']['channel_id'] = $info['channel_id'];
			$msg = $this->channel_msg->get_one_by_where($msg_where);
			$data['msg'] = $msg;

			//目前总注册数
			$bus_count = 0;
			$bus_where['channel_id'] = $info['channel_id'];
			$bus_count = $this->business->get_count($bus_where);
			$data['bus_count'] = $bus_count;

			$this->tpl('home/channel_setting_tpl',$data);

		}else{

			$channel_ad = array();
			$ad_where['where'] = array('channel_id'=>$id);
			$_channel_ad = $this->channel_ad->getList($ad_where);
			foreach($_channel_ad as $k => $v){
				$channel_ad[] = $v['ad_id'];
			}	

			//广告列表
			$ads = array();
			$ads = $this->ads->getList();
			$data['ads'] = $ads;

			$data['channel_ad'] = $channel_ad;
			$this->tpl('home/channel_setting_add_tpl',$data);

		}


	

	}

	//短信
	public function save_msg()
	{
		
		$channel_id = $this->input->post('channel_id');
		$qianming = $this->input->post('qianming');
		$msg_1 = $this->input->post('msg_1');
		$msg_2 = $this->input->post('msg_2');
		$msg_3 = $this->input->post('msg_3');
		$msg_4 = $this->input->post('msg_4');
		$msg_5 = $this->input->post('msg_5');

		$add['msg_1'] = $msg_1;
		$add['msg_2'] = $msg_2;
		$add['msg_3'] = $msg_3;
		$add['msg_4'] = $msg_4;
		$add['msg_5'] = $msg_5;
		$add['channel_id'] = $channel_id;
		$add['qianming'] = $qianming;
		//先删除
		$del_config['channel_id'] = $channel_id;
		$this->channel_msg->del($del_config);
		//重新添加
		$this->channel_msg->add($add);

		$msg = array(
			'code'=>'0',
			'msg'=>'更新成功'
			);

		echo json_encode($msg);
		exit;

	}

	public function save_source()
	{
		$channel_id = $this->input->post('channel_id');
		$ids = $this->input->post('ids');
		$_ids = explode(',', $ids);
		//先删除
		$del_where['channel_id'] = $channel_id;
		$this->channel_source->del($del_where);
		//重新添加
		for($i=0;$i<count($_ids);$i++){
			$add['pos_id'] = $_ids[$i];
			$add['channel_id'] = $channel_id;
			$this->channel_source->add($add);
		}
		//重新组队列
		$this->set_queue();
		
		$msg = array(
			'code'=>'0',
			'msg'=>'更新成功'
			);

		echo json_encode($msg);
		exit;
	}

	public function save_ads()
	{

		$ad_id = $this->input->post('ad_id');
		$id = $this->input->post('id');
		$types = $this->input->post('types');

		if(count($ad_id) > 0){
			//先删除
			$del_where['channel_id'] = $id;
			$this->channel_ad->del($del_where);
			for($i=0;$i<count($ad_id);$i++){

				$ad_add['channel_id'] = $id;
				$ad_add['ad_id'] = $ad_id[$i];
				$ad_add['addtime'] = time();
				$this->channel_ad->add($ad_add);

			}

		}

		redirect('home/channel/index?types='.$types);

	}

	public function save_source_count()
	{

		$id = $this->input->post('id');
		$amount = $this->input->post('amount');
		$show_url = $this->input->post('show_url');
		$total = $this->input->post('total');

		$update_config['id'] = $id;
		$update_data['amount'] = $amount;
		$update_data['total'] = $total;
		$update_data['show_url'] = $show_url;
		if($this->user_channel->update($update_config,$update_data)){
			$msg = array(
				'code'=>'0',
				'msg'=>'更新成功'
			);
		}else{
			$msg = array(
				'code'=>'0',
				'msg'=>'更新成功'
			);
		}

		echo json_encode($msg);
		exit;
	}

	//重置队列
	public function set_queue()
	{
		//
		$del_config['update_time <>'] ='';
		$this->queues->del($del_config);
		$list = $this->channel_source->getList();
		foreach($list as $k => $v){
			$pos[$v['pos_id']][] = $v['channel_id'];
		}

		foreach($pos as $pk => $pv){
			$add['pos_id'] = $pk;
			$add['info'] = implode('|', $pos[$pk]);
			$add['update_time'] = time();
			$this->queues->add($add);
		}
	}

	


}

