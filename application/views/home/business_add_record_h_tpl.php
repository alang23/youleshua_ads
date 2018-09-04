<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>H+ 后台主题UI框架 - 表单验证 jQuery Validation</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <?php
        $this->load->view('widgets/main_source_tpl');
    ?>

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加跟进记录</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" action="<?=base_url()?>home/business/add_record_h?id=<?=$id?>">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">跟进状态:</label>
                                <div class="col-sm-8">
                                <select class="input-sm form-control input-s-sm inline" name="flw_status" id="flw_status">
                                    <option value="0">未跟进</option>
                                    <option value="1" <?php if($status == '1'){?> selected <?php } ?>>未接通</option>
                                    <option value="2" <?php if($status == '2'){?> selected <?php } ?>>需求待定</option>
                                    <option value="3" <?php if($status == '3'){?> selected <?php } ?>>确认邮寄</option>
                                    <option value="4" <?php if($status == '4'){?> selected <?php } ?>>已寄出</option>
                                    <option value="5" <?php if($status == '5'){?> selected <?php } ?>>已签收</option>
                                    <option value="6" <?php if($status == '6'){?> selected <?php } ?>>已拒收</option>
                                    <option value="7" <?php if($status == '7'){?> selected <?php } ?>>已激活</option>
                                    <?php
                                      if($userinfo['role'] == '13'){
                                    ?>
                                    <option value="8" <?php if($status == '8'){?> selected <?php } ?>>已达标</option>
                                    <?php
                                      }
                                    ?>
                                     <option value="9" <?php if($status == '9'){?> selected <?php } ?>>不需要</option>

                                     <option value="10" <?php if($status == '10'){?> selected <?php } ?>>提交</option>
                                     <option value="11" <?php if($status == '11'){?> selected <?php } ?>>派送中</option>
                                     <option value="12" <?php if($status == '12'){?> selected <?php } ?>>问题件</option>
                                </select>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-sm-3 control-label">跟进备注：</label>
                                <div class="col-sm-8">
                                    <textarea id="intro" name="intro" class="form-control" required="" aria-required="true" placeholder="备注简要内容，25个汉字左右" ></textarea>
                                </div>
                            </div>
                  
                            <div class="form-group">
                                <label class="col-sm-3 control-label">客服:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="realname"  value="<?=$userinfo['realname']?>"  readonly="true"/>
                                  <input type="hidden" name="sever_id" value="<?=$userinfo['id']?>"  id="sever_id"/>

                                  <input type="hidden" name="id" value="<?=$id?>"  id="id"/>
                                </div>
                            </div>
                     
                            <div class="form-group">
                                <label class="col-sm-3 control-label">跟进时间:</label>
                                <div class="col-sm-8">
                                <input type="text" name="addtime" id='addtime' class="form-control" value="<?=date('Y-m-d H:i:s',time())?>">
                                <input type="hidden" name="end" value='' id='end' class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="button" onclick='add_record()'>提交</button>
                                    <button class="btn btn-defaults" type="button" onclick="history.back();">返回</button>

                                </div>
                            </div>
                        </form>

                    </div>

                </div>
             </div>

              <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>短信发送</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" >
                           <div class="form-group">
                                <label class="col-sm-3 control-label">姓名:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="realname"  value="<?=$info['ad_name']?>"  readonly="true"/>

                                  <input type="hidden" name="id" value="<?=$id?>"  id="id"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">手机:</label>
                                <div class="col-sm-8">
                                  <input type="text" name="phone" id="phone"  value="<?=$info['phone']?>"  />

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">短信发送:</label>
                                <div class="col-sm-8">
                                <select class="input-sm form-control input-s-sm inline" onchange="msg_info(this.value)">
                                   <option value="0" >=短信模板=</option>
                                    <option value="1" >拨打前预热短信</option>
                                    <option value="2" >未接通短信</option>
                                    <option value="3" >无需求、不愿付费、费率高等未达成</option>
                                    <option value="4" >确认邮寄短信</option>
                                    <option value="5" >签收后短信催激活短信</option>
                              
                                    
                                </select>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-sm-3 control-label">短信内容：</label>
                                <div class="col-sm-8">
                                    <textarea id="msg" name="msg" class="form-control" required="" aria-required="true" placeholder="短信内容" ></textarea>
                                </div>
                            </div>
                  
                  
                      
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="button" onclick='sen_msg()'>发送</button>
                                    <button class="btn btn-defaults" type="button" onclick="history.back();">返回</button>

                                </div>
                            </div>
                        </form>

                    </div>

                </div>
             </div>
                    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>跟进记录</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                 
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" >
                          <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>客户姓名</th> 
                                    <th>跟进内容</th>                                    
                               
                                    <th>客服</th>
                                    <th>跟进备注</th>
                                    <th>跟进状态</th>
                                    <th>跟进时间</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($list as $k => $v){
                            ?>
                                <tr>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['realname']?></td> 
                                    <td><?=re_type($v['re_type'])?></td>
                                   
                                    <td><?=$v['username']?></td> 
                                    <td><?=$v['intro']?></td>
                                     <td><?=flw_status($v['flw_status'])?></td>
                                    <td><?=date('Y-m-d H:i:s',$v['addtime'])?></td> 
                                 
                                </tr>
                                <?php
                                    }
                                ?>
                
                            </tbody>
                             <tfoot>

                                <tr>
                                    <td colspan="11" class="footable-visible">
                                        <ul class="pagination pull-right">
                                            <?=$page?>
                                        </ul>
                                    </td>
                                </tr>
                                
                            </tfoot>
                        </table>
                    </div>
                </div>
    </div>
    <?php

        $this->load->view('widgets/main_footer_tpl');
    ?>
