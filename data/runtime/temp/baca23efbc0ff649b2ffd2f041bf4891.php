<?php /*a:2:{s:82:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/userauth/index.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
			<li class="active"><a >认证申请</a></li>

		</ul>

		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('userauth/index'); ?>">
		  审核状态：			
			<select class="form-control" name="status" style="width: 200px;">
				<option value="">全部</option>
				<option value="0" <?php if(input('request.status') == '0'): ?>selected<?php endif; ?> >处理中</option>
				<option value="1" <?php if(input('request.status') == '1'): ?>selected<?php endif; ?>>审核成功</option>
				<option value="2" <?php if(input('request.status') == '2'): ?>selected<?php endif; ?>>审核失败</option>
				
			</select>&nbsp; &nbsp;

			提交时间：	
			<input type="text" name="start_time" class="js-bootstrap-date form-control" value="<?php echo input('request.start_time'); ?>" autocomplete="off" placeholder="开始时间">-
			<input type="text" name="end_time" class="js-bootstrap-date form-control" value="<?php echo input('request.end_time'); ?>" autocomplete="off" placeholder="结束时间">&nbsp; &nbsp;
						

			关键字：			
			<input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>"
               placeholder="会员ID/姓名/手机">
			<input type="submit" class="btn btn-primary" value="搜索"/>
			<a class="btn btn-danger" href="<?php echo url('Admin/userauth/index'); ?>">清空</a>
		</form>				
		<form method="post" class="js-ajax-form">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th align="center">会员ID</th>
						<th>会员</th>						
						<th>真实姓名</th>
						<th>手机号码</th>
						<th>审核状态</th>
						<th>提交时间</th>
						<th>处理时间</th>
						<th><?php echo lang('ACTIONS'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $status=array("0"=>"处理中","1"=>"审核成功", "2"=>"审核失败"); if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
					<tr>
						<td align="center"><?php echo $vo['uid']; ?></td>
						<td><?php echo $vo['userinfo']['user_nicename']; ?> </td>	
						<td><?php echo $vo['real_name']; ?></td>
						<td><?php echo $vo['mobile']; ?></td>				
						<td><?php echo $status[$vo['status']]; ?></td>
						<td><?php echo date('Y-m-d H:i:s',$vo['addtime']); ?></td>						
						<td>
							<?php if($vo['status'] == '0'): ?>
								处理中
							<?php else: if($vo['uptime'] != '0'): ?>
								<?php echo date('Y-m-d H:i:s',$vo['uptime']); else: ?>
								--
								<?php endif; ?>
							<?php endif; ?>
						</td>

						<td align="center">							
							<a class="btn btn-xs btn-primary" href="<?php echo url('userauth/edit',array('id'=>$vo['uid'])); ?>">编辑</a>
							<a class="btn btn-xs btn-danger js-ajax-delete" href="<?php echo url('userauth/del',array('id'=>$vo['uid'])); ?>">删除</a>
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