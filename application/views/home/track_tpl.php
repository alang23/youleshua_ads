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

        <div class="row">
        
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>申请列表</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
               
                        </div>

                    </div>

                    <div class="ibox-content">
              
                        <form method="get" name="form">
                        <div class="row">
                     
                            <div class="col-sm-2 m-b-xs">                                
                               <input type="text" name="show_time" id="start" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="开始时间" value="<?=$show_time?>">
                            </div>
                            <div class="col-sm-2 m-b-xs"> 
                               <input type="text" name="end_time" id="end" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="结束时间" value="<?=$end_time?>">
                            </div>
                          <div class="col-sm-2 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="status" id="status">
                                    <option value="all">跟进状态</option>
                                    <option value="0" <?php if($status == '0'){?> selected <?php } ?>>未跟进</option>
                                    <option value="1" <?php if($status == '1'){?> selected <?php } ?>>未接通</option>
                                    <option value="2" <?php if($status == '2'){?> selected <?php } ?>>需求待定</option>
                                    <option value="3" <?php if($status == '3'){?> selected <?php } ?>>确认邮寄</option>
                                    <option value="4" <?php if($status == '4'){?> selected <?php } ?>>已寄出</option>
                                    <option value="5" <?php if($status == '5'){?> selected <?php } ?>>已签收</option>
                                    <option value="6" <?php if($status == '6'){?> selected <?php } ?>>已拒收</option>
                                    <option value="7" <?php if($status == '7'){?> selected <?php } ?>>已激活</option>
                                    <option value="8" <?php if($status == '8'){?> selected <?php } ?>>已达标</option>
                                    <option value="9" <?php if($status == '9'){?> selected <?php } ?>>不需要</option>

                                    <option value="10" <?php if($status == '10'){?> selected <?php } ?>>提交</option>
                                     <option value="11" <?php if($status == '11'){?> selected <?php } ?>>派送中</option>
                                     <option value="12" <?php if($status == '12'){?> selected <?php } ?>>问题件</option>
                                      <option value="13" <?php if($status == '13'){?> selected <?php } ?>>人工确认</option>

                                </select>
                            </div>
                            <div class="col-sm-2 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="user_id" id="user_id">
                                    <option value="0">客服</option>
                                    <?php
                                        foreach($admin as $admin_k => $admin_v){
                                    ?>

                                    <option value="<?=$admin_v['id']?>" <?php if($user_id == $admin_v['id']){ ?> selected <?php } ?>><?=$admin_v['realname']?></option>

                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>

                             <div class="col-sm-1">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="search();"> 搜索</button> 
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-4 m-b-xs">
                   
                                <div class="btn-group">
                                    <button type="button" class="btn btn-w-sm btn-white" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button> 
                               </div>

                    
                            </div>
                            </form>
                        </div>

          
                    </div>
                </div>
            </div>

        </div>





        <div class="row">
        
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>交易查询</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
               
                        </div>

                    </div>

                    <div class="ibox-content">
              
                        <form method="get" name="form">
                        <div class="row">
         
                          <div class="col-sm-2 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="jiange" id="jiange">
                                    <option value="all">未交易间隔</option>
                                    <option value="1" >1个月</option>
                                    <option value="2" >2个月</option>
                                    <option value="3" >3个月</option>
                                    <option value="4" >4个月</option>
                      
                                </select>
                            </div>
             
                            <div class="col-sm-2 m-b-xs">                                
                               <input type="text" name="start_l" id="start_l"  class="input-sm form-control input-s-sm inline" placeholder="从第几条数据开始发" value="0">
                            </div>
                            <div class="col-sm-2 m-b-xs">                                
                               <input type="text" name="end_l" id="end_l"  class="input-sm form-control input-s-sm inline" placeholder="发送的短信条数" value="100">
                            </div>
                             <div class="col-sm-1">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="search_trade();"> 搜索</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4 m-b-xs">
                   
                                <div class="btn-group">
                                    <button type="button" class="btn btn-w-sm btn-white" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button> 
                               </div>

                    
                            </div>
                            </form>
                        </div>

          
                    </div>
                </div>
            </div>

        </div>




        <div class="row">
        
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>签收未激活</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
               
                        </div>

                    </div>

                    <div class="ibox-content">
              
                        <form method="get" name="form">
                        <div class="row">
                     
                            <div class="col-sm-2 m-b-xs">                                
                               <input type="text" name="show_time2" id="start2" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="开始时间" value="<?=$show_time2?>">
                            </div>
                            <div class="col-sm-2 m-b-xs"> 
                               <input type="text" name="end_time2" id="end2" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="结束时间" value="<?=$end_time2?>">
                            </div>
        
                            <div class="col-sm-2 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="types" id="types">
                                    <option value="0" >押金类型</option>
                                    <option value="1" >56</option>
                                    <option value="2" >99</option>
                                    <option value="3" >18到付</option>
                                    <option value="4" >23到付</option>
                                 
                                </select>
                            </div>
                            <div class="col-sm-2">                                
                               <input type="text" name="start_q" id="start_q" style="width: 100px"  class="input-sm form-control input-s-sm inline" placeholder="从第几条数据开始发" value="0">
                              <input type="text" name="end_q" id="end_q" style="width: 100px"  class="input-sm form-control input-s-sm inline" placeholder="发送的短信条数" value="100">
                            </div>
                           
                             <div class="col-sm-1">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="qianshoujh();"> 搜索</button> 
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-4 m-b-xs">
                   
                                <div class="btn-group">
                                    <button type="button" class="btn btn-w-sm btn-white" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button> 
                               </div>

                    
                            </div>
                            </form>
                        </div>

          
                    </div>
                </div>
            </div>

        </div>





    </div>

<div style="display: none;" id="uuiddiv">
<textarea id="phones" name="phones" class="form-control" required="" aria-required="true" placeholder="短信内容" ></textarea>
    <select class="input-sm form-control input-s-sm inline" onchange="msg_info(this.value)">
            <option value="0" >=短信模板=</option>
            <option value="1" >拨打前预热短信</option>
            <option value="2" >未接通短信</option>
            <option value="3" >无需求、不愿付费、费率高等未达成</option>
            <option value="4" >确认邮寄短信</option>
            <option value="5" >签收后短信催激活短信</option>
                                  
                                        
    </select> 
 <br/>
 <br/>
 <textarea id="msg" name="msg" class="form-control" required="" aria-required="true" placeholder="短信内容" ></textarea>
 <br/>
 <br/>
 <input type="button" value="发送" onclick="send_msg();" /> 
</div>


    <?php

        $this->load->view('widgets/main_footer_tpl');
    ?>
<script type="text/javascript" src="<?=base_url()?>static/layer/layer.js"></script>
    <script type="text/javascript" src="<?=base_url()?>static/layer/jedate/jedate.js"></script>
 
 <script type="text/javascript" src="<?=base_url()?>static/ylsadmin/laydate/laydate.js"></script>

 <script type="text/javascript">
    //jeDate.skin('gray');

lay('#version').html('-v'+ laydate.v);


laydate.render({
  elem: '#start'
  ,type: 'datetime'
}); 

laydate.render({
  elem: '#end'
  ,type: 'datetime'
});

laydate.render({
  elem: '#start2'
  ,type: 'datetime'
}); 

laydate.render({
  elem: '#end2'
  ,type: 'datetime'
});
</script>    

<script>
$("#checkall").click(
    function(){
        if(this.checked){
            $("input[name='ids[]']").each(function(){this.checked=true;});
        }else{
            $("input[name='ids[]']").each(function(){this.checked=false;});
        }
    }
);



function flush(msg,url){
  layer.confirm(msg, {
    btn: ['确定','取消'] //按钮
  }, function(){
      
      window.location=url;
      //alert(url);
  }, function(){
         

  });
}


var ids='';
function ziyuan_alert()
{ 
    var count = 0;
    var uuid = $("#uuid").val();
    $("input[name='ids[]']:checkbox:checked").each(function(){ 
        count++;      
        ids += $(this).val()+',';
    });
    $("#phones").val(ids);

    layer.open({
      type: 1,
      title:'发送短信('+count+')',
      skin: 'layui-layer-rim', //加上边框
      area: ['60%', '60%'], //宽高
      content: $("#uuiddiv")
    });
}

function search()
{
    var start = $("#start").val();
    var end = $("#end").val();
    var status = $("#status").val();
    var user_id = $("#user_id").val();

    var aj = $.ajax( {

                url:'<?=base_url()?>home/track/get_list_ajax',
                      data:{
                          
                          show_time : start,
                          end_time : end,
                          status : status,
                          user_id : user_id
                          
                      },
                      contentType:"application/x-www-form-urlencoded; charset=utf-8",
                      type:'post',
                      cache:false,
                      dataType:'json',
                      success:function(data){
                                               
                        //alert(data.data.phone);

                            var count = 0;
                            var uuid = $("#uuid").val();
                          
                            $("#phones").val(data.data.phone);

                            layer.open({
                              type: 1,
                              title:'发送短信('+data.data.count+')(总共:'+data.total+')',
                              skin: 'layui-layer-rim', //加上边框
                              area: ['60%', '60%'], //宽高
                              content: $("#uuiddiv")
                            });

                      },
                      error : function() {
                          alert("请求失败，请重试");
                      }
                });
}

function search_trade()
{
    var jiange = $("#jiange").val();
    var start_l = $("#start_l").val();
    var end_l = $("#end_l").val();

    var aj = $.ajax( {

                url:'<?=base_url()?>home/track/get_list_trade',
                      data:{
                          
                          jiange : jiange,
                          start_l : start_l,
                          end_l : end_l
                        
                      },
                      contentType:"application/x-www-form-urlencoded; charset=utf-8",
                      type:'post',
                      cache:false,
                      dataType:'json',
                      success:function(data){
                                               
                        //alert(data.data.phone);

                            var count = 0;
                            var uuid = $("#uuid").val();
                          
                            $("#phones").val(data.data.phone);

                            layer.open({
                              type: 1,
                               title:'发送短信('+data.data.count+')(总共:'+data.total+')',
                              skin: 'layui-layer-rim', //加上边框
                              area: ['60%', '60%'], //宽高
                              content: $("#uuiddiv")
                            });

                      },
                      error : function() {
                          alert("请求失败，请重试");
                      }
                });
}

function qianshoujh()
{
    var start2 = $("#start2").val();
    var end2 = $("#end2").val();
    var types = $("#types").val();
    var user_id = $("#user_id").val();
    var start_q = $("#start_q").val();
    var end_q = $("#end_q").val();

    var aj = $.ajax( {

                url:'<?=base_url()?>home/track/get_qianshou_ajax',
                      data:{
                          
                          show_time : start2,
                          end_time : end2,
                          types : types,
                          start_q : start_q,
                          end_q : end_q
                          
                      },
                      contentType:"application/x-www-form-urlencoded; charset=utf-8",
                      type:'post',
                      cache:false,
                      dataType:'json',
                      success:function(data){
                                               

                            var count = 0;
                            var uuid = $("#uuid").val();
                          
                            $("#phones").val(data.data.phone);

                            layer.open({
                              type: 1,
                              title:'发送短信('+data.data.count+')(总共:'+data.total+')',
                              skin: 'layui-layer-rim', //加上边框
                              area: ['60%', '60%'], //宽高
                              content: $("#uuiddiv")
                            });

                      },
                      error : function() {
                          alert("请求失败，请重试");
                      }
                });
}

//发送短信
function send_msg()
{
    var ids = $("#phones").val();
    var msg = $("#msg").val();
   
    var aj = $.ajax( {
                url:'<?=base_url()?>home/track/send_message',
                      data:{
                          
                          phone : ids,
                          msg : msg
                          
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
</body>

</html>