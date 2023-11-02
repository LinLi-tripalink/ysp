    //上传
    function file_click(e){
			var n= e.attr("data-index");  //ipt-file1
			upload(n);
    }
    function upload(index) {
			$('#upload').empty();
			var input = '<input type="file" id="ipt-file1" name="image" accept="image/*" />';
			$('#upload').html(input);
			var iptt=document.getElementById(index);
			if(window.addEventListener) { // Mozilla, Netscape, Firefox
					iptt.addEventListener('change',function(){
						ajaxFileUpload(index);
						$(".shadd[data-select="+index+"]").show();
					},false);
			}else{
					iptt.attachEvent('onchange',function(){
						ajaxFileUpload(index);
						$(".shadd[data-select="+index+"]").show();
					});
			}
			$('#'+index).click();
    }
    function ajaxFileUpload(img) {
			$("."+img).css({"width":"0px"});
			$("."+img).animate({"width":"100%"},700,function(){
				var id= img;
				$.ajaxFileUpload
				(
					{
						url: '/Appapi/Userreport/upload',
						secureuri: false,
						fileElementId: id,
						data: { },
						dataType: 'html',
						success: function(data) {

                            console.log(data);
							//data=data.replace(/<[^>]+>/g,"");
							var str=JSON.parse(data);
                            //var str=data;
							if(str.ret==200){
								var sub=img.substr(8,1);
								$(".sf"+sub).attr("value",str.data.url);
								$(".shadd[data-select="+img+"]").hide();
								$(".img-sfz[data-index="+img+"]").attr("src",str.data.url_sign);
							}else{
                                layer.msg(str.msg);
								$(".shadd[data-select="+img+"]").hide();
							}
						},
						error: function(data) {
							console.log(data);
							layer.msg("上传失败");
							$(".shadd[data-select="+img+"]").hide();
						}
					}
				)
				return true;
			});
    }
    (function(){

        var issubmit=false;

        $(".report_con_bottom").click(function(){
            if(issubmit){
                return !1;
            }
            
            var classify=$('input[name="classify"]:checked ').val();
            var thumb=$("#thumb").val();
            var content=$("#content").val();
            //var contactMsg=$("#contactMsg").val();
            var contactMsg='';
            
            if(classify==""){
                layer.msg("请选择举报类型");
                return !1;
            }
            if(content==''){
                layer.msg("请填写反馈内容");
                return !1;
            }

            /*if(contactMsg==""){
                layer.msg("请填写联系方式");
                return !1;
            }*/

            /* if(hasEmoji(content)){
                layer.msg("不能含有表情");
                return !1;
            } */
            issubmit=true;
            $.ajax({
                url:'/Appapi/Userreport/save',
                type:'POST',
                data:{uid:uid,token:token,touid:touid,classify:classify,thumb:thumb,content:content,contactMsg:contactMsg},
                dataType:'json',
                success:function(data){
                    issubmit=false;
                    /*layer.msg(data.msg);
                    if(data.code==0){
                        $("#thumb").val('');
                        $("#content").val('');
                        $("#contactMsg").val('');
                        $("#input_nums").text("0");
                        $(".img-sfz").attr('src','/public/appapi/userreport/images/upload.png');
                    }*/

                    if(data.code==0){
                        layer.msg('举报成功', {time:500},function(){
                        //window.location.reload();
                        location.href="userreport://";
                        });
                    }else{
                        layer.msg(data.msg);
                    }
                    

                    
                },
                error:function(data){

                    layer.msg("提交失败");
                    return !1;
                }
                
            })
            
        })
    })();




    $(function(){
    	var scrW=$(window).width();
    	var report_conBodyW=$(".report_con_tel").width();
    	var report_conTelNameW=$(".report_con_tel_name").width();
    	console.log(report_conTelNameW);
    	$(".report_con_tel_con").width(report_conBodyW-report_conTelNameW);

        $("#content").on('blur keyup input',function(){  
            var text=$("#content").val();  
            var counter=text.length;  
            $("#input_nums").text(counter);  
        });  
    });