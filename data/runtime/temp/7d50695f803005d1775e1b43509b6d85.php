<?php /*a:2:{s:83:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/shopgoods/index.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
			<li class="active"><a >商品列表</a></li>
			<li ><a href="<?php echo url('Shopgoods/add'); ?>">添加平台自营商品</a></li>

		</ul>
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('Shopgoods/index'); ?>">
		
			<!-- 推荐：
			<select class="form-control" name="isrecom" >
				<option value="">全部</option>
					<option value="1" <?php if(input('request.isrecom') != '' && input('request.isrecom') == 1): ?>selected<?php endif; ?>>是</option>
					<option value="0" <?php if(input('request.isrecom') != '' && input('request.isrecom') == 0): ?>selected<?php endif; ?>>否</option>
			</select> -->

			商品类型：
			<select class="form-control" name="goods_type" >
				<option value="">全部</option>
				<?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<option value="<?php echo $key; ?>" <?php if(input('request.goods_type') != '' && input('request.goods_type') == $key): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
				<?php endforeach; endif; else: echo "" ;endif; ?>
					
			</select>
			
			提交时间：
			<input class="form-control js-bootstrap-date" name="start_time" id="start_time" autocomplete="off" value="<?php echo input('request.start_time'); ?>" aria-invalid="false" style="width: 110px;"> - 
            <input class="form-control js-bootstrap-date" name="end_time" id="end_time" autocomplete="off" value="<?php echo input('request.end_time'); ?>" aria-invalid="false" style="width: 110px;">
			用户： 
            <input class="form-control" type="text" name="uid" style="width: 200px;" value="<?php echo input('request.uid'); ?>"
                   placeholder="请输入会员ID">
            名称： 
            <input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>"
                   placeholder="请输入商品名称">
			<input type="submit" class="btn btn-primary" value="搜索">
			<a class="btn btn-danger" href="<?php echo url('Shopgoods/index'); ?>">清空</a>
		</form>				
		<form method="post" class="js-ajax-form" >
			<div class="table-actions">
                <!-- <button class="btn btn-danger btn-sm js-ajax-submit" type="submit" data-action="<?php echo url('Shopgoods/del'); ?>"
                        data-subcheck="true">批量删除
                </button> -->

                <button class="btn btn-danger btn-sm js-ajax-submit" type="submit" data-action="<?php echo url('Shopgoods/setStatus',array('status'=>'-2')); ?>"
                        data-subcheck="true">批量下架
                </button>

                <button class="btn btn-danger btn-sm js-ajax-submit" type="submit" data-action="<?php echo url('Shopgoods/setStatus',array('status'=>'1')); ?>"
                        data-subcheck="true">批量取消下架
                </button>

                <p class="help-block" style="font-weight: bold;">批量操作请谨慎</p>
            </div>
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th width="16">
							
                            <label>
                                <input type="checkbox" class="js-check-all" data-direction="x" data-checklist="js-check-x">
                            </label>
                        	
                        </th>
						<th>ID</th>
						<th>会员</th>
						<th width="10%">商品名称</th>
						<th width="10%">商品类型</th>
						<th>一级分类</th>
						<th>二级分类</th>
						<th>三级分类</th>
						<th>外链商品地址</th>
						<th>外链商品原价</th>
						<th>外链商品现价</th>
						<th>封面</th>
						<th>邮费</th>
						<th>分享购买佣金</th>
						<th>销量</th>
						<th>状态</th>
						<th>提交时间</th>
						<th><?php echo lang('ACTIONS'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
					<tr>
						<td>
							<?php if($vo['status'] == '1' or $vo['status'] == '-2'): ?>
                            	<input type="checkbox" class="js-check" data-yid="js-check-y" data-xid="js-check-x" name="ids[]" value="<?php echo $vo['id']; ?>">
                            <?php endif; ?>
                        </td>
						<td><?php echo $vo['id']; ?></td>
						<td>
							<?php if($vo['uid'] == '1'): ?>
								平台自营
							<?php else: ?>
								<?php echo $vo['userinfo']['user_nicename']; ?> (<?php echo $vo['uid']; ?>)
							<?php endif; ?>
						</td>
						<td><?php echo $vo['name']; ?></td>
						<td><?php echo $type[$vo['type']]; ?></td>
						<td><?php echo $vo['oneclass_name']; ?></td>
						<td><?php echo $vo['twoclass_name']; ?></td>
						<td><?php echo $vo['threeclass_name']; ?></td>
						<td style="max-width: 200px;word-wrap:break-word;"><?php echo $vo['href']; ?></td>
						<td><?php echo $vo['original_price']; ?></td>
						<td><?php echo $vo['present_price']; ?></td>
						<td><img src="<?php echo $vo['thumb']; ?>" class="imgtip" width="60"></td>
						<td><?php echo $vo['postage']; ?></td>
						<td><?php echo $vo['share_income']; ?></td>
						<td><?php echo $vo['sale_nums']; ?></td>
                        <td><?php echo $status[$vo['status']]; ?></td>
						<td><?php echo date('Y-m-d H:i:s',$vo['addtime']); ?></td>
						<td>
							<?php if($vo['status'] == 0 && $vo['uid'] > 1): ?>
                            	<a class="btn btn-xs btn-primary" href='<?php echo url("Shopgoods/edit",array("id"=>$vo["id"])); ?>'>审核</a>
                            <?php elseif($vo['status'] == -2): ?>
                            	<a class="btn btn-xs btn-info js-ajax-dialog-btn" href="<?php echo url('Shopgoods/setstatus',array('id'=>$vo['id'],'status'=>'1')); ?>" >取消下架</a>
                            <?php else: if($vo['type'] != 2): ?>
                            		<a class="btn btn-xs btn-primary" href='<?php echo url("Shopgoods/edit",array("id"=>$vo["id"])); ?>'>详情</a>
                            	<?php else: ?>
                            		<a class="btn btn-xs btn-primary" href='<?php echo url("Shopgoods/platformedit",array("id"=>$vo["id"])); ?>'>编辑</a>
                            	<?php endif; if($vo['status'] == 1): ?>
                            		<a class="btn btn-xs btn-info js-ajax-dialog-btn" href="<?php echo url('Shopgoods/setstatus',array('id'=>$vo['id'],'status'=>'-2')); ?>" >下架</a>
                            	<?php endif; ?>
                            <?php endif; ?>
                            <!-- <?php if($vo['isrecom'] == 1): ?>
                            <a class="btn btn-xs btn-info js-ajax-dialog-btn" href="<?php echo url('Shopgoods/setRecom',array('id'=>$vo['id'],'isrecom'=>'0')); ?>" >取消推荐</a>
                            <?php else: ?>
                            <a class="btn btn-xs btn-info js-ajax-dialog-btn" href="<?php echo url('Shopgoods/setRecom',array('id'=>$vo['id'],'isrecom'=>'1')); ?>" >推荐</a>
                            <?php endif; ?> -->
                            <?php if($vo['type'] == '0' or $vo['type'] == '2'): ?>
                            	<a class="btn btn-xs btn-primary"  onclick="commentlist(<?php echo $vo['id']; ?>)">评论列表</a>
                        	<?php endif; ?>
                            <a class="btn btn-xs btn-danger js-ajax-delete" href="<?php echo url('Shopgoods/del',array('id'=>$vo['id'])); ?>"><?php echo lang('DELETE'); ?></a>
						</td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			<div class="table-actions">
                <!-- <button class="btn btn-danger btn-sm js-ajax-submit" type="submit" data-action="<?php echo url('Shopgoods/del'); ?>"
                        data-subcheck="true">批量删除
                </button> -->

                <button class="btn btn-danger btn-sm js-ajax-submit" type="submit" data-action="<?php echo url('Shopgoods/setStatus',array('status'=>'-2')); ?>"
                        data-subcheck="true">批量下架
                </button>

                <button class="btn btn-danger btn-sm js-ajax-submit" type="submit" data-action="<?php echo url('Shopgoods/setStatus',array('status'=>'1')); ?>"
                        data-subcheck="true">批量取消下架
                </button>

                <p class="help-block" style="font-weight: bold;">批量操作请谨慎</p>
            </div>
			<div class="pagination"><?php echo $page; ?></div>
		</form>
	</div>
	<script src="/static/js/admin.js"></script>
	<script type="text/javascript">
		$(function(){
			Wind.use('layer');
		});

		function commentlist(goodsid){
			layer.open({
			  type: 2,
			  title: '商品评论列表',
			  shadeClose: true,
			  shade: 0.8,
			  area: ['90%', '90%'],
			  content: '/Admin/Shopgoods/commentlist?goods_id='+goodsid //iframe的url
			});
		}
	</script>
</body>
</html>