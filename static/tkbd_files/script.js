/**
 *
 * HTML5 Image uploader with Jcrop
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2012, Script Tutorials
 * http://www.script-tutorials.com/
 */

// convert bytes into friendly format
function step2(){
    
    var ID_just = $("#input_image_file").val();
    var ID_back = $("#input_image_file1").val();
    var bank_just = $("#input_image_file2").val();
    var bank_back = $("#input_image_file3").val();
    if( ID_just=="" ){
        new TipBox({type:'error',str:'请上传身份证+银行卡正面',hasBtn:true});  
        return false;
        }
    if( ID_back=="" ){
        new TipBox({type:'error',str:'请上传身份证+银行卡背面',hasBtn:true});  
        return false;
        }
    if( bank_just=="" ){
        new TipBox({type:'error',str:'请上传手持身份证+银行卡照片',hasBtn:true});  
        return false;
        }
    
    $.ajax({
        type: "POST",
        url: "conn.php",
        data : {
                action : "edit",
                ID_just : ID_just,
                ID_back : ID_back,
                bank_just : bank_just,
                bank_back : bank_back,
                },
        beforeSend: function(){ 
          $(".foot_inp").html('<input type="button" name="" id="i_sub" class="i_sub"  value="正在处理" />');
        },
        success: function(msg){
            msg=msg.replace(/\s/g,'')
            if(msg=="成功"){
                   $(".foot_inp").html('<input type="button" name="" class="i_sub"  onclick="step2()"  value="提交完成" />');
                    new TipBox({type:'success',str:"操作成功..",setTime:1500,callBack:function(){  
                       window.location.href="Success.html";
                    }});  
             }
            else if(msg=="过期"){
                
                new TipBox({type:'error',str:"您的订单已过期,请重新提交..",setTime:1500,callBack:function(){  
                   window.location.href="Submit.html";
                }});  
                 }
            else{
                new TipBox({type:'error',str:"提交失败",hasBtn:true});  
                $(".foot_inp").html('<input type="button" name="" class="i_sub"  onclick="step2()"  value="点击提交" />');
                }
        }
    });
    
    
    }

function cart_hm(cart){
    var cart="#"+cart;
    var cart_hide="#"+cart+"_hide";
    $(cart).show(); 
    
}
function cart_hide(cart){
    var cart="#"+cart;
    $(cart).hide(); 
    
}

// $(cart_hide).click(function(){
//    $(cart).hide()
// })



function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB'];
    if (bytes == 0)
        return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
}

// check for selected crop region
function checkForm() {
    if (parseInt($('#w').val()))
        return true;
    $('.error').html('请先选择图片，并且截图').show();
    return false;
}

// update info by cropping (onChange and onSelect events handler)
function updateInfo(e) {
    $('#x1').val(e.x);
    $('#y1').val(e.y);
    $('#x2').val(e.x2);
    $('#y2').val(e.y2);
    $('#w').val(e.w);
    $('#h').val(e.h);
}
;

// clear info by cropping (onRelease event handler)
function clearInfo() {
    $('.info #w').val('');
    $('.info #h').val('');
}

function fileSelectHandler(p_ul) {
    var pofile="#"+p_ul
    // get selected file
    var oFile = $(pofile)[0].files[0];
    var form_pofile="#"+p_ul+"_form"
    var class_pofile="#class_"+p_ul
    var input_pofile="#input_"+p_ul
    var txt_pofile="#txt_"+p_ul
    // hide all errors

    // check for image type (jpg and png are allowed)
    var rFilter = /^(image\/jpeg|image\/png|image\/jpg)$/i;
    if (!rFilter.test(oFile.type)) {
        $(txt_pofile).html('<span class="a">*请选择jpg、jpeg或png格式的图片</span>').show();
        return;
    }

    // check for file size
    if (oFile.size >3 * 1000 * 1024) {
        $(txt_pofile).html('<span class="a">*请上传小于3M的图片</span>').show();
        return;
    }

    // preview element
    var oImage = document.getElementById('preview');

    // prepare HTML5 FileReader
    var oReader = new FileReader();
    oReader.onload = function(e) {
        // e.target.result contains the DataURL which we can use as a source of the image
        oImage.src = e.target.result;
   
        oImage.onload = function() { // onload event handler

            // display step 2

            // display some basic image info
            var sResultFileSize = bytesToSize(oFile.size);
            $('#filesize').val(sResultFileSize);
            $('#filetype').val(oFile.type);
            $('#filedim').val(oImage.naturalWidth + ' x ' + oImage.naturalHeight);
            $('#w').val(oImage.naturalWidth);
            $('#h').val(oImage.naturalHeight);

            // Create variables (in this scope) to hold the Jcrop API and image size
            var jcrop_api, boundx, boundy;

            // destroy Jcrop if it is existed
            if (typeof jcrop_api != 'undefined')
                jcrop_api.destroy();

            // initialize Jcrop
            $('#preview').Jcrop({
                minSize: [32, 32], // min crop size
                aspectRatio: 1, // keep aspect ratio 1:1
                bgFade: true, // use fade effect
                bgOpacity: .3, // fade opacity
                onChange: updateInfo,
                onSelect: updateInfo,
                onRelease: clearInfo
            }, function() {

                // use the Jcrop API to get the real image size
                var bounds = this.getBounds();
                boundx = bounds[0];
                boundy = bounds[1];

                // Store the Jcrop API in the jcrop_api variable
                jcrop_api = this;
            });
        };
    };
    oReader.readAsDataURL(oFile);
    // read selected file as DataURL
    var formData = new FormData($(form_pofile)[0]);  
    
     $.ajax({  
          url: './upload.php' ,  
          type: 'POST',  
          dataType: 'json', 
          data: formData,  
          async: true,  
          cache: false,  
          contentType: false,  
          processData: false,  
        beforeSend: function(){ 
          $(class_pofile).html('<img src="/style/images/jin.gif" />');
        
        },
          success: function (returndata) { 
           // alert(returndata.url); 
            if(returndata.url){
                 $("#input_image_file").val(returndata.url);
                 $(pofile).attr("disabled",false);
                 $(txt_pofile).html("上传成功！点击修改");
            }
               
            if(returndata.error){
              $(txt_pofile).html("<span class='a'>"+returndata.error+"</span>");
            }
          },  
          error: function (returndata) { 
             console.log(123); 
             //$(txt_pofile).html("<span class='a'>文件上传错误或内部错误！</span>");
          }  
     });  
}
