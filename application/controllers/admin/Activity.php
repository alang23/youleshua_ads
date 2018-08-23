<?php


class Activity extends Zrjoboa
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Activity_mdl','activity');
		$this->load->model('Trade_mdl','trade');
		$this->load->model('Lottery_mdl','lottery');
		$this->load->model('quan_mdl','quan');
	}


	public function index()
	{

		$userinfo = $this->userinfo;
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
                
        $count = $this->activity->get_count();
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/admin/activity/index?');
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;

        $where['order'] = array('key'=>'rank','value'=>'ASC');
		$list = $this->activity->getList($where);	
		$data['list'] = $list;

		$this->tpl('admin/activity_tpl',$data);
	}

	//添加
	public function add()
	{
		if(!empty($_POST)){
			$add['name'] = $this->input->post('name');
			$add['rank'] = $this->input->post('rank');
			$add['passin'] = intval($this->input->post('passin'));
			$add['num'] = $this->input->post('num');
			$add['num_s'] = $this->input->post('num_s');
			$add['price'] = $this->input->post('price');
			$add['rounds'] = $this->input->post('rounds');
			$add['month'] = $this->input->post('month');
			$add['enabled'] = intval($this->input->post('enabled'));
			$start_time = $this->input->post('start_time');
			$end_time = $this->input->post('end_time');
			$add['start_time'] = strtotime($start_time);
			$add['end_time'] = strtotime($end_time);

			//奖券logo
			if(!empty($_FILES['quanlogo']['name'])){

	             $config['upload_path'] = FCPATH.'/uploads/quanlogo/';               
	             $config['allowed_types'] = '*';
	             $config['file_name']  =date("YmdHis").'_logo';

	             $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('quanlogo')){

	                    $error = array('error' => $this->upload->display_errors());
	                    echo json_encode($error);

	            }else{

	                $data = array('upload_data' => $this->upload->data());
	                $add['quan_logo'] = $data['upload_data']['orig_name'];
	            }
	        }


			//图片上传
			if(!empty($_FILES['icon']['name'])){

	             $config['upload_path'] = FCPATH.'/uploads/activity/';               
	             $config['allowed_types'] = '*';
	             $config['file_name']  =date("YmdHis");

	             $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('icon')){

	                    $error = array('error' => $this->upload->display_errors());
	                    echo json_encode($error);

	                }else{

	                    $data = array('upload_data' => $this->upload->data());
	                    $add['pic'] = $data['upload_data']['orig_name'];
	                    if(!empty($add['name'])){
							if($this->activity->add($add)){
								redirect('/admin/activity');
							}else{
								exit('err');
							}
						}else{
							exit('活动名称不能为空');
						}

	                }

	        }else{
	           exit('请上传图片');
	        }	


		}else{
			$this->tpl('admin/activity_add_tpl');
		}

	}

		//添加
	public function edit()
	{
		if(!empty($_POST)){

			$add['name'] = $this->input->post('name');
			$add['rank'] = $this->input->post('rank');
			$add['passin'] = intval($this->input->post('passin'));
			$add['num'] = $this->input->post('num');
			$add['num_s'] = $this->input->post('num_s');
			$add['price'] = $this->input->post('price');
			$add['rounds'] = $this->input->post('rounds');
			$add['month'] = $this->input->post('month');
			$add['enabled'] = intval($this->input->post('enabled'));
			$start_time = $this->input->post('start_time');
			$end_time = $this->input->post('end_time');
			$add['start_time'] = strtotime($start_time);
			$add['end_time'] = strtotime($end_time);

			$id = $this->input->post('id');

			//奖券logo
			if(!empty($_FILES['quanlogo']['name'])){

	             $config['upload_path'] = FCPATH.'/uploads/quanlogo/';               
	             $config['allowed_types'] = '*';
	             $config['file_name']  =date("YmdHis").'_logo';

	             $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('quanlogo')){

	                    $error = array('error' => $this->upload->display_errors());
	                    echo json_encode($error);

	            }else{

	                $data = array('upload_data' => $this->upload->data());
	                $add['quan_logo'] = $data['upload_data']['orig_name'];
	            }
	        }


			if(!empty($_FILES['icon']['name'])){

	             $config['upload_path'] = FCPATH.'/uploads/activity/';               
	             $config['allowed_types'] = '*';
	             $config['file_name']  =date("YmdHis");

	             $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('icon')){

	                    $error = array('error' => $this->upload->display_errors());
	                    echo json_encode($error);

	                }else{

	                    $data = array('upload_data' => $this->upload->data());
	                    $add['pic'] = $data['upload_data']['orig_name'];	                    

	                }
	        }

			if(!empty($add['name']) && !empty($id)){
				$update_config = array('id'=>$id);

				if($this->activity->update($update_config,$add)){
					redirect('/admin/activity/index');
				}else{
					exit('err');
				}
				
			}else{
				exit('empty');
			}
		}else{

			$id = $this->input->get('id');
			$config['where'] = array('id'=>$id);
			$info = $this->activity->get_one_by_where($config);
			$data['info'] = $info;

			$this->tpl('admin/activity_edit_tpl',$data);
		}

	}

	public function del()
	{
		$id = $this->input->get('id');

		$config = array('id'=>$id);
		if($this->activity->del($config)){
			redirect('/admin/activity/index');
		}
	}

	public function delall()
	{
		$id = $this->input->post('id');
		$where = array('key'=>'id','value'=>$id);
		$this->activity->del(array(),$where);
		redirect('/admin/activity/index');
	}

	//生成奖券
	public function lottery()
	{
		$id = $this->input->get('id');
		$a_where['where'] = array('id'=>$id);

		//活动基本信息
		$activity = array();
		$activity = $this->activity->get_one_by_where($a_where);
		$a_price = $activity['price'];

		$where['where'] = array('act_id'=>$id);
		$orders = array();
		$orders = $this->trade->getList($where);
		$num = 0;
		foreach($orders as $k => $v){
			$price = $v['price'];
			//奖票数量
			$lottery_num = $price/$a_price;
			for($i=0;$i<$lottery_num;$i++){
				$add['order_no'] = $v['order_no'];
				$add['act_id'] = $v['act_id'];
				$add['phone'] = $v['phone'];
				$add['pro_name'] = $v['pro_name'];
				$add['addtime'] = time();
				$add['lottery_no'] = $v['id'].'_'.$i;
				$add['rounds'] = $activity['rounds'];
				$add['realname'] = $v['realname'];
				if($this->lottery->add($add)){
					$jid = $this->lottery->insert_id();
					$num++;
				}
				$jiang[$i] = $jid;
			}

			$update_config = array('id'=>$v['act_id']);
			$update_data['do_ticket'] = 1;
			$this->activity->update($update_config,$update_data);

			
		}
					//出奖
		/*
		$jnum = count($jiang);
		$_num = mt_rand(0,($jnum-1));
		$j_id = $jiang[$_num];
		$j_config = array('id'=>$j_id);
		$j_update_data['winning'] = 1;
		$this->lottery->update($j_config,$j_update_data);
		*/
		echo '成功生成:'.$num.'张奖券';
	}

	//奖券
	public function quan()
	{
		$id = $this->input->get('id');
		//用户订单
		$where['where'] = array('t.act_id'=>$id);
		$list = array();
		$list = $this->trade->get_list_by_join($where);
		
		$q = array();
		$q_num = 0;
		if(count($list) > 0){
			foreach($list as $k => $v){
				$total = $v['price'];
				$num = round($v['price']/2);
				for($i=0;$i<$num;$i++){
					$_q['pro_name'] = $v['pro_name']; 
					if($i == 0){
						$_q['order_no'] = $v['order_no'];
					}else{
						$_q['order_no'] = $v['order_no'].'-'.$i;
					}
					$_q['realname'] = $v['realname'];
					$_q['phone'] = $v['phone'];
					
					$_q['rounds'] = $v['rounds'];
					$_q['addtime'] = time();
					$_q['act_id'] = $v['act_id'];
					
					$this->quan->add($_q);
					$q_num++;
				}
			}
			$update_config = array('id'=>$id);
			$update_data['do_quan'] = 1;
			$this->activity->update($update_config,$update_data);
		}

		//print_r($q);
		echo '生成优惠券:'.$q_num.'张';

	}




}