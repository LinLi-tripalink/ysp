<?php /*a:2:{s:82:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/music/classify.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
			<li class="active"><a >音乐分类</a></li>
			<li><a href="<?php echo url('Music/classify_add'); ?>">添加</a></li>
		</ul>
		
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('Music/classify'); ?>">
			关键字：			
			<input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>" placeholder="分类名称">			
			<input type="submit" class="btn btn-primary" value="搜索"/>
			<a class="btn btn-danger" href="<?php echo url('Admin/Music/classify'); ?>">清空</a>
		</form>

		<form method="post" class="js-ajax-form" action="<?php echo url('Music/classify_listorders'); ?>">
			<div class="table-actions">
				<button class="btn btn-primary btn-small js-ajax-submit" type="submit"><?php echo lang('SORT'); ?></button>
			</div>
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>序号</th>
						<th align="center">ID</th>
						<th>分类名称</th>
						<th>分类图标</th>
						<th>添加时间</th>
						<th>修改时间</th>
						<th>是否删除</th>
						<th align="center"><?php echo lang('ACTIONS'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $isdel=array("0"=>"否","1"=>"是"); if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
					<tr>
						<td><input name="listorders[<?php echo $vo['id']; ?>]" type="text" size="3" value="<?php echo $vo['orderno']; ?>" class="input input-order"></td>
						<td align="center"><?php echo $vo['id']; ?></td>
						<td><?php echo $vo['title']; ?></td>
						<td><img src="<?php echo get_upload_path($vo['img_url']); ?>" class="imgtip" width="50px" height="50px"></td>
					
						
						<td><?php echo date('Y-m-d H:i:s',$vo['addtime']); ?></td>
						<td><?php if($vo['updatetime'] != '0'): ?><?php echo date('Y-m-d H:i:s',$vo['updatetime']); else: ?>--<?php endif; ?></td>
						
						<td><?php echo $isdel[$vo['isdel']]; ?></td>
						<td align="center">
							<a class="btn btn-xs btn-primary" href="<?php echo url('Music/classify_edit',array('id'=>$vo['id'])); ?>" >编辑</a>
							<?php if($vo['isdel'] == '0'): ?>
							<a class="btn btn-xs btn-danger  js-ajax-dialog-btn" href="<?php echo url('Music/classify_del',array('id'=>$vo['id'])); ?>" data-msg="您确定要删除吗？删除后对应分类下的音乐将不显示">删除</a>
							<?php else: ?>
							<a class="btn btn-xs btn-danger js-ajax-dialog-btn" href="<?php echo url('Music/classify_canceldel',array('id'=>$vo['id'])); ?>"  data-msg="您确定要取消删除吗？">取消删除</a>
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