<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>物流详细信息</title>
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
                        <h5>物流详细信息</h5>
   
                    </div>
                    <div class="ibox-content">
                        <form method="get" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">状态</label>

                                <div class="col-sm-10">
                                <select class="input-sm form-control input-s-sm inline" name="flw_status" id="flw_status">
                                    <option value="0">未跟进</option>
                                    <option value="1" <?php if($info['status'] == '1'){?> selected <?php } ?>>未接通</option>
                                    <option value="2" <?php if($info['status'] == '2'){?> selected <?php } ?>>需求待定</option>
                                    <option value="3" <?php if($info['status'] == '3'){?> selected <?php } ?>>确认邮寄</option>
                                    <option value="4" <?php if($info['status'] == '4'){?> selected <?php } ?>>已寄出</option>
                                    <option value="5" <?php if($info['status'] == '5'){?> selected <?php } ?>>已签收</option>
                                    <option value="6" <?php if($info['status'] == '6'){?> selected <?php } ?>>已拒收</option>
                                    <option value="7" <?php if($info['status'] == '7'){?> selected <?php } ?>>已激活</option>
                                    <option value="8" <?php if($info['status'] == '8'){?> selected <?php } ?>>已达标</option>
                                     <option value="9" <?php if($info['status'] == '9'){?> selected <?php } ?>>不需要</option>

                                     <option value="10" <?php if($info['status'] == '10'){?> selected <?php } ?>>提交</option>
                                     <option value="11" <?php if($info['status'] == '11'){?> selected <?php } ?>>派送中</option>
                                     <option value="12" <?php if($info['status'] == '12'){?> selected <?php } ?>>问题件</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">备注</label>

                                <div class="col-sm-10">
                                    <p class="form-control-static"><input type="text" id="remark" name="remark" value="<?=$info['remark']?>" class="input-sm form-control input-s-sm inline" /></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">真实姓名</label>

                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$info['realname']?></p>
                                </div>
                            </div>
                           
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">电话</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$info['phone']?></p>
                                </div>
                            </div>                            
                            <div class="hr-line-dashed"></div>
                             <div class="form-group">
                                <label class="col-sm-2 control-label">地址</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$info['address']?></p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">订单号</label>

                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$info['order_id']?></p>
                                    <input type="hidden" name="order_id" value="<?=$info['order_id']?>" id="order_id" />
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">申请时间</label>

                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=date("Y-m-d H:i:s",$info['addtime'])?></p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>

                                <div class="col-sm-10">
                                    <input type="button" value="保存" onclick="save_info();" />
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

<script>

function save_info()
{
    var flw_status = $("#flw_status").val();
    var order_id = $("#order_id").val();
    var remark = $("#remark").val();

      var aj = $.ajax( {
              url:'<?=base_url()?>home/logistics/change_express',
              data:{               

                  status : flw_status,
                  order_id : order_id,
                  remark : remark

              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
                //alert(data.msg);
                if(data.code == '0'){

                    location.reload();

                }else{

                    alert(data.msg);

                }              
              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });
}
</script>

</body>

</html>