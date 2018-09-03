<?php


class Role extends Zrjoboa
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Account_mdl','account');
		$this->load->model('Role_mdl','role');
		$this->load->model('Role_tag_mdl','role_tag');
		$this->load->model('Role_author_mdl','role_author');
		$this->load->library('My_excel','my_excel');

		
	}

	public function index()
	{
		$userinfo = $this->userinfo;
		$check_role = $this->userlib->check_role('role_list');

		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $role_name = isset($_GET['role_name']) ? $_GET['role_name'] : '';
        $data['role_name'] = $role_name;

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
                
        $count = $this->role->get_count($countwhere);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/role/index?');
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'id','value'=>'desc');

        if(!empty($role_name)){
        	$where['where']['role_name'] = $role_name;
        	$countwhere['role_name'] = $role_name;
        }

		$list = $this->role->getList($where);	
		$data['list'] = $list;
		$this->tpl('home/role_tpl',$data);
	}


	public function add(){

		$check_role = $this->userlib->check_role('user_add');

		$role_name = $this->input->post('role_name');
		$role_list_one = $this->input->post('tag_name_one');
		$role_list_two = $this->input->post('tag_name_two');


		if(!empty($_POST)){
			
			$role_add['role_name'] = $role_name;
			$this->role->add($role_add);
			$role_id = $this->role->insert_id();
			
			if(!empty($role_list_one)){

				$len = count($role_list_one);
				for($i=0;$i<$len;$i++){
					$_tag = explode('-', $role_list_one[$i]);
					
					$add['role_id'] = $role_id;
					$add['role_name'] = $_tag[1];
					$add['role_tag'] = $_tag[0];
					$add['Level'] = '1';
					if(!$this->role_author->add($add))
					{
						exit('error');
					}
				}
				
			}
		
			if(!empty($role_list_two)){

				for($i=0;$i<count($role_list_two);$i++){
					$_tag = explode('-', $role_list_two[$i]);
					$add['role_id'] = $role_id;
					$add['role_name'] = $_tag[1];
					$add['role_tag'] = $_tag[0];
					$add['Level'] = '2';
					if(!$this->role_author->add($add))
					{
						exit('error');
					}
				}
			}

			header("Location:".base_url()."/home/role/index?");
	
		}else{

			//一级权限
			$where['where']['Level'] = '1';
			$list_role_one = $this->role_tag->getList($where);

			//二级权限
			$list_role_two = array();
			$where_two['where']['Level'] = '2';
			$where_two['order'] = array('key'=>'id','value'=>'ASC');
			$_list_role_two = $this->role_tag->getList($where_two);
			foreach($_list_role_two as $llrk => $llrv){
				$list_role_two[$llrv['parent_id']][] = $llrv;
			}

			$data['list_role_one'] = $list_role_one;
			$data['list_role_two'] = $list_role_two;

			$this->tpl('home/role_add_tpl',$data);
		}

	}

	public function edit()
	{
		$id = $this->input->get('id');

		if(!empty($_POST)){

			$id = $this->input->post('id');
			$role_name = $this->input->post('role_name');
			$list_tag_name_one = $this->input->post('list_tag_name_one');
			$list_tag_name_two = $this->input->post('list_tag_name_two');

			$update_config = array('id'=>$id);
			$update_data = array('role_name'=>$role_name);
			$this->role->update($update_config,$update_data);


			if(!empty($role_name) && !empty($list_tag_name_one)){		

				$del_config_one['role_id'] = $id;	
				$del_config_one['Level'] = '1';			
				$list_del = $this->role_author->del($del_config_one);

				for($i=0;$i<count($list_tag_name_one);$i++){
					$_tag = explode('-', $list_tag_name_one[$i]);
					$add['role_id'] = $id;
					$add['role_name'] = $_tag[1];
					$add['role_tag'] = $_tag[0];
					$add['Level'] = '1';
					$this->role_author->add($add);
				}				
			}


			if(!empty($role_name) && !empty($list_tag_name_two)){						

				$del_config_two['role_id'] = $id;	
				$del_config_two['Level'] = '2';		
				$this->role_author->del($del_config_two);
				$info = $this->role->get_one_by_where($where);
				$role_id = $info['id'];

				for($i=0;$i<count($list_tag_name_two);$i++){
					$_tag = explode('-', $list_tag_name_two[$i]);
					$add['role_id'] = $id;
					$add['role_name'] = $_tag[1];
					$add['role_tag'] = $_tag[0];
					$add['Level'] = '2';	
					$this->role_author->add($add);
				}				
			}
			header("Location:".base_url()."/home/role/index?");

		}else{

			$id = $this->input->get('id');
			$where['where'] = array('a.role_id'=>$id);
			$info = $this->role->get_list_by_join($where);

			//var_dump($info);
			$_temp = array();
			foreach ($info as $k => $v) {
				$role_name = $v['role_name'];
				$_temp[] = $v['role_tag'];
			}
			$data['_temp'] = $_temp;
			$data['role_name'] = $role_name;
			$data['info'] = $info;
			$data['id'] = $id;

			//一级权限
			$list_role_one = array();
			$where_one['where']['Level'] = '1';
			$where_two['order'] = array('key'=>'id','value'=>'ASC');
			$list_role_one = $this->role_tag->getList($where_one);

			//二级权限
			$list_role_two = array();
			$where_two['where']['Level'] = '2';
			$where_two['order'] = array('key'=>'id','value'=>'ASC');
			$_list_role_two = $this->role_tag->getList($where_two);
			foreach($_list_role_two as $llrk => $llrv){
				$list_role_two[$llrv['parent_id']][] = $llrv;
			}
			
			$data['list_role_one'] = $list_role_one;
			$data['list_role_two'] = $list_role_two;


			$this->tpl('home/role_edit_tpl',$data);

		}
	}

	public function del()
	{
		$id = $this->input->get('id');
		$del_config = array('id'=>$id);
		$del_config2 = array('role_id'=>$id);
		if($this->role->del($del_config)){
			$this->role_author->del($del_config2);
			$msg['title'] = '删除成功';
			$msg['msg'] = '<a href="'.base_url().'home/role/index?">返回列表</a> ';
					$this->tpl('msg/msg_success',$msg);				
			}else{
				$msg['title'] = '删除失败';
				$msg['msg'] = '<a href="'.base_url().'home/role/index?">返回列表</a> ';
					$this->tpl('msg/msg_errors',$msg);		
		}
	}


}
