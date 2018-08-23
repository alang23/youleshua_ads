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
                           <!--  <ul class="dropdown-menu dropdown-user">
                                <li><a href="table_basic.html#">选项1</a>
                                </li>
                                <li><a href="table_basic.html#">选项2</a>
                                </li>
                            </ul> -->
                           <!--  <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a> -->
                        </div>

                    </div>

                    <div class="ibox-content">
                    <!--     <div class="">
                            <a  href="<?=base_url()?>home/ads/add" class="btn btn-primary ">添加广告</a>
                        </div> -->
                        <form method="get" name="form" action="<?=base_url()?>home/deal/index">
                        <div class="row">
                      <!--       <div class="col-sm-2 m-b-xs">                                
                               <input type="test" name="show_time" id="start" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="开始时间" value="<?=$show_time?>">
                            </div>
                            <div class="col-sm-2 m-b-xs"> 
                               <input type="test" name="end_time" id="end" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="结束时间" value="<?=$end_time?>">
                            </div> -->
                             <div class="col-sm-2 m-b-xs">
                                        <select name="status" id="status" class="input-sm form-control input-s-sm inline" >
                                            <option value="all" <?php if($status == 'all'){ ?> selected <?php } ?> >全部</option>
                                            <option value="0" <?php if($status == '0'){?> selected <?php } ?> >待审核</option>
                                            <option value="1" <?php if($status == '1'){?> selected <?php } ?>>审核通过</option>
                                            <option value="2" <?php if($status == '2'){?> selected <?php } ?>>审核不通过</option>
                                            <option value="3" <?php if($status == '3'){?> selected <?php } ?>>已退还</option>
                                        </select>
                            </div>

                            <div class="col-sm-2 m-b-xs">
                                     <input type="text" name="p_name" id="p_name" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="姓名" value="<?=$p_name?>">
                            </div>


            

                        </div>
                        <div class="row">
                            <div class="col-sm-2 m-b-xs">
                                     <input type="text" name="p_mobile" id="p_mobile" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="手机号" value="<?=$p_mobile?>">


                            </div>
                            <div class="col-sm-2 m-b-xs">
                                     <input type="text" name="p_sn" id="p_sn" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="CBC码" value="<?=$p_sn?>">
                            </div>
                             <div class="col-sm-2 m-b-xs">
                                        <select name="types" id="types" class="input-sm form-control input-s-sm inline" >
                                            <option value="0" <?php if($types == '0'){ ?> selected <?php } ?> >押金类型</option>
                                           <option value="1" <?php if($types == '1'){ ?> selected <?php } ?> >56</option>
                                           <option value="2" <?php if($types == '2'){ ?> selected <?php } ?> >99</option>
                                        </select>
                            </div>
                            <div class="col-sm-1">
                               
                                        <button class="btn btn-sm btn-primary" type="submit"> 搜索</button> 
                                   
                            </div>
                            <div class="col-sm-4 m-b-xs">
                          
                                <div class="btn-group">
                                    <button type="button" class="btn btn-w-sm btn-white" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button> 
                               </div>
                            </div>
                        </div>
                            </form>

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>真实姓名</th>
                                    <th>手机号码</th>
                                    <th>机器CBC码</th>                                   
                                    <th>退换方式</th>
                                    <th>支付宝账号</th>
                                    <th>银行</th>
                                    <th>银行卡号</th> 
                                    <th>交易凭证</th>
                                    <th>添加时间</th>
                                    <th>押金</th>
                                    <th>审核状态</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($list as $k => $v){
                            ?>
                                <tr>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['p_name']?></td>
                                    <td><?=$v['p_mobile']?></td>
                                    <td><a href="javascript:alert_detail('<?=base_url()?>home/trade/index?p_sn=<?=$v['p_sn']?>&show_type=small');"><?=$v['p_sn']?></a></td>
                                    <td><?=deal_type($v['p_pay'])?></td> 
                                    <td><?php if(empty($v['p_zhifubao'])){ echo '无';}else{ echo $v['p_zhifubao'];} ?></td> 
                                    <td><?php if(empty($v['p_bank'])){ echo '无';}else{ echo $v['p_bank'];} ?></td> 
                                    <td><?php if(empty($v['p_card'])){ echo '无';}else{ echo $v['p_card'];} ?></td>
                                    <td id="photo_<?=$v['id']?>">
                                    <a href="http://app.1chuanqi.com/uploads/lkl/<?=$v['p_img']?>" target="_blank">
                                    <img src='http://app.1chuanqi.com/uploads/lkl/<?=$v['p_img']?>' width="100"/></a>
                                    </a>
                                    </td>
                                    <td><?=date("Y-m-d H:i:s",$v['addtime'])?></td>
                                    <td><?=yajin($v['types'])?></td> 

                                    <td><?=user_prompt($v['status'])?></td> 
                                    <td>
                                    <a href="<?=base_url()?>home/business/edit_lakala?id=<?=$v['id']?>" >查看</a>|
                                    <a href="javascript:void(0);" onclick="flush('删除后不能恢复，确定删除吗','<?=base_url()?>home/business/del_lakala?id=<?=$v['id']?>');">删除</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                
                            </tbody>
                             <tfoot>
                                <form name="pageform" method="get" action="<?=base_url()?>home/business/lakala">
                                <tr>
                                    <td colspan="14" class="footable-visible">
                                        <ul class="pagination pull-right">
                         
                                            <?=$page?>
                                            <?php
                                                if(!empty($page)){
                                            ?>
                                            <input type="hidden" name="show_time" value="<?=$show_time?>" />
                                             <input type="hidden" name="end_time" value="<?=$end_time?>" />
                                             <input type="hidden" name="p_name" value='<?=$p_name?>' />
                                             <input type="hidden"  name="p_mobile" value="<?=$p_mobile?>" />                                           
                                             <input type="hidden"  name="status" value="<?=$status?>" />
                                            <li class="footable-page"><input type="text"  name="page"  value="<?=$pagenum?>" style="width: 50px;" /></li>
                                            <li><input type="button" class="input-btn" onclick="document.pageform.submit();" value="跳转>" /></li>
                                            <?php
                                                }
                                            ?>
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