<?php /*a:2:{s:83:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/pushmessage/add.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->


    <link href="/themes/admin_simpleboot3/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/admin_simpleboot3/public/assets/simpleboot3/css/simplebootadmin.css" rel="stylesheet">
    <link href="/static/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        form .input-order {
            margin-bottom: 0px;
            padding: 0 2px;
            width: 42px;
            font-size: 12px;
        }

        form .input-order:focus {
            outline: none;
        }

        .table-actions {
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 0px;
        }

        .table-list {
            margin-bottom: 0px;
        }

        .form-required {
            color: red;
        }
    </style>
    <script type="text/javascript">
        //全局变量
        var GV = {
            ROOT: "/",
            WEB_ROOT: "/",
            JS_ROOT: "static/js/",
            APP: '<?php echo app('request')->module(); ?>'/*当前应用名*/
        };
    </script>
    <script src="/themes/admin_simpleboot3/public/assets/js/jquery-1.10.2.min.js"></script>
    <script src="/static/js/wind.js"></script>
    <script src="/themes/admin_simpleboot3/public/assets/js/bootstrap.min.js"></script>
    <script>
        Wind.css('artDialog');
        Wind.css('layer');
        $(function () {
            $("[data-toggle='tooltip']").tooltip({
                container:'body',
                html:true,
            });
            $("li.dropdown").hover(function () {
                $(this).addClass("open");
            }, function () {
                $(this).removeClass("open");
            });
        });
    </script>
    <?php if(APP_DEBUG): ?>
        <style>
            #think_page_trace_open {
                z-index: 9999;
            }
        </style>
    <?php endif; ?>
<style type="text/css">
	#linkUrl{
		display: none;
	}
</style>
</head>
<body>
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li ><a href="<?php echo url('Pushmessage/index'); ?>">通知记录</a></li>
			<li class="active"><a >通知添加</a></li>
		</ul>
		<form method="post" class="form-horizontal  margin-top-20">
			<fieldset>
				<div class="form-group" >
					<label for="input-title" class="col-sm-2 control-label"><span class="form-required">*</span>消息标题</label>
					<div class="col-md-6 col-sm-10">
						<input type="text"class="form-control" id="title"  name="title" value="">
					</div>
				</div>
				
				
				<div class="form-group" >
					<label for="input-synopsis" class="col-sm-2 control-label"><span class="form-required">*</span>消息简介</label>
					<div class="col-md-6 col-sm-10">
						<textarea class="form-control" name="synopsis" id="synopsis" style="height: 150px;"></textarea>
					</div>
				</div>

				
				<div class="form-group">
					<label for="input-msg_type" class="col-sm-2 control-label">消息类型</label>
					<div class="col-md-6 col-sm-10">
						<label class="radio-inline"><input type="radio" name="msg_type" value="1" checked>文本类型</label>
						<label class="radio-inline"><input type="radio" name="msg_type" value="2" >外部链接</label>
					</div>
				</div>
				
				<div class="form-group" id="msg_con">
					<label for="input-content" class="col-sm-2 control-label">消息内容</label>
					<div class="col-md-6 col-sm-10">
						<script type="text/plain" id="content" style="width: 100%;" name="content"></script>
					</div>
				</div>
				
				<div class="form-group" id="linkUrl">
					<label for="input-url" class="col-sm-2 control-label">外部链接</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" name="url" id="url">
					</div>
				</div>

			</fieldset>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<div  class="btn btn-primary" id="submit">添加</div>
					<a class="btn btn-default" href="<?php echo url('pushmessage/index'); ?>"><?php echo lang('BACK'); ?></a>
				</div>
			</div>
			
		
		</form>
	</div>
	<script src="/static/js/admin.js"></script>
	<script type="text/javascript" src="/static/layer/layer.js"></script>
	<script type="text/javascript">
		//编辑器路径定义
		var editorURL = GV.DIMAUB;
	</script>
	<script type="text/javascript" src="/static/js/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="/static/js/ueditor/ueditor.all.min.js"></script>

	<script type="text/javascript">

		var isPush=0;

		$(function(){
			//编辑器
			editorcontent = new baidu.editor.ui.Editor();
			editorcontent.render('content');
			try {
				editorcontent.sync();
			} catch (err) {
			}

			//切换消息类型
			$("input[name='msg_type']").click(function(){
				var val=$(this).val();
				if(val==1){
					$("#linkUrl").hide();
					$("#msg_con").show();
				}else{
					$("#msg_con").hide();
					$("#linkUrl").show();
				}
			});

			$("#submit").click(function(){

				if(isPush==1){
					return;
				}

				var title=$("#title").val();
				var synopsis=$("#synopsis").val();
				var msg_type=$('input[name="msg_type"]:checked').val();
				var url=$('#url').val();

				var ue = UE.getEditor('content');

				var content=ue.getContent();

				if(title==""){
					layer.msg("请填写标题");
					return;
				}

				if(synopsis==""){
					layer.msg("请填写简介");
					return;
				}

				if(msg_type==2){
					if(url==""){
						layer.msg("请填写链接地址");
						return;
					}
				}

				isPush=1;
				$("#submit").attr("disabled",true).text("添加中……");

				$.ajax({
					url: '/admin/pushmessage/add_post.html',
					type: 'POST',
					dataType: 'json',
					data: {title:title,synopsis:synopsis,msg_type:msg_type,content:content,url:url},

					
					success:function(data){
						var code=data.code;
						if(code!=0){
							layer.msg(data.msg);
							return;
						}
						
						layer.msg("消息添加成功",{time:1000},function(){
							layer.closeAll('dialog');
							location.reload();
						});
						
						

					},
					error:function(e){
						isPush=0;
						$("#submit").attr("disabled",false).text("添加");
						
						layer.msg("消息添加失败",{time:1000},function(){
							layer.closeAll('dialog');
							location.reload();
						});
					}
				});
				
				
			});

	});


	</script>
</body>
</html>