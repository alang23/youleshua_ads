
		/************************  失焦判断  **********************************/
			$("input").blur(function(){

				if($(this).is("#p_name")){             //姓名判断
					var na=/^[\u4E00-\u9FA5]{2,4}$/
					if($("#p_name").val()!=""){
						if(!(na.test($("#p_name").val()))){
							$(".c_list1").text("*请输入正确的姓名！");
							return false;
						}else if(na){
							$(".c_list1").text("");
							return true;
						}
					}else{
							$(".c_list1").text("*请输入正确的姓名！");
							return false;
					}
				}
				if($(this).is("#p_mobile")){            //手机号判断
					var ph=/^1[3|5|7|8|][0-9]{9}$/
					if($("#p_mobile").val()!=""){
					if(!(ph.test($("#p_mobile").val()))){
						$(".c_list2").text("请输入正确手机号");
						return false;
					}else if(ph){
						$(".c_list2").text("");
						return true;
					}
					}else{
						$(".c_list2").text("请输入正确手机号");
						return false;
					}
				}
				
				if($(this).is("#p_sn")){            //手机号判断
					if($("#p_sn").val()==""){
						$(".c_list3").text("请输入机器背面的CBC码");
						return false;
					}else{
						$(".c_list3").text("");
					}
				}
				
				if($(this).is("#input_image_file")){            //手机号判断
					if($("#input_image_file").val()==""){
						$("#txt_image_file").text("请上传您的交易截图");
						return false;
					}else{
						$("#txt_image_file").text("");
					}
				}
				
			})
		/********************** 聚焦提示 ************************/	

		/*********************** 提交验证 ***************************/
			$("#su").click(function(){
				var na=/^[\u4E00-\u9FA5]{2,4}$/;   //姓名正则
				var ph=/^1[3|5|7|8|][0-9]{9}$/;    //手机号正则
				var ad=/^(?=.*?[\u4E00-\u9FA5])[\dA-Za-z\u4E00-\u9FA5]{8,32}/;     //地址正则
				if(na.test($("#p_name").val())&&ph.test($("#p_mobile").val())&&$("#p_sn").val()!=""&&$("#input_image_file").val()!=""){
				//if($("#input_image_file").val()!=""){
					var p_name = $('#p_name').val();  
					var p_mobile = $('#p_mobile').val();  
					var p_sn = $('#p_sn').val();  
					var p_pay = $("input[name='p_pay']:checked").val();
					var p_zhifubao = $('#p_zhifubao').val();
					var p_bank = $('#p_bank').val();
					var p_card = $('#p_card').val();
					var p_img = $('#input_image_file').val();
				    //$("#su").attr("disabled", true);
						$.ajax({
							type: "POST",
							url: "save.php",
							data : {
									type : "add",
									p_name : p_name,
									p_mobile : p_mobile,
									p_sn : p_sn,
									p_pay : p_pay,
									p_zhifubao : p_zhifubao,
									p_bank : p_bank,
									p_card : p_card,
									p_img : p_img,
									},
							beforeSend: function(){ 
							  	$("#su").val("正在提交...");
								$("#su").attr("disabled", true);

							},
							success: function(data){
								console.log(data);
								if(data.code==0){
									alert(data.msg);
									$("#su").val("提交成功");
									$("#su").attr("disabled", true);
									
									}
								else{
								    alert(data.msg);
									$("#su").val("重新提交");
									$("#su").attr("disabled", false);
									}
								
							},
							error: function () {
								alert("程序异常");
								 $("#su").val("立即提交");
								 $("#su").attr("disabled", false);
							}
						});
				}else{
					if($("#p_name").val()==""){
						$(".c_list1").text('请输入订购人姓名')
					} 
					if($("#p_mobile").val()==""){
						$(".c_list2").text('请输入手机号码')
					} 
					if($("#p_sn").val()==""){
						$(".c_list3").text('请输入您的CBC码')
					}
					if($("#input_image_file").val()==""){
						$("#txt_image_file").text('请上传您的交易截图')
					}
					return false;
				}
			})