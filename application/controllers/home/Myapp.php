<?php


class Myapp extends Zrjoboa
{
	



	public function __construct()
	{
		parent::__construct();
		$this->load->model('App_page_mdl','app_page');
		$this->load->model('App_nav_mdl','app_nav');

	}


	public function index()
	{

	}


	//图片管理
	public function ads()
	{
		$list = array();
		$list = $this->app_page->getList();

		$data['list'] = $list;

		$this->tpl('home/app_page_tpl',$data);
	}

	public function ads_update()
	{

		if(!empty($_POST)){

			$id = $this->input->post('id');
			$remark = $this->input->post('remark');
						//图片上传
			if(!empty($_FILES['userfile']['name'])){

	             $config['upload_path'] = FCPATH.'/uploads/app_page/';               
	             $config['allowed_types'] = '*';
	             $config['file_name']  =date("YmdHis");

	             $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('userfile')){

	                    $error = array('error' => $this->upload->display_errors());
	                    echo json_encode($error);

	                }else{

	                    $data = array('upload_data' => $this->upload->data());
	                    $add['filename'] = $data['upload_data']['orig_name'];
	                    $add['remark'] = $remark;
	                    $update_config['id'] = $id;
	                   	if($this->app_page->update($update_config,$add)){

	        				redirect('/home/myapp/ads');

	                   	}else{
	                   		exit('添加有误，请重试');
	                   	}

	                }
	        }else{
	        	exit('error');
	        }


		}else{

			$id = $this->input->get('id');
			$where['where'] = array('id'=>$id);
			$info = $this->app_page->get_one_by_where($where);
			$data['info'] = $info;

			$this->tpl('home/app_page_edit_tpl',$data);
		}

	}

		//图片管理
	public function mynav()
	{
		$list = array();
		$list = $this->app_nav->getList();

		$data['list'] = $list;

		$this->tpl('home/app_nav_tpl',$data);
	}	


	public function add_mynav()
	{

		if(!empty($_POST)){

			$rank = $this->input->post('rank');
			$title = $this->input->post('title');
			$url = $this->input->post('url');
						//图片上传
			if(!empty($_FILES['userfile']['name'])){

	             $config['upload_path'] = FCPATH.'/uploads/app_nav/';               
	             $config['allowed_types'] = '*';
	             $config['file_name']  =date("YmdHis");

	             $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('userfile')){

	                    $error = array('error' => $this->upload->display_errors());
	                    echo json_encode($error);

	                }else{

	                    $data = array('upload_data' => $this->upload->data());
	                    $add['icon'] = $data['upload_data']['orig_name'];
	            //         $add['rank'] = $rank;
	            //         $add['title'] = $title;
	            //         $add['url'] = $url;
	            //         $update_config['id'] = $id;
	            //        	if($this->app_nav->add($add)){

	        				// redirect('/home/myapp/mynav');

	            //        	}else{

	            //        		exit('添加有误，请重试');

	            //        	}

	                }
	        }else{
	        	exit('error');
	        }

	        if(!empty($_FILES['userfile2']['name'])){

	             $config2['upload_path'] = FCPATH.'/uploads/app_nav/';               
	             $config2['allowed_types'] = '*';
	             $config2['file_name']  = md5(date("YmdHis"));

	             $this->load->library('upload', $config2);
	             $this->upload->initialize($config2);
	            if ( ! $this->upload->do_upload('userfile2')){

	                    $error = array('error' => $this->upload->display_errors());
	                    echo json_encode($error);

	            }else{

	                $data2 = array('upload_data' => $this->upload->data());
	                $add['icon_active'] = $data2['upload_data']['orig_name'];


	            }
	        }else{

	        	exit('error');

	        }


	        $add['rank'] = $rank;
	        $add['title'] = $title;
	        $add['url'] = $url;
	        $update_config['id'] = $id;

	        if($this->app_nav->add($add)){

	        	redirect('/home/myapp/mynav');

	        }else{

	            exit('添加有误，请重试');

	        }

		}else{

			$this->tpl('home/app_mynav_add_tpl');
		}
	}

	public function mynav_edit()
	{

		if(!empty($_POST)){

			$rank = $this->input->post('rank');
			$title = $this->input->post('title');
			$url = $this->input->post('url');
			$id = $this->input->post('id');
						//图片上传
			if(!empty($_FILES['userfile']['name'])){

	             $config['upload_path'] = FCPATH.'/uploads/app_nav/';               
	             $config['allowed_types'] = '*';
	             $config['file_name']  =date("YmdHis");

	             $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('userfile')){

	                    $error = array('error' => $this->upload->display_errors());
	                    echo json_encode($error);

	                }else{

	                    $data = array('upload_data' => $this->upload->data());
	                    $add['icon'] = $data['upload_data']['orig_name'];


	            }
	        }

	       	
	       	if(!empty($_FILES['userfile2']['name'])){

	             $config2['upload_path'] = FCPATH.'/uploads/app_nav/';               
	             $config2['allowed_types'] = '*';
	             $config2['file_name']  = md5(date("YmdHis"));

	             $this->load->library('upload', $config2);
	             $this->upload->initialize($config2);
	            if ( ! $this->upload->do_upload('userfile2')){

	                    $error = array('error' => $this->upload->display_errors());
	                    echo json_encode($error);

	            }else{

	                $data2 = array('upload_data' => $this->upload->data());
	                $add['icon_active'] = $data2['upload_data']['orig_name'];


	            }
	        }

	        $add['rank'] = $rank;
	        $add['title'] = $title;
	        $add['url'] = $url;
	        $update_config['id'] = $id;
	        $this->app_nav->update($update_config,$add);

	        redirect('/home/myapp/mynav');

	                
		}else{

			$id = $this->input->get('id');
			$where['where'] = array('id'=>$id);
			$info = $this->app_nav->get_one_by_where($where);
			$data['info'] = $info;

			$this->tpl('home/app_mynav_edit_tpl',$data);

		}
	}

	public function mynav_del()
	{
		$id = $this->input->get('id');
		$config['id'] = $id;
		if($this->app_nav->del($config)){
			redirect('/home/myapp/mynav');
		}
	}


}