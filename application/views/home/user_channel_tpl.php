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
                      
                  
                            
                            <div class="col-sm-4 m-b-xs">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-w-sm btn-primary" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button> 
                               </div>
                               <div class="btn-group">
                                    <button type="button" class="btn btn-w-sm btn-white" onclick="location='<?=base_url()?>home/channel/add?types=<?=$types?>';"><i class=""></i>添加账号</button> 
                               </div>
                            </div>
                            </form>
                        </div>

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>客户名称</th>
                                    <th>登录名</th>
                                    <th>渠道标识</th>
                                    <th>备注</th>
                                    <th>添加时间</th>
                                    <th>状态</th>

                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($list as $k => $v){
                            ?>
                                <tr>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['title']?>(<a href="javascript:;" onclick="alert_detail('<?=base_url()?>home/channel/parent?parent_id=<?=$v['id']?>');">查看子账户</a>)</td>
                                    <td><?=$v['username']?></td>  
                                    <td><?=$v['channel_id']?></td>                             
                                    <td><?=$v['remark']?></td>
                                
                                    <td><?=date("Y-m-d H:i:s",$v['addtime'])?></td>
                                    <td><?=work_type($v['status'])?></td>

                                    <th>
                                     <a href="javascript:void(0);" onclick="location='<?=base_url()?>home/channel/edit?id=<?=$v['id']?>';"><i class="fa fa-check text-navy"></i>编辑</a> 
                                     |
                                    <a href="javascript:void(0);" onclick="flush('确定删除吗?','<?=base_url()?>home/channel/del?id=<?=$v['id']?>&types=<?=$v['types']?>')"><i class="fa fa-check text-navy"></i>删除</a>
                                           <?php if($v['status'] == '0'){?>
                                      |
                                    <a href="javascript:void(0);" onclick="flush('确定要开始自动分配吗?','<?=base_url()?>home/channel/open?id=<?=$v['id']?>&types=<?=$v['types']?>')"><i class="fa fa-check text-navy"></i>开始</a>
                                    <?php } ?>
                                     
                                     <?php if($v['status'] == '1'){?>
                                     |
                                    <a href="javascript:void(0);" onclick="flush('确定要关闭自动分配吗?','<?=base_url()?>home/channel/close?id=<?=$v['id']?>&types=<?=$v['types']?>')"><i class="fa fa-check text-navy"></i>关闭</a> 
                                    <?php } ?> 
                                    |
                                    <a href="<?=base_url()?>home/channel/setting?id=<?=$v['id']?>"><i class="fa fa-check text-navy"></i>参数配置</a> 
                                    </th>                      
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

        </div>

    </div>




    <?php

        $this->load->view('widgets/main_footer_tpl');
    ?>
<script type="text/javascript" src="<?=base_url()?>static/layer/layer.js"></script>
    <script type="text/javascript" src="<?=base_url()?>static/layer/jedate/jedate.js"></script>
   

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
          ,title: '子账号'
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