<?php /*a:2:{s:78:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/manual/add.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
			<li ><a href="<?php echo url('Manual/index'); ?>">手动充值记录</a></li>
			<li class="active"><a >手动充值</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('Manual/add_post'); ?>">
			<fieldset>
				
				<div class="form-group" >
					<label for="input-user_login" class="col-sm-2 control-label"><span class="form-required">*</span>会员ID</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" id="input-user_login" name="user_login" />
					</div>
				</div>
				
				<div class="form-group" >
					<label for="input-coin" class="col-sm-2 control-label"><span class="form-required">*</span>充值点数</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" id="input-coin" name="coin" maxlength="7" onkeyup="this.value=this.value.replace(/[^\d-]/g,'')" />
						<p class="help-block">注(最多7位数): 填写正数表示加点数, 负数表示扣点数;</p>
					</div>
				</div>


			

			</fieldset>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('ADD'); ?></button>
				<a class="btn btn-default" href="<?php echo url('Manual/index'); ?>"><?php echo lang('BACK'); ?></a>
				</div>
			</div>

		</form>
	</div>
	<script src="/static/js/admin.js"></script>
</body>
</html>