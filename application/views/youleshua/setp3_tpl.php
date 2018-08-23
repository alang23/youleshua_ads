<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 ,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/youleshua/css/situation.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/youleshua/css/style.css">
    <script type="text/javascript" src="<?=base_url()?>static/youleshua/js/s_adaptation.js"></script>
	<title>结算资料页</title>
</head>
<body>
<div class="list1">
	<img src="<?=base_url()?>static/youleshua/images/1.jpg">
</div>
<div class="list2">
	<div class="from_con1">
		<h2>2.请完善银行结算信息</h2>
		<div class="text_con">
			<input type="text" class="text" name="realname" placeholder="请输入你的姓名" id="realname" value="<?=$info['realname']?>">
		</div>
		<div class="text_con">
			<input type="text" class="text" name="card_no" placeholder="请输入你的身份证号" id="card_no">
		</div>
		<div class="text_con">
			<input type="text" class="text" name="access" placeholder="请输入你的收款银行卡号" id="access">
		</div>
		<h1 class="text_h1">温馨提示：为了您的收款到账即时请确保卡号正确</h1>
		<input type="hidden" name="id" value="<?=$info['id']?>" />
		<a href="javascript:void(0);" class="next_btn" onclick="do_post();">
			<p>完成</p>
		</a>
	</div>
</div>
<div class="list3">
	<p class="message_text">《人民币银行结算账户管理办法》(中国人民银行令〔2003〕第5号发布)第十七条、第二十四条、第二十六条等相关规定，pos交易账户需实名制管理。</p>
</div>
<script src="<?=base_url()?>static/youleshua/js/zepto.min.js"></script>
<script src="<?=base_url()?>static/youleshua/js/main.js"></script>
<script>

var hostname = '<?=base_url()?>';
function do_post()
{

	var realname = $("#realname").val();
	var card_no = $("#card_no").val();
	var access = $("#access").val();

	if(realname == ''){
		alert('请填写姓名');
		return false;
	}

	if(card_no == ''){
		alert('请填写身份证号');
		return false;
	}

	if(access == ''){
		alert('请填写银行账号');
		return false;
	}

	var aj = $.ajax( {

              url:hostname+'defaults/setp3_save',
              data:{
                             
                  realname : realname,
                  phone : '<?=$info['phone']?>',
                  access : access,
                  card_no : card_no,
                  id : '<?=$info['id']?>'
                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
              
               if(data.code == 0){
               	
                    window.location = '<?=base_url()?>defaults/setp4?id='+data.data;

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
</body>
</html>