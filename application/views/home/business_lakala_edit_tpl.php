<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>详细信息</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <?php
        $this->load->view('widgets/main_source_tpl');
    ?>

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>详细信息</h5>
   
                    </div>
                    <div class="ibox-content">
                        <form method="get" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">真实姓名</label>

                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$info['p_name']?></p>
                                </div>
                            </div>
                           
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">手机号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$info['p_mobile']?></p>
                                </div>
                            </div>                            
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">机器CBC码</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$info['p_sn']?></p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">退款方式</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$info['p_pay']?></p>
                                </div>
                            </div>
                             <div class="hr-line-dashed"></div>
                             <div class="form-group">
                                <label class="col-sm-2 control-label">支付宝账号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php if(empty($info['p_zhifubao'])){ echo '无';}else{ echo $info['p_zhifubao'];} ?></p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                             <div class="form-group">
                                <label class="col-sm-2 control-label">银行</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php if(empty($info['p_bank'])){ echo '无';}else{ echo $info['p_bank'];} ?></p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">银行卡号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php if(empty($info['p_card'])){ echo '无';}else{ echo $info['p_card'];} ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">支付凭证</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><img src="http://app.1chuanqi.com/uploads/lkl/<?=$info['p_img']?>" width="100"/></p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">时间</label>

                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=date("Y-m-d H:i:s",$info['addtime'])?></p>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">审核状态</label>

                                <div class="col-sm-10">
                                    
                                        <select name="status" id="status" class="input-sm form-control input-s-sm inline" style="width: 200px; height: 35px;">
                                            <option value="0" <?php if($info['status'] == '0'){ ?> selected <?php } ?> >待审核</option>
                                            <option value="1" <?php if($info['status'] == '1'){ ?> selected <?php } ?>>审核通过</option>
                                            <option value="2" <?php if($info['status'] == '2'){ ?> selected <?php } ?>>审核不通过</option>
                                            <option value="3" <?php if($info['status'] == '3'){ ?> selected <?php } ?>>已退还</option>
                                        </select>
                                  
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">备注</label>

                                <div class="col-sm-10">
                                    <p class="form-control-static">
                                        <textarea name="remark" id="remark"><?=$info['remark']?></textarea>
                                    </p>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="col-sm-10" align="center">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="history.back()">返回</button>
                                        <button class="btn btn-sm btn-primary" type="button" id="submit">提交</button> 
                                        
                              </div>
                            </div>
 
        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php

        $this->load->view('widgets/main_footer_tpl');
    ?>

</body>
<script type="text/javascript">
      $('#submit').click(function()
    {
        var id = "<?=$info['id']?>";
        var status = $("#status").val();
        var remark = $("#remark").val();

        var aj = $.ajax( {
              url:'<?=base_url()?>home/business/edit_lakala',
              data:{
                  
                  id : id,
                  status : status,
                  remark : remark
                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
                
               if(data.code == 0){
                    alert(data.msg);
                    window.location.reload();
                    

               }else{
                
                    alert(data.msg);

               }

              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });
    })

</script>
</html>