<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 ,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/youleshua/css/situation.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/youleshua/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/youleshua/css/LArea.css">
    <script type="text/javascript" src="<?=base_url()?>static/youleshua/js/s_adaptation.js"></script>
	<title>优乐富</title>
</head>
<body>
<div class="list1">
	<img src="<?=base_url()?>static/youleshua/images/6.jpg">
</div>
<div class="list1">
	<img src="<?=base_url()?>static/youleshua/images/7.jpg">
</div>
<div class="list1">
	<img src="<?=base_url()?>static/youleshua/images/8.jpg">
</div>
<div class="list2">
	<form action="<?=base_url()?>defaults/setp1_save" method="post" name="form1" >
	<div class="from_con1">
		<div class="head_text">
			<img src="<?=base_url()?>static/youleshua/images/9.jpg">
		</div>
		<div class="text_con">
			<input type="text" class="text" name="realname" placeholder="姓名" id="realname">
		</div>
		<div class="text_con">
			<input type="text" class="text" name="phone" placeholder="手机号" id="phone">
		</div>
		<div class="text_code">
			<div class="text_con">
				<input type="text" class="text" name="vcode" placeholder="验证码" id="vcode">
			</div>
			<a href="javascript:void(0);" onclick="send_msg();" class="yellow_btn">
				<p id="msg_code_btn">获取验证码</p>
			</a>
		</div>
		<div class="address_con">
			<p>所在省市</p>
			<input type="text" class="info_input" id="address" name="address" readonly="readonly" value="广东省，深圳市，福田区">
			<i class="ddl_down_icon"></i>
		</div>
		<a href="javascript:void(0);" onclick="do_post();" class="next_btn">
			<p>立即免费申领</p>
		</a>
	</div>
	</form>
</div>





<script src="<?=base_url()?>static/youleshua/js/zepto.min.js"></script>
<script src="<?=base_url()?>static/youleshua/js/main.js"></script>

	<!-- E 可根据自己喜好引入样式风格文件 -->
	<script src="<?=base_url()?>static/youleshua/js/LAreaData1.js"></script>
	<script src="<?=base_url()?>static/youleshua/js/LAreaData2.js"></script>
	<script src="<?=base_url()?>static/youleshua/js/LArea.js"></script>
<script>


$(function(){
		var area1 = new LArea();
		area1.init({
			'trigger': '#address', //触发选择控件的文本框，同时选择完毕后name属性输出到该位置
			
			'keys': {
				id: 'id',
				name: 'name'
			}, //绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出
			'type': 1, //数据源类型
			'data': LAreaData //数据源
		});
		area1.value=[1,13,3];//控制初始位置，注意：该方法并不会影响到input的value

			//解决插件在Safari键盘关闭不完全的bug
			$("#address").focus(function(){
	        document.activeElement.blur();
	    });
	});

function validatemobile(phone) 
{ 
       if(phone.length==0) 
       { 
          alert('请输入手机号码！'); 
          document.form1.phone.focus(); 
          return false; 
       }     
       if(phone.length!=11) 
       { 
           alert('请输入有效的手机号码！'); 
           document.form1.phone.focus(); 
           return false; 
       } 
        
       var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/; 
       if(!myreg.test(phone)) 
       { 
           alert('请输入有效的手机号码！'); 
           document.form1.phone.focus(); 
           return false; 
       } 

       return true;
}

function do_post()
{
	var realname = $("#realname").val();
	var phone = $("#phone").val();
	var vcode = $("#vcode").val();
	var address = $("#address").val();

	if(realname == ''){
		alert('请填写姓名');
		return false;
	}

	if(phone == ''){
		alert('请填写手机号');
		return false;
	}

	if(!validatemobile(phone)){

		return;
	}

	if(vcode == ''){
		alert('请填写验证码');
		return false;
	}

	if(address == ''){
		alert('请填写地址');
		return false;
	}

	var aj = $.ajax( {
              url:'<?=base_url()?>defaults/setp1_save',
              data:{
                  
                  realname : realname,
                  phone : phone,
                  vcode : vcode,
                  address : address
                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
               
               if(data.code == 0){
                    window.location = '<?=base_url()?>defaults/setp2?id='+data.data;
               }else{
                
                    $("#err").html('<div class="ce"><div class="err" id="J_errbox" >'+data.msg+'</div></div>');

               }

              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });

}

//发送验证码
function send_msg()
{
    var phone = $("#phone").val();

    if(!validatemobile(phone)){

		return false;
	}


    $("#msg_code_btn").html('正在获取...'); 
   
    var aj = $.ajax( {
              url:'<?=base_url()?>defaults/send_msg',
              data:{
                  
                  phone : phone
                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
               		
                  if(data.code != '0'){
                      alert(data.msg);
                      return;
                  }
                  
                  //$('.next_btn').removeAttr('href');//去掉a标签中的href属性
                  //$('.next_btn').removeAttr('onclick');//去掉a标签中的onclick事件
                  settime();

              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });
}

var countdown=60; 

function settime() {
  //alert(countdown);
  if (countdown == 0) { 
    //val.removeAttribute("disabled");    
    $("#msg_code_btn").html('获取验证码'); 
    
  } else { 
    //val.setAttribute("disabled", true); 
    $("#msg_code_btn").html("重新发送(" + countdown + ")"); 
    countdown--; 
  } 
  setTimeout(function() { 
  settime() 
  },1000);

} 

</script>
</body>
</html>