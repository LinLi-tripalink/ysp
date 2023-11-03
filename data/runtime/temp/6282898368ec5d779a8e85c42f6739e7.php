<?php /*a:2:{s:82:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/shopgoods/edit.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
			<li ><a href="<?php echo url('Shopgoods/index'); ?>">商品列表</a></li>
			<li class="active"><a ><?php echo lang('EDIT'); ?></a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('Shopgoods/editPost'); ?>">
            
            
            <div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required"></span>用户:</label>
				<div class="col-md-6 col-sm-10" style="padding-top:7px;">
					<?php echo $data['userinfo']['user_nicename']; ?> (<?php echo $data['uid']; ?>)
				</div>
			</div>
            
            <div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required"></span>商品名称:</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-name" value="<?php echo $data['name']; ?>" readonly="readonly">
				</div>
			</div>

			<?php if($data['type'] == 0): ?>
				<div class="form-group">
					<label for="input-one_class" class="col-sm-2 control-label"><span class="form-required"></span>商品所属一级分类:</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" id="input-one_class" value="<?php echo $data['oneclass_name']; ?>" readonly="readonly">
					</div>
				</div>

				<div class="form-group">
					<label for="input-two_class" class="col-sm-2 control-label"><span class="form-required"></span>商品所属二级分类:</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" id="input-two_class" value="<?php echo $data['twoclass_name']; ?>" readonly="readonly">
					</div>
				</div>

				<div class="form-group">
					<label for="input-three_class" class="col-sm-2 control-label"><span class="form-required"></span>商品所属三级分类:</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" id="input-three_class" value="<?php echo $data['threeclass_name']; ?>" readonly="readonly">
					</div>
				</div>

				<?php if($data['video_url'] != ''): ?>
					<div class="form-group">
						<label for="input-video" class="col-sm-2 control-label"><span class="form-required"></span>商品视频:</label>
			            <div class="col-md-6 col-sm-10">
			                <div class="playerzmblbkjP" id="playerzmblbkjP" style="width:auto;height:300px;"></div>
			            </div>
			        </div>
		        <?php endif; ?>

		        <div class="form-group">
					<label for="input-content" class="col-sm-2 control-label"><span class="form-required"></span>商品内容:</label>
					<div class="col-md-6 col-sm-10">
						<textarea class="form-control" id="input-content"><?php echo $data['content']; ?></textarea> 
					</div>
				</div>

				<div class="form-group">
					<label for="input-thumbs" class="col-sm-2 control-label"><span class="form-required"></span>商品内容图集:</label>
					<div class="col-md-6 col-sm-10">
						<?php if(is_array($data['picture_arr']) || $data['picture_arr'] instanceof \think\Collection || $data['picture_arr'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['picture_arr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<img src="<?php echo $vo; ?>" style="width: 150px;height: auto;margin-right: 30px;margin-top: 20px;" class="imgtip">
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>

				<?php if(is_array($data['spec_arr']) || $data['spec_arr'] instanceof \think\Collection || $data['spec_arr'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['spec_arr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				
					<div class="form-group">
						<label class="col-sm-2 control-label"><span class="form-required"></span>商品规格名称:</label>
						<div class="col-md-6 col-sm-10">
							<input type="text" class="form-control" value="<?php echo $vo['spec_name']; ?>" readonly="readonly">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label"><span class="form-required"></span>商品规格库存:</label>
						<div class="col-md-6 col-sm-10">
							<input type="text" class="form-control" value="<?php echo $vo['spec_num']; ?>" readonly="readonly">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label"><span class="form-required"></span>商品规格单价(元):</label>
						<div class="col-md-6 col-sm-10">
							<input type="text" class="form-control" value="<?php echo $vo['price']; ?>" readonly="readonly">
						</div>
					</div>

				<?php endforeach; endif; else: echo "" ;endif; ?>

				<div class="form-group">
					<label for="input-postage" class="col-sm-2 control-label"><span class="form-required"></span>商品邮费:</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" id="input-postage" value="<?php echo $data['postage']; ?>" readonly="readonly">
					</div>
				</div>

				<div class="form-group">
					<label for="input-sale_nums" class="col-sm-2 control-label"><span class="form-required"></span>商品总销量:</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" id="input-sale_nums" value="<?php echo $data['sale_nums']; ?>" readonly="readonly">
					</div>
				</div>

			<?php else: ?>

				<div class="form-group">
					<label for="input-href" class="col-sm-2 control-label"><span class="form-required"></span>商品外链地址:</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" id="input-href" value="<?php echo $data['href']; ?>" readonly="readonly">
					</div>
				</div>

				<div class="form-group">
					<label for="input-original_price" class="col-sm-2 control-label"><span class="form-required"></span>商品原价:</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" id="input-original_price" value="<?php echo $data['original_price']; ?>" readonly="readonly">
					</div>
				</div>

				<div class="form-group">
					<label for="input-present_price" class="col-sm-2 control-label"><span class="form-required"></span>商品现价:</label>
					<div class="col-md-6 col-sm-10">
						<input type="text" class="form-control" id="input-present_price" value="<?php echo $data['present_price']; ?>" readonly="readonly">
					</div>
				</div>

				<div class="form-group">
					<label for="input-goods_desc" class="col-sm-2 control-label"><span class="form-required"></span>商品简介:</label>
					<div class="col-md-6 col-sm-10">
						<textarea class="form-control" id="input-goods_desc"><?php echo $data['goods_desc']; ?></textarea> 
					</div>
				</div>

			<?php endif; ?>

			
			   
            
            <div class="form-group">
				<label for="input-thumbs" class="col-sm-2 control-label"><span class="form-required"></span>商品封面图:</label>
				<div class="col-md-6 col-sm-10">
					<?php if(is_array($data['thumb_arr']) || $data['thumb_arr'] instanceof \think\Collection || $data['thumb_arr'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['thumb_arr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<img src="<?php echo $vo; ?>" style="width: 150px;height: auto;margin-right: 30px;margin-top: 20px;" class="imgtip">
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
            


			<?php if($data['status'] != '1'): ?>
				<div class="form-group">
	                <label for="input-status" class="col-sm-2 control-label"><span class="form-required">*</span>商品状态:</label>
	                <div class="col-md-6 col-sm-10">
	                    <select class="form-control" name="status">
	                        <?php if(is_array($status) || $status instanceof \think\Collection || $status instanceof \think\Paginator): $i = 0; $__LIST__ = $status;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
	                        	<option value="<?php echo $key; ?>" <?php if($data['status'] == $key): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
	                        <?php endforeach; endif; else: echo "" ;endif; ?>
	                        
	                    </select>
	                </div>
	            </div>

	            <div class="form-group">
					<label for="input-refuse_reason" class="col-sm-2 control-label"><span class="form-required"></span>商品拒绝原因:</label>
					<div class="col-md-6 col-sm-10">
						<textarea name="refuse_reason" style="width: 100%;min-height: 100px;"><?php echo $data['refuse_reason']; ?></textarea>
					</div>
				</div>

	        <?php else: ?>
	        <div class="form-group">
				<label for="input-postage" class="col-sm-2 control-label"><span class="form-required"></span>商品状态:</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-postage" value="<?php echo $status[$data['status']]; ?>" readonly="readonly">
				</div>
			</div>



	        <?php endif; ?>

            <div class="form-group">
				<label for="input-hits" class="col-sm-2 control-label"><span class="form-required"></span>商品访问量:</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-hits" value="<?php echo $data['hits']; ?>" readonly="readonly">
				</div>
			</div>

			<div class="form-group">
				<label for="input-share_income" class="col-sm-2 control-label"><span class="form-required"></span>用户分享后被购买获得的佣金:</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-share_income" value="<?php echo $data['share_income']; ?>" readonly="readonly">
				</div>
			</div>

            <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
					<?php if($data['status'] != '1'): ?>
						<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('EDIT'); ?></button>
					<?php endif; ?>
					<a class="btn btn-default" href="<?php echo url('Shopgoods/index'); ?>"><?php echo lang('BACK'); ?></a>
				</div>
			</div>

		</form>
	</div>

    <script src="/static/js/admin.js"></script>
    <?php if($data['video_url'] != ''): ?>
		<script src="/static/xigua/xgplayer.js?t=1574906138" type="text/javascript"></script>
	    <!-- <script src="/static/xigua/xgplayer-flv.js.js" type="text/javascript"></script>
	    <script src="/static/xigua/xgplayer-hls.js.js" type="text/javascript"></script> -->
	    <script src="/static/xigua/player.js" type="text/javascript"></script>
	    <script>
	    (function(){
	        var pull='<?php echo $data['video_url']; ?>';
	        if(pull){
	            xgPlay('playerzmblbkjP',pull);
	        }
	    })()
	    </script>

	<?php endif; ?>
</body>
</html>
