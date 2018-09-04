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
                        <h5>申请列表(<?=$count?>)</h5>
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
                    <!--     <div class="">
                            <a  href="<?=base_url()?>home/ads/add" class="btn btn-primary ">添加广告</a>
                        </div> -->
                        <form method="get" name="form">
                        <div class="row">
                            <div class="col-sm-2 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="s_type">
                                    <option value="0">全部</option>
                                    <option value="1" <?php if($s_type == '1'){?> selected <?php } ?>>注册时间</option>
                                    <option value="2" <?php if($s_type == '2'){?> selected <?php } ?>>开通时间</option>
                                    <option value="3" <?php if($s_type == '3'){?> selected <?php } ?>>达标时间</option>
                   
                                </select>
                            </div>
                            <div class="col-sm-2 m-b-xs">                                
                               <input type="test" name="show_time" id="start" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="开始时间" value="<?=$show_time?>">
                            </div>
                            <div class="col-sm-2 m-b-xs"> 
                               <input type="test" name="end_time" id="end" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="结束时间" value="<?=$end_time?>">
                            </div>
                             <div class="col-sm-2 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="factor">
                                    <option value="0">四要素状态</option>
                                    <option value="1" <?php if($factor == '1'){?> selected <?php } ?>>通过</option>
                                    <option value="2" <?php if($factor == '2'){?> selected <?php } ?>>未通过</option>
                                </select>
                            </div>
                             <div class="col-sm-2 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="ads_channel">
                                    <option value="0">广告来源</option>
                                    <?php foreach($ads_list as $ads_k=>$ads_v){?>
                                    <option value="<?=$ads_v['id']?>" <?php if($ads_channel == $ads_v['id']){ ?> selected <?php } ?> ><?=$ads_v['ad_name']?>
                                    </option>
                                    <?php }?>
                                </select>
                            </div>

                          <div class="col-sm-2 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="status">
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
                                <select class="input-sm form-control input-s-sm inline" name="user_id">
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
                             <div class="col-sm-2 m-b-xs">
                              <input type="text" placeholder="姓名" class="input-sm form-control" name="realname" value="<?=$realname?>">
                            </div>
                             <div class="col-sm-2 m-b-xs">
                              <input type="text" placeholder="电话" class="input-sm form-control" name="phone" value="<?=$phone?>">
                            </div>
                             <div class="col-sm-1">
                                <div class="input-group">
                                   <!--  <input type="text" placeholder="姓名" class="input-sm form-control" name="realname">  -->
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm btn-primary" onclick="form.action='<?=base_url()?>home/business/shoukuanhe';form.submit();"> 搜索</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4 m-b-xs">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-primary" onclick="form.action='<?=base_url()?>home/business/export';form.submit();"> 
                                    <i class="fa fa-download"></i>
                                    导出
                                    </button> 
                               </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-w-sm btn-white" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button> 
                               </div>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-w-sm btn-primary" onclick="window.location='<?=base_url()?>home/business/add'"><i class="fa fa-add"></i> 添加</button> 
                               </div>
                            </div>
                            </form>
                        </div>
                        <?php
                            if(in_array('source_fenpei',$rolelist)){
                        ?>
                         <div class="ibox-content">
                         
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-warning" onclick="ziyuan_alert();"><i class="fa fa-info"></i> 分配资源</button> 
                               </div>
      
                         </div>
                         <?php
                            }
                         ?>
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>全选<input type="checkbox"  id="checkall" /></th>
                                    <th>#</th>
                                    <th>注册姓名</th>
<!--                                     <th>真实姓名</th>
 -->                                    <th>电话</th>                                   
                                   <!--  <th>身份证</th>
                                    <th>银行卡号</th> -->
