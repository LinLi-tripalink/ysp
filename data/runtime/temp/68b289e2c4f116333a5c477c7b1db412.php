<?php /*a:2:{s:83:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/adminpost/index.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo url('Adminpost/index'); ?>">文章管理</a></li>
			<li><a href="<?php echo url('Adminpost/add'); ?>">添加文章</a></li>
		</ul>
        <form class="well form-inline margin-top-20" method="post" action="<?php echo url('Adminpost/index'); ?>">
			分类:
			<select name="termid" class="form-control" style="width: 150px;">
				<option value="">全部</option>
				<?php if(is_array($terms_list) || $terms_list instanceof \think\Collection || $terms_list instanceof \think\Paginator): $i = 0; $__LIST__ = $terms_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<option value="<?php echo $vo['id']; ?>" <?php if($_GET['termid'] ==  $vo['id']): ?> selected<?php endif; ?>><?php echo $vo['name']; ?></option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</select>&nbsp;&nbsp;
            文章ID:
            <input type="text" class="form-control" name="id" style="width: 200px;" value="<?php echo $_GET['id']; ?>" placeholder="请输入文章ID..." oninput = "value=value.replace(/[^\d]/g,'')">&nbsp;&nbsp;
            关键字:
            <input type="text" class="form-control" name="keyword" style="width: 200px;" value="<?php echo $_GET['keyword']; ?>" placeholder="请输入标题、关键词...">
            <input type="submit" class="btn btn-primary" value="搜索" />
            <a class="btn btn-danger" href="<?php echo url('Adminpost/index'); ?>">清空</a>
        </form>
		<form class="js-ajax-form" action="" method="post">
			<div class="table-actions">
				<button class="btn btn-primary btn-small js-ajax-submit" data-action="<?php echo url('Adminpost/listordersset'); ?>" type="submit"><?php echo lang('SORT'); ?></button>
				
				<!--<button class="btn btn-primary btn-small js-ajax-submit" type="submit" data-action="<?php echo url('Adminpost/check',array('check'=>1)); ?>" data-subcheck="true">审核</button>
				<button class="btn btn-primary btn-small js-ajax-submit" type="submit" data-action="<?php echo url('Adminpost/check',array('check'=>0)); ?>" data-subcheck="true">取消审核</button>
				
				<button class="btn btn-primary btn-small js-ajax-submit" type="submit" data-action="<?php echo url('Adminpost/tops',array('top'=>1)); ?>" data-subcheck="true">置顶</button>
				<button class="btn btn-primary btn-small js-ajax-submit" type="submit" data-action="<?php echo url('Adminpost/tops',array('top'=>0)); ?>" data-subcheck="true">取消置顶</button>-->
				<button class="btn btn-danger btn-small js-ajax-submit" type="submit" data-action="<?php echo url('Adminpost/deletes'); ?>" data-subcheck="true" data-msg="您确定删除吗？"><?php echo lang('DELETE'); ?></button>
				
				
		
			</div>
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th width="15"><label><input type="checkbox" class="js-check-all" data-direction="x" data-checklist="js-check-x"></label></th>
						<th>序号</th>
						<th width="50">ID</th>
						<th>标题</th>
						<th>地址</th>
						<th>作者</th>
						<th>分类</th>
						<!-- <th>点击量</th> -->
						<!-- <th>关键字/来源/摘要/缩略图</th> -->
						<!-- <th>相关阅读</th> -->
						<th>发布时间</th>
						<!-- <th>状态</th> -->
						<th width="140"><?php echo lang('ACTIONS'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($posts) || $posts instanceof \think\Collection || $posts instanceof \think\Paginator): if( count($posts)==0 ) : echo "" ;else: foreach($posts as $key=>$vo): ?>
					<tr>
						<td><input type="checkbox" class="js-check" data-yid="js-check-y" data-xid="js-check-x" name="ids[]" value="<?php echo $vo['id']; ?>" title="ID:<?php echo $vo['id']; ?>"></td>
						<td><input name="listordersset[<?php echo $vo['id']; ?>]" type="text" size="3" value="<?php echo $vo['orderno']; ?>" class="input input-order"></td>
						<td><b><?php echo $vo['id']; ?></b></td>
						<td><?php echo $vo['post_title']; ?></td>
						<td><a href="<?php echo $site; ?>/Appapi/page/news?id=<?php echo $vo['id']; ?>" target="_blank"><?php echo $site; ?>/Appapi/page/news?id=<?php echo $vo['id']; ?></a></td>
						<td><?php echo $vo['userinfo']['user_nicename']; ?></td>
						<td><?php echo $vo['termsinfo']['name']; ?></td>
						<!-- <td><?php echo $vo['post_hits']; ?></td>
						<td>
							<?php if(!(empty($vo['post_keywords']) || (($vo['post_keywords'] instanceof \think\Collection || $vo['post_keywords'] instanceof \think\Paginator ) && $vo['post_keywords']->isEmpty()))): ?>
								<i class="fa fa-check fa-fw"></i>
							<?php else: ?>
								<i class="fa fa-close fa-fw"></i> 
							<?php endif; if(!(empty($vo['post_source']) || (($vo['post_source'] instanceof \think\Collection || $vo['post_source'] instanceof \think\Paginator ) && $vo['post_source']->isEmpty()))): ?>
								<i class="fa fa-check fa-fw"></i>
							<?php else: ?>
								<i class="fa fa-close fa-fw"></i> 
							<?php endif; if(!(empty($vo['post_excerpt']) || (($vo['post_excerpt'] instanceof \think\Collection || $vo['post_excerpt'] instanceof \think\Paginator ) && $vo['post_excerpt']->isEmpty()))): ?>
								<i class="fa fa-check fa-fw"></i>
							<?php else: ?>
								<i class="fa fa-close fa-fw"></i> 
							<?php endif; if(!(empty($vo['smeta']) || (($vo['smeta'] instanceof \think\Collection || $vo['smeta'] instanceof \think\Paginator ) && $vo['smeta']->isEmpty()))): ?>
								<a onclick="image_preview_dialog('<?php echo cmf_get_image_url($vo['smeta']); ?>');">
									<i class="fa fa-photo fa-fw"></i>
								</a>
							<?php endif; ?>
						</td>
						<td><?php echo $vo['post_relevant']; ?></td> -->
						<td><?php echo date('Y-m-d H:i:s',$vo['post_date']); ?></td>
						
						<!--<td>
							<?php if(!(empty($vo['post_status']) || (($vo['post_status'] instanceof \think\Collection || $vo['post_status'] instanceof \think\Paginator ) && $vo['post_status']->isEmpty()))): ?>
								<a data-toggle="tooltip" title="已审核"><i class="fa fa-check"></i></a>
								<?php else: ?>
								<a data-toggle="tooltip" title="未审核"><i class="fa fa-close"></i></a>
							<?php endif; if(!(empty($vo['istop']) || (($vo['istop'] instanceof \think\Collection || $vo['istop'] instanceof \think\Paginator ) && $vo['istop']->isEmpty()))): ?>
								<a data-toggle="tooltip" title="已置顶"><i class="fa fa-arrow-up"></i></a>
								<?php else: ?>
								<a data-toggle="tooltip" title="未置顶"><i class="fa fa-arrow-down"></i></a>
							<?php endif; ?>
						</td>-->
						<td>
							<a class="btn btn-xs btn-primary" href="<?php echo url('Adminpost/edit',array('id'=>$vo['id'])); ?>"><?php echo lang('EDIT'); ?></a>
							<a class="btn btn-xs btn-danger js-ajax-delete" class="" href="<?php echo url('Adminpost/del',array('id'=>$vo['id'])); ?>"><?php echo lang('DELETE'); ?></a>
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