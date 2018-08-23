<?php

class Ads extends Zrjoboa
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Ads_mdl','ads');
		$this->load->model('Brand_mdl','brand');
		$this->load->model('Adsense_mdl','adsense');
		$this->load->model('Statistics_mdl','statistics');
		$this->load->model('Adpond_mdl','adpond');
		$this->load->model('Business_mdl','business');
	}


	public function index()
	{
		$userinfo = $this->userinfo;

		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;        
		$ad_name = isset($_GET['ad_name']) ? $_GET['ad_name'] : '';
		$data['ad_name'] = $ad_name;

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
                
        $count = $this->ads->get_count($countwhere);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/ads/index?ad_name='.$ad_name);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'id','value'=>'desc');

        if(!empty($ad_name)){
        	$where['like'] = array('key'=>'ad_name','value'=>$ad_name);
        }

		$list = $this->ads->getList($where);	
		$data['list'] = $list;



		$this->tpl('home/ads_tpl',$data);
	}

	//当日详情
	public function ads_date()
	{

		$userinfo = $this->userinfo;
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;        
		$ad_name = isset($_GET['ad_name']) ? $_GET['ad_name'] : '';
		$date = isset($_GET['date']) ? $_GET['date'] : '';
		$aid = isset($_GET['aid']) ? $_GET['aid'] : 0;
		$data['aid'] = $aid;
		$data['ad_name'] = $ad_name;



        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';


       	if(empty($date)){
	        $date = date("Y-m-d");
	    }

        $where['where']['l.dates'] = $date;
                
        $count = $this->statistics->get_count_by_join($where);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/ads/ads_date?ad_name='.$ad_name);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'id','value'=>'desc');



		$list = $this->statistics->get_list_by_join($where);	
		$data['list'] = $list;

		$this->tpl('home/ads_date_tpl',$data);

	}

		//当日详情
	public function ads_date_view()
	{

		$userinfo = $this->userinfo;
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;        
		$date = isset($_GET['date']) ? $_GET['date'] : '';
		$ad_name = $this->input->get('ad_name');
		$data['ad_name'] = $ad_name;
		$aid = isset($_GET['aid']) ? $_GET['aid'] : 0;
		$data['aid'] = $aid;


        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';

       	if(!empty($date)){
	         $where['where']['l.dates'] = $date;  
	    }

	    $where['where']['l.aid'] = $aid;  
                   
        $count = $this->statistics->get_count_by_join($where);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/ads/ads_date_view?aid='.$aid.'&date='.$date);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'id','value'=>'desc');



		$list = $this->statistics->get_list_by_join($where);	
		$data['list'] = $list;

		$this->tpl('home/ads_date_view_tpl',$data);
	}


	public function add()
	{
		if(!empty($_POST)){

			$add['ad_name'] = $this->input->post('ad_name');
			$add['url'] = $this->input->post('url');
			$add['ad_type'] = $this->input->post('ad_type');
			$add['pos_id'] = $this->input->post('pos_id');
			$add['b_no'] = $this->input->post('b_no');
			$add['intro'] = $this->input->post('intro');
			$add['addtime'] = time();
			if($this->ads->add($add)){
				redirect('/home/ads/index');
			}
		}else{

			//广告位
			$ad_pos = array();
			$ad_pos = $this->adsense->getList();
			$data['ad_pos'] = $ad_pos;

			$_brand = array();
			$_brand = $this->brand->getList();
			$data['brand'] = $_brand;

			$this->tpl('home/ads_add_tpl',$data);

		}
	}

	public function update()
	{
		if(!empty($_POST)){

			$add['ad_name'] = $this->input->post('ad_name');
			$add['url'] = $this->input->post('url');
			$add['ad_type'] = $this->input->post('ad_type');
			$add['pos_id'] = $this->input->post('pos_id');
			$add['b_no'] = $this->input->post('b_no');
			$add['intro'] = $this->input->post('intro');
			$id = $this->input->post('id');
			$add['pv_base'] = $this->input->post('pv_base');
			$add['uv_base'] = $this->input->post('uv_base');
			$add['reg_base'] = $this->input->post('reg_base');
			$config['id'] = $id;

			if($this->ads->update($config,$add)){

				redirect('/home/ads/index');

			}

		}else{

			$id = $this->input->get('id');
			//广告位
			$ad_pos = array();
			$ad_pos = $this->adsense->getList();
			$data['ad_pos'] = $ad_pos;

			$_brand = array();
			$_brand = $this->brand->getList();
			$data['brand'] = $_brand;

			$info = array();
			$config['where'] = array('id'=>$id);
			$info = $this->ads->get_one_by_where($config);
			$data['info'] = $info;

			$this->tpl('home/ads_update_tpl',$data);

		}
	}

	public function status_change()
	{
		$id = $this->input->get('id');
		$status = $this->input->get('status');

		$update_config['id'] = $id;
		$update_data['status'] = $status;

		if($this->ads->update($update_config,$update_data)){
			redirect('home/ads/index');
		}
	}



	public function dataview()
	{

		$aid = $this->input->get('id');
		$where['where'] = array('aid'=>$aid);
		$list = $this->statistics->getList($where);
		$data['list'] = $list;

		//统计
		//ads
		$ad_where['where'] = array('id'=>$aid);
		$ad_info = $this->ads->get_one_by_where($ad_where);
		$data['ad_info'] = $ad_info;


		$zhuce = 0;
		$zhuce_where['frm'] = $aid;
		//$zhuce_where['status'] = 3;
		$zhuce = $this->business->get_count($zhuce_where);
		$data['zhuce'] = $zhuce;
		//确认邮寄
		$youji = 0;
		$youji_where['frm'] = $aid;
		$youji_where['status'] = 3;
		$youji = $this->business->get_count($youji_where);
		$data['youji'] = $youji;


		//签收
		$jianshou = 0;
		$jianshou_where['frm'] = $aid;
		$jianshou_where['status'] = 5;
		$jianshou = $this->business->get_count($jianshou_where);
		$data['jianshou'] = $jianshou;

		$dabiao = 0;
		$dabiao_where['frm'] = $aid;
		$dabiao_where['status'] = 8;
		$dabiao = $this->business->get_count($dabiao_where);
		$data['dabiao'] = $dabiao;
	
		$this->tpl('home/ads_dataview_tpl',$data);
	}

	public function dlist()
	{
		$id = $this->input->get('id');
		$list = array();
		$where['where']['aid'] = $id;

		$ad_where['where']['id'] = $id;
		$ad_info = $this->ads->get_one_by_where($ad_where);

		$userinfo = $this->userinfo;

		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;        

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
        $countwhere['aid'] = $id;
                
        $count = $this->statistics->get_count($countwhere);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/ads/dlist?id='.$id);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'id','value'=>'desc');
        $where['where']['aid'] = $id;
		$list = $this->statistics->getList($where);	
		//$data['list'] = $list;

		foreach($list as $kk => $vv){
			$tmp['id'] = $vv['id'];
			$tmp['dates'] = $vv['dates'];
			$tmp['total'] = $vv['total'];
			$tmp['addtime'] = $vv['addtime'];
			$tmp['total'] = $vv['total'];
			$tmp['aid'] = $vv['aid'];
			$tmp['uv_total'] = $vv['uv_total'];
			$tmp['reg_total'] = $vv['reg_total'];

			if($vv['dates'] > '2017-11-29'){
				if(!empty($ad_info['pv_base'])){
					$tmp['total'] = ceil($vv['total']*($ad_info['pv_base']));
				}

				if(!empty($ad_info['uv_base'])){
					$tmp['uv_total'] = ceil($vv['uv_total']*($ad_info['uv_base']));
				}

				if(!empty($ad_info['reg_base'])){
					$tmp['reg_total'] = ceil($vv['reg_total']*($ad_info['reg_base']));
				}
				
			}

			$_tmp[] = $tmp;
		}
		$data['list'] = $_tmp;

		$this->tpl('home/dlist_tpl',$data);
	}


	public function d_update()
	{
		if(!empty($_POST)){

			$id = $this->input->post('id');
			$aid = $this->input->post('aid');

			$update_config['id'] = $id;
			$update_data['total'] = $this->input->post('total');
			$update_data['uv_total'] = $this->input->post('uv_total');
			$update_data['reg_total'] = $this->input->post('reg_total');
			if($this->statistics->update($update_config,$update_data)){
				redirect('home/ads/dlist?id='.$aid);
			}
			redirect('home/ads/dlist?id='.$aid);
		}else{

			$id = $this->input->get('id');
			$where['where']['id'] = $id;
			$info = $this->statistics->get_one_by_where($where);
			$data['info'] = $info;

			$this->tpl('home/d_update_tpl',$data);
		}

	}


	public function del()
	{
		$id = $this->input->get('id');
		$config['id'] = $id;
		if($this->ads->del($config)){
			redirect('/home/ads/index');
		}
	}


}

