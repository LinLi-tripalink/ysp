<?php /*a:2:{s:82:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/shopapply/edit.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
	.red_tips{
		color: #F00;
	}
</style>
</head>
<body>
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li ><a href="<?php echo url('Shopapply/index'); ?>">店铺申请列表</a></li>
			<li class="active"><a ><?php echo lang('EDIT'); ?></a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('Shopapply/editPost'); ?>">
            <div class="form-group">
				<label class="col-sm-2 control-label"><span class="form-required">*</span>会员</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" value="<?php echo $data['userinfo']['user_nicename']; ?> (<?php echo $data['uid']; ?>)" readonly>
				</div>
			</div>
            
            <!-- <div class="form-group">
				<label for="input-thumb" class="col-sm-2 control-label"><span class="form-required">*</span>店铺图片</label>
				<div class="col-md-6 col-sm-10">
					<img src="<?php echo $data['thumb']; ?>" width="135" style="cursor: hand">
				</div>
			</div>
            
            <div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>名称</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control"  value="<?php echo $data['name']; ?>" readonly>
				</div>
			</div>
            
            <div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>简介</label>
				<div class="col-md-6 col-sm-10">
                    <textarea class="form-control" name="des" id="des" readonly><?php echo $data['des']; ?></textarea>
				</div>
			</div> -->

			<div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>姓名</label>
				<div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control"  value="<?php echo $data['username']; ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>身份证号</label>
				<div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control"  value="<?php echo $data['cardno']; ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>经营类目</label>
				<div class="col-md-6 col-sm-10">
					<?php if(is_array($oneGoodsClass) || $oneGoodsClass instanceof \think\Collection || $oneGoodsClass instanceof \think\Paginator): $i = 0; $__LIST__ = $oneGoodsClass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

                    	<label class="checkbox-inline">
                    		<input type="checkbox" value="<?php echo $vo['gc_id']; ?>" name="classids[]" <?php if(in_array(($vo['gc_id']), is_array($seller_class)?$seller_class:explode(',',$seller_class))): ?>checked="checked"<?php endif; ?>><?php echo $vo['gc_name']; if($vo['gc_isshow'] == '0'): ?><span class="red_tips">(不显示)</span><?php elseif($vo['gc_isshow'] == '3'): ?><span class="red_tips">(已存在)</span><?php endif; ?>
                    	</label>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <p class="help-block">至少一项</p>
				</div>
			</div>

			<div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>经营者联系人</label>
				<div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control"  value="<?php echo $data['contact']; ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>经营者联系电话</label>
				<div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control"  value="<?php echo $data['phone']; ?>" readonly>
				</div>
			</div>
            
            <div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>经营者所在地区</label>
				<div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control"  value="<?php echo $data['province']; ?>-<?php echo $data['city']; ?>-<?php echo $data['area']; ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>经营者详细地址</label>
				<div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control"  value="<?php echo $data['address']; ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>客服电话</label>
				<div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control"  value="<?php echo $data['service_phone']; ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>退货收货人手机号</label>
				<div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control"  value="<?php echo $data['receiver_phone']; ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>退货收货人地区</label>
				<div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control"  value="<?php echo $data['receiver_province']; ?>-<?php echo $data['receiver_city']; ?>-<?php echo $data['receiver_area']; ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>退货收货人详细地址</label>
				<div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control"  value="<?php echo $data['receiver_address']; ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>退货收货人</label>
				<div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control"  value="<?php echo $data['receiver']; ?>" readonly>
				</div>
			</div>

            <div class="form-group">
				<label for="input-needcoin" class="col-sm-2 control-label"><span class="form-required">*</span>营业执照</label>
				<div class="col-md-6 col-sm-10">
					<img src="<?php echo $data['certificate']; ?>" class="imgtip" width="135" style="cursor: hand">
				</div>
			</div>
            <!-- <div class="form-group">
				<label for="input-needcoin" class="col-sm-2 control-label"><span class="form-required">*</span>许可证</label>
				<div class="col-md-6 col-sm-10">
					<img src="<?php echo $data['license']; ?>" width="135" style="cursor: hand">
				</div>
			</div> -->
            
            <div class="form-group">
				<label for="input-needcoin" class="col-sm-2 control-label"><span class="form-required">*</span>其他证件</label>
				<div class="col-md-6 col-sm-10">
					<img src="<?php echo $data['other']; ?>" width="135" class="imgtip" style="cursor: hand">
				</div>
			</div>
            
            <div class="form-group">
				<label for="input-needcoin" class="col-sm-2 control-label"><span class="form-required">*</span>审核状态</label>
				<div class="col-md-6 col-sm-10">
					<select class="form-control" name="status">
                        <?php if(is_array($status) || $status instanceof \think\Collection || $status instanceof \think\Paginator): $i = 0; $__LIST__ = $status;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $key; ?>" <?php if($data['status'] == $key): ?>selected<?php endif; ?>><?php echo $v; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
				</div>
			</div>
            
            <div class="form-group">
				<label for="input-needcoin" class="col-sm-2 control-label"><span class="form-required"></span>审核意见</label>
				<div class="col-md-6 col-sm-10">
                    <textarea class="form-control" name="reason" id="reason"><?php echo $data['reason']; ?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>订单抽水比例</label>
				<div class="col-md-6 col-sm-10">
                    <input type="text" name="order_percent" class="form-control"  value="<?php echo $data['order_percent']; ?>" onkeyup="value=value.replace(/[^\d]/g,'')">%
                    <p class="help-block">0-100之间的整数</p>
				</div>
			</div>
            

            <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="hidden" name="uid" value="<?php echo $data['uid']; ?>" />
					<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('EDIT'); ?></button>
					<a class="btn btn-default" href="<?php echo url('Shopapply/index'); ?>"><?php echo lang('BACK'); ?></a>
				</div>
			</div>

		</form>
	</div>
	<script src="/static/js/admin.js"></script>
</body>
</html>