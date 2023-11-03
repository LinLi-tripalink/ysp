<?php /*a:2:{s:85:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/votesrecord/index.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
			<li class="active"><a ><?php echo $name_votes; ?>收入记录</a></li>
		</ul>
		<form class="well form-inline margin-top-20" name="form1" method="post" action="">
            收入行为：
            <select class="form-control" name="type">
				<option value="">全部</option>
                <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $key; ?>" <?php if(input('request.type') != '' && input('request.type') == $key): ?>selected<?php endif; ?>><?php echo $v; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
			</select>

			收入时间：
			<input class="form-control js-bootstrap-date" name="start_time" id="start_time" value="<?php echo input('request.start_time'); ?>" aria-invalid="false" style="width: 110px;" autocomplete="off"> - 
            <input class="form-control js-bootstrap-date" name="end_time" id="end_time" value="<?php echo input('request.end_time'); ?>" aria-invalid="false" style="width: 110px;" autocomplete="off">
            收入会员：
            <input class="form-control" type="text" name="uid" style="width: 200px;" value="<?php echo input('request.uid'); ?>"
                   placeholder="请输入用户ID">

            上级会员：
            <input class="form-control" type="text" name="touid" style="width: 200px;" value="<?php echo input('request.touid'); ?>"
                   placeholder="请输入用户ID">
			
            <input type="button" class="btn btn-primary" value="搜索" onclick="form1.action='<?php echo url('Votesrecord/index'); ?>';form1.submit();"/>
            <a class="btn btn-danger" href="<?php echo url('Admin/Votesrecord/index'); ?>">清空</a>
			<input type="button" class="btn btn-success" value="导出" onclick="form1.action='<?php echo url('Votesrecord/export'); ?>';form1.submit();"/>	
            
	
		</form>	
    	
		<form method="post" class="js-ajax-form" >
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>收支行为</th>
						<th>会员(ID)</th>
						<th>上级会员(ID)</th>
						<th><?php echo $name_votes; ?></th>
						<th>上级<?php echo $name_votes; ?></th>
						<th>时间</th>
						<!-- <th><?php echo lang('ACTIONS'); ?></th> -->
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
					<tr>
						<td><?php echo $vo['id']; ?></td>
						<td><?php echo $type[$vo['action']]; ?></td>
						<td><?php echo $vo['userinfo']['user_nicename']; ?> ( <?php echo $vo['uid']; ?> )</td>	
						<td>
							<?php if(empty($vo['touserinfo'])): ?>
								--
							<?php else: ?>
								<?php echo $vo['touserinfo']['user_nicename']; ?> ( <?php echo $vo['touid']; ?> )
							<?php endif; ?>
						</td>
						<td><?php echo $vo['votes']; ?></td>
						<td><?php echo $vo['touid_votes']; ?></td>
						<td><?php echo date('Y-m-d H:i:s',$vo['addtime']); ?></td>
						<!-- <td>	
                            <?php if($vo['status'] == 0): ?>
                            <a class="btn btn-xs btn-danger js-ajax-dialog-btn" href="<?php echo url('Votesrecord/del',array('id'=>$vo['id'])); ?>" data-msg="您确定要删除吗？">删除</a>
                            <?php endif; ?>
						</td> -->
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