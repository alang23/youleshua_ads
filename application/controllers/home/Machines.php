<?php

class Machines extends Zrjoboa
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Machines_mdl','machines');
		$this->load->library('My_excel','my_excel');

	}


	public function index()
	{
		$userinfo = $this->userinfo;

		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;  
        $cbc = isset($_GET['cbc']) ? $_GET['cbc'] : ''; 
        $types = isset($_GET['types']) ? $_GET['types'] : ''; 
        $data['cbc'] = $cbc;  
        $data['types'] = $types;    

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
         
        $countwhere = array();
        if(!empty($cbc)){
        	$countwhere = array('dev_sn'=>$cbc);
        	$where['where']['dev_sn'] = $cbc;
        }

        if(!empty($types)){
        	$countwhere = array('types'=>$types);
        	$where['where']['types'] = $types;
        }

        $count = $this->machines->get_count($countwhere);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/machines/index?cbc='.$cbc.'&types='.$types);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'id','value'=>'desc');



		$list = $this->machines->getList($where);	
		$data['list'] = $list;
		
		$this->tpl('home/machines_tpl',$data);
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

	public function imports()
	{
		$files = dirname().'uploads'.'/excel';
				if(!is_dir($files)){
					mkdir($files);					
				}
					
		if(!empty($_FILES['excel']['name'])){

            $config['upload_path'] = FCPATH.'/uploads/excel/';
            
            $config['allowed_types'] = '*';
            $config['file_name']  =date("YmdHis").'_machines';

            $types = $this->input->post('types');
            $agent_id = $this->input->post('agent_id',0);

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('excel')){

                $error = array('error' => $this->upload->display_errors());
                echo json_encode($error);

            }else{

                $data = array('upload_data' => $this->upload->data());
                $picname = $data['upload_data']['orig_name'];
                $dir = FCPATH.$files.'/'.$picname;
				//$result = $this->my_excel->imports($dir);
				$add_count = 0;
				$update_count = 0;

				require_once FCPATH.'/application/libraries/phpexcel/PHPExcel.php';

				if (!file_exists($dir)) {
				    die('no file!');
				}
				$extension = strtolower( pathinfo($dir, PATHINFO_EXTENSION) );

				if ($extension =='xlsx') {
				    $objReader = new PHPExcel_Reader_Excel2007();
				    $objExcel = $objReader ->load($dir);
				} else if ($extension =='xls') {
				    $objReader = new PHPExcel_Reader_Excel5();
				    $objExcel = $objReader ->load($dir);
				} else if ($extension=='csv') {
				    $PHPReader = new PHPExcel_Reader_CSV();

				    //默认输入字符集
				    $PHPReader->setInputEncoding('GBK');

				    //默认的分隔符
				    $PHPReader->setDelimiter(',');

				    //载入文件
				    $objExcel = $PHPReader->load($dir);
				}
				
				$sheet = $objExcel->getSheet(0); // 读取第一個工作表
				$highestRow = $sheet->getHighestRow(); // 取得总行数
				$colsNum = $sheet->getHighestColumn(); // 取得总列数
				$highestColumm= PHPExcel_Cell::columnIndexFromString($colsNum); //字母列转换为数字列 

				$arr = array();
				$tmp = array();
				$result = array();
				$add_count = 0;
				for ($row = 2; $row <= $highestRow; $row++){//行数是以第1行开始
				    for ($column = 0; $column < $highestColumm; $column++) {//列数是以第0列开始
				        $columnName = PHPExcel_Cell::stringFromColumnIndex($column);
				        $arr[$column] = $sheet->getCellByColumnAndRow($column, $row)->getValue();
				    }
					$add['m_mode'] = $arr[1];
					$add['dev_sn'] = $arr[6];
					$add['zd_no'] = $arr[7];
					$add['riqi_int'] = strtotime($arr[5]);
					$add['types'] = intval($types);
					$add['agent_id'] = $agent_id;
					$add['logis'] = $arr[12];
					$add['logis_no'] = $arr[11];
					if($this->machines->add($add)){
						$add_count +=1;
					}

				}
				
		        $msg['title'] = '成功导入:<font color="red">'.$add_count.'</font>条数据,更新：<font color="red">'.$update_count.'</font>条数据';
				$msg['msg'] = '<a href="'.base_url().'home/machines/index?">返回列表</a> ';
				$this->tpl('msg/msg_success',$msg);

		    }

		}else{    
			
			$this->tpl('/home/machines_excel_tpl');
		} 
	}


	public function huabo()
	{
		$files = dirname().'uploads'.'/excel';
				if(!is_dir($files)){
					mkdir($files);					
				}
					
		if(!empty($_FILES['excel']['name'])){

            $config['upload_path'] = FCPATH.'/uploads/excel/';
            
            $config['allowed_types'] = '*';
            $config['file_name']  =date("YmdHis").'_machines_huabo';

            $agent_id = $this->input->post('agent_id');

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('excel')){

                $error = array('error' => $this->upload->display_errors());
                echo json_encode($error);

            }else{

                $data = array('upload_data' => $this->upload->data());
                $picname = $data['upload_data']['orig_name'];
                $dir = FCPATH.$files.'/'.$picname;
				$result = $this->my_excel->imports($dir);

				$add_count = 0;
				$update_count = 0;

				for($i=1; $i < count($result) ; $i++){
					// $add['m_mode'] = $result[$i][1];
					// $add['dev_sn'] = $result[$i][6];
					// $add['riqi_int'] = strtotime($result[$i][5]);
					// $add['types'] = intval($types);

					$update_config['dev_sn'] = $result[$i][1];
					$update_data['agent_id'] = $agent_id;

					if($this->machines->update($update_config,$update_data)){
						$update_count++;
					}
				}

				
		        $msg['title'] = '划拨机器:<font color="red">'.$update_count.'</font>台';
				$msg['msg'] = '<a href="'.base_url().'home/machines/index?">返回列表</a> ';
				$this->tpl('msg/msg_success',$msg);

		    }

		}else{    
			
			$this->tpl('/home/machines_huabo_tpl');
		} 
	}

	public function search_machines()
	{
		$this->tpl('home/search_machines_tpl');
	}

	//电销查询机器
	public function s_machines()
	{
		$dev_sn = $this->input->post('dev_sn');
		$where['where']['dev_sn'] = $dev_sn;
		$info = $this->machines->get_one_by_where($where);

		if(empty($info)){
			$data = "<font color='red'>无相关机器信息!</font>";
		}else{
			$data .="<h4><font color='red'>型号:</font>  ".$info['m_mode']."</h4>";
            $data .="<p><font color='red'>设备号:</font>  ".$info['dev_sn']."</p>";
            $data .="<p><font color='red'>ZD号:</font>  ".$info['zd_no']."</p>";
            $data .='<p><font color="red">时间:</font>  '.date("Y-m-d",$info['riqi_int']).'</p>';  
            $data .='<p class="text-center">'.machines_type($info['types']).'</p>';   
            if(!empty($info['agent_id'])){
           	 $data .='<p class="text-center">已划拨:<font color="red">'.machines_agent($info['agent_id']).'</font></p>';
            }             
            
		}

		$msg = array(
					'code'=>0,
					'msg'=>'ok',
					'data'=>$data
			);

		responseData($msg);

	}

	//检查是否经济存在
	public function check_cbc($cbc){
		$where['where']['dev_sn'] = $cbc;
		$info = $this->machines->get_one_by_where($where);
		if(!empty($info)){

			return true;

		}else{

			return false;
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

