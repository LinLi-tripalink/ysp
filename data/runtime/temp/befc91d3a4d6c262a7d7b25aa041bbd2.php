<?php /*a:2:{s:84:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/user/admin_index/index.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
        <li class="active"><a><?php echo lang('USER_INDEXADMIN_INDEX'); ?></a></li>
		<li ><a href="<?php echo url('user/adminIndex/add'); ?>">新增会员</a></li>
    </ul>
    <form class="well form-inline margin-top-20" method="post" action="<?php echo url('user/adminIndex/index'); ?>">
		<?php echo lang('BLOCK_USER'); ?>： 

		<select class="form-control" name="user_status" style="width: 200px;">
			<option value="">全部</option>
			<option value="0" <?php if(input('request.user_status') == '0'): ?>selected<?php endif; ?> >是</option>
			<option value="1" <?php if(input('request.user_status') == '1'): ?>selected<?php endif; ?>>否</option>
		</select>
        主播推荐：
        <select class="form-control" name="isrecommend" style="width: 200px;">
            <option value="">全部</option>
            <option value="1" <?php if(input('request.isrecommend') == '1'): ?>selected<?php endif; ?> >是</option>
            <option value="0" <?php if(input('request.isrecommend') == '0'): ?>selected<?php endif; ?>>否</option>
        </select>
        超管：
        <select class="form-control" name="issuper" style="width: 200px;">
            <option value="">全部</option>
            <option value="1" <?php if(input('request.issuper') == '1'): ?>selected<?php endif; ?> >是</option>
            <option value="0" <?php if(input('request.issuper') == '0'): ?>selected<?php endif; ?>>否</option>
        </select>
		
        用户ID：
        <input class="form-control" type="text" name="uid" style="width: 200px;" value="<?php echo input('request.uid'); ?>"
               placeholder="请输入用户ID">
        关键字：
        <input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>"
               placeholder="用户名/昵称/手机"><br />
		注册时间：	
			<input type="text" name="start_time" class="js-bootstrap-date form-control" value="<?php echo input('request.start_time'); ?>" autocomplete="off" placeholder="开始时间">-
			<input type="text" name="end_time" class="js-bootstrap-date form-control" value="<?php echo input('request.end_time'); ?>" autocomplete="off" placeholder="结束时间">&nbsp; &nbsp;
        <input type="submit" class="btn btn-primary" value="搜索"/>
        <a class="btn btn-danger" href="<?php echo url('user/adminIndex/index'); ?>">清空搜索</a>
		<br>
        <br>
        用户数：<?php echo $nums; ?>  (根据条件统计)
    </form>
    <form method="post" class="js-ajax-form">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>国家/地区</th>
                <th><?php echo lang('USERNAME'); ?></th>
                <th><?php echo lang('NICENAME'); ?></th>
                <th><?php echo lang('AVATAR'); ?></th>
                <!-- <th><?php echo lang('EMAIL'); ?></th> -->
                <th>背景图</th>
                <th><?php echo $name_coin; ?>余额</th>
                <th>累计消费<?php echo $name_coin; ?></th>
                <th><?php echo $name_votes; ?>余额</th>
                <th>累计<?php echo $name_votes; ?></th>
                <th>人民币余额</th>
                <th>累计收入人民币</th>
                <th>人民币累计消费</th>
                <th>邀请码</th>
                <th>注册设备</th>
                <th><?php echo lang('REGISTRATION_TIME'); ?></th>
                <th><?php echo lang('LAST_LOGIN_TIME'); ?></th>
                <th><?php echo lang('LAST_LOGIN_IP'); ?></th>
				<th>广告视频发布者</th>
                <th>vip到期时间</th>
                <th><?php echo lang('STATUS'); ?></th>
                <th><?php echo lang('ACTIONS'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php 
                $user_statuses=array("0"=>lang('USER_STATUS_BLOCKED'),"1"=>lang('USER_STATUS_ACTIVATED'),"2"=>lang('USER_STATUS_UNVERIFIED'));
				$isAd=array("0"=>"否","1"=>"是");
             if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                <tr>
                    <td><?php echo $vo['id']; ?></td>
                    <td><?php if($vo['login_type'] == 'phone'): ?><?php echo $vo['country_name']; else: ?>--<?php endif; ?></td>
                    <td><?php echo !empty($vo['user_login']) ? $vo['user_login'] : ($vo['mobile']?$vo['mobile']:lang('THIRD_PARTY_USER')); ?>
                    </td>
                    <td><?php echo !empty($vo['user_nicename']) ? $vo['user_nicename'] : lang('NOT_FILLED'); ?></td>
                    <td><img width="25" height="25" class="imgtip" src="<?php echo get_upload_path($vo['avatar']); ?>"/></td>
                    <!-- <td><?php echo $vo['user_email']; ?></td> -->
                    <td><img width="25" height="25" class="imgtip" src="<?php echo get_upload_path($vo['bg_img']); ?>"/></td>
                    <td><?php echo $vo['coin']; ?></td>
                    <td><?php echo $vo['consumption']; ?></td>
                    <td><?php echo $vo['votes']; ?></td>
                    <td><?php echo $vo['votestotal']; ?></td>
                    <td><?php echo $vo['balance']; ?></td>
                    <td><?php echo $vo['balance_total']; ?></td>
                    <td><?php echo $vo['balance_consumption']; ?></td>
                    <td><?php echo $vo['code']; ?></td>
                    <td><?php echo $vo['source']; ?></td>
                    <td><?php echo date('Y-m-d H:i:s',$vo['create_time']); ?></td>
                    <td><?php if($vo['last_login_time'] > 0): ?><?php echo date('Y-m-d H:i:s',$vo['last_login_time']); else: ?>--<?php endif; ?></td>
                    <td><?php echo $vo['last_login_ip']; ?></td>
					<td><?php echo $isAd[$vo['is_ad']]; ?></td>
                    <td><?php echo $vo['vip_endtime_format']; ?></td>
                    <td>
                        <?php if($vo['user_status'] == '3'): ?>
                            <!-- 已注销 -->
                            已注销
                        <?php else: switch($vo['user_status']): case "0": ?>
                                    <span class="label label-danger"><?php echo $user_statuses[$vo['user_status']]; ?></span>
                                <?php break; case "1": ?>
                                    <span class="label label-success"><?php echo $user_statuses[$vo['user_status']]; ?></span>
                                <?php break; case "2": ?>
                                    <span class="label label-warning"><?php echo $user_statuses[$vo['user_status']]; ?></span>
                                <?php break; ?>
                            <?php endswitch; ?>
                        <?php endif; ?>
                        
                    </td>
                    <td>
                        <?php if($vo['user_status'] == '3'): else: if($vo['id'] != '1'): if(empty($vo['user_status']) || (($vo['user_status'] instanceof \think\Collection || $vo['user_status'] instanceof \think\Paginator ) && $vo['user_status']->isEmpty())): ?>
                                    <a class="btn btn-xs btn-success js-ajax-dialog-btn"
                                       href="<?php echo url('adminIndex/cancelban',array('id'=>$vo['id'])); ?>"
                                       data-msg="<?php echo lang('ACTIVATE_USER_CONFIRM_MESSAGE'); ?>"><?php echo lang('ACTIVATE_USER'); ?></a>
                                    <?php else: ?>
                                    <a class="btn btn-xs btn-warning js-ajax-dialog-btn"
                                       href="<?php echo url('adminIndex/ban',array('id'=>$vo['id'])); ?>"
                                       data-msg="<?php echo lang('BLOCK_USER_CONFIRM_MESSAGE'); ?>"><?php echo lang('BLOCK_USER'); ?></a>
                                <?php endif; else: ?>
                                <a class="btn btn-xs btn-warning disabled"><?php echo lang('BLOCK_USER'); ?></a>
                                
                            <?php endif; if($vo['issuper'] == '1'): ?>
                                <a class="btn btn-xs btn-success js-ajax-dialog-btn"
                                       href="<?php echo url('adminIndex/cancelsuper',array('id'=>$vo['id'])); ?>"
                                       data-msg="您确定要取消超管吗?">取消超管</a>
                            <?php else: ?>
                                <a class="btn btn-xs btn-warning js-ajax-dialog-btn"
                                       href="<?php echo url('adminIndex/super',array('id'=>$vo['id'])); ?>"
                                       data-msg="您确定要设置超管吗?">设置超管</a>
                            <?php endif; if($vo['isrecommend'] == '1'): ?>
                                <a class="btn btn-xs btn-success js-ajax-dialog-btn"
                                       href="<?php echo url('adminIndex/setrecommend',array('id'=>$vo['id'],'status'=>0)); ?>"
                                       data-msg="您确定要取消推荐吗?">取消主播推荐</a>
                            <?php else: ?>
                                <a class="btn btn-xs btn-warning js-ajax-dialog-btn"
                                       href="<?php echo url('adminIndex/setrecommend',array('id'=>$vo['id'],'status'=>1)); ?>"
                                       data-msg="您确定将该用户设置为推荐主播吗?">设置主播推荐</a>
                            <?php endif; ?>

                            <a class="btn btn-xs btn-primary" href="<?php echo url('adminIndex/setvip',array('id'=>$vo['id'])); ?>">设置vip</a>

                        <?php endif; ?>
                        

						<a class="btn btn-xs btn-primary" href="<?php echo url('adminIndex/edit',array('id'=>$vo['id'])); ?>">编辑</a>
						<a class="btn btn-xs btn-danger js-ajax-delete" href="<?php echo url('adminIndex/del',array('id'=>$vo['id'])); ?>">删除</a>
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