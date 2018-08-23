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

                        <h5>交易数据:交易次数:  <font color="red"><?=$count?></font>,总交易金额:<font color="red"><?=$amount?></font> |  交易的POS机数:  <font color="red"><?=$trade_total?></font></h5>
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
                    
                        <form method="get" name="form" action="<?=base_url()?>home/trade/index">
                        <div class="row">

                            <div class="col-sm-2 m-b-xs">                                
                               <input type="test" name="show_time" id="start" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="开始时间" value="<?=$show_time?>">
                            </div>
                            <div class="col-sm-2 m-b-xs"> 
                               <input type="test" name="end_time" id="end" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="结束时间" value="<?=$end_time?>">
                            </div>
                            <div class="col-sm-2 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="pay_type">
                                    <option value="">刷卡类型</option>
                                    <option value="借记卡" <?php if($pay_type == '借记卡'){?> selected <?php } ?>>借记卡</option>
                                    <option value="贷记卡" <?php if($pay_type == '贷记卡'){?> selected <?php } ?>>贷记卡</option>
                                    <option value="准贷记卡" <?php if($pay_type == '准贷记卡'){?> selected <?php } ?>>准贷记卡</option>
                                    <option value="扫码" <?php if($pay_type == '扫码'){?> selected <?php } ?>>扫码</option>
                                </select>
                            </div>

                            <div class="col-sm-2 m-b-xs">                           
                                <div class="input-group">
                                    <select name="m_type" class="input-sm form-control input-s-sm inline" id="m_type">
                                        <option value="0" <?php if($m_type == '0'){ ?> selected <?php } ?>>机构</option>
                                        <option value="1" <?php if($m_type == '1'){ ?> selected <?php } ?>>力活</option>
                                        <option value="2" <?php if($m_type == '2'){ ?> selected <?php } ?>>创展</option>
                                    </select>
                               </div>                            
                            </div>

                            <div class="col-sm-2 m-b-xs">                           
                                <div class="input-group">
                                    <select name="jigou_no" class="input-sm form-control input-s-sm inline" id="jigou_no">
                                        <option value="0" <?php if($jigou_no == '0'){ ?> selected <?php } ?>>代理</option>
                                        <option value="606842" <?php if($jigou_no == '606842'){ ?> selected <?php } ?>>广州市增城粤坚商行</option>
                                        <option value="571544" <?php if($jigou_no == '571544'){ ?> selected <?php } ?>>江陵县光明专业合作社</option>
                                        <option value="640147" <?php if($jigou_no == '640147'){ ?> selected <?php } ?>>鼎龙电子商务有限公司</option>
                                        <option value="672391" <?php if($jigou_no == '672391'){ ?> selected <?php } ?>>来宾市飞发走丝</option>
                                        <option value="647147" <?php if($jigou_no == '647147'){ ?> selected <?php } ?>>广州逸骅装饰设计公司</option>
                                        <option value="672368" <?php if($jigou_no == '672368'){ ?> selected <?php } ?>>吉林奥森信息技术</option>
                                        <option value="722343" <?php if($jigou_no == '722343'){ ?> selected <?php } ?>>桦甸市小叶文体用品店</option>
                                    </select>
                               </div>                            
                            </div>


                             <div class="col-sm-2 m-b-xs">                           
                                <div class="input-group">
                                    <select name="kefu" class="input-sm form-control input-s-sm inline" id="weihu">
                                        <option value="0" <?php if($kefu == '0'){ ?> selected <?php } ?>>客服</option>
                                        <?php
                                          foreach($admin as $admink => $adminv){
                                        ?>
                                        <option value="<?=$adminv['id']?>" <?php if($kefu == $adminv['id']){ ?> selected <?php } ?>><?=$adminv['realname']?></option>
                                      <?php
                                        }
                                      ?>
                                    </select>
                               </div>                            
                            </div>

                            <div class="col-sm-2 m-b-xs">                           
                                <div class="input-group">
                                    <select name="chuhuo" class="input-sm form-control input-s-sm inline" id="weihu">
                                        <option value="0" <?php if($chuhuo == '0'){ ?> selected <?php } ?>>批次</option>
                                        <?php
                                          foreach($chuhuo_list as $chuhuok => $chuhuov){
                                        ?>
                                        <option value="<?=$chuhuov['chuhuo_time']?>" <?php if($chuhuo == $chuhuov['chuhuo_time']){ ?> selected <?php } ?>><?=$chuhuov['chuhuo_time']?></option>
                                      <?php
                                        }
                                      ?>
                                    </select>
                               </div>                            
                            </div>
                            <div class="col-sm-1 m-b-xs">                           
                                <div class="input-group">
                                    <select name="bijiao" class="input-sm form-control input-s-sm inline" id="bijiao">
                                        <option value="0" <?php if($bijiao == '0'){ ?> selected <?php } ?>>关系</option>
                                        <option value="1" <?php if($bijiao == '1'){ ?> selected <?php } ?>>大于</option>
                                        <option value="2" <?php if($bijiao == '2'){ ?> selected <?php } ?>>小于</option>
                                        <option value="3" <?php if($bijiao == '3'){ ?> selected <?php } ?>>等于</option>
                                    </select>
                               </div>                            
                            </div>
                            <div class="col-sm-2 m-b-xs">
                             
                                     <input type="text" name="jiner" id="jiner" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="交易金额" value="<?=$jiner?>">
                            </div>
                            <div class="col-sm-2 m-b-xs">
                                     <input type="text" name="p_sn" id="p_sn" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="CBC码" value="<?=$p_sn?>">
                            </div>
                             <div class="col-sm-1">                              
                                  <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>                                   
                            </div>
                            <div class="col-sm-4 m-b-xs">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-primary" onclick="form.action='<?=base_url()?>home/trade/imports'"> 
                                    <i class="fa fa-import"></i>
                                    导入
                                    </button> 
                               </div>

                               <div class="btn-group">
                                    <button class="btn btn-sm btn-primary" onclick="form.action='<?=base_url()?>home/trade/export';form.submit();"> 
                                    <i class="fa fa-download"></i>
                                    导出
                                    </button> 
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
                                    <th>流水号</th>
                                    <th>商户注册名</th>
                                    <th>交易日期</th>                                   
                                    <th>交易金额</th>
                                    <th>商户手续费</th>
                                    <th>借贷记标</th>
                                  
                                    <th>PSAM卡号</th>
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
                                    <td><?=$v['order_sn']?></td>
                                    <td><?=$v['mer_name']?></td>
                                    <td><?=$v['trade_date']?></td>
                                    <td><?=$v['amount']?></td> 
                                    <td><?=$v['pay_fee']?></td> 
                                    <td><?=$v['pay_type']?></td> 
                                    <td><?=$v['p_sn']?>（<font color="red"><?=$v['chuhuo_time']?></font>）</td>
                                    <td><?=machines_type($v['m_type'])?>（<font color="red"><?=empty($v['admin_name']) ? '未知' : $v['admin_name'];?></font>） </td> 
                                    <td>
                                    <!-- <a href="<?=base_url()?>home/trade/detail?id=<?=$v['id']?>" >查看</a>| -->
                                    <a href="javascript:void(0);" onclick="flush('删除后不能恢复，确定删除吗','<?=base_url()?>home/trade/del?id=<?=$v['id']?>');">删除</a>
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