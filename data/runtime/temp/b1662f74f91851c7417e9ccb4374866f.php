<?php /*a:2:{s:84:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/advertiser/index.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
<style type="text/css">

	.imgtip{
		width: 100px;
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
			<li class="active"><a >广告主申请列表</a></li>
		</ul>
		
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('Advertiser/index'); ?>">
			用户昵称：<input class="form-control" type="text" name="keyword2" style="width: 200px;" value="<?php echo input('request.keyword2'); ?>" placeholder="请输入用户昵称">			
			认证主体：<input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>" placeholder="请输入认证主体">
			手机号：<input class="form-control" type="text" name="keyword1" style="width: 200px;" value="<?php echo input('request.keyword1'); ?>" placeholder="请输入手机号">
			
	
			<input type="submit" class="btn btn-primary" value="搜索"/>
			<a class="btn btn-danger" href="<?php echo url('Admin/advertiser/index'); ?>">清空</a>
		</form>		
		
		<form method="post" class="js-ajax-form" action="<?php echo url('Advert/listsorders'); ?>">
			
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th align="center">ID</th>
						<th>会员昵称（ID）</th>
						<th>认证主体</th>
						<th>联系电话</th>
						<th style="max-width:300px;">认证说明</th>
						<th>资质图片1</th>
						<th>资质图片2</th>
						<th>状态</th>
						<th>申请时间</th>
						<th>处理时间</th>
						
						<th align="center"><?php echo lang('ACTIONS'); ?></th>
					</tr>
				</thead>
				<tbody>
					
					<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
					<tr>
						<td align="center"><?php echo $vo['id']; ?></td>
						<td><?php echo $vo['userinfo']['user_nicename']; ?> (<?php echo $vo['uid']; ?>)</td>
						<td><?php echo $vo['username']; ?></td>
						<td><?php echo $vo['mobile']; ?></td>
						<td style="max-width:300px;"><?php echo $vo['auth_desc']; ?></td>
						<td>
							<?php if($vo['img1']): ?>
								<img class="imgtip" src="<?php echo get_upload_path($vo['img1']); ?>" />
							<?php else: ?>
								无
							<?php endif; ?>
						</td>
						<td>
							<?php if($vo['img2']): ?>
								<img class="imgtip" src="<?php echo get_upload_path($vo['img2']); ?>" />
							<?php else: ?>
								无
							<?php endif; ?>
						</td>
						<td><?php echo $status[$vo['status']]; ?></td>
						<td><?php echo $vo['addtime']; ?></td>
						<td><?php echo $vo['uptime']; ?></td>
						
						
						<td align="center">
							<?php if($vo['status'] == '0'): ?>
								<a class="btn btn-xs btn-primary js-ajax-dialog-btn" href="<?php echo url('Advertiser/setpass',array('id'=>$vo['id'],'status'=>'1')); ?>" data-msg="您确定要审核通过吗？">通过</a>
								<a class="btn btn-xs btn-danger" href="javascript:void (0)"  onclick="refuse(<?php echo $vo['id']; ?>)">拒绝</a>
							<?php endif; if($vo['status'] == '1'): ?>
								<a class="btn btn-xs btn-danger" href="javascript:void (0)" onclick="refuse(<?php echo $vo['id']; ?>)">拒绝</a>
							<?php endif; if($vo['status'] == '-1'): ?>
								<a class="btn btn-xs btn-primary js-ajax-dialog-btn" href="<?php echo url('Advertiser/setpass',array('id'=>$vo['id'],'status'=>'1')); ?>" data-msg="您确定要审核通过吗？">通过</a>
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
	<script src="/static/layer/layer.js"></script>
	<script type="text/javascript">

		var refuse_status=0;

		function refuse(id){
			layer.open({
			  type: 1,
			  title:"是否确定将该申请拒绝?",
			  skin: 'layui-layer-rim', //加上边框
			  area: ['30%', '30%'], //宽高
			  content: '<div class="textArea"><textarea id="refuse_reason" maxlength="50" placeholder="请输入拒绝原因,最多50字,可不写" /> </div><div class="textArea_btn" ><input type="button" id="refuse" value="提交" onclick="refuse_submit('+id+')" /><input type="button" id="cancel" onclick="layer.closeAll();" value="取消" /></div>'
			});
		}

		function refuse_submit(id){

			var reason=$("#refuse_reason").val();
			if(refuse_status==1){
				return;
			}
			refuse_status=1;
			$.ajax({
				url: '/admin/advertiser/setstatus',
				type: 'POST',
				dataType: 'json',
				data: {id:id,reason:reason,status:'-1'},
				success:function(data){
					var code=data.code;
					if(code!=0){
						layer.msg(data.msg);
						return;
					}
					refuse_status=0;
					//设置按钮不可用
					$("#refuse").attr("disabled",true);
					$("#cancel").attr("disabled",true);
					layer.msg(data.msg,{icon: 1,time:1000},function(){
						layer.closeAll();
						location.reload();
					});
				},
				error:function(e){
					$("#refuse").attr("disabled",false);
					$("#cancel").attr("disabled",false);
					console.log(e);
				}
			});
			
			
		}
	</script>

</body>
</html>