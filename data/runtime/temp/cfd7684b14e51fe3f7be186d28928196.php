<?php /*a:2:{s:84:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/useradvert/index.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
<style>
.table img{
	max-width:100px;
	max-height:100px;
}
.textArea textarea{
	width:90%;padding:3%;height:80%;margin:0 auto;margin-top:30px;
	margin-left: 2%;
}
.textArea_btn{
	text-align: right;
	margin-top: 30px;
}
.textArea_btn input{
	margin-right: 30px;
}
</style>
</head>
<body>
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a >用户广告列表</a></li>
		</ul>
		
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('Useradvert/index'); ?>">
			关键字：			
			<input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>" placeholder="会员ID/广告ID">
			<input class="form-control" type="text" name="keyword1" style="width: 200px;" value="<?php echo input('request.keyword1'); ?>" placeholder="广告标题">
			<input class="form-control" type="text" name="keyword2" style="width: 200px;" value="<?php echo input('request.keyword2'); ?>" placeholder="用户名称">
	
			<input type="submit" class="btn btn-primary" value="搜索"/>
			<a class="btn btn-danger" href="<?php echo url('Admin/Useradvert/index'); ?>">清空</a>
		</form>		
		
		<form method="post" class="js-ajax-form" action="<?php echo url('Useradvert/listsorders'); ?>">

			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th align="center">ID</th>
						<th>会员昵称（ID）</th>
						<th style="max-width: 300px;">标题</th>
						<th>图片</th>
						<th>点赞数</th>
						<th>评论数</th>
						<th>分享数</th>
						<th style="max-width: 200px;">文字说明</th>
						<th>广告链接</th>
						<th>状态</th>
						<th>发布时间</th>
						<th align="center"><?php echo lang('ACTIONS'); ?></th>
					</tr>
				</thead>
				<tbody>
					
					<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
					<tr>
						<td align="center"><?php echo $vo['id']; ?></td>
						<td><?php echo $vo['userinfo']['user_nicename']; ?> (<?php echo $vo['uid']; ?>)</td>
						<td style="max-width: 300px;"><?php echo $vo['title']; ?></td>
						<td><img class="imgtip" src="<?php echo get_upload_path($vo['thumb']); ?>" /></td>
						<td><?php echo $vo['likes']; ?></td>
						<td><?php echo $vo['comments']; ?></td>
						<td><?php echo $vo['shares']; ?></td>
						<td><?php echo $vo['ad_desc']; ?></td>
						<td><?php echo $vo['userad_url']; ?></td>
						<td>
							<?php echo $status[$vo['status']]; if($vo['status'] == 1): ?>
								--<?php echo $isdel[$vo['isdel']]; ?>
							<?php endif; ?>
						</td>
						<td><?php echo date('Y-m-d H:i:s',$vo['addtime']); ?></td>
						<td align="center">
							<a class="btn btn-xs btn-primary" href="javascript:void(0)" onclick="videoListen(<?php echo $vo['id']; ?>)" >观看</a>
							<!-- 未审核 -->
							<?php if($vo['status'] == 0): ?>
								<a class="btn btn-xs btn-primary" href="javascript:void(0)" onclick="setStatus(<?php echo $vo['id']; ?>,'1')">通过</a>
								<a class="btn btn-xs btn-danger" href="javascript:void(0)" onclick="setStatus(<?php echo $vo['id']; ?>,'2')">拒绝</a>
							<?php endif; ?>
							<br /><br />
							<!-- 通过 -->
							<?php if($vo['status'] == 1): if($vo['isdel'] == '0'): ?>
							 		<a class="btn btn-xs btn-danger js-ajax-dialog-btn"  href="<?php echo url('Useradvert/setDel',array('id'=>$vo['id'],'isdel'=>'1')); ?>" data-msg="您确定要下架吗？">下架</a>
							 	<?php endif; if($vo['isdel'] == '1'): ?>
							 		<a class="btn btn-xs btn-primary js-ajax-dialog-btn"  href="<?php echo url('Useradvert/setDel',array('id'=>$vo['id'],'isdel'=>'0')); ?>" data-msg="您确定要上架吗？">上架</a>
							 	<?php endif; ?>
							<?php endif; ?>
							<!-- 拒绝 -->
							<?php if($vo['status'] == 2): ?>
								<a class="btn btn-xs btn-primary" href="javascript:void(0)" onclick="setStatus(<?php echo $vo['id']; ?>,'1')">通过</a>
							<?php endif; ?>
							
							<a class="btn btn-xs btn-primary" href="javascript:void (0)" onclick="commentlists(<?php echo $vo['id']; ?>)" >评论列表</a>

							<a class="btn btn-xs btn-danger " href="javascript:void (0)" onclick="del(<?php echo $vo['id']; ?>)" >删除</a>
							
						</td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			
			<div class="pagination"><?php echo $page; ?></div>
		</form>
	</div>
	<script src="/static/js/admin.js"></script>
	<script src="/static/layer/layer.js"></script>
	<script type="text/javascript">

		var review_status=0;
		var del_status=0;


		function setStatus(id,status){
			var p=<?php echo $p; ?>;

			layer.open({
			  type: 1,
			  title:"是否确定审核?",
			  skin: 'layui-layer-rim', //加上边框
			  area: ['30%', '30%'], //宽高
			  content: '<div class="textArea"><textarea id="status_reason" maxlength="50" placeholder="请输入审核事由,最多50字,可不填写" /> </div><div class="textArea_btn" ><input type="button" id="setStatus" value="提交" onclick="status_submit('+id+','+status+','+p+')" /><input type="button" id="status_cancel" onclick="layer.closeAll();" value="取消" /></div>'
			});
		}

		function status_submit(id,status,p){

			var reason=$("#status_reason").val();

			if(review_status==1){
				return;
			}

			review_status=1;

			$.ajax({
				url: '/admin/useradvert/setStatus',
				type: 'POST',
				dataType: 'json',
				data: {id:id,status:status,reason: reason},
				success:function(data){
					var code=data.code;
					if(code!=0){
						layer.msg(data.msg);
						return;
					}

					review_status=0;
					//设置按钮不可用
					$("#setStatus").attr("disabled",true);
					$("#status_cancel").attr("disabled",true);

					layer.msg("审核完成",{icon: 1,time:1000},function(){
						layer.closeAll();
						location.href='/admin/useradvert/index.html&p='+p;
					});
				},
				error:function(e){
					$("#setStatus").attr("disabled",false);
					$("#status_cancel").attr("disabled",false);

					console.log(e);
				}
			});
			
			
		}


		function del(id){
			var p=<?php echo $p; ?>;

			layer.open({
			  type: 1,
			  title:"是否确定将该广告删除",
			  skin: 'layui-layer-rim', //加上边框
			  area: ['30%', '30%'], //宽高
			  content: '<div class="textArea"><textarea id="del_reason" maxlength="50" placeholder="请输入删除原因,最多50字" /> </div><div class="textArea_btn" ><input type="button" id="delete" value="删除" onclick="del_submit('+id+','+p+')" /><input type="button" id="cancel" onclick="layer.closeAll();" value="取消" /></div>'
			});
		}

		function del_submit(id,p){

			var reason=$("#del_reason").val();

			if(del_status==1){
				return;
			}

			del_status=1;

			$.ajax({
				url: '/admin/useradvert/del.html',
				type: 'POST',
				dataType: 'json',
				data: {id:id,reason: reason},
				success:function(data){
					var code=data.code;
					if(code!=0){
						layer.msg(data.msg);
						return;
					}

					del_status=0;
					//设置按钮不可用
					$("#delete").attr("disabled",true);
					$("#cancel").attr("disabled",true);

					layer.msg("删除成功",{icon: 1,time:1000},function(){
						layer.closeAll();
						location.href='/admin/useradvert/index.html&p='+p;
					});
				},
				error:function(e){
					$("#delete").attr("disabled",false);
					$("#cancel").attr("disabled",false);

					console.log(e);
				}
			});
			
			
		}

		/*获取视频评论列表*/
		function commentlists(videoid){
			layer.open({
				type: 2,
				title: '视频评论列表',
				shadeClose: true,
				shade: 0.8,
				area: ['60%', '90%'],
				content: '/admin/useradvert/commentlists.html&videoid='+videoid 
			}); 
		}
	</script>

	<script type="text/javascript">
		function videoListen(id){
			layer.open({
			  type: 2,
			  title: '观看视频',
			  shadeClose: true,
			  shade: 0.8,
			  area: ['500px', '750px'],
			  content: '/admin/useradvert/video_listen.html&id='+id
			}); 
		}
	</script>
</body>
</html>