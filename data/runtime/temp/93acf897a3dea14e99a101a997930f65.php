<?php /*a:2:{s:82:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/user/admin_index/add.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
﻿<!DOCTYPE html>
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
	<div class="wrap js-check-wrap">

		<ul class="nav nav-tabs">
			<li><a  href="<?php echo url('user/adminIndex/index'); ?>"><?php echo lang('USER_INDEXADMIN_INDEX'); ?></a></li>
			<li class="active"><a>新增会员</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('user/adminIndex/add_post'); ?>">
			<fieldset>

				<div class="form-group">
	                <label for="input-maintain_switch" class="col-sm-2 control-label"><span class="form-required">*</span>选择国家/地区</label>
	                <div class="col-md-6 col-sm-10">
	                    <select class="form-control" name="country_code">
	                    	<option value="">--选择国家/地区--</option>
	                    	<?php if(is_array($country_list) || $country_list instanceof \think\Collection || $country_list instanceof \think\Paginator): if( count($country_list)==0 ) : echo "" ;else: foreach($country_list as $key=>$vo): ?>
	                    		<option value="<?php echo $vo['tel']; ?>"><?php echo $vo['name']; ?></option>
	                    	<?php endforeach; endif; else: echo "" ;endif; ?>
	                    </select>
	                </div>
	            </div>

				<div class="form-group" >
					<label for="input-user_login" class="col-sm-2 control-label"><span class="form-required">*</span>手机号</label>
					<div class="col-md-6 col-sm-10">
						<input type="text"class="form-control" id="input-user_login"  name="user_login" value="">
					</div>
				</div>
				
				
				<div class="form-group" style="display: none;">
					<label for="input-user_login" class="col-sm-2 control-label"><span class="form-required">*</span>密码</label>
					<div class="col-md-6 col-sm-10">
						<input type="password" class="form-control" id="input-user_pass"  name="user_pass" value="qwe123" autocomplete = 'new-password' />
					</div>
				</div>
				
				<div class="form-group" >
					<label for="input-user_nicename" class="col-sm-2 control-label"><span class="form-required">*</span>昵称</label>
					<div class="col-md-6 col-sm-10">
						<input type="text"class="form-control" id="input-user_nicename"  name="user_nicename" value="" maxlength="8"> <p class="help-block">最多8个字</p>
					</div>
				</div>
				
				<div class="form-group">
					<label for="input-avatar" class="col-sm-2 control-label">头像/封面</label>
					<div class="col-md-6 col-sm-10">
						<input type="hidden" name="avatar" id="thumbewm" value="<?php echo $userinfo['avatar']; ?>">
						<a href="javascript:uploadOneImage('图片上传','#thumbewm');">
						<?php if($userinfo['avatar'] != ''): ?>
							<img src="<?php echo cmf_get_image_preview_url($userinfo['avatar']); ?>"
										id="thumbewm-preview"
										style="cursor: pointer;max-width:150px;max-height:150px;"/>
						<?php else: ?>
							<img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png" id="thumbewm-preview" style="cursor: pointer;max-width:150px;max-height:150px;"/>
						<?php endif; ?>
						</a>
						<input type="button" class="btn btn-sm btn-cancel-thumbewm" value="取消图片">
					</div>
				</div>

				<div class="form-group">
					<label for="input-bg_img" class="col-sm-2 control-label">背景图</label>
					<div class="col-md-6 col-sm-10">
						<input type="hidden" name="bg_img" id="bg_img" value="<?php echo $userinfo['bg_img']; ?>">
						<a href="javascript:uploadOneImage('图片上传','#bg_img');">
						<?php if($userinfo['avatar'] != ''): ?>
							<img src="<?php echo cmf_get_image_preview_url($userinfo['avatar']); ?>"
										id="bg_img-preview"
										style="cursor: pointer;max-width:150px;max-height:150px;"/>
						<?php else: ?>
							<img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png" id="bg_img-preview" style="cursor: pointer;max-width:150px;max-height:150px;"/>
						<?php endif; ?>
						</a>
						<input type="button" class="btn btn-sm btn-cancel-bg_img" value="取消图片">
						<p class="help-block">如果头像上传背景图没上传,默认赋值头像;如果头像和背景图都没上传,赋值平台默认头像</p>
					</div>
				</div>

				<div class="form-group">
					<label for="input-sex" class="col-sm-2 control-label"><span class="form-required">*</span>性别</label>
					<div class="col-md-6 col-sm-10">
						<label class="radio-inline"><input type="radio" name="sex" value="1" checked>男</label>
						<label class="radio-inline"><input type="radio" name="sex" value="2" >女</label>
					</div>
				</div>
		

				<div class="form-group">
					<label for="input-signature" class="col-sm-2 control-label">个性签名</label>
					<div class="col-md-6 col-sm-10">
						<textarea class="form-control"  rows="2" cols="20" id="input-signature" name="signature" style="height: 100px; width: 500px;" ></textarea> 
					</div>
				</div>								
				
				
				<div class="form-group">
					<label for="input-user_status" class="col-sm-2 control-label"><span class="form-required">*</span><?php echo lang('STATUS'); ?></label>

					<div class="col-md-6 col-sm-10">
						<label class="radio-inline"><input type="radio" name="user_status" value="1" checked="checked" ><?php echo lang('ENABLED'); ?></label>
						<label class="radio-inline"><input type="radio" name="user_status" value="0" /><?php echo lang('DISABLED'); ?></label>
					</div>
				</div>
				
				
				<div class="form-group">
					<label for="input-is_ad" class="col-sm-2 control-label"><span class="form-required">*</span>是否为广告视频发布者</label>
					<div class="col-md-6 col-sm-10">
						<label class="radio-inline"><input type="radio" name="is_ad" value="0" checked="checked" >否</label>
						<label class="radio-inline"><input type="radio" name="is_ad" value="1" />是</label>
					</div>
				</div>
				
				
			</fieldset>
			
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary js-ajax-submit">添加</button>
					<a class="btn btn-default" href="<?php echo url('user/adminIndex/index'); ?>"><?php echo lang('BACK'); ?></a>
				</div>
			</div>
		
		</form>
	</div>
	<script src="/static/js/admin.js"></script>
	<script type="text/javascript">
		(function(){

			$('.btn-cancel-thumbewm').click(function () {
				$('#thumbewm-preview').attr('src', '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png');
				$('#thumbewm').val('');
			});

			$('.btn-cancel-bg_img').click(function () {
				$('#bg_img-preview').attr('src', '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png');
				$('#bg_img').val('');
			});
			
		})()


	</script>
</body>
</html>