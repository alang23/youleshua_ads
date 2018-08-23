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
	<title>优乐富-基本资料</title>
</head>
<body>
<div class="list1">
	<img src="<?=base_url()?>static/youleshua/images/1.jpg">
</div>
<div class="list2">
	<div class="from_con1">
		<h2>1.请完善收货信息</h2>
		<div class="address_con">
			<p>收货地址</p>
			<input type="text" class="info_input" id="address" readonly="readonly" value="广东省，深圳市，福田区">
			<i class="ddl_down_icon"></i>
		</div>
		<div class="detail_address_con">
			<textarea class="detail_address_textarea" placeholder="请填写详细地址" id="street"></textarea>
		</div>
		<input type="hidden" name="id" value="<?=$id?>" />
		<h1 class="text_h1">请确保地址准确，我们会根据此地址寄送POS机。</h1>
		<a href="javascript:void(0);" onclick="do_post();" class="next_btn">
			<p>下一步</p>
		</a>
	</div>
</div>
<div class="list2">
	<div class="img_100">
		<img src="<?=base_url()?>static/youleshua/images/2.jpg">
	</div>
	<div class="img_100">
		<img src="<?=base_url()?>static/youleshua/images/3.jpg">
	</div>
	<div class="img_100">
		<img src="<?=base_url()?>static/youleshua/images/4.jpg">
	</div>
	<div class="img_100">
		<img src="<?=base_url()?>static/youleshua/images/5.jpg">
	</div>
</div>


<script src="<?=base_url()?>static/youleshua/js/zepto.min.js"></script>
<script src="<?=base_url()?>static/youleshua/js/main.js"></script>



	<!-- E 地址列表相关 -->
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

var hostname = '<?=base_url()?>';
function do_post()
{

	var street = $("#street").val();
	if(street == ''){
		alert('请填写收货地址');
		return false;
	}

	var aj = $.ajax( {

              url:'<?=base_url()?>defaults/setp2_save',
              data:{
                  
                  street : street,
                  id : '<?=$id?>'
                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
               
               if(data.code == 0){
                    window.location = '<?=base_url()?>defaults/setp3?id='+data.data;
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