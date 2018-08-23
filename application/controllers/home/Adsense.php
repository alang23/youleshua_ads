<?php

class Adsense extends Zrjoboa
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Adsense_mdl','adsense');
		$this->load->model('Channel_source_mdl','channel_source');
		$this->load->model('User_channel_mdl','user_channel');
		$this->load->model('Queues_mdl','queue');


	}


	public function index()
	{

		$ismobile = isMobile();

		$userinfo = $this->userinfo;

		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
                
        $count = $this->adsense->get_count();
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/adsense/index?');
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'id','value'=>'desc');
		$list = $this->adsense->getList($where);	
		$data['list'] = $list;

		// if(!$ismobile){
		// 	$this->tpl('home/adsense_tpl',$data);
		// }else{
		// 	$this->tpl('mobile/mobile_adsense_tpl',$data);
		// }
		$this->tpl('home/adsense_tpl',$data);

	}


	public function add()
	{
		if(!empty($_POST)){

			$add['title'] = $this->input->post('title');
			$add['url'] = $this->input->post('url');
			$add['ad_type'] = $this->input->post('ad_type');
			$add['intro'] = $this->input->post('intro');
			$add['addtime'] = time();
			if($this->adsense->add($add)){
				redirect('/home/adsense/index');
			}
		}else{

			$this->tpl('home/adsense_add_tpl');
		}
	}

	public function del()
	{
		$id = $this->input->get('id');
		$config['id'] = $id;
		if($this->adsense->del($config)){
			redirect('/home/adsense/index');
		}
	}


	public function update()
	{
		if(!empty($_POST)){

			$add['title'] = $this->input->post('title');
			$add['url'] = $this->input->post('url');
			$add['ad_type'] = $this->input->post('ad_type');
			$add['intro'] = $this->input->post('intro');
			$id = $this->input->post('id');
			$update_config = array('id'=>$id);
			$this->adsense->update($update_config,$add);
			redirect('/home/adsense/index');
			
		}else{

			$id = $this->input->get('id');
			$where['where'] = array('id'=>$id);
			$info = $this->adsense->get_one_by_where($where);
			$data['info'] = $info;

			$this->tpl('home/adsense_update_tpl',$data);
		}
	}

	//流量分配
	public function channel()
	{
		$id = $this->input->get('id');
		$data['pos_id'] = $id;
		$channel = array();
		$where['where']['source.pos_id'] = $id;
		$channel = $this->channel_source->get_list_by_join($where);
		
		$ids = array();
		foreach($channel as $k => $v){
			$ids[] = $v['channel_id'];
		}
		$data['ids'] = $ids;

		//渠道列表
		$user_where['where']['types']='1';
		$user_where['where']['parent_id']='0';
		$channel_user = array();
		$channel_user = $this->user_channel->getList($user_where);
		$data['channel_user'] = $channel_user;

		$this->tpl('home/adsense_channel_tpl',$data);

	}

	public function save_source()
	{
		$pos_id = $this->input->post('pos_id');
		$channel_id = $this->input->post('channel_id');
		$_channel_id = explode(',', $channel_id);

		//先删除
		$del_config['pos_id'] = $pos_id;
		$this->channel_source->del($del_config);

		//重新添加
		for($i=0;$i<count($_channel_id);$i++){
			$add['channel_id'] = $_channel_id[$i];
			$add['pos_id'] = $pos_id;
			$this->channel_source->add($add);
		}

		//修改对列表
		$queue_where['where']['pos_id'] = $pos_id;
		$queue_id = array();
		$queue_list = $this->channel_source->getList($queue_where);
		foreach($queue_list as $k => $v){
			$queue_id[] = $v['channel_id'];
		}
		//修改队列
		$queue_where['where']['pos_id'] = $pos_id;
		$queue_info = $this->queue->get_one_by_where($queue_where);
		if(empty($queue_info)){

			$q_add['pos_id'] = $pos_id;
			$q_add['info'] = implode('|', $queue_id);
			$q_add['update_time'] = time();
			$this->queue->add($q_add);

		}else{

			$update_queue_config['pos_id'] = $pos_id;
			$update_queue_data['info'] = implode('|', $queue_id);
			$this->queue->update($update_queue_config,$update_queue_data);
		}

		$msg = array(
			'code'=>'0',
			'msg'=>'修改成功!'
			);
		echo json_encode($msg);
		exit;
	}



}

