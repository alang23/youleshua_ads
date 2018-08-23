<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>汽车秀</title>
    <link rel="stylesheet" href="<?=base_url()?>static/mobile/css/ui.css">
    <script type="text/javascript" src="<?=base_url()?>static/mobile/js/new-iscroll.js"></script>
    <script type="text/javascript">
        var myScroll;
        function loaded () {
            myScroll = new IScroll('.scroll-content');
        }
        document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
    </script>
</head>
<body onload="loaded()">


<div class="view-container">
    <div class="content">
        <div class="scroll-content">
            <div class="scroll">
                <div class="list list-in">
                    <h1>管理员登录</h1>            
                </div>
                <div class="list">
                    <div class="item">
                        <div class="item-content">
                            <label class="name">用户名:</label>
                            
                            <input class="input" name="username" id="username" placeholder="用户名" type="text">
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-content">
                            <label class="name">密码:</label>
                            <input class="input" name="admin_pwd" id="admin_pwd"  placeholder="密码" type="password">
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-content">
                            <label class="name">验证码:</label>
                            <input class="input" name="acode" id="acode" type="text" placeholder="验证码">
                             <img src="<?=base_url()?>home/login/getauthcode" id="acodeimg" style="cursor:hand;" onclick="changecode();">
                        </div>
                    </div>
                
                </div>
                <div class="item-inquiry b-line"><button class="item-inquiry-btn btn-orange" onclick="login();">登录</button></div>
                <div class="item-inquiry b-line" id="err"></div>
                <div class="devider b-line"></div>
            
            </div>
        </div>
    </div>
</div>

    <script src="<?=base_url()?>static/ylsadmin/js/jquery.min.js?v=2.1.4"></script>
    <script src="<?=base_url()?>static/ylsadmin/js/bootstrap.min.js?v=3.3.5"></script>
    <script>
    function login()
    {
        var username = $("#username").val();
        var pawd = $("#admin_pwd").val();
        var acode = $("#acode").val();

        if(username == ''){
          $("#err").html('<div class="ce"><div class="err" id="J_errbox" >请输入用户名</div></div>');
          return false;
        }

        if(pawd == ''){
          $("#err").html('<div class="ce"><div class="err" id="J_errbox" >请输入密码</div></div>');
          return false;
        }

        if(acode == ''){
          $("#err").html('<div class="ce"><div class="err" id="J_errbox" >请输入验证码</div></div>');
          return false;
        }

        var aj = $.ajax( {
              url:'<?=base_url()?>home/login/user_login',
              data:{
                  
                  username : username,
                  pawd : pawd,
                  acode : acode
                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
                
                //alert(data.code);
               if(data.code == 0){
                    window.location = '<?=base_url()?>home/defaults';
               }else{
                
                    $("#err").html('<div class="ce"><div class="err" id="J_errbox" >'+data.msg+'</div></div>');

               }

              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });
    }

function changecode()
{
  $("#acodeimg").attr("src","<?=base_url()?>home/login/getauthcode?rnd="+Math.random());
}
</script>
</body>
</html>