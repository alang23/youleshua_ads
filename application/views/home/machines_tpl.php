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
                        <h5>机器列表(<?=$count?>)</h5>
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
                        
                           
                            <div class="col-sm-2 m-b-xs">
                              <input type="text" placeholder="CBC" class="input-form-control" name="cbc" value='<?=$cbc?>'>
                            </div>
                           
                            <div class="col-sm-2 m-b-xs">                           
                                <div class="input-group">
                                    <select name="types" class="input-sm form-control input-s-sm inline" id="types">
                                        <option value="0" <?php if($types == '0'){ ?> selected <?php } ?>>分类</option>
                                        <option value="1" <?php if($types == '1'){ ?> selected <?php } ?>>力活</option>
                                        <option value="2" <?php if($types == '2'){ ?> selected <?php } ?>>创展</option>
                                    </select>
                               </div>                            
                            </div>
                       
                             <div class="col-sm-1">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm btn-primary" onclick="form.action='<?=base_url()?>home/machines/index';form.submit();"> 搜索</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4 m-b-xs">
                              
                               <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary" onclick="location='<?=base_url()?>home/machines/imports'"></i> 导入</button> 
                               </div>
                              <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary" onclick="location='<?=base_url()?>home/machines/huabo'"></i> 划拨机器</button> 
                               </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-w-sm btn-white" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button> 
                               </div>
                            </div>
                            </form>
                        </div>

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>型号</th>
                                    <th>CBC</th>
                                    <th>ZD</th>
                                    <th>时间</th>  
                                    <th>机构</th>                                  
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($list as $k => $v){
                            ?>
                                <tr>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['m_mode']?></td>
                                    <td><?=$v['dev_sn']?></td>
                                    <td><?=$v['zd_no']?></td>
                                    <td><?=date("Y-m-d",$v['riqi_int'])?> </td>  
                                    <td><?=machines_type($v['types'])?> </td>                            
                                    <th>
                                  
                                    #                          
                                    </th>
                                </tr>
                                <?php 
                                  }
                                ?>
                            </tbody>
                             <tfoot>
                              <form name="pageform" method="get" action="<?=base_url()?>home/machines/index">

                                <tr>
                                    <td colspan="11" class="footable-visible">
                                        <ul class="pagination pull-right">
                                        
                                        
                                 
                                            <?=$page?>
                                        
                                        </ul>
                                    </td>
                                </tr>
                              </form>
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

function flush(msg,url){
  layer.confirm(msg, {
    btn: ['确定','取消'] //按钮
  }, function(){
      
      window.location=url;
      //alert(url);
  }, function(){
         

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