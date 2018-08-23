<?php

class Brand extends Zrjoboa
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Brand_mdl','brand');
	}


	public function index()
	{
		$userinfo = $this->userinfo;

		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
                
        $count = $this->brand->get_count();
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/brand/index?');
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'id','value'=>'desc');
		$list = $this->brand->getList($where);	
		$data['list'] = $list;
		$this->tpl('home/brand_tpl',$data);

	}


	public function add()
	{
		if(!empty($_POST)){

			$add['b_name'] = $this->input->post('b_name');
			$add['intro'] = $this->input->post('intro');
			$add['b_no'] = $this->input->post('b_no');
			
			if($this->brand->add($add)){

				redirect('/home/brand/index');

			}

			
		}else{

			$this->tpl('home/brand_add_tpl');
		}
	}

	public function del()
	{
		$id = $this->input->get('id');
		$config['id'] = $id;
		if($this->brand->del($config)){
			redirect('/home/brand/index');
		}
	}


	public function update()
	{
		if(!empty($_POST)){

			$id = $this->input->post('id');

			$add['b_name'] = $this->input->post('b_name');
			$add['b_no'] = $this->input->post('b_no');
			$add['intro'] = $this->input->post('intro');

			$update_config = array('id'=>$id);

			$this->brand->update($update_config,$add);

			redirect('/home/brand/index');
			
		}else{

			$id = $this->input->get('id');
			$where['where'] = array('id'=>$id);
			$info = $this->brand->get_one_by_where($where);
			$data['info'] = $info;

			$this->tpl('home/brand_update_tpl',$data);
		}
	}



}

