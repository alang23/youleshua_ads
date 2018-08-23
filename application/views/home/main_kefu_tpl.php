<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>H+ 后台主题UI框架 - FooTable</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> 
    <link href="<?=base_url()?>static/ylsadmin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="<?=base_url()?>static/ylsadmin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="<?=base_url()?>static/ylsadmin/css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="<?=base_url()?>static/ylsadmin/css/animate.min.css" rel="stylesheet">
    <link href="<?=base_url()?>static/ylsadmin/css/style.min.css?v=4.0.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-sm-5">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>记事本</h5>

                            <div class="ibox-tools">
                           <!--      <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">选项 01</a>
                                    </li>
                                    <li><a href="#">选项 02</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a> -->
                                    <button type="button" class="btn btn-default btn-xs" onclick="open_div();">添加</button>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                <thead>
                                <tr>

                                    <th data-toggle="true">标题</th>
                                    <th>级别</th>
                                    <th>日期</th>
                                    <th data-hide="all"></th>
                                 
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach($note as $nk => $nv){
                                ?>
                                <tr>
                                    <td><?=$nv['title']?></td>
                                    <td><?=grade_type($nv['grade'])?></td>
                                    <td><?=date("Y/m/d H:i",$nv['addtime'])?></td>
                                    <td><?=$nv['content']?></td>
                            
                                    <td>
                                    <?php
                                        if($nv['status'] == '0'){
                                    ?>
                                    <a href="javascript:;" onclick="check_status('<?=$nv['id']?>');"><i class="fa fa-check text-navy"></i> 完成</a>
                                    <?php
                                        }else{
                                    ?>
                                    <font color="blue"> 已完成</font>
                                    <?php
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    <script src="<?=base_url()?>static/ylsadmin/js/jquery.min.js?v=2.1.4"></script>
    <script src="<?=base_url()?>static/ylsadmin/js/bootstrap.min.js?v=3.3.5"></script>
    <script src="<?=base_url()?>static/ylsadmin/js/plugins/footable/footable.all.min.js"></script>
    <script src="<?=base_url()?>static/ylsadmin/js/content.min.js?v=1.0.0"></script>
    <script type="text/javascript" src="http://ads.youleshua.com/static/layer/layer.js"></script>    <script>
        $(document).ready(function(){$(".footable").footable();$(".footable2").footable()});

        function open_div()
        {
            layer.open({
              type: 1,
              area: ['500px', '450px'],
              content: $('#note') //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
            });
        }
    </script>
    
</body>
<div id="note" style="display: none;">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>简单示例</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="form_basic.html#">选项1</a>
                                </li>
                                <li><a href="form_basic.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">标题：</label>
                                <div class="col-sm-8">
                                    <input id="title" name="title" minlength="2" type="text" class="form-control" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">等级：</label>
                                <div class="col-sm-8">
                                    <select name="grade" id="grade">
                                    <option value="0">一般</option>
                                    <option value="1">紧急</option>
                                    <option value="2">重要</option>
                                    
                                    </select>
                                </div>
                            </div>
                    
                            <div class="form-group">
                                <label class="col-sm-3 control-label">内容：</label>
                                <div class="col-sm-8">
                                    <textarea id="content" name="content" class="form-control" required="" aria-required="true"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="button" onclick="add_note();">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
</div>

<script type="text/javascript">
    
    function add_note()
    {
        var title = $("#title").val();
        var grade = $("#grade").val();
        var content = $("#content").val();

        var aj = $.ajax( {
              url:'<?=base_url()?>home/main/add_note',
              data:{
                  
                  title : title,
                  grade : grade,
                  content : content
                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
                
                if(data.code == '0'){
                    location.reload(); 
                }else{
                    alert(data.msg);
                }
           

              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });
        
    }


    function check_status(id)
    {
        layer.confirm('确定任务完成了吗?', {
          btn: ['确定','关闭'] //按钮
        }, function(){
            var aj = $.ajax( {
              url:'<?=base_url()?>home/main/check_status',
              data:{
                  
                  id : id,
                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
                
                if(data.code == '0'){

                    location.reload(); 

                }else{
                    alert(data.msg);
                }
           

              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });
        }, function(){
         

        });
    }
</script>
</html>