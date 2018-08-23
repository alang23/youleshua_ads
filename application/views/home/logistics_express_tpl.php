 <!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>申请列表</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <?php
        $this->load->view('widgets/main_source_tpl');
    ?>

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
                               <div class="form-group">
                                <label class="col-sm-3 control-label">跟进状态:</label>
                                <div class="col-sm-8">
                                <select class="input-sm form-control input-s-sm inline" name="status" id="status">
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
                                <input type="hidden" name="order_id" id="order_id" value="<?=$info['order_id']?>" />
                                <input type="button" value="提交" onclick="change_status();" />
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-sm-3 control-label">手机号：</label>
                                <div class="col-sm-8">
                                    <input type="text" name="phone" id="phone" value="<?=$info['phone']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">短信：</label>
                                <div class="col-sm-8">
                                    <textarea id="msg" name="msg" class="form-control">【拉卡拉支付】</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-8">
                                    <input type="button" value="发送" onclick="send_msg();" />

                                </div>
                            </div>
        <div class="row">

            <div class="col-sm-12">
                <div class="ibox float-e-margins">

                    <div class="ibox-title">
                        <h5>物流信息 </h5>
                    </div>
 

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>时间</th>
                                    <th>进度</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($list as $k => $v){
                            ?>
                                <tr>
                                    <td><?=$v['AcceptTime']?></td>
                                    <td><?=$v['AcceptStation']?></td>
           
                                </tr>

                          
                      
                                <?php
                                    }
                                ?>
                
                            </tbody>
                             <tfoot>

                                <tr>
                                    <td colspan="11" class="footable-visible">
                                        <ul class="pagination pull-right">
                           
                                           
                                        </ul>
                                    </td>
                                </tr>
                                
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>

        </div>

    </div>




    <?php

        $this->load->view('widgets/main_footer_tpl');
    ?>

<script type="text/javascript" src="<?=base_url()?>static/layer/layer.js"></script>
<script type="text/javascript">
function change_status()
{
 // var re_type = $("#re_type").val();
  var status = $("#status").val();
  var order_id = $("#order_id").val();


  var aj = $.ajax( {
              url:'<?=base_url()?>home/logistics/change_express',
              data:{               
                  //re_type : re_type,
                  order_id : order_id,
                  status : status,
        
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
               // alert(data.msg);
                if(data.code == '0'){
                  //location.reload();
                  alert(data.msg);
                }else{
                 alert(data.msg);
                }              
              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });
}

function send_msg()
{
  var phone = $("#phone").val();
  var msg = $("#msg").val();

    var aj = $.ajax( {
              url:'<?=base_url()?>home/message/send_message',
              data:{               
                  //re_type : re_type,
                  phone : phone,
                  msg : msg,
        
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
                alert(data.msg);          
              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });

}
    
function alert_detail(url)
{
        //多窗口模式，层叠置顶
        layer.open({
          type: 2 //此处以iframe举例
          ,title: '物流详情'
          ,area: ['800px', '90%']
          ,shade: 0
          ,maxmin: true
          ,content: url
          ,btn: ['关闭'] //只是为了演示

          ,btn2: function(){
            layer.closeAll();
          }
          
          ,zIndex: layer.zIndex //重点1
          ,success: function(layero){
            layer.setTop(layero); //重点2
          }
        });
}
</script>
</body>

</html>