<!--                                     <th>四要素验证</th>
 -->                                    <th>省/市</th>
                                    <th>地址</th>
                                    <?php 
                                        if(in_array('view_ad_frm', $rolelist)){
                                    ?>
                                    <th>来源</th> 
                                    <?php
                                        }
                                    ?>
                                    <th>申请时间</th>
                                    <th>跟进状态</th>
                                    <th>客服</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($list as $k => $v){
                            ?>
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="<?=$v['id']?>" /></td>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['ad_name']?></td>
<!--                                     <td><?=$v['realname']?></td>
 -->                                    <td><?=$v['phone']?></td>
                                   <!--  <td><?=$v['card_no']?></td> 
                                    <td><?=$v['access']?></td>  -->
<!--                                     <td><?=siyaosu($v['factor'])?></td>
 -->                                    <td><?=$v['address']?></td>
                                    <td><?=$v['street']?></td>
                                    <?php 
                                        if(in_array('view_ad_frm', $rolelist)){
                                    ?>
                                    <td><?=$v['adname']?></td>
                                    <?php
                                        }
                                    ?>
                                    <td><?=date("Y-m-d H:i:s",$v['addtime'])?></td>
                                    <td><?=flw_status($v['status'])?></td>
                                    <td><?=$v['admin_name']?></td>
                                    <td>
                  

                                            <div class="dropdown">
                                                <a data-toggle = "dropdown" href="#">操作<b class="caret"></b></a>
                                                <ul class="dropdown-menu" role = "menu">
                                                    <li><a href="<?=base_url()?>home/business/add_record_h?id=<?=$v['id']?>">添加记录</a></li>             
                                                    <li><a href="<?=base_url()?>home/business/edith?id=<?=$v['id']?>">编辑</a></li>
                                                    <li><a href="javascript:void(0);" onclick="alert_detail('<?=base_url()?>home/business/detail?id=<?=$v['id']?>');">查看</a></li>
                                                    <li><a href="javascript:void(0);" onclick="flush('确定删除吗?','<?=base_url()?>home/business/del_h?id=<?=$v['id']?>')">删除</a></li>
                                                    
                                                </ul>
                                            </div>
                                    </td>
                                </tr>

                          

                                <?php
                                    }
                                ?>
                
                            </tbody>
                             <tfoot>

                                <tr>
                                    <td colspan="16" class="footable-visible">
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

        </div>

    </div>

<div style="display: none;" id="uuiddiv">
 <select class="input-sm form-control input-s-sm inline" name="uuid" id="uuid">
    <?php
        foreach($admin as $ukk =>$uvv){
    ?>

        <option value="<?=$uvv['id']?>"><?=$uvv['realname']?></option>
    <?php

        }

    ?>
 </select>
 <br/>
 <br/>
<button type="button" class="btn btn-w-sm btn-defaults" onclick="fenpei();"> 确定分配</button>                
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

function fenpei()
{

      layer.confirm('分配后不可还原，确定分配吗?', {

        btn: ['确定','取消'] //按钮

      }, function(){
            var index = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
            var ids='';
            var uuid = $("#uuid").val();
            $("input[name='ids[]']:checkbox:checked").each(function(){ 
                
                ids += $(this).val()+',';
            });

            var aj = $.ajax( {
                      url:'<?=base_url()?>home/business/fenpei',
                      data:{
                          
                          ids : ids,
                          user_id : uuid
                          
                      },
                      contentType:"application/x-www-form-urlencoded; charset=utf-8",
                      type:'post',
                      cache:false,
                      dataType:'json',
                      success:function(data){
                        
                        
                       if(data.code == 0){
                            layer.closeAll();
                            window.location.reload();
                       }else{
                        
                            

                       }

                      },
                      error : function() {
                          alert("请求失败，请重试");
                      }
                  });
         
      }, function(){
             

      });

 
  
}


function flush(msg,url){
  layer.confirm(msg, {
    btn: ['确定','取消'] //按钮
  }, function(){
      
      window.location=url;
      //alert(url);
  }, function(){
         

  });
}

function ziyuan_alert()
{
    layer.open({
      type: 1,
      title:'分配',
      skin: 'layui-layer-rim', //加上边框
      area: ['320px', '150px'], //宽高
      content: $("#uuiddiv")
    });
}

function alert_detail(url)
{
        //多窗口模式，层叠置顶
        layer.open({
          type: 2 //此处以iframe举例
          ,title: '申请详情'
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