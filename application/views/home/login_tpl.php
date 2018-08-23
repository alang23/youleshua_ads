<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>优乐刷 - 登录</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="<?=base_url()?>static/ylsadmin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="<?=base_url()?>static/ylsadmin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <link href="<?=base_url()?>static/ylsadmin/css/animate.min.css" rel="stylesheet">
    <link href="<?=base_url()?>static/ylsadmin/css/style.min.css?v=4.0.0" rel="stylesheet"><base target="_blank">
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
    <style type="text/css">
      
      .acode img{
        display:inline;
        margin: 0 0 0 0;
      };
    </style>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h6 class="logo-name">H+</h6>

            </div>
            <h3>管理员登录</h3>

            <form class="m-t" role="form" action="index.html">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="用户名" id="username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码" id="admin_pwd" required="">
                </div>

                <div class="form-group">
                    <div style="float:left;display:inline;">
                      <input type="text" class="form-control" placeholder="验证码" id="acode" style="width: 200px;" />
                    </div>
                    <div style="float:left;display:inline;">
                        <img src="<?=base_url()?>home/login/getauthcode" id="acodeimg" style="cursor:hand;" onclick="changecode();">                    
                    </div>
                    
                </div>
                <br/>
                <br/>
                <p/>
                                <div class="form-group">

                <button type="button" onclick="login();" class="btn btn-primary block full-width m-b">登 录</button>
                </div>

                <p class="text-muted text-center" style="color:red;" id="err"> </a>
            </form>
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