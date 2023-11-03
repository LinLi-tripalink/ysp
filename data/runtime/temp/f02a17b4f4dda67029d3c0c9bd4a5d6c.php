<?php /*a:2:{s:77:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/guide/set.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
<style>
input{
  width:500px;
}
.form-horizontal textarea{
 width:500px;
}
.nav-tabs>.current>a{
    color: #95a5a6;
    cursor: default;
    background-color: #fff;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
}
.nav li
{
	cursor:pointer
}
.nav li:hover
{
	cursor:pointer
}
.hide{
	display:none;
}
</style>
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a >配置</a></li>
			<li><a href="<?php echo url('Guide/index'); ?>">管理</a></li>
		</ul>
		
		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('Guide/set_post'); ?>">
			<div class="js-tabs-content">
				<!-- 网站信息 -->
				<div>
					<fieldset>
					
						
						
						<div class="form-group">
                            <label for="input-banned_usernames" class="col-sm-2 control-label">引导页开关</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="post[switch]">
                                    <option value="0">否</option>
                                    <?php 
                                        $open_switch_selected = empty($config['switch'])?'':'selected';
                                     ?>
                                    <option value="1" <?php echo $open_switch_selected; ?>>是</option>
                                </select>
                            </div>
                        </div>

						<div class="form-group">
                            <label for="input-banned_usernames" class="col-sm-2 control-label">引导页类型</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="post[type]">
                                    <option value="0">图片</option>
                                    <?php 
                                        $open_type_selected = empty($config['type'])?'':'selected';
                                     ?>
                                    <option value="1" <?php echo $open_type_selected; ?>>视频</option>
                                </select>
                            </div>
                        </div>
						
						
						<?php 
							$open_type_none = empty($config['type'])?'':"style='display:none'";
						 ?>	
						<div class="form-group" <?php echo $open_type_none; ?>>
						 
						
                            <label for="input-time" class="col-sm-2 control-label">图片展示时间</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-time" name="post[time]"
                                       value="<?php echo (isset($config['time']) && ($config['time'] !== '')?$config['time']:''); ?>">
                            </div>
                        </div>
                        

						
					</fieldset>
				</div>

			</div>
		
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('SAVE'); ?></button>
					<a class="btn btn-default" href="javascript:history.back(-1);"><?php echo lang('BACK'); ?></a>
				</div>
			</div>
		</form>
	</div>
	<script src="/static/js/admin.js"></script>

</body>
</html>