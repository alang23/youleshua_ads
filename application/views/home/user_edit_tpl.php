<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>H+ 后台主题UI框架 - 表单验证 jQuery Validation</title>
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
                        <h5>修改用户</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                  <!--           <ul class="dropdown-menu dropdown-user">
                                <li><a href="form_basic.html#">选项1</a>
                                </li>
                                <li><a href="form_basic.html#">选项2</a>
                                </li>
                            </ul> -->
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" action="<?=base_url()?>home/user/edit?id=<?=$info['id'] ?>">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">用户名称:</label>
                                <div class="col-sm-8">
                                    <input id="username" name="username" class="form-control" type='text' aria-required="true" placeholder="用户名称" value="<?=$info['username']?>" />
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label">姓名:</label>
                                <div class="col-sm-8">
                                    <input id="realname" name="realname" class="form-control" type='text' aria-required="true" placeholder="姓名" value="<?=$info['realname']?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">性别</label>
                                <input type="radio" name="gender" value='1' <?php if($info['gender'] == '1'){?> checked <?php }?>>男
                                <input type="radio" name="gender" value='2' <?php if($info['gender'] == '2'){?> checked <?php }?>>女
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label">手机:</label>
                                <div class="col-sm-8">
                                    <input id="phone" name="phone" class="form-control" type='text' aria-required="true" placeholder="手机" value="<?=$info['phone']?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">分配数:</label>
                                <div class="col-sm-8">
                                    <input id="count_num" name="count_num" class="form-control" type='text' aria-required="true" placeholder="分配数" value="<?=$info['count_num']?>"/>
                                </div>
                            </div>
                              <div class="form-group">
                                <label class="col-sm-3 control-label">用户密码:</label>
                                <div class="col-sm-8">
                                    <input id="password" name="password" class="form-control" type='password' aria-required="true" placeholder="用户密码不改不需要填" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">备注：</label>
                                <div class="col-sm-8">
                                    <textarea id="remark" name="remark" class="form-control" required="" aria-required="true"><?=$info['remark'] ?></textarea>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label">角色</label>
                                <?php
                                    foreach($list_role as $k => $v){
                                ?>
                                <input type="radio" name="role_id" value="<?=$v['id']?>" <?php if($info['role'] == $v['id']){?> checked <?php }?> ><?=$v['role_name']?>
                            
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                    <button class="btn btn-defaults" type="button" onclick="window.location='<?=base_url()?>home/user/index'">返回</button>
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
</body>
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
    dateCell:"#addtime",
    format:"YYYY-MM-DD hh:mm:ss",
   // isinitVal:true,
    isTime:true, //isClear:false,
    minDate:"2014-09-19 00:00:00",
    //okfun:function(val){alert(val)}
  })
</script>    

</html>