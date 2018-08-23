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
                        <h5>修改跟进记录</h5>
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
                        <form class="form-horizontal m-t" id="commentForm" method="post" action="<?=base_url()?>home/business/edit_record?">
                         <input type="hidden" name="uid" id='uid' class="form-control" value="<?=$info['id']?>">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">跟进内容：</label>
                                <div class="col-sm-8">
                                   <select name="re_type" class="form-control" id="re_type">
                                        <option value=""></option>
                                        <option value="1" <?php if($info['re_type'] == 1){?> selected <?php }?>>完善资料</option>
                                        <option value="2"  <?php if($info['re_type'] == 2){?> selected <?php }?>>确认资料</option>
                                        <option value="3"  <?php if($info['re_type'] == 3){?> selected <?php }?>>签收确认</option>
                                        <option value="4"  <?php if($info['re_type'] == 4){?> selected <?php }?>>激活跟进</option>
                                        <option value="5"  <?php if($info['re_type'] == 5){?> selected <?php }?>>其他</option>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">跟进备注：</label>
                                <div class="col-sm-8">
                                    <textarea id="intro" name="intro" class="form-control" required="" aria-required="true" placeholder="备注简要内容，25个汉字左右" ><?=$info['intro']?></textarea>
                                </div>
                            </div>
                          <!--   <div class="form-group">
                                <label class="col-sm-3 control-label">短信类别</label>
                                <div class="col-sm-8">
                                   <select name="msg_type" class="form-control" id='msg_type'>
                                        <option value=""></option>
                                        <option value="1" <?php if($info['msg_type'] == 1){?> selected <?php }?>>完善资料带链接</option>
                                        <option value="2" <?php if($info['msg_type'] == 2){?> selected <?php }?>>快递发出提醒</option>
                                        <option value="3" <?php if($info['msg_type'] == 3){?> selected <?php }?>>快递签收提醒</option>
                                        <option value="4" <?php if($info['msg_type'] == 4){?> selected <?php }?>>POS激活提醒</option>
                                        <option value="5" <?php if($info['msg_type'] == 5){?> selected <?php }?>>其他</option>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">短信是否发送</label>
                                <input type="radio" name="is_msg" id="is_msg" value='0' <?php if($info['is_msg'] == 0){?> checked <?php }?>>否
                                <input type="radio" name="is_msg" id="is_msg" value='1' <?php if($info['is_msg'] == 1){?> checked <?php }?>>是
                            </div> -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">客服</label>
                                <div class="col-sm-8">
                                   <select name="sever_id" class="form-control" id="sever_id">
                                   <option></option>
                                   <?php foreach($u_list as $k=>$v){?>
                                        <option value="<?=$v['id']?>" <?php if($info['sever_id']== $v['id']){?> selected <?php }?> ><?=$v['realname']?></option>
                                    <?php }?>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">跟进时间</label>
                                <div class="col-sm-8">
                                <input type="text" name="addtime" id='addtime' class="form-control" value="<?=date('Y-m-d H:i:s',$info['addtime'])?>">

                                <input type="hidden" name="end" value='' id='end' class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="button" onclick="edit_record()">提交</button>
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
  <script src="<?=base_url()?>static/assets/js/jquery-1.8.1.min.js"></script>
 <script type="text/javascript">
     //修改跟进记录
function edit_record()
{
  var re_type = $("#re_type").val();
  var intro = $("#intro").val();
  var msg_type = $("#msg_type").val();
  var is_msg = $("input[name='is_msg']:checked").val();
  var addtime = $("#addtime").val();
  var uid = $("#uid").val();
  var sever_id = $("#sever_id").val();
  
  var aj = $.ajax( {
              url:'<?=base_url()?>home/business/edit_record?',
              data:{               
                  re_type : re_type,
                  intro : intro,
                  msg_type : msg_type,
                  is_msg : is_msg,               
                  addtime : addtime,
                  uid:uid,
                  sever_id:sever_id
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
               // alert(data.msg);
                if(data.code == '0'){
                  history.back();
                }else{
                 alert(data.msg);
                }              
              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });
}
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