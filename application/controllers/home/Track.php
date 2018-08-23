<?php

class Track extends Zrjoboa
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
		$this->load->model('Logistics_mdl','logistics');
		$this->load->model('Logistics_qianshou_mdl','logistics_qianshou');
		$this->load->model('Common_mdl','common_mdl');
		$this->load->library('Smsapi','smsapi');
		$this->load->model('Track_mdl','track');
		$this->load->model('Trade_mdl','trade');

		
	}


	public function index()
	{
		$userinfo = $this->userinfo;

		$check_role = $this->userlib->check_role('search_business');

		$roleinfo = $this->userlib->check_hidden('');
	

		//来源add
		$ads_list = $this->ads->getList();
		$data['ads_list'] = $ads_list;
		
		$admin = array();
		$admin = $this->admin->getList();
		$data['admin'] = $admin;

		
		$this->tpl('home/track_tpl',$data);

		

	}

	//获取数据
	public function get_list_ajax()
	{
		$userinfo = $this->userinfo;
		//print_r($userinfo);

		$check_role = $this->userlib->check_role('search_business');

		$roleinfo = $this->userlib->check_hidden('');
		$rolelist =array();
		foreach ($roleinfo as $k => $v) {
			$rolelist[] = $v['role_tag'];
		}
		$data['rolelist'] = $rolelist;

		$type = isset($_GET['type']) ? $_GET['type'] : '';
        $show_time = $this->input->post('show_time');		
		$end_time = $this->input->post('end_time');
		$factor = $this->input->post('factor');		
		$ads_channel = $this->input->post('ads_channel');
		$realname = $this->input->post('realname');
		$status = isset($_POST['status']) ? $_POST['status'] : 'all';
		$phone = $this->input->post('phone');
		$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : 0;
		$s_type = isset($_POST['s_type']) ? $_POST['s_type'] : 0;

		$data['show_time'] = $show_time;
		$data['end_time'] = $end_time;
		$data['factor'] = $factor;
		$data['ads_channel'] = $ads_channel;
		$data['realname'] = $realname;
		$data['status'] = $status;
		$data['phone'] = $phone;
		$data['user_id'] = $user_id;
		$data['s_type'] = $s_type;
   

		$list = array();

        $where['where']['n.isdel'] = '0';
        $where['order'] = array('key'=>'n.id','value'=>'desc');
        $s_type = 1;
        //搜索条件
        if($s_type == '1'){
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
        }elseif($s_type == '2'){

	        if(!empty($show_time)){
	        	$s_time = strtotime($show_time);
	        	$where['where']['stan.open_time_int >'] = $s_time;
	        	$where_count['addtime >'] = $s_time;
	        	if (!empty($end_time)) {
	        		$e_time = strtotime($end_time);
	        		$where['where']['stan.open_time_int <'] = $e_time;
	        		$where_count['dabiao_time_int <'] = $e_time;
	        	}
	        }
        }elseif($s_type == '3'){

	        if(!empty($show_time)){
	        	$s_time = strtotime($show_time);
	        	$where['where']['stan.dabiao_time_int >'] = $s_time;
	        	$where_count['addtime >'] = $s_time;
	        	if (!empty($end_time)) {
	        		$e_time = strtotime($end_time);
	        		$where['where']['stan.dabiao_time_int <'] = $e_time;
	        		$where_count['dabiao_time_int <'] = $e_time;
	        	}
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
        	$where['like'] = array('key'=>'n.ad_name','value'=>$realname);

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
        $where['where']['n.merchant_id'] = '2';
        $where['where']['n.channel_id'] = $userinfo['channel_id'];  
     
		$list = $this->business->get_list_by_join($where);
		$phones = array();
		$realnames = array();
		foreach($list as $lk => $lv){
			//if(!empty($lv['phone'])){
				$phones[] = $lv['phone'];
				$realnames[] = $lv['ad_name'];
			//}

		}
		
		$list_tmp['phone'] = implode(',', $phones);
		$list_tmp['realname'] = implode(',', $realnames);
		$list_tmp['count'] = count($phones);
		
		$ret = array(
			'code'=>0,
			'msg'=>'ok',
			'data'=>$list_tmp,
			'total'=>count($phones)
			);

		responseData($ret);



	}


	//交易
	public function get_list_trade()
	{
		$jiange = $this->input->post('jiange');
		$start_l = $this->input->post('start_l');
		$end_l = $this->input->post('end_l');
		// $jiange = '3';
		// $start_l = '0';
		// $end_l = '10';
		if(!empty($jiange) && $jiange != 'all'){
			$now = time();
			$time = time();
			switch($jiange)
			{
				case '1':
					$time = $now-2592000;
					break;
				case '2':
					$time = $now-5184000;
					break;
				case '3':
					$time = $now-7776000;
					break;
				case '4':
					$time = $now-10368000;
					break;	
				default:
					$time = $now-2592000;
					break;
			}
			
			$sql = "select trade.*,logis.phone from ls_trade as trade left join ls_logistics as logis on(logis.dev_sn=trade.p_sn) where trade.trade_time < '".$time."' and trade.p_sn not in(
					select p_sn from ls_trade where trade_time > '".$time."' group by p_sn
				)  group by trade.p_sn limit ".$start_l.' , '.$end_l;

			$sql_total = "select logis.phone from ls_trade as trade left join ls_logistics as logis on(logis.dev_sn=trade.p_sn) where trade.trade_time < '".$time."' and trade.p_sn not in(
					select p_sn from ls_trade where trade_time > '".$time."' group by p_sn
				)  group by trade.p_sn";

			$query = $this->db->query($sql);
			$arr = $query->result_array();
			foreach($arr as $lk => $lv){
				if(!empty($lv['phone'])){
					$phones[] = $lv['phone'];
				}
				
			}

			$query_total = $this->db->query($sql_total);
			$arr_total = $query_total->result_array();
			
			$list_tmp['phone'] = implode(',', $phones);
			$list_tmp['count'] = count($phones);
			
			$ret = array(
				'code'=>0,
				'msg'=>'ok',
				'data'=>$list_tmp,
				'total'=>count($arr_total)
				);

			responseData($ret);



		}
	}

	//
	public function get_qianshou_ajax()
	{

		$userinfo = $this->userinfo;

		$types = $this->input->post('types');	
        $show_time = $this->input->post('show_time');		
		$end_time = $this->input->post('end_time');
		$start_q = $this->input->post('start_q');
		$end_q = $this->input->post('end_q');

		$data['show_time2'] = $show_time2;
		$data['end_time2'] = $end_time2;
   		
   		$where = array();
   		if(!empty($types)){
   			$where['where']['types'] = $types;
   		}

   		if(!empty($show_time)){
	        	$s_time = strtotime($show_time);
	        	$where['where']['addtime >='] = $s_time;
	        	if (!empty($end_time)) {
	        		$e_time = strtotime($end_time);
	        		$where['where']['addtime <='] = $e_time;
	        	}
	    }

	    $count = $this->logistics_qianshou->get_count($where['where']);
        $data['count'] = $count;

	    // $end_q = 10;
	    // $start_q = 0;
	    $where['page'] = true;
        $where['limit'] = $end_q;
        $where['offset'] = $start_q;

	    $list = array();
	    $list = $this->logistics_qianshou->getList($where);
	  
		foreach($list as $lk => $lv){
				$phones[] = $lv['phone'];
				$realnames[] = $lv['ad_name'];

		}
		
		$list_tmp['phone'] = implode(',', $phones);
		$list_tmp['realname'] = implode(',', $realnames);
		$list_tmp['count'] = count($phones);
		
		$ret = array(
			'code'=>0,
			'msg'=>'ok',
			'data'=>$list_tmp,
			'total'=>$count
			);

		responseData($ret);
	}



	//详情
	public function send_message()
	{

		$userinfo = $this->userinfo;
	
		$phone = $this->input->post('phone');
		$msg = $this->input->post('msg');
		$send_suc = 0;

    	if(!empty($phone)){
    		$data['phone'] = $phone;
    		$data['msg'] = $msg;
    		$ret = $this->smsapi->send_msg($data);
    		
    		if($ret['code'] == '0'){
		    		//记录短信
		    	$phone_arr = explode(',', $phone);		    		
		    	for($i=0;$i<count($phone_arr);$i++){
		    			
		    		$add['phone'] = $_s_phone[$i];
		    		$add['content'] = $msg;
		    		$add['addtime'] = time();
		    		$this->track->add($add);
		    		$send_suc++;
	    			
		    	}

		    	$msg = array(
			    	'code'=>'0',
			    	'msg'=>'发送完成，成功发送条数:'.$send_suc
			    );
	    					
		    
			}else{
				$msg = array(
			    	'code'=>'1',
			    	'msg'=>'发送失败，请重试'
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


	public function dataview()
	{
		$this->tpl('home/ads_dataview_tpl');
	}




}




