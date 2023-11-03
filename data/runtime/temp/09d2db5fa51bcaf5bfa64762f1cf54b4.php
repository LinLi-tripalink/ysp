<?php /*a:2:{s:81:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/liveing/index.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
			<li class="active"><a >直播列表</a></li>
			<li><a href="<?php echo url('Liveing/add'); ?>">添加视频</a></li>
			
		</ul>
		
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('Liveing/index'); ?>">
			时间：	
			<input type="text" name="start_time" class="js-bootstrap-date form-control" value="<?php echo input('request.start_time'); ?>" autocomplete="off" placeholder="开始时间">-
			<input type="text" name="end_time" class="js-bootstrap-date form-control" value="<?php echo input('request.end_time'); ?>" autocomplete="off" placeholder="结束时间">&nbsp; &nbsp;
			关键字：			
			<input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>" placeholder="请输入会员ID">			
			<input type="submit" class="btn btn-primary" value="搜索"/>
			<a class="btn btn-danger" href="<?php echo url('Admin/Liveing/index'); ?>">清空</a>
		</form>

		<form method="post" class="js-ajax-form" action="">
			
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>编号</th>
						<th align="center">会员昵称</th>
						<th align="center">直播ID</th>
						<th align="center">直播分类</th>
						<th align="center">直播状态</th>
						<th align="center">直播开始时间</th>
						<th align="center">在线人数</th>
						<th align="center">本场收益</th>
						<th align="center">打赏人数</th>
						<th align="center">人均打赏</th>
						<th align="center">播流地址</th>
						<th align="center">设备信息</th>
						<th align="center"><?php echo lang('ACTIONS'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $islive=array("0"=>"直播结束","1"=>"直播中"); if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
					<tr>
						<td align="center"><?php echo $vo['uid']; ?></td>
						<td align="center"><?php echo $vo['userinfo']['user_nicename']; ?></td>
						<td align="center"><?php echo $vo['showid']; ?></td>
						<td align="center"><?php echo $liveclass[$vo['liveclassid']]; ?></td>
						<td align="center"><?php echo $islive[$vo['islive']]; ?></td>
						<td align="center"><?php echo date('Y-m-d H:i:s',$vo['starttime']); ?></td>
						<td align="center"><?php echo $vo['nums']; ?></td>
						<td align="center"><?php echo $vo['totalcoin']; ?></td>
						<td align="center"><?php echo $vo['total_nums']; ?></td>
						<td align="center"><?php echo $vo['total_average']; ?></td>
						<td align="center"><?php echo $vo['pull']; ?></td>
						<td align="center"><?php echo $vo['deviceinfo']; ?></td>
						<td align="center">
							<?php if($vo['isvideo'] == '1'): ?>
								<a class="btn btn-xs btn-primary" href="<?php echo url('Liveing/edit',array('uid'=>$vo['uid'])); ?>" >编辑</a>

								<a class="btn btn-xs btn-danger  js-ajax-dialog-btn" href="<?php echo url('Liveing/del',array('id'=>$vo['uid'])); ?>" data-msg="您确定要删除吗？">删除</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			<div class="pagination"><?php echo $page; ?></div>
		</form>
	</div>
	<script src="/static/js/admin.js"></script>
</body>
</html>