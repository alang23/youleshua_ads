 <!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>用户列表</title>
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
                        <h5>用户列表(<?=$count?>)</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="table_basic.html#">选项1</a>
                                </li>
                                <li><a href="table_basic.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>

                    </div>

                    <div class="ibox-content">
                    <!--     <div class="">
                            <a  href="<?=base_url()?>home/ads/add" class="btn btn-primary ">添加广告</a>
                        </div> -->
                        <form method="get" name="form">
                        <div class="row">
                     <!--        <div class="col-sm-2 m-b-xs">                                
                               <input type="test" name="show_time" id="start" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="开始时间" value="<?=$show_time?>">
                            </div>
                            <div class="col-sm-2 m-b-xs"> 
                               <input type="test" name="end_time" id="end" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="结束时间" value="<?=$end_time?>">
                            </div> -->
                            <div class="col-sm-2 m-b-xs"> 
                               <input type="test" name="realname" id="realname" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="姓名" value="<?=$realname?>">
                            </div>
                             <div class="col-sm-2 m-b-xs"> 
                               <input type="test" name="phone" id="phone" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="电话" value="<?=$phone?>">
                            </div>
                    
                             <div class="col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm btn-primary" onclick="form.action='<?=base_url()?>home/user/index';form.submit();"> 搜索</button> 
                                    </span>
                                </div>
                            </div>
<!--                             <div class="col-sm-4 m-b-xs">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-w-sm btn-white" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button> 
                               </div>
                               <div class="btn-group">
                                    <button type="button" class="btn btn-w-sm btn-white" onclick="location='<?=base_url()?>home/user/add';"><i class=""></i>添加账号</button> 
                               </div>
                            </div> -->
                            </form>
                        </div>
                        <div class="row">
                              <div class="col-sm-4 m-b-xs">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-w-sm btn-white" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button> 
                               </div>
                               <div class="btn-group">
                                    <button type="button" class="btn btn-w-sm btn-white" onclick="location='<?=base_url()?>home/user/add';"><i class=""></i>添加账号</button> 
                               </div>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>账号</th>
                                    <th>姓名</th>
                                    <th>电话</th>                                   
                                    <th>角色</th>
                                    <th>备注</th>
                                    <th>状态</th>
                                    <!-- <th>分配数</th> -->
                                    <th>统计</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($list as $k => $v){
                            ?>
                                <tr>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['username']?></td>
                                    <td><?=$v['realname']?></td> 
                                    <td><?=$v['phone']?></td> 
                                    <td><?=$role[$v['role']]?></td>
                                    <td><?=$v['remark']?></td>
                                    <td><?=work_type($v['enabled'])?></td>
                                     <!-- <td><?=$v['count_num']?></td> -->
                                    <td id="user_ids_<?=$v['id']?>" data-id="<?=$v['id']?>"></td>
                                    <th>
                                     <a href="javascript:void(0);" onclick="location='<?=base_url()?>home/user/edit?id=<?=$v['id']?>';"><i class="fa fa-check text-navy"></i>编辑</a> 
                                     |
                                    <a href="javascript:void(0);" onclick="flush('确定删除吗?','<?=base_url()?>home/user/del?id=<?=$v['id']?>')"><i class="fa fa-check text-navy"></i>删除</a>
                                    
                                     <?php if($v['enabled'] == '0'){?>
                                      |
                                    <a href="javascript:void(0);" onclick="flush('确定要开始自动分配吗?','<?=base_url()?>home/user/open?id=<?=$v['id']?>')"><i class="fa fa-check text-navy"></i>开始</a>
                                    <?php } ?>
                                     
                                     <?php if($v['enabled'] == '1'){?>
                                     |
                                    <a href="javascript:void(0);" onclick="flush('确定要关闭自动分配吗?','<?=base_url()?>home/user/close?id=<?=$v['id']?>')"><i class="fa fa-check text-navy"></i>关闭</a> 
                                    <?php } ?>  
                                    <!--  |
                                    <a href="javascript:void(0);" onclick="alert_detail('<?=base_url()?>home/business/detail?id=<?=$v['id']?>');"><i class="fa fa-check text-navy"></i> 查看</a>  -->
                                </tr>

                                 

                                <?php
                                    }
                                ?>
                
                            </tbody>
                             <tfoot>

                                <tr>
                                    <td colspan="11" class="footable-visible">
                                        <ul class="pagination pull-right">
                                   <!--          <li class="footable-page-arrow">
                                            <a data-page="first" href="#first">«</a></li>
                                            <li class="footable-page-arrow"><a data-page="prev" href="#prev">‹</a></li>
                                            <li class="footable-page active"><a data-page="0" href="#">1</a></li>
                                            <li class="footable-page"><a data-page="1" href="#">2</a></li>
                                            <li class="footable-page-arrow"><a data-page="next" href="#next">›</a></li>
                                            <li class="footable-page-arrow"><a data-page="last" href="#last">»</a></li> -->
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




    <?php

        $this->load->view('widgets/main_footer_tpl');
    ?>
<script type="text/javascript" src="<?=base_url()?>static/layer/layer.js"></script>
    <script type="text/javascript" src="<?=base_url()?>static/layer/jedate/jedate.js"></script>

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
    dateCell:"#start",
    format:"YYYY-MM-DD hh:mm:ss",
   // isinitVal:true,
    isTime:true, //isClear:false,
    minDate:"2014-09-19 00:00:00",
    //okfun:function(val){alert(val)}
  })
</script>    

<script>

$(function(){
    <?php
      foreach($list as $kk => $vv){
    ?>
      tongji(<?=$vv['id']?>);

    <?php

      }

    ?>
  
});

function flush(msg,url){
  layer.confirm(msg, {
    btn: ['确定','取消'] //按钮
  }, function(){
      
      window.location=url;
      //alert(url);
  }, function(){
         

  });
}

function tongji(user_id)
{

        var aj = $.ajax( {
              url:'<?=base_url()?>home/user/tongji',
              data:{
                  
                  user_id : user_id
                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'text',
              success:function(data){
                
                //alert(data);
                $("#user_ids_"+user_id).text(data);

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