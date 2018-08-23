<?php


class Lklagent extends BaseController
{
	


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Deal_agent_mdl','deal_agent');
		$this->load->model('User_channel_mdl','user_channel');
		$this->load->model('Logistics_agent_mdl','logistics_agent');
		

	}

	public function index()
	{

		if(!empty($_POST)){

			$add=array(
				'p_name'  => $_POST['p_name'],//真实姓名
				'p_mobile'=>$_POST['p_mobile'],//手机号
				'p_sn'   =>$_POST['p_sn'],//机器CBC码
				'p_pay'  =>$_POST['p_pay'],//支付方式
				'p_zhifubao' =>$_POST['p_zhifubao'],//支付宝
				'p_bank'=>$_POST['p_bank'],//银行
				'p_card'=>$_POST['p_card'],//银行卡号
				'p_img'=>$_POST['p_img'],//交易凭证截图
				'channel_id' => $_POST['channel_id'],
				'user_id'=>$_POST['user_id'],

				);

			$add['addtime'] = time();

			$where['where'] = array('p_sn'=>$_POST['p_sn']);
			$info = $this->deal_agent->get_one_by_where($where);

			$logis_where['where'] = array('dev_sn'=>$add['p_sn'],'phone'=>$add['p_mobile']);
			$logis_info = $this->logistics_agent->get_one_by_where($logis_where);
			if(empty($logis_info)){
					$msg = array(
						'code'=>'1',
						'msg'=>'您提交的机器信息不一致'
						);
				echo json_encode($msg);
				exit;
			}

			if(!empty($info)){

				//审核不通过
				if($info['status'] == '2'){
					$update_config['id'] = $info['id'];
					unset($add['p_sn']);
					$add['status'] = 0;
					if($this->deal_agent->update($update_config,$add)){

						$msg = array(
						'code'=>'0',
						'msg'=>'提交成功'
						);

					}else{
						$msg = array(
						'code'=>'6',
						'msg'=>'提交失败，请重试'
						);
					}

					echo json_encode($msg);
					exit;

				}else{

					$msg = array(
						'code'=>'2',
						'msg'=>'您已经提交过，无需重复提交'
						);
					echo json_encode($msg);
					exit;

				}

			}else{

				if($this->deal_agent->add($add)){
					$msg = array(
						'code'=>'0',
						'msg'=>'提交成功'
						);
				}else{
					$msg = array(
						'code'=>'1',
						'msg'=>'提交失败，请重试'
						);
				}

				echo json_encode($msg);
				exit;
			}



		}else{

			$channel_id = $this->input->get('channel_id');
			$data['channel_id'] = $channel_id;

			$channel_where['where']['channel_id'] = $channel_id;
			$channel_where['where']['parent_id'] = '0';
			$channel_info = $this->user_channel->get_one_by_where($channel_where);
			
			$user_id = intval($channel_info['id']);
			$data['user_id'] = $user_id;
			//

			$this->tpl('lkl_agent_tpl',$data);

		}

	}

	public function uploadfile()
	{

		if(!empty($_FILES['image_file']['name'])){

             $config['upload_path'] = FCPATH.'/uploads/lkl/';
                
             $config['allowed_types'] = '*';
             $config['file_name']  =date("YmdHis");

             $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('image_file')){

                    $msg = array('errcode'=>'1','errmsg' => $this->upload->display_errors());
                   

                }else{

                	$data = array('upload_data' => $this->upload->data());
                    $picname = $data['upload_data']['orig_name'];
                	$msg = array(
                		'errcode'=>'0',
                		'errmsg'=>'OK',
                		'url'=>$picname
                		);

                }

            }else{
            	   $msg = array(
                		'errcode'=>'2',
                		'errmsg'=>'nofile'
                		);
            }

        echo json_encode($msg);

	}



}