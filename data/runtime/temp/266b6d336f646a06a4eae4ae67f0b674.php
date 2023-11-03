<?php /*a:2:{s:85:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/pushmessage/index.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
</style>
</head>
<body>
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a >通知记录</a></li>
			<li><a href="<?php echo url('Pushmessage/add'); ?>">通知添加</a></li>
		</ul>

		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('Pushmessage/index'); ?>">
			关键字：			
			 <input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>"
               placeholder="标题内容">
			<input type="submit" class="btn btn-primary" value="搜索"/>
			<a class="btn btn-danger" href="<?php echo url('Admin/Pushmessage/index'); ?>">清空</a>
		</form>		
		
		<form method="post" class="js-ajax-form">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th align="center">ID</th>
						<th>标题</th>
						<th>简介</th>
						<th>类型</th>
						<th>链接</th>
						<th>推送者</th>
						<th>推送IP</th>
						<th>添加时间</th>
						<th>是否推送</th>
						<th>推送时间</th>
						
						<th align="center"><?php echo lang('ACTIONS'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $url_type=array("1"=>"普通内容","2"=>"外部链接"); if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
					<tr>
						<td align="center"><?php echo $vo['id']; ?></td>
						<td style="max-width: 200px;"><?php echo $vo['title']; ?></td>
						<td style="max-width: 200px;"><?php echo $vo['synopsis']; ?></td>
						<td><?php echo $url_type[$vo['type']]; ?></td>
						<td>
							<?php if($vo['type'] == '1'): ?>
								<a href="/Appapi/Message/msginfo.html&id=<?php echo $vo['id']; ?>" target="_blank">/Appapi/Message/msginfo.html&id=<?php echo $vo['id']; ?></a>
							<?php else: ?>
								<a href="<?php echo $vo['url']; ?>" target="_blank"><?php echo $vo['url']; ?></a>
							<?php endif; ?>
						</td>
						<td><?php echo $vo['admin']; ?></td>
						<td><?php echo $vo['ip']; ?></td>
						<td><?php echo date('Y-m-d H:i:s',$vo['addtime']); ?></td>
						<td><?php if($vo['is_push'] == 1): ?>是<?php else: ?>否<?php endif; ?></td>
						<td><?php if($vo['pushtime'] > 0): ?><?php echo date('Y-m-d H:i:s',$vo['pushtime']); else: ?>--<?php endif; ?></td>
						
						<td align="center">							
							<a class="btn btn-xs btn-primary" onclick="push(<?php echo $vo['id']; ?>)" >推送</a>
							<a class="btn btn-xs btn-danger js-ajax-delete" href="<?php echo url('pushmessage/del',array('id'=>$vo['id'])); ?>">删除</a>
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

		var count=<?php echo $count; ?>;
		var lastid=0;
		var res=0;


		function push(id){
			layer.confirm('是否确定推送该信息？', {
			  btn: ['确定','取消'] //按钮
			}, function(){
			  
				if(id==""){
					layer.msg("推送消息获取失败");
					return;
				}

				layer.closeAll('dialog');

				$.ajax({
					url: '/admin/pushmessage/push_return',
					type: 'POST',
					dataType: 'json',
					data: {id: id},
					async:true,

					beforeSend:function(){

						layer.open({
						  title:"提示",
						  type: 1,
						  skin: 'layui-layer-demo', //样式类名
						  closeBtn: 0, //不显示关闭按钮
						  anim: 2,
						  area: ['300px', '150px'],
						  shadeClose: true, //开启遮罩关闭
						  content: "<div style='width:90%;padding:5%;'>推送中…… 时间较久，请耐心等待，推送未完成前请不要刷新页面或关闭浏览器，否则会造成用户收不到推送通知</div>"
						});

					},
					success:function(data){

						if(data.code!=0){
							layer.msg(data.msg);
							return;
						}

						//var count=data.info;

						var num=8; //每次查询推送人数

						sendMsg(lastid,num,id,count);

						if(res==-1){
							layer.msg("消息推送失败",{time:1000},function(){
								layer.closeAll('dialog');
								location.reload();
							});
							
							return;
						}else{
							layer.msg("推送成功",{time:1000},function(){
								layer.closeAll('dialog');
								location.reload();
							});
						}

						
	
					},
					error:function(e){
						console.log(e);
						layer.msg("消息添加失败",{time:1000},function(){
							layer.closeAll('dialog');
							location.reload();
						});
				}
				});
				
				
				
			}, function(){
			  layer.closeAll();
			});
		}

	/*发送信息*/
	function sendMsg(lastid,num,msgid,count){

		$.ajax({

			url: '/admin/pushmessage/push',
			type: 'POST',
			dataType: 'json',
			data: {lastid:lastid,num:num,msgid:msgid},
			async:false,
			
			success:function(data){

				if(data.code!=0){
					res=-1;
					return;
				}

				count=count-num;
				lastid=data.info;

				if(count>0){
					sendMsg(lastid,num,msgid,count);
				}
				
			},
			error:function(e){
				console.log(e);
				res=-1;
				return;
			}
		});
	}
		
	</script>
	
</body>
</html>