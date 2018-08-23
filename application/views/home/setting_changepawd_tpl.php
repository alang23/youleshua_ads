<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>系统设置-密码修改</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <?php
        $this->load->view('widgets/main_source_tpl');
    ?>

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>密码修改</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                        
                           <!--  <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a> -->
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" >
                            <div class="form-group">
                                <label class="col-sm-3 control-label">原密码：</label>
                                <div class="col-sm-8">
                                    <input id="pawd" name="pawd" minlength="2" type="text" class="form-control" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">新密码：</label>
                                <div class="col-sm-8">
                                    <input id="newpawd" name="newpawd" minlength="2" type="text" class="form-control" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">再次输入新密码：</label>
                                <div class="col-sm-8">
                                    <input id="repawd" name="repawd" minlength="2" type="text" class="form-control" required="" aria-required="true">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="button" onclick="do_post();">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

        </div>
    </div>
    <?php

        $this->load->view('widgets/main_footer_tpl');
    ?>
        <script src="<?=base_url()?>static/js/jquery.js"></script>
  <script type="text/javascript" src="<?=base_url()?>static/layer/layer.js"></script>
</body>
<script>
function alertmsg(msg)
{
  layer.msg(msg);
}

function do_post()
{

    var pawd = $("#pawd").val();
    var newpawd = $("#newpawd").val();
    var repawd = $("#repawd").val();
    
    if(pawd == ''){
        alertmsg('请输入原密码');
        return false;
    }

    if(newpawd == ''){
        alertmsg('请输入新密码');
        return false;
    }


    if(repawd == ''){
        alertmsg('请再次输入新密码');
        return false;
    }

    var aj = $.ajax( {
              url:'<?=base_url()?>home/setting/changepwd_ajax',
              data:{
                  
                  pawd : pawd,
                  newpawd : newpawd,
                  repawd : repawd
                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
                
                if(data.code != 0){
                  alert(data.msg);
                }else{
                  $("#pawd").val('');
                  $("#newpawd").val('');
                  $("#repawd").val('');
                  alertmsg(data.msg);
                }              
              },
              error : function() {
                  alertmsg("请求失败，请重试");
              }
          });
}

</script>
</html>