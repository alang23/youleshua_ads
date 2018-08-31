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
                        <h5>编辑角色</h5>
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
                        <form class="form-horizontal m-t" id="commentForm" method="post" action="<?=base_url()?>home/role/edit">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">角色名称:</label>
                                <div class="col-sm-8">
                                    <input id="role_name" name="role_name" class="form-control" type='text' aria-required="true" placeholder="角色名称" value="<?=$role_name?>" />
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label">权限等级一:</label>
                                <div class="col-sm-8">
                                <?php foreach($list_role_one as $k=>$v){?>
                                    <input id="tag_name_one" name="list_tag_name_one[]" type='checkbox' aria-required="true" value="<?=$v['tag_name']?>-<?=$v['name']?>" <?php if(in_array($v['tag_name'], $_temp)){?> checked <?php }else{?> <?php }?>/>&nbsp;<?=$v['name']?>&nbsp;&nbsp;&nbsp;
                                <?php }?>
                                </div>
                                
                            </div>   
                             <div class="form-group">
                                <label class="col-sm-3 control-label">权限等级二:</label>
                                <div class="col-sm-8">
                                <?php foreach($list_role_two as $k=>$v){?>
                                    <input id="tag_name_two" name="list_tag_name_two[]" type='checkbox' aria-required="true" value="<?=$v['tag_name']?>-<?=$v['name']?>" <?php if(in_array($v['tag_name'], $_temp)){?> checked <?php }else{?> <?php }?>/>&nbsp;<?=$v['name']?><br />
                                <?php }?>
                                </div>
                               
                                <input type="hidden" name="id" id = "id" value="<?=$id?>" >
                            </div>                           
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                    <button class="btn btn-primary" type="button" onclick="window.location='<?=base_url()?>home/role/index'">返回</button>
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
//    $('input[name=tag_name_one]').change(function(){
    
//     $('#role_list_one').val($('input[name=tag_name_one]:checked').map(function(){return this.value}).get().join(','));

//   })

// $('input[name=tag_name_two]').change(function(){
    
//     $('#role_list_two').val($('input[name=tag_name_two]:checked').map(function(){return this.value}).get().join(','));

//   })
 </script>

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