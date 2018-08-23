<?php
/**
*流量池
*
*/
class Adpond extends Zrjoboa
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Adpond_mdl','adpond');
		$this->load->model('Ads_mdl','ads');
	}


	public function index()
	{
		$userinfo = $this->userinfo;

		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
                
        $count = $this->adpond->get_count();
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/adpond/index?');
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'id','value'=>'desc');
		$list = $this->adpond->getList($where);	
		$data['list'] = $list;

		$this->tpl('home/adpond_tpl',$data);
	}


	public function add()
	{
		if(!empty($_POST)){

			$add['title'] = $this->input->post('title');
			$add['status'] = $this->input->post('status');
			$add['remark'] = $this->input->post('remark');
			$add['p_no'] = $this->input->post('p_no');
			$add['addtime'] = time();

			$ids = $this->input->post('ids');

			if($this->adpond->add($add)){

				//添加池子信息
				
				redirect('/home/adpond/index');
			}

		}else{

			//广告
			$ads = array();
			$ads = $this->ads->getList();
			$data['ads'] = $ads;

			$this->tpl('home/adpond_add_tpl',$data);
		}
	}

	public function del()
	{
		$id = $this->input->get('id');
		$config['id'] = $id;
		if($this->adpond->del($config)){
			redirect('/home/adpond/index');
		}
	}


	public function update()
	{
		if(!empty($_POST)){

			$add['title'] = $this->input->post('title');
			$add['status'] = $this->input->post('status');
			$add['remark'] = $this->input->post('remark');
			$add['p_no'] = $this->input->post('p_no');
			$id = $this->input->post('id');
			$update_config = array('id'=>$id);
			$this->adpond->update($update_config,$add);
			redirect('/home/adpond/index');
			
		}else{

			$id = $this->input->get('id');
			$where['where'] = array('id'=>$id);
			$info = $this->adpond->get_one_by_where($where);
			$data['info'] = $info;

						//广告
			$ads = array();
			$ads = $this->ads->getList();
			$data['ads'] = $ads;

			$this->tpl('home/adpond_update_tpl',$data);
		}
	}



}