</body>
 <script type="text/javascript" src="<?=base_url()?>static/layer/jedate/jedate.js"></script>
 <script src="<?=base_url()?>static/assets/js/jquery-1.8.1.min.js"></script>
 <script type="text/javascript" src="<?=base_url()?>static/layer/layer.js"></script>
<script type="text/javascript">
function flush(msg,url){
  layer.confirm(msg, {
    btn: ['确定','取消'] //按钮
  }, function(){
      
      window.location=url;
      //alert(url);
  }, function(){
         
  });
}
</script>

 <script type="text/javascript">
    //jeDate.skin('gray');
  jeDate({
    dateCell:"#end",//isinitVal:true,
    format:"YYYY-MM-DD hh:mm:ss",
    isTime:true, //isClear:false,
    minDate:"2015-10-19 00:00:00",
    maxDate:"2099-00-00 00:00:00"
  })
    jeDate({
    dateCell:"#addtime",
    format:"YYYY-MM-DD hh:mm:ss",
   // isinitVal:true,
    isTime:true, //isClear:false,
    minDate:"2014-09-19 00:00:00",
    //okfun:function(val){alert(val)}
  })
</script>  


<script type="text/javascript">

    //添加跟进记录
function add_record()
{
 // var re_type = $("#re_type").val();
  var intro = $("#intro").val();
  var msg_type = $("#msg_type").val();
  var sever_id = $("#sever_id").val();
  var addtime = $("#addtime").val();
  var flw_status = $("#flw_status").val();
  var id = $("#id").val();

  var aj = $.ajax( {
              url:'<?=base_url()?>home/business/add_record_h?id=<?=$id?>',
              data:{               
                  //re_type : re_type,
                  intro : intro,
                  msg_type : msg_type,
                  sever_id : sever_id,              
                  addtime : addtime,
                  flw_status : flw_status,
                  id : id
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
               // alert(data.msg);
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


function msg_info(id)
{
   var msg = '';
   
  switch(id)
  {
      case '1':
        msg = "【拉卡拉支付】您好！感谢您选择拉卡拉，我们客服将电话联系您确认快递地址，以便于今天安排发货，请您保持电话畅通。如您不方便接听电话，请关注公众号“优乐富”联系在线客服核实快递地址。";      
        break;
      case '2':
        msg = "【拉卡拉支付】您好！我们客服电话联系您确认快递地址，电话未能接通，为了便于安排发货。如您不方便接听电话，请关注公众号“优乐富”联系在线客服核实快递地址。";
        break;
      case '3':
        msg = "【拉卡拉支付】您好！刚刚我们客服电话联系您确认快递地址。如您后续想申领按键机具，请关注公众号“优乐富”并联系在线客服。";
        break;
      case '4':
        msg = "【拉卡拉支付】您好！您的拉卡拉蓝牙键盘POS机，今天安排顺丰快递寄出。请关注公众号“优乐富”  输入收件人名字和电话实时查询快递进展。";
        break;
      case '5':
        msg = "【拉卡拉支付】温馨提示您：您已申领拉卡拉收款宝，请在签收后30自然日激活并刷满借贷卡3000，以便您在公众号（优乐富）办理押金退还手续，过期将不再退还押金！再次感谢您选择拉卡拉！";
        break;
     
  }
 
  $("#msg").val(msg);

}

function sen_msg()
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



</script>
</html>