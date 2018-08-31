<?php
class User extends Zrjoboa
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Account_mdl','admin');
		$this->load->model('Role_mdl','role');
		$this->load->model('Record_mdl','record');
		$this->load->model('Business_mdl','business');

		$this->load->library('My_excel','my_excel');
		
	}

	public function index()
	{
		$userinfo = $this->userinfo;
		//$check_role = $this->userlib->check_role('user_list');

		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $show_time = isset($_GET['show_time']) ? $_GET['show_time'] : '';
        $end_time = isset($_GET['end_time']) ? $_GET['end_time'] : '';
        $realname = isset($_GET['realname']) ? $_GET['realname'] : '';
        $phone = isset($_GET['phone']) ? $_GET['phone'] : '';

        $data['show_time'] = $show_time;
        $data['end_time'] = $end_time;
        $data['realname'] = $realname;
        $data['phone'] = $phone;

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';

        if(!empty($show_time)){
        	$s_time = strtotime($show_time);
        	$where['where']['addtime >'] = $s_time;
        	$countwhere['addtime >'] = $s_time;

	        if(!empty($end_time)){
	        	$e_time = strtotime($end_time);
	        	$where['where']['addtime <'] = $e_time;
	        	$countwhere['addtime <'] = $e_time;
	        }

        }

        if(!empty($realname)){
        	$where['like'] = array('key'=>'realname','value'=>$realname); 
        	$countwhere['realname'] = $realname; 
        }

        if(!empty($phone)){
        	$where['where']['phone'] = $phone;
        	$countwhere['phone'] = $phone;
        }
                
        $count = $this->admin->get_count($countwhere);
        $data['count'] = $count;
       // print_r($countwhere);

        $pageconfig['base_url'] = base_url('/home/role/index?');
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'id','value'=>'desc');


		$list = $this->admin->getList($where);	
		$data['list'] = $list;

		$role_name = array();
		$_role = array();
		$role_name = $this->role->getList();
		foreach($role_name as $rlk => $rlv){
			$_role[$rlv['id']] = $rlv['role_name'];
		}
		$data['role'] = $_role;
		
		$this->tpl('home/user_tpl',$data);
	}


	public function add(){

		$check_role = $this->userlib->check_role('user_add');

		$username = $this->input->post('username');
		$realname = $this->input->post('realname');
		$gender = $this->input->post('gender');
		$phone = $this->input->post('phone');
		$password = $this->input->post('password');
		$remark = $this->input->post('remark');
		$role_id = $this->input->post('role_id');
		

		if(!empty($phone) && !empty($gender)){
			$add['username'] = $username;
			$add['realname'] = $realname;
			$add['gender'] = $gender;
			$add['phone'] = $phone;
			$add['pawd'] = md5($password);
			$add['remark'] = $remark;
			$add['role'] = $role_id;
			$add['addtime'] = time();
			$add['channel_id'] = '10003';
			//var_dump($add);
			//echo $this->db->last_query($this->admin->add($add));
			if($this->admin->add($add)){
				$msg['title'] = '添加成功';
				$msg['msg'] = '<a href="'.base_url().'home/user/index?">返回列表</a> ';
					$this->tpl('msg/msg_success',$msg);	
			}else{
				$msg['title'] = '添加失败';
				$msg['msg'] = '<a href="'.base_url().'home/user/index?">返回列表</a> ';
					$this->tpl('msg/msg_errors',$msg);
			}
		}else{

			$list_role = $this->role->getList();
			$data['list_role'] = $list_role;
			$this->tpl('home/user_add_tpl',$data);
		}

	}

	public function edit()
	{
		if(!empty($_POST)){
			$username = $this->input->post('username');
			$realname = $this->input->post('realname');
			$gender = $this->input->post('gender');
			$phone = $this->input->post('phone');
			$password = $this->input->post('password');
			$remark = $this->input->post('remark');
			$role_id = $this->input->post('role_id');
			$id = $this->input->get('id');
			$count_num = $this->input->post('count_num');

			$update['username'] = $username;
			$update['realname'] = $realname;
			$update['gender'] = $gender;
			$update['phone'] = $phone;
			$update['count_num'] = $count_num;
			if(!empty($password)){
				$update['pawd'] = md5($password);
			}
			$update['remark'] = $remark;
			$update['role'] = $role_id;

			$update_config = array('id'=>$id);

			if($this->admin->update($update_config,$update)){
					$msg['title'] = '修改成功';
					$msg['msg'] = '<a href="'.base_url().'home/user/index?">返回列表</a> ';
					$this->tpl('msg/msg_success',$msg);				
			}else{
				$msg['title'] = '修改失败';
				$msg['msg'] = '<a href="'.base_url().'home/user/index?">返回列表</a>';
				$this->tpl('msg/msg_errors',$msg);

			}
		}else{
			$id = $this->input->get('id');
			$where['where'] = array('id'=>$id);
			$info = $this->admin->get_one_by_where($where);
			$data['info'] = $info;

			$list_role = $this->role->getList();
			$data['list_role'] = $list_role;

			$this->tpl('home/user_edit_tpl',$data);
		}
	}

	public function del()
	{
		$id = $this->input->get('id');
		$del_config = array('id'=>$id);
		if($this->admin->del($del_config)){
			$msg['title'] = '删除成功';
			$msg['msg'] = '<a href="'.base_url().'home/user/index?">返回列表</a> ';
					$this->tpl('msg/msg_success',$msg);				
			}else{
				$msg['title'] = '删除失败';
				$msg['msg'] = '<a href="'.base_url().'home/user/index?">返回列表</a> ';
					$this->tpl('msg/msg_errors',$msg);		
		}
	}

	public function open()
	{
		$userinfo = $this->userinfo;

		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$update_config = array('id'=>$id);
		$update_data['enabled'] = '1';
		if($this->admin->update($update_config,$update_data)){
			//改变计数
			$update_count_config['channel_id'] = $userinfo['channel_id'];
			$update_count_num['count_num'] = '1';
			$this->admin->update($update_count_config,$update_count_num);
			
			$msg['title'] = '开启成功';
			$msg['msg'] = '<a href="'.base_url().'home/user/index?">返回列表</a> ';
					$this->tpl('msg/msg_success',$msg);				
			}else{
				$msg['title'] = '开启失败';
				$msg['msg'] = '<a href="'.base_url().'home/user/index?">返回列表</a> ';
					$this->tpl('msg/msg_errors',$msg);		
		}
	}

	public function close()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$update_config = array('id'=>$id);
		$update_data['enabled'] = '0';
		if($this->admin->update($update_config,$update_data)){
			$msg['title'] = '关闭成功';
			$msg['msg'] = '<a href="'.base_url().'home/user/index?">返回列表</a> ';
					$this->tpl('msg/msg_success',$msg);				
			}else{
				$msg['title'] = '关闭失败';
				$msg['msg'] = '<a href="'.base_url().'home/user/index?">返回列表</a> ';
				$this->tpl('msg/msg_errors',$msg);		
		}
	}
	

	public function tongji()
	{
		
		$user_id = $this->input->post('user_id');
		//$user_id = 16;
		//总资源
		$total = 0;
		$total_where['user_id'] = $user_id;
		$total = $this->business->get_count($total_where);

		//未跟进
		$wgj = 0;
		$wgj_where['user_id'] = $user_id;
		$wgj_where['status'] = 0;
		$wgj = $this->business->get_count($wgj_where);

		//确认邮寄
		$youji = 0;
		$youji_where['user_id'] = $user_id;
		$youji_where['status'] = 3;
		$youji = $this->business->get_count($youji_where);

		//签收
		$jianshou = 0;
		$jianshou_where['user_id'] = $user_id;
		$jianshou_where['status'] = 5;
		$jianshou = $this->business->get_count($jianshou_where);

		$dabiao = 0;
		$dabiao_where['user_id'] = $user_id;
		$dabiao_where['status'] = 8;
		$dabiao = $this->business->get_count($dabiao_where);

		echo '总资源:'.$total.'   ,未跟进:'.$wgj.'   ,确认邮寄:'.($youji+$jianshou).'   ,已签收:'.($jianshou+$dabiao).'  ,达标:'.$jianshou;
		exit;


	}
}
