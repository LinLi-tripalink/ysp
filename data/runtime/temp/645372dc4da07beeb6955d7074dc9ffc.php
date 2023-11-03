<?php /*a:2:{s:78:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/advert/add.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
</head>
<body>
	<div class="wrap">
		<ul class="nav nav-tabs">	
			<li class="active"><a >广告添加</a></li>
		</ul>


		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('Advert/add_post'); ?>">
			<fieldset>				
				

				<div class="form-group" id="owner_uid">
					<label for="input-user_nicename" class="col-sm-2 control-label"><span class="form-required">*</span>所有者用户</label>
					<div class="col-md-6 col-sm-10">
						<!-- <input type="text" class="form-control" name="owner_uid" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');">请填写用户id -->
						
						<select class="select_2 form-control" name="owner_uid">
							<?php if(is_array($adLists) || $adLists instanceof \think\Collection || $adLists instanceof \think\Paginator): $i = 0; $__LIST__ = $adLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo $vo['id']; ?>" ><?php echo $vo['user_nicename']; ?>(<?php echo $vo['id']; ?>)</option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						
					</div>
				</div>
				
				
				
				<div class="form-group" >
					<label for="input-title" class="col-sm-2 control-label"><span class="form-required">*</span>广告标题</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" id="input-title"  name="title"  />
					</div>
				</div>
				
				<div class="form-group">
					<label for="input-user_login" class="col-sm-2 control-label"><span class="form-required">*</span>广告封面</label>
					<div class="col-md-6 col-sm-10">
						<input type="hidden" name="thumb" id="thumbewm" value="">
						<a href="javascript:uploadOneImage('图片上传','#thumbewm');">
							<img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png" id="thumbewm-preview" style="cursor: pointer;max-width:150px;max-height:150px;"/>
						</a>
						<input type="button" class="btn btn-sm btn-cancel-thumbewm" value="取消图片">
					</div>
				</div>
				
				
				<div class="form-group" >
					<label for="input-ad_endtime" class="col-sm-2 control-label">到期时间</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="js-bootstrap-date form-control" id="input-ad_endtime"  name="ad_endtime" autocomplete="off"  />
					</div>
				</div>

				
				<div class="form-group">
					<label for="input-video_upload_type" class="col-sm-2 control-label"><span class="form-required">*</span>视频上传型式</label>
					<div class="col-md-6 col-sm-10">
						<label class="radio-inline"><input type="radio" name="video_upload_type" value="0" checked>视频链接</label>
						<label class="radio-inline"><input type="radio" name="video_upload_type" value="1" >视频文件</label>
					</div>
				</div>

				
				
				
				<div class="form-group video_url_area" >
					<label for="input-href" class="col-sm-2 control-label"><span class="form-required">*</span>视频链接</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" id="input-href"  name="href"  />以http://或https://开头
					</div>
				</div>
				
				<div class="form-group upload_video_area" style="display: none;">
					<label for="input-file" class="col-sm-2 control-label">上传视频</label>
					<div class="col-md-6 col-sm-10">
						<input type="file" class="form-control" id="input-file"  name="file"  />
					</div>
				</div>

				<div class="form-group" >
					<label for="input-ad_url" class="col-sm-2 control-label">广告外链</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" id="input-ad_url"  name="ad_url"  />
					</div>
				</div>

			</fieldset>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('ADD'); ?></button>
					<a class="btn btn-default" href="<?php echo url('Advert/index'); ?>"><?php echo lang('BACK'); ?></a>
				</div>
			</div>
		</form>
	</div>
	<script src="/static/js/admin.js"></script>
	<script type="text/javascript">
		$(function(){

			$("input[name='video_upload_type']").click(function(){
				var val=$("input[name='video_upload_type']:checked").val();
				console.log(val);
				if(val==0){
					$(".video_url_area").show();
					$(".upload_video_area").hide();
				}else{
					$(".video_url_area").hide();
					$(".upload_video_area").show();
					$("input[name='href']").val('');
				}
			});
			
			
			$('.btn-cancel-thumbewm').click(function () {
				$('#thumbewm-preview').attr('src', '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png');
				$('#thumbewm').val('');
			});

			

		});
	</script>
</body>
</html>