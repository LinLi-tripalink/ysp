<?php /*a:2:{s:81:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/userauth/edit.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
			<li ><a href="<?php echo url('userauth/index'); ?>">认证申请</a></li>
			<li class="active"><a >编辑</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('userauth/edit_post'); ?>">
		   <input type="hidden" name="uid" value="<?php echo $auth['uid']; ?>">
			<fieldset>

				<div class="form-group" >
					<label for="input-user_nicename" class="col-sm-2 control-label"><span class="form-required">*</span>会员</label>
					<div class="col-md-6 col-sm-10">
						<input type="text"class="form-control" id="input-user_nicename" value="<?php echo $auth['userinfo']['user_nicename']; ?> ( <?php echo $auth['uid']; ?> )" readonly>
					</div>
				</div>
				
				
				
				<div class="form-group" >
					<label for="input-real_name" class="col-sm-2 control-label"><span class="form-required">*</span>真实姓名</label>
					<div class="col-md-6 col-sm-10">
						<input type="text"class="form-control" id="input-real_name"  name="" value="<?php echo $auth['real_name']; ?>" readonly>
					</div>
				</div>
				
				
				<div class="form-group" >
					<label for="input-mobile" class="col-sm-2 control-label"><span class="form-required">*</span>手机号码</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" id="input-mobile"  name=""  value="<?php echo $auth['mobile']; ?>" readonly>
					</div>
				</div>
				
				<div class="form-group" >
					<label for="input-cer_no" class="col-sm-2 control-label"><span class="form-required">*</span>证件号</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" id="input-cer_no"  name=""  value="<?php echo $auth['cer_no']; ?>" readonly>
					</div>
				</div>
				
				
				<div class="form-group" >
					<label for="input-front_view" class="col-sm-2 control-label"><span class="form-required">*</span>证件正面</label>
					<div class="col-md-6 col-sm-10">
						<!-- <input type="hidden" class="form-control" id="input-front_view"  name="front_view"  value="<?php echo $auth['front_view']; ?>" readonly> -->
	
						<img src="<?php echo get_upload_path($auth['front_view']); ?>" class="imgtip" width="135" style="cursor: hand">
					</div>
				</div>
				
				<div class="form-group" >
					<label for="input-back_view" class="col-sm-2 control-label"><span class="form-required">*</span>证件反面</label>
					<div class="col-md-6 col-sm-10">
						<!-- <input type="hidden" class="form-control" id="input-back_view"  name="back_view"  value="<?php echo $auth['back_view']; ?>" readonly> -->
						<img src="<?php echo get_upload_path($auth['back_view']); ?>" class="imgtip" width="135" style="cursor: hand">
					</div>
				</div>
				
				<div class="form-group" >
					<label for="input-handset_view" class="col-sm-2 control-label"><span class="form-required">*</span>手持证件照</label>
					<div class="col-md-6 col-sm-10">
						<!-- <input type="hidden" class="form-control" id="input-handset_view"  name="handset_view"  value="<?php echo $auth['handset_view']; ?>" readonly> -->
						<img src="<?php echo get_upload_path($auth['handset_view']); ?>" class="imgtip" width="135" style="cursor: hand">
					</div>
				</div>

				
				<div class="form-group">
					<label for="input-status" class="col-sm-2 control-label"><span class="form-required">*</span>审核状态</label>
					<div class="col-md-6 col-sm-10">
						<label class="radio-inline"><input type="radio" name="status" value="2" <?php if($auth['status'] == '2'): ?>checked<?php endif; ?>>失败</label>
						<label class="radio-inline"><input type="radio" name="status" value="0" <?php if($auth['status'] == '0'): ?>checked<?php endif; ?>>处理中</label>
						<label class="radio-inline"><input type="radio" name="status" value="1" <?php if($auth['status'] == '1'): ?>checked<?php endif; ?>>成功</label>
					</div>
				</div>
				
				
				<div class="form-group" style="display:none">
					<label for="input-reason" class="col-sm-2 control-label"><span class="form-required">*</span>失败原因</label>
					<div class="col-md-6 col-sm-10">
						<textarea class="form-control"  rows="2" cols="20" id="input-reason" name="reason" style="height: 100px; width: 500px;" ><?php echo $auth['reason']; ?></textarea> 
					</div>
				</div>	
				
				

			</fieldset>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('EDIT'); ?></button>
				<a class="btn btn-default" href="<?php echo url('Userauth/index'); ?>"><?php echo lang('BACK'); ?></a>
				</div>
			</div>
		</form>
	</div>
	<script src="/static/js/admin.js"></script>
</body>
</html>