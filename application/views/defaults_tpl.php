<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=640,target-densitydpi=device-dpi,user-scalable=no">
<meta content="telephone=no" name="format-detection" />
<title>路上诚品</title>
<link href="<?=base_url()?>static/lushang/css/main.css" rel="stylesheet">
<link href="<?=base_url()?>static/lushang/css/animate.css" rel="stylesheet">
<style>


        body .lushang-class {
            
            border: none;
        }

            body .lushang-class .layui-layer-content {
                padding: 3rem 3rem 0 3rem;
                text-align:center;
                font-size: 1.4rem;
                font-weight: bold;
                height: 100px;
                width: 420px;
            }

 body .lushang-class .layui-layer-btn {
        margin-right:5.5rem;
            }

                body .lushang-class .layui-layer-btn a {
                    background: #ff6a00;
                    border: 0px;
                    font-size: 1.6rem;
          padding:10px 50px;
          line-height:2.2rem;
                }

                body .lushang-class .layui-layer-btn .layui-layer-btn1 {
                    background: #afb611;
                    border: 0px;
                }
        .layui-layer-title{
          text-align:center;
          top:0;
        }
</style>
</head>
<body>
<!--
<section class="phone_bg">
       <a href="https://h5.youzan.com/v2/feature/10qwlqr2j" class="phone_nav"><img src="<?=base_url()?>static/lushang/images/nav_1.png"></a>
       <div class="phone_input">
            <h2>输入您的手机号码：</h2>
            <input type="text" id="phone"  placeholder="" maxlength="11" />
            <input type="text" id="phone"  placeholder="" maxlength="11" />
            <a href="javascript:void(0);" onclick="do_post();" class="left">确 认</a>
            <a href="javascript:void(0);" onclick="$('#phone').val('')" class="right">取 消</a>
       </div>
</section>
-->
<section class="phone_bg">
       <a href="https://h5.youzan.com/v2/feature/10qwlqr2j" class="phone_nav"><img src="<?=base_url()?>static/lushang/images/nav_1.png"></a>
       <div class="phone_input">
            <h2>输入您的手机号码：</h2>
            <input type="text" id="phone" placeholder="" maxlength="11">
            <h3>请输入检验码：</h3>
            <input type="text" placeholder="" id="authcode"  class="yzm" >
            <div class="phone_yzm"><img src="<?=base_url()?>defaults/getauthcode" id="acode" style="cursor:hand;" onclick="changecode();"></div>
            <a href="javascript:void(0);" onclick="do_post();" class="left">确 认</a>
            <a href="javascript:void(0);" onclick="$('#phone').val('')" class="right">取 消</a>
       </div>
</section>

<script src="<?=base_url()?>static/lushang/js/jquery-1.10.2.min.js"></script>
<script src="<?=base_url()?>static/lushang/js/main.js"></script>
<script src="<?=base_url()?>static/layer/layer.js"></script>

<script>


function changecode()
{
  $("#acode").attr("src","<?=base_url()?>defaults/getauthcode?rnd="+Math.random());
}

function do_post()
{
    var phone = $("#phone").val();
    if(!(/^1(3|4|5|7|8)\d{9}$/.test(phone))){ 
        layer.tips('请填写正确的手机号', '#phone');
        return false; 
    } 

    var authcode = $("#authcode").val();
    if(authcode == ''){
        layer.tips('请填写验证码', '#authcode');
        return false; 
    }


	var aj = $.ajax( {
              url:'<?=base_url()?>defaults/user_login',
              data:{
                  
                  phone : phone,
                  acode : authcode
                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
                //alert(data.data);
               if(data.code == 0){
                //alert(data.data);
               		window.location = '<?=base_url()?>products';
               }else{
               		//询问框
                   // alert(data.data);
                    layer.confirm('4月1日至4月7日为开奖时间请耐心等候，祝您好运！', {
                      skin : 'lushang-class',
                      title : '提示',
                      btn: ['关闭','参加活动'] //按钮
                    }, function(){
                      
                      layer.closeAll();

                    }, function(){

                        window.location = 'https://h5.youzan.com/v2/feature/1i2j1nf32';

                    });
               }

              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });
	//window.location = '<?=base_url()?>products';
}


</script>
</body>
</html>
