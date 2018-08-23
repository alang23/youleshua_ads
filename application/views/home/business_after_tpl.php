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
                               <input type="test" name="show_time" id="start" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="开始时间" value="<?=$show_time?>">
                            </div>
                            <div class="col-sm-2 m-b-xs"> 
                               <input type="test" name="end_time" id="end" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="结束时间" value="<?=$end_time?>">
                            </div>
                            <!--  <div class="col-sm-2 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="factor">
                                    <option value="0">四要素状态</option>
                                    <option value="1" <?php if($factor == '1'){?> selected <?php } ?>>通过</option>
                                    <option value="2" <?php if($factor == '2'){?> selected <?php } ?>>未通过</option>
                                </select>
                            </div> -->
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
                                        <button class="btn btn-sm btn-primary" onclick="form.action='<?=base_url()?>home/business/after_index';form.submit();"> 搜索</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4 m-b-xs">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-primary" onclick="form.action='<?=base_url()?>home/business/export_customer';form.submit();"> 
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
                                    <th>注册姓名</th>
                                    <th>真实姓名</th>
                                    <th>电话</th>                                   
                                <!--<th>身份证</th>
                                    <th>银行卡号</th> -->
                                    <th>四要素验证</th>
                                    <th>地区</th>
                                    <th>地址</th>
                                    <!-- <th>来源</th> -->
                                    <th>申请时间</th>
                                    <th>补全资料时间</th>
                                    <th>跟进状态</th>
                                    <!-- <th>跟进记录</th> -->
                                    <th>客服</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($list as $k => $v){
                            ?>
                                <tr>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['ad_name']?></td>
                                    <td><?=$v['realname']?></td>
                                    <td><?=$v['phone']?></td>
                                    <!-- <td><?=$v['card_no']?></td> -->
                                    <!-- <td><?=$v['access']?></td> -->
                                    <td><?=siyaosu($v['factor'])?></td>
                                    <td><?=$v['address']?></td>
                                    <td><?=$v['street']?></td>
                                   <!-- <td><?=$v['frm']?></td> -->
                                    <td><?=date("Y-m-d H:i:s",$v['addtime'])?></td>
                                    <td><?=date("Y-m-d H:i:s",$v['update_time'])?></td>
                                    <!-- <td><?=status($v['status'])?></td> -->
                                    <td><?=flw_status($v['status'])?></td>
                                    <td></td>
                                    <th>
                                    <a href="javascript:void(0);" onclick="location='<?=base_url()?>home/business/add_record?id=<?=$v['id']?>';"><i class="fa fa-check text-navy"></i>添加记录</a> 
                                     |
                                       
                                    <a href="javascript:void(0);" onclick="alert_detail('<?=base_url()?>home/business/detail?id=<?=$v['id']?>&type=<?=$type?>');"><i class="fa fa-check text-navy"></i> 查看</a>                           
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