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
                       <!--       <div class="col-sm-2 m-b-xs">                                
                               <input type="radio" name="t_type" value="1" />
                               <input type="radio" name="t_type" value="2" />
                            </div> -->
                          <div class="col-sm-2 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="s_type">
                                    <option value="0">全部</option>
                                    <option value="1" <?php if($s_type == '1'){?> selected <?php } ?>>开通时间</option>
                                    <option value="2" <?php if($s_type == '2'){?> selected <?php } ?>>达标时间</option>
                   
                                </select>
                            </div>
                            <div class="col-sm-2 m-b-xs">  
                                                           
                               <input type="test" name="show_time" id="start" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="开始时间" value="<?=$show_time?>">
                            </div>
                            <div class="col-sm-2 m-b-xs"> 
                               <input type="test" name="end_time" id="end" style="width: 180px" class="input-sm form-control input-s-sm inline" placeholder="结束时间" value="<?=$end_time?>">
                            </div>
                        
                            <div class="col-sm-2 m-b-xs">
                              <input type="text" placeholder="CBC" class="input-sm form-control" name="cbc" value='<?=$cbc?>'>
                            </div>
                         
                            <div class="col-sm-2 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline" name="dabiao">
                                    <option value="all">达标状态</option>
                                    <option value="all">全部</option>
                                    <option value="是" <?php if($dabiao == '是'){?> selected <?php } ?>>是</option>
                                    <option value="否" <?php if($dabiao == '否'){?> selected <?php } ?>>否</option>
                   
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
                                    <select name="weihu" class="input-sm form-control input-s-sm inline" id="weihu">
                                        <option value="0" <?php if($weihu == '0'){ ?> selected <?php } ?>>代理</option>
                                        <option value="收款宝广州市增城粤坚商行" <?php if($weihu == '收款宝广州市增城粤坚商行'){ ?> selected <?php } ?>>收款宝广州市增城粤坚商行</option>
                                        <option value="收款宝江陵县光明专业合作社" <?php if($weihu == '收款宝江陵县光明专业合作社'){ ?> selected <?php } ?>>收款宝江陵县光明专业合作社</option>
                                        <option value="收款宝鼎龙电子商务有限公司" <?php if($weihu == '收款宝鼎龙电子商务有限公司'){ ?> selected <?php } ?>>收款宝鼎龙电子商务有限公司</option>
                                        <option value="来宾市飞发走丝" <?php if($weihu == '来宾市飞发走丝'){ ?> selected <?php } ?>>来宾市飞发走丝</option>
                                        <option value="广州逸骅装饰设计公司" <?php if($weihu == '广州逸骅装饰设计公司'){ ?> selected <?php } ?>>广州逸骅装饰设计公司</option>
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
                             <div class="col-sm-1">
                                <div class="input-group">
                                   <!--  <input type="text" placeholder="姓名" class="input-sm form-control" name="realname">  -->
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm btn-primary" onclick="form.action='<?=base_url()?>home/standard/index';form.submit();"> 搜索</button> 
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4 m-b-xs">
                               <!--  <div class="btn-group">
                                    <button class="btn btn-sm btn-primary" onclick="form.action='<?=base_url()?>home/business/export_customer';form.submit();"> 
                                    <i class="fa fa-download"></i>
                                    导出
                                    </button> 
                               </div> -->
                               <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary" onclick="location='<?=base_url()?>home/standard/imports'"></i> 导入</button> 
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
                                    <th>商户号</th>
                                    <th>商户名称</th>
                                    <th>终端号/机型</th>                                   
<!--                                     <th>用户姓名</th>
                                    <th>电话</th> -->
                                    <th>物流/交易</th>
                                    <th>开通时间</th>
                                    <th>是否达标</th>
                                    <th>达标时间</th>
                                    <th>出货时间</th>
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
                                    <td><?=$v['merchant_no']?></td>
                                    <td><?=$v['merchant_name']?></td>
                                    <td><?=$v['dev_sn']?>（<font color="red"><?=$v['dev_no']?></font>）</td>
<!--                                     <td><?=$v['realname']?></td>
                                    <td><?=$v['phone']?></td> -->
                                    <td><a href="javascript:;" onclick="show_detail('<?=base_url()?>home/standard/wuliu?cbc=<?=$v['dev_sn']?>');">物流</a>|<a href="javascript:;" onclick="show_detail('<?=base_url()?>home/trade/index_small?p_sn=<?=$v['dev_sn']?>&show_type=small');">交易</a></td>
                                    <td><?=$v['open_time']?></td>
                                    <td><?=$v['dabiao']?></td>                              
                                    <td><?=$v['dabiao_time']?></td>
                                    <td><?=$v['chuhuo_time']?></td>
                                    <td><?=machines_type($v['m_type'])?>（<font color="red"><?=empty($v['admin_name']) ? '未知' : $v['admin_name'];?></font>） </td>
                                    <th>                          
                                       
                                    <a href="javascript:void(0);" onclick="alert_detail('<?=$v['id']?>','<?=$v['remark']?>');"> 备注</a>                           
                                    </th>
                                </tr>
                                <?php 
                                  }
                                ?>
                            </tbody>
                             <tfoot>
                              <form name="pageform" method="get" action="<?=base_url()?>home/standard/index">

                                <tr>
                                    <td colspan="11" class="footable-visible">
                                        <ul class="pagination pull-right">
                                         <input type="hidden" name="show_time" value="<?=$show_time?>" />
                                         <input type="hidden" name="end_time" value="<?=$end_time?>" />
                                         <input type="hidden" name="cbc" value='<?=$cbc?>' />
                                         <input type="hidden"  name="dabiao" value="<?=$dabiao?>" />
                                         <input type="hidden"  name="s_type" value="<?=$s_type?>" />
                                        <li class="footable-page"><input type="text"  name="page"  value="<?=$pagenum?>" style="width: 50px;" /></li>
                                        <li><input type="button" class="input-btn" onclick="document.pageform.submit();" value="跳转>" /></li>

                       
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
<script type="text/javascript" src="<?=base_url()?>static/layer/extend/layer.ext.js"></script>
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

function alert_detail(id,remark)
{
  //prompt层
    layer.prompt({title: '备注', value:remark,formType: 2}, function(text, index){
      layer.close(index);
      var aj = $.ajax( {
              url:'<?=base_url()?>home/standard/add_info',
              data:{
                  
                  remark : text,
                  id : id
                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){

               if(data.code == 0){
                   layer.msg(data.msg);
                   location.reload();
               }else{
                
                    alert('error');

               }

              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });
      
    });
}

function show_detail(url)
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