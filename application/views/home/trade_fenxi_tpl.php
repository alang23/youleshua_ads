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

                        <h5>机器交易总汇(<font color='red'><?=$count?></font>)</h5>
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
                    
                        <form method="get" name="form" action="<?=base_url()?>home/trade/fenxi">
                        <div class="row">

                            <div class="col-sm-2 m-b-xs">                                
                               <input type="test" name="show_time" id="start" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="开始时间" value="<?=$show_time?>">
                            </div>
                            <div class="col-sm-2 m-b-xs"> 
                               <input type="test" name="end_time" id="end" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="结束时间" value="<?=$end_time?>">
                            </div>
                                      
                    
                       
                            <div class="col-sm-2 m-b-xs">
                                     <input type="text" name="p_sn" id="p_sn" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="CBC码" value="<?=$p_sn?>">
                            </div>
                             <div class="col-sm-1">                              
                                  <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>                                   
                            </div>
                            <div class="col-sm-4 m-b-xs">
                       

                       <!--         <div class="btn-group">
                                    <button class="btn btn-sm btn-primary" onclick="form.action='<?=base_url()?>home/trade/export';form.submit();"> 
                                    <i class="fa fa-download"></i>
                                    导出
                                    </button> 
                               </div> -->

                                <div class="btn-group">
                                    <button type="button" class="btn btn-w-sm btn-white" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button> 
                               </div>
                            </div>
                            </form>
                        </div>

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    
                                    <th>CBC</th>
                                    <th>交易额</th>                                   
                                    <th>姓名</th>
                                    <th>电话</th>
                                    <th>地址</th>
                                  
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($list as $k => $v){
                            ?>
                                <tr>
                                   
                                   
                                    <td><?=$v['p_sn']?></td>
                                    <td><?=$v['total']?></td>
                                    <td><?=$v['realname']?></td> 
                                    <td><?=$v['phone']?></td> 
                                    <td><?=$v['address']?></td> 
                                    <td>
                                   
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                
                            </tbody>
                             <tfoot>

                                <tr>
                                    <td colspan="14" class="footable-visible">
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

function flush(msg,url){
  layer.confirm(msg, {
    btn: ['确定','取消'] //按钮
  }, function(){
      
      window.location=url;
      //alert(url);
  }, function(){
         

  });
}

function show_photo(id)
{
    layer.photos({
      photos: '#'+id
      ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
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