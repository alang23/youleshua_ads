<?php

class Business extends Zrjoboa
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Account_mdl','admin');
		$this->load->model('Business_mdl','business');
		$this->load->model('Ads_mdl','ads');
		$this->load->model('Record_mdl','record');
		$this->load->library('My_excel','my_excel');
		$this->load->model('Deal_mdl','deal');
		
	}


	public function index()
	{
		$userinfo = $this->userinfo;
		
		$check_role = $this->userlib->check_role('search_business');
		//var_dump($check_role);

		$type = isset($_GET['type']) ? $_GET['type'] : '';
		$data['type'] = $type;
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $show_time = $this->input->get('show_time');		
		$end_time = $this->input->get('end_time');
		$factor = $this->input->get('factor');		
		$ads_channel = $this->input->get('ads_channel');
		$realname = $this->input->get('realname');
		$status = isset($_GET['status']) ? $_GET['status'] : 'all';
		$phone = $this->input->get('phone');
		$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 0;

		$data['show_time'] = $show_time;
		$data['end_time'] = $end_time;
		$data['factor'] = $factor;
		$data['ads_channel'] = $ads_channel;
		$data['realname'] = $realname;
		$data['status'] = $status;
		$data['phone'] = $phone;
		$data['user_id'] = $user_id;

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
        

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['where']['n.isdel'] = '0';
        $where['order'] = array('key'=>'n.id','value'=>'desc');

        //搜索条件
        if(!empty($show_time)){
        	$s_time = strtotime($show_time);
        	$where['where']['n.addtime >'] = $s_time;
        	$where_count['addtime >'] = $s_time;
        	if (!empty($end_time)) {
        		$e_time = strtotime($end_time);
        		$where['where']['n.addtime <'] = $e_time;
        		$where_count['addtime <'] = $e_time;
        	}
        }

        if(!empty($factor)){
        	if ($factor == '1') {
        		$where['where']['n.factor'] = '1';
        		$where_count['factor'] = '1';

        	}elseif ($factor == '2') {
	        	$where['where']['n.factor'] = '0';
	        	$where_count['factor'] = '0';
        	}
        }

        if(!empty($ads_channel)){
        	$where['where']['n.frm'] = $ads_channel;
        	$where_count['frm'] = $ads_channel;
        }


        if(!empty($realname)){
        	$where['like'] = array('key'=>'n.realname','value'=>$realname);
        	$where['or_like'] = array('key'=>'n.ad_name','value'=>$realname);

        	$where_count['realname'] = $realname;
        }

        if($status != 'all'){
        	$where['where']['n.status'] = $status;
        	$where_count['status'] = $status;

        }

        if(!empty($phone)){
        	$where['where']['n.phone'] = $phone;
        	$where_count['phone'] = $phone;

        }

        if(!empty($user_id)){
        	$where['where']['n.user_id'] = $user_id;
        	$where_count['user_id'] = $user_id;

        }
        $where['where']['n.channel_id'] = $userinfo['channel_id'];
		$where_count['channel_id'] = $userinfo['channel_id'];

        $where_count['isdel'] = '0';      
        $count = $this->business->get_count($where_count);
        //print_r($where);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/business/index?show_time='.$show_time.'&end_time='.$end_time.'&factor='.$factor.'&ads_channel='.$ads_channel.'&realname='.$realname.'&status='.$status.'&user_id='.$user_id);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = $this->business->get_list_by_join($where);
	//	echo $this->db->last_query($list);	
		$data['list'] = $list;

		//来源add
		$ads_list = $this->ads->getList();
		$data['ads_list'] = $ads_list;
     //   echo date('Y-m-d H:i:s','1501064609');
		//
		$admin = array();
		$admin = $this->admin->getList();
		$data['admin'] = $admin;

		$this->tpl('home/business_tpl',$data);
	}

	//电销跟进 申请列表
	public function flw_index()
	{
		$userinfo = $this->userinfo;
		//print_r($userinfo);

		$type = isset($_GET['type']) ? $_GET['type'] : '';
		$data['type'] = $type;
		//var_dump($type);
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $show_time = $this->input->get('show_time');		
		$end_time = $this->input->get('end_time');
		$factor = $this->input->get('factor');		
		$phone = $this->input->get('phone');
		$realname = $this->input->get('realname');
		$status = isset($_GET['status']) ? $_GET['status'] : 'all';

		$data['show_time'] = $show_time;
		$data['end_time'] = $end_time;
		$data['factor'] = $factor;
		$data['phone'] = $phone;
		$data['realname'] = $realname;
		$data['status'] = $status;

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
        
		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['where']['n.isdel'] = '0';
        $where['order'] = array('key'=>'n.id','value'=>'desc');

        //搜索条件
        if(!empty($show_time)){
        	$s_time = strtotime($show_time);
        	$where['where']['n.addtime >'] = $s_time;
        	$where_count['addtime >'] = $s_time;
        	if (!empty($end_time)) {
        		$e_time = strtotime($end_time);
        		$where['where']['n.addtime <'] = $e_time;
        		$where_count['addtime <'] = $e_time;
        	}
        }

        if($status != 'all'){
        	$where['where']['n.status'] = $status;
        	$where_count['status'] = $status;

        }

        if(!empty($factor)){
        	if ($factor == '1') {
        		$where['where']['n.factor'] = '1';
        		$where_count['factor'] = '1';

        	}elseif ($factor == '2') {
	        	$where['where']['n.factor'] = '0';
	        	$where_count['factor'] = '0';
        	}
        }

        if(!empty($phone)){
        	$where['where']['n.phone'] = $phone;
        	$where_count['phone'] = $phone;
        }


        if(!empty($realname)){
        	$where['like'] = array('key'=>'n.realname','value'=>$realname);
        	$where['or_like'] = array('key'=>'n.ad_name','value'=>$realname);

        	$where_count['realname'] = $realname;
        }

        $where['where']['n.user_id'] = $userinfo['id'];
        $where_count['user_id'] = $userinfo['id'];
        $where['where']['n.channel_id'] = $userinfo['channel_id'];
		$where_count['channel_id'] = $userinfo['channel_id'];

        $where_count['isdel'] = '0';  
        //print_r($where_count);

        $count = $this->business->get_count($where_count);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/business/flw_index?show_time='.$show_time.'&end_time='.$end_time.'&factor='.$factor.'&phone='.$phone.'&realname='.$realname.'&status='.$status);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);
        //print_r($where);

		$list = $this->business->get_list_by_join($where);
	//	echo $this->db->last_query($list);	
		$data['list'] = $list;

		//来源
		$ads_list = $this->ads->getList();
		$data['ads_list'] = $ads_list;
     //   echo date('Y-m-d H:i:s','1501064609');

		$this->tpl('home/business_flw_tpl',$data);
	}

	//资料补全
	public function after_index()
	{
		$userinfo = $this->userinfo;
		//print_r($userinfo);

		$type = isset($_GET['type']) ? $_GET['type'] : '';
		$data['type'] = $type;
		//var_dump($type);
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $show_time = $this->input->get('show_time');		
		$end_time = $this->input->get('end_time');
		$factor = $this->input->get('factor');		
		$phone = $this->input->get('phone');
		$realname = $this->input->get('realname');

		$data['show_time'] = $show_time;
		$data['end_time'] = $end_time;
		$data['factor'] = $factor;
		$data['phone'] = $phone;
		$data['realname'] = $realname;

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
        
		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['where'] = array('isdel'=>'0');
        $where['where'] = array('after_pay'=>'1');
        $where['order'] = array('key'=>'id','value'=>'desc');

        //搜索条件
        if(!empty($show_time)){
        	$s_time = strtotime($show_time);
        	$where['where']['addtime >'] = $s_time;
        	$where_count['addtime >'] = $s_time;
        	if (!empty($end_time)) {
        		$e_time = strtotime($end_time);
        		$where['where']['addtime <'] = $e_time;
        		$where_count['addtime <'] = $e_time;
        	}
        }

        if(!empty($factor)){
        	if ($factor == '1') {
        		$where['where']['factor'] = '1';
        		$where_count['factor'] = '1';

        	}elseif ($factor == '2') {
	        	$where['where']['factor'] = '0';
	        	$where_count['factor'] = '0';
        	}
        }

        if(!empty($phone)){
        	$where['where']['phone'] = $phone;
        	$where_count['phone'] = $phone;
        }


        if(!empty($realname)){
        	$where['like'] = array('key'=>'realname','value'=>$realname);
        	$where_count['realname'] = $realname;
        }

        $where_count['isdel'] = '0';   
        $where_count['after_pay'] = '1';     
        $count = $this->business->get_count($where_count);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/business/after_index?show_time='.$show_time.'&end_time='.$end_time.'&phone='.$phone.'&realname='.$realname);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = $this->business->getList($where);
	//	echo $this->db->last_query($list);	
		$data['list'] = $list;

		//来源
		$ads_list = $this->ads->getList();
		$data['ads_list'] = $ads_list;
     //   echo date('Y-m-d H:i:s','1501064609');

		$this->tpl('home/business_after_tpl',$data);
	}

	//详情
	public function detail()
	{

		$id = $this->input->get('id');
		$type = $this->input->get('type');
		$where['where'] = array('id'=>$id);
		$info = $this->business->get_one_by_where($where);

		$data['info'] = $info;
		$data['type'] = $type;

		$this->tpl('home/business_detail_tpl',$data);

	}


	public function add()
	{
		if(!empty($_POST)){

			$add['ad_name'] = $this->input->post('ad_name');
			$add['url'] = $this->input->post('url');
			$add['ad_type'] = $this->input->post('ad_type');
			$add['pos_id'] = $this->input->post('pos_id');
			$add['intro'] = $this->input->post('intro');
			$add['addtime'] = time();
			if($this->ads->add($add)){
				redirect('/home/ads/index');
			}
		}else{

			$this->tpl('home/ads_add_tpl');
		}
	}

	public function del()
	{
		$id = $this->input->get('id');
		$config = array('id'=>$id);
		$update_data['isdel'] = 1;
		if($this->business->update($config,$update_data)){
			redirect('/home/business/index');
		}
	}

	public function edit()
	{
		if(!empty($_POST)){
			$ad_name = $this->input->post('ad_name');
			$realname = $this->input->post('realname');
			$phone = $this->input->post('phone');
			$card_no = $this->input->post('card_no');
			$access = $this->input->post('access');
			$street = $this->input->post('street');
			$factor = $this->input->post('factor');
			$addtime = $this->input->post('addtime');
			$a_time = strtotime($addtime);
			//$status = $this->input->post('status');
			$id = $this->input->get('id');

			$update['ad_name']     = $ad_name;
			$update['realname']    = $realname;
			$update['phone']       = $phone;
			$update['card_no']     = $card_no;
			$update['access']      = $access;
			$update['street']      = $street;
			$update['factor']      = $factor;
			$update['addtime']     = $a_time;
			//$update['status']      = $status;

			$update_config = array('id'=>$id);

			if($this->business->update($update_config,$update)){
					$msg['title'] = '修改成功';
					$msg['msg'] = '<a href="'.base_url().'home/business/index?">返回列表</a> ';
					$this->tpl('msg/msg_success',$msg);				
			}else{
				$msg['title'] = '修改失败';
				$msg['msg'] = '<a href="'.base_url().'home/business/index?">返回列表</a>';
				$this->tpl('msg/msg_errors',$msg);

			}
		}else{
			$id = $this->input->get('id');
			$where['where'] = array('id'=>$id);
			$info = $this->business->get_one_by_where($where);
			$data['info'] = $info;
			$this->tpl('home/business_edit_tpl',$data);
		}
	}

	//跟进记录的添加
	public function add_record(){

		$userinfo = $this->userinfo;
		$data['userinfo'] = $userinfo;
		
		if(!empty($_POST)){

			$sever_id = $this->input->post('sever_id');
			//$re_type = $this->input->post('re_type');
			$intro = $this->input->post('intro');
			$flw_status = $this->input->post('flw_status');
			$addtime = $this->input->post('addtime');
			$a_time = strtotime($addtime);
			$id = $this->input->post('id');

			$add['re_type'] = 0;
			$add['sever_id'] = $sever_id;
			$add['intro'] = $intro;
			
			$add['uid'] = $id;
			$add['flw_status'] = $flw_status;
			$add['addtime'] = $a_time;
			$update['status'] = $flw_status;
			$update_config = array('id'=>$id);

		
			if($this->record->add($add)){
				$this->business->update($update_config,$update);
				$msg = array(
				'code'=>'0',
				'msg'=>'添加成功'
				);
			
			}else{

				$msg = array(
				'code'=>'1',
				'msg'=>'添加失败'
				);
			
			}
			echo json_encode($msg);
			
		}else{

			$id = $this->input->get('id');
			$where['where'] = array('uid'=>$id);
			$where['order'] = array('key'=>'id','value'=>'DESC');
			$list = $this->record->get_list_join_customer($where);
			$data['id'] = $id;
			$data['list'] = $list;

			$info = array();
			$info_where['where'] = array('id'=>$id);
			$info = $this->business->get_one_by_where($info_where);
			$data['info'] = $info;

			
			//客服
			// $where['where'] = array('role'=>'3');
			// $u_list = $this->admin->getList($where);
			// $data['list'] = $list;
			// $data['u_list'] = $u_list;
			// $data['id'] = $id;

			$this->tpl('home/business_add_record_tpl',$data);
		}

	}

	//修改跟进记录
	public function edit_record()
	{	

		if(!empty($_POST)){
			$re_type = $this->input->post('re_type');
			$intro = $this->input->post('intro');
			$sever_id = $this->input->post('sever_id');
			// $msg_type = $this->input->post('msg_type');
			// $is_msg = $this->input->post('is_msg');
			$addtime = $this->input->post('addtime');
			$a_time = strtotime($addtime);
			$uid = $this->input->post('uid');

			$update['re_type']  = $re_type;
			$update['intro']    = $intro;
			// $update['msg_type'] = $msg_type;
			// $update['is_msg']   = $is_msg;
			$update['addtime']  = $a_time;
			$update['sever_id']  = $sever_id;

			$update_config = array('id'=>$uid);

			if($this->record->update($update_config,$update)){
				$msg = array(
				'code'=>'0',
				'msg'=>'修改成功'
				);
			
			}else{

				$msg = array(
				'code'=>'1',
				'msg'=>'修改失败'
				);
			}	
			echo json_encode($msg);
			
			
		}else{
			$id = $this->input->get('id');
			$where['where'] = array('id'=>$id);
			$info = $this->record->get_one_by_where($where);

			//客服
			$where['where'] = array('role'=>'3');
			$u_list = $this->admin->getList($where);
			$data['u_list'] = $u_list;

			$data['info'] = $info;
			$this->tpl('home/business_record_edit_tpl',$data);
		}
	}

	//删除记录
	public function del_record()
	{
		$id = $this->input->get('id');
		$del_config = array('id'=>$id);
		// $update['record'] = 0;
		// $update_config = array('id'=>$id);
		if($this->record->del($del_config)){
			//$this->business->update($update_config,$update);
			// $msg['title'] = '删除成功';
			// $msg['msg'] = '<a href="'.base_url().'home/business/add_record?">返回列表</a> ';
			// 		$this->tpl('msg/msg_success',$msg);	
			echo '<script type="text/javascript"> history.back();</script >';			
			}else{
				$msg['title'] = '删除失败';
				$msg['msg'] = '<a href="'.base_url().'home/business/add_record?">返回列表</a> ';
					$this->tpl('msg/msg_errors',$msg);		
		}
	}

	public function dataview()
	{
		$this->tpl('home/ads_dataview_tpl');
	}

	public function export()
	{
		$userinfo = $this->userinfo;
		$list = array();
		$show_time = $this->input->get('show_time');		
		$end_time = $this->input->get('end_time');
		$factor = $this->input->get('factor');		
		$ads_channel = $this->input->get('ads_channel');
		$realname = $this->input->get('realname');
		$status = $this->input->get('status');


		$data['show_time'] = $show_time;
		$data['end_time'] = $end_time;
		$data['factor'] = $factor;
		$data['ads_channel'] = $ads_channel;
		$data['realname'] = $realname;
		
		$where['where'] = array('isdel'=>'0');
        $where['order'] = array('key'=>'id','value'=>'desc');
		 //搜索条件
        if(!empty($show_time)){
        	$s_time = strtotime($show_time);
        	$where['where']['addtime >'] = $s_time;
        	if (!empty($end_time)) {
        		$e_time = strtotime($end_time);
        		$where['where']['addtime <'] = $e_time;
        	}
        }

        if(!empty($factor)){
        	if ($factor == '1') {
        		$where['where']['factor'] = '1';

        	}elseif ($factor == '2') {
	        	$where['where']['factor'] = '0';
        	}
        }

        if($status != 'all'){
        	$where['where']['status'] = $status;

        }

        if(!empty($ads_channel)){
        	$where['where']['frm'] = $ads_channel;
        }
		     
		if(!empty($realname)){
        	$where['like'] = array('key'=>'realname','value'=>$realname);
        	$where['or_like'] = array('key'=>'ad_name','value'=>$realname);
        }

        $where['where']['channel_id'] = $userinfo['channel_id'];
        //$where['where']['factor'] = '1';
		$list = $this->business->getList($where);

		// print_r($_POST);
		// echo $this->db->last_query($list);
		// exit();
		$export = array();	
		foreach($list as $k => $v)
		{
			$_tmp['id'] = $v['id'];
			$_tmp['ad_name'] = $v['ad_name'];
			$_tmp['realname'] = $v['realname'];
			$_tmp['phone'] = $v['phone'];
			$_tmp['card_no'] = $v['card_no'];
			$_tmp['access'] = $v['access'];
			$_tmp['address'] = $v['address'];
			$_tmp['street'] = $v['street'];
			$_tmp['frm'] = $v['frm'];
			$_tmp['addtime'] = $v['addtime'];
			$_tmp['factor'] = $v['factor'];
			$export[] = $_tmp;
		}

		$title = '申请列表-'.date("Ymd").'.xls';
		$this->my_excel->export_business($export,$title);
	}

	//客服导出
	public function export_customer()
	{
		$userinfo = $this->userinfo;
		$list = array();
		$show_time = $this->input->get('show_time');		
		$end_time = $this->input->get('end_time');
		$factor = $this->input->get('factor');		
		$ads_channel = $this->input->get('ads_channel');
		$realname = $this->input->get('realname');
		$status = $this->input->get('status');

		$data['show_time'] = $show_time;
		$data['end_time'] = $end_time;
		$data['factor'] = $factor;
		$data['ads_channel'] = $ads_channel;
		$data['realname'] = $realname;
		
		$where['where']['isdel'] = '0';
        $where['order'] = array('key'=>'id','value'=>'desc');
		 //搜索条件
        if(!empty($show_time)){
        	$s_time = strtotime($show_time);
        	$where['where']['addtime >'] = $s_time;
        	if (!empty($end_time)) {
        		$e_time = strtotime($end_time);
        		$where['where']['addtime <'] = $e_time;
        	}
        }

        if(!empty($factor)){
        	if ($factor == '1') {
        		$where['where']['factor'] = '1';

        	}elseif ($factor == '2') {
	        	$where['where']['factor'] = '0';
        	}
        }

        if($status != 'all'){
        	$where['where']['status'] = $status;

        }

        if(!empty($ads_channel)){
        	$where['where']['frm'] = $ads_channel;
        }
		     
		if(!empty($realname)){
        	$where['like'] = array('key'=>'realname','value'=>$realname);
        	$where['or_like'] = array('key'=>'ad_name','value'=>$realname);        
        }
        //$where['where']['factor'] = '1';
        $where['where']['channel_id'] = $userinfo['channel_id'];
        $where['where']['user_id'] = $userinfo['id'];
		$list = $this->business->getList($where);

		// print_r($_POST);
		// echo $this->db->last_query($list);
		// exit();
		$export = array();	
		foreach($list as $k => $v)
		{
			$_tmp['id'] = $v['id'];
			$_tmp['ad_name'] = $v['ad_name'];
			$_tmp['realname'] = $v['realname'];
			$_tmp['phone'] = $v['phone'];
			// $_tmp['card_no'] = $v['card_no'];
			// $_tmp['access'] = $v['access'];
			$_tmp['address'] = $v['address'];
			$_tmp['street'] = $v['street'];
			// $_tmp['frm'] = $v['frm'];
			$_tmp['addtime'] = $v['addtime'];
			$_tmp['factor'] = $v['factor'];
			$export[] = $_tmp;
		}

		$title = '申请列表-'.date("Ymd").'.xls';
		$this->my_excel->export_customer($export,$title);
	}


	public function lakala(){

		$userinfo = $this->userinfo;

		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
		$p_name = $this->input->get('p_name');
		$p_mobile = $this->input->get('p_mobile');
		$p_sn = $this->input->get('p_sn');
		$status = $this->input->get('status');

		$data['p_mobile'] = $p_mobile;
		$data['p_sn'] = $p_sn;
		$data['p_name'] = $p_name;
		$data['status'] = $status;

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
        
		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'id','value'=>'desc');



        $where_count = array();
        if(!empty($p_name)){
        	$where['like'] = array('key'=>'p_name','value'=>$p_name);
        	$where_count = array('p_name'=>$p_name);
        }

        if(!empty($p_mobile)){
        	$where['like'] = array('key'=>'p_mobile','value'=>$p_mobile);
        	$where_count = array('p_mobile'=>$o_mobile);
        }

        if(!empty($p_sn)){
        	$where['like'] = array('key'=>'p_sn','value'=>$p_sn);
        	$where_count = array('p_sn'=>$p_sn);
        }

        if(is_numeric($status)){
	        $where['where']['status'] = $status;
	        $where_count['status'] = $status;
        }

        

        // if($status != 'all'){
        // 	// $where['where']['status'] = $status;
        // 	// $where_count['status'] = $status;
        // 	unset($where['where']['status']);
        // 	unset($where_count['status']);
        // }
       	// var_dump($where);
        $count = $this->deal->get_count($where_count);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/business/lakala?show_time='.$show_time.'&end_time='.$end_time.'&realname='.$realname.'&status='.$status);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = $this->deal->getList($where);
		$data['list'] = $list;


		$this->tpl('home/business_lakala_tpl',$data);
	}

	public function edit_lakala(){

		$uid = $this->input->post('id');
		$status = $this->input->post('status');
		if(!empty($_POST)){
			$update_config = array('id'=>$uid);
			$update_data['status'] = $status;
			if($this->deal->update($update_config,$update_data)){
				$msg = array(
						'code'=>'0',
						'msg' => '执行成功'						
					);
			}else{
				$msg = array(
						'code'=>'1',
						'msg'=>'执行失败'
					);
			}
			echo json_encode($msg);
		}else{
			$id = isset($_GET['id']) ? $_GET['id'] : '';
			$where['where']['id'] = $id;
			$info = $this->deal->get_one_by_where($where);

			$data['info'] = $info;
			$this->tpl('home/business_lakala_edit_tpl',$data);
		}
	}

	public function del_lakala()
	{
		$id = $this->input->get('id');

		$config = array('id'=>$id);
		if($this->deal->del($config)){
			redirect('home/business/lakala');
		}
	}




}




