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
                        <h5>广告列表</h5>


                    </div>

                    <div class="ibox-content">
                        <div class="">
                            <a  href="<?=base_url()?>home/ads/add" class="btn btn-primary ">添加广告</a>
                        </div>
                        <div class="row">

                            <div class="col-sm-3">
                            <form action="<?=base_url()?>home/ads/index" method='get'>
                                <div class="input-group">                              
                                    <input type="text" name='ad_name' placeholder="请输入关键词" class="input-sm form-control" value="<?=$ad_name?>"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> 
                                        <button type="button" class="btn btn-w-sm btn-white" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button> 

                                        </span>
                               
                                </div>
                             </form>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>广告名称</th>
                                    <th>渠道</th>
                                    <th>URL</th>
                                    <th>添加时间</th>
                                    <th>PV</th>
                                    <th>UV</th>
                                    <th>注册数</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($list as $k => $v){
                            ?>
                                <tr>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['ad_name']?> <a  class="fa fa-database" href="<?=base_url()?>home/ads/dlist?id=<?=$v['id']?>">查看数据</a></td>
                                    <td><?=$v['b_no']?></td>
                                    <td><?=$v['url']?></td>
                                    <td><?=date("Y-m-d H:i:s",$v['addtime'])?></td>
                                    <td><?=$v['total']?></td>
                                    <td><?=$v['uv_total']?></td>
                                    <td><?=$v['reg_total']?></td>
                                    <th>
                                    <a href="<?=base_url()?>home/ads/update?id=<?=$v['id']?>"><i class="fa fa-pencil-square-o text-navy"></i> 编辑</a> 
                                    |
                                    <a href="javascript:void(0);" onclick="flush('删除后不能回复，确定删除吗?','<?=base_url()?>home/ads/del?id=<?=$v['id']?>');"><i class="fa fa-times text-navy"></i> 删除</a> 
                                    |
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_<?=$k?>"><i class="fa fa-line-chart text-navy"></i> 监控代码</a> 
                                
                                    </th>
                                </tr>

                          
                                <div class="modal inmodal" id="myModal_<?=$k?>" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content animated fadeIn">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<!--                                             <i class="fa fa-clock-o modal-icon"></i>
 -->                                          <!--   <h4 class="modal-title">窗口标题</h4>
                                            <small>这里可以显示副标题。 -->
                                        </div>
                                        <div class="modal-body">
                                        <?php
                                            $redirect_url = $v['url'].'?frm='.$v['id'].'&b_no='.$v['b_no'];
                                        ?>
                                            <p><?=base_url()?>dclick/dredirect?aid=<?=$v['id']?>&pos_id=<?=$v['pos_id']?>&redirect=<?=urlencode($redirect_url)?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                                            <button type="button" class="btn btn-primary">复制</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

</script>

</body>

</html>