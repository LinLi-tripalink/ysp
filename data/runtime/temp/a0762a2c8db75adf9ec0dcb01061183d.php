<?php /*a:2:{s:80:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/setting/site.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
        <li class="active"><a href="#A" data-toggle="tab"><?php echo lang('WEB_SITE_INFOS'); ?></a></li>
        <li><a href="#B" data-toggle="tab">登录开关</a></li>
        <li><a href="#C" data-toggle="tab">APP版本管理</a></li>
        <li><a href="#D" data-toggle="tab">分享设置</a></li>
        <li><a href="#E" data-toggle="tab">美颜/萌颜</a></li>
        <li><a href="#F" data-toggle="tab">登录协议弹窗</a></li>
        <li><a href="#G" data-toggle="tab"><?php echo lang('SEO_SETTING'); ?></a></li>
    </ul>
    <form class="form-horizontal js-ajax-form margin-top-20" role="form" action="<?php echo url('setting/sitePost'); ?>"
          method="post">
        <fieldset>
            <div class="tabbable">
                <div class="tab-content">

					<!-- 网站信息 -->
                    <div class="tab-pane active" id="A">
                        
                        <!-- <div class="form-group">
                            <label for="input-admin_url_password" class="col-sm-2 control-label">
                                后台加密码
                                <a href="http://www.thinkcmf.com/faq.html?url=https://www.kancloud.cn/thinkcmf/faq/493509"
                                   title="查看帮助手册"
                                   data-toggle="tooltip"
                                   target="_blank"><i class="fa fa-question-circle"></i></a>
                            </label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-admin_url_password"
                                       name="admin_settings[admin_password]"
                                       value="<?php echo (isset($admin_settings['admin_password']) && ($admin_settings['admin_password'] !== '')?$admin_settings['admin_password']:''); ?>"
                                       id="js-site-admin-url-password">
                                <p class="help-block">英文字母数字，不能为纯数字</p>
                                <p class="help-block" style="color: red;">
                                    设置加密码后必须通过以下地址访问后台,请劳记此地址，为了安全，您也可以定期更换此加密码!</p>
                                <?php 
                                    $root=cmf_get_root();
                                    $root=empty($root)?'':'/'.$root;
                                    $site_domain = cmf_get_domain().$root;
                                 ?>
                                <p class="help-block">后台登录地址：<span id="js-site-admin-url"><?php echo $site_domain; ?>/<?php echo (isset($admin_settings['admin_password']) && ($admin_settings['admin_password'] !== '')?$admin_settings['admin_password']:'admin'); ?></span>
                                </p>
                            </div>
                        </div> -->
						
                        <div class="form-group">
                            <label for="input-company_name" class="col-sm-2 control-label">公司名称</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-company_name" name="options[company_name]"
                                       value="<?php echo (isset($site_info['company_name']) && ($site_info['company_name'] !== '')?$site_info['company_name']:''); ?>">
                                       <p class="help-block">公司名称(网站首页关于我们使用)</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  for="input-company_desc" class="col-sm-2 control-label">公司简介</label>
                            <div class="col-md-6 col-sm-10">        
                                <textarea  class="form-control" name="options[company_desc]"><?php echo (isset($site_info['company_desc']) && ($site_info['company_desc'] !== '')?$site_info['company_desc']:''); ?></textarea>
                                <p class="help-block">公司简介（网站首页关于我们使用,字数在120字以内）</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-app_name" class="col-sm-2 control-label">APP名称</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-app_name" name="options[app_name]"
                                       value="<?php echo (isset($site_info['app_name']) && ($site_info['app_name'] !== '')?$site_info['app_name']:''); ?>"><p class="help-block">应用名称(用户认证时协议显示)</p>
                            </div>
                        </div>
						<div class="form-group">
                            <label for="input-sitename" class="col-sm-2 control-label">网站标题</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-sitename" name="options[sitename]"
                                       value="<?php echo (isset($site_info['sitename']) && ($site_info['sitename'] !== '')?$site_info['sitename']:''); ?>"><p class="help-block">网站标题</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-site" class="col-sm-2 control-label">网站域名</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-site" name="options[site]"
                                       value="<?php echo (isset($site_info['site']) && ($site_info['site'] !== '')?$site_info['site']:''); ?>"><p class="help-block">网站域名，http:// 开头  尾部不带 /</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-name_coin" class="col-sm-2 control-label">钻石名称</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-name_coin" name="options[name_coin]"
                                       value="<?php echo (isset($site_info['name_coin']) && ($site_info['name_coin'] !== '')?$site_info['name_coin']:''); ?>">
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-name_votes" class="col-sm-2 control-label">金币名称</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-name_votes" name="options[name_votes]"
                                       value="<?php echo (isset($site_info['name_votes']) && ($site_info['name_votes'] !== '')?$site_info['name_votes']:''); ?>">
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-copyright" class="col-sm-2 control-label">版权信息</label>
                            <div class="col-md-6 col-sm-10">
								<textarea class="form-control" id="input-copyright" name="options[copyright]"><?php echo (isset($site_info['copyright']) && ($site_info['copyright'] !== '')?$site_info['copyright']:''); ?></textarea><p class="help-block">版权信息（200字以内）</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-copyright_url" class="col-sm-2 control-label">版权链接</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-copyright_url" name="options[copyright_url]"
                                       value="<?php echo (isset($site_info['copyright_url']) && ($site_info['copyright_url'] !== '')?$site_info['copyright_url']:''); ?>">
                            </div>
                        </div>
                        
						<div class="form-group">
                            <label for="input-qq" class="col-sm-2 control-label">客服QQ</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-qq" name="options[qq]"
                                       value="<?php echo (isset($site_info['qq']) && ($site_info['qq'] !== '')?$site_info['qq']:''); ?>"><p class="help-block">官方客服QQ</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-mobile" class="col-sm-2 control-label">客服电话</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-mobile" name="options[mobile]"
                                       value="<?php echo (isset($site_info['mobile']) && ($site_info['mobile'] !== '')?$site_info['mobile']:''); ?>"><p class="help-block">官方客服电话</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-service_switch" class="col-sm-2 control-label">在线客服</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[service_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($site_info['service_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-service_url" class="col-sm-2 control-label">在线客服链接</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-service_url"
                                       name="options[service_url]" value="<?php echo (isset($site_info['service_url']) && ($site_info['service_url'] !== '')?$site_info['service_url']:''); ?>">
                                       <p class="help-block">注册链接：http://www.53kf.com/reg/index?yx_from=210260</p>
                            </div>
                        </div>
						
						<div class="form-group">
							<label for="input-user_login" class="col-sm-2 control-label">水印图片</label>
							<div class="col-md-6 col-sm-10">
								<input type="hidden" name="options[watermark]" id="thumbnail" value="<?php echo $site_info['watermark']; ?>">
								<a href="javascript:uploadOneImage('图片上传','#thumbnail');">
									<?php if(empty($site_info['watermark'])): ?>
									<img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png"
											 id="thumbnail-preview"
											 style="cursor: pointer;max-width:100px;max-height:100px;"/>
									<?php else: ?>
									<img src="<?php echo get_upload_path($site_info['watermark']); ?>"
										 id="thumbnail-preview"
										 style="cursor: pointer;max-width:100px;max-height:100px;"/>
									<?php endif; ?>
								</a>
								<input type="button" class="btn btn-sm btn-cancel-thumbnail" value="取消图片">
							</div>
						</div>
						
						<div class="form-group">
							<label for="input-qr_url" class="col-sm-2 control-label">安卓下载二维码</label>
							<div class="col-md-6 col-sm-10">
								<input type="hidden" name="options[qr_url]" id="thumbewm" value="<?php echo $site_info['qr_url']; ?>">
								<a href="javascript:uploadOneImage('图片上传','#thumbewm');">
									<?php if(empty($site_info['qr_url'])): ?>
									<img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png"
											 id="thumbewm-preview"
											 style="cursor: pointer;max-width:100px;max-height:100px;"/>
									<?php else: ?>
									<img src="<?php echo get_upload_path($site_info['qr_url']); ?>"
										 id="thumbewm-preview"
										 style="cursor: pointer;max-width:100px;max-height:100px;"/>
									<?php endif; ?>
								</a>
								<input type="button" class="btn btn-sm btn-cancel-thumbewm" value="取消图片">
							</div>
						</div>

                        <div class="form-group">
                            <label for="input-qr_url_ios" class="col-sm-2 control-label">iOS下载二维码</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="hidden" name="options[qr_url_ios]" id="thumbewm_ios" value="<?php echo $site_info['qr_url_ios']; ?>">
                                <a href="javascript:uploadOneImage('图片上传','#thumbewm_ios');">
                                    <?php if(empty($site_info['qr_url_ios'])): ?>
                                    <img src="/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png"
                                             id="thumbewm_ios-preview"
                                             style="cursor: pointer;max-width:100px;max-height:100px;"/>
                                    <?php else: ?>
                                    <img src="<?php echo get_upload_path($site_info['qr_url_ios']); ?>"
                                         id="thumbewm_ios-preview"
                                         style="cursor: pointer;max-width:100px;max-height:100px;"/>
                                    <?php endif; ?>
                                </a>
                                <input type="button" class="btn btn-sm btn-cancel-thumbewm_ios" value="取消图片">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-recommend_classname" class="col-sm-2 control-label">APP直播广场推荐分类名称</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-recommend_classname" name="options[recommend_classname]"
                                       value="<?php echo (isset($site_info['recommend_classname']) && ($site_info['recommend_classname'] !== '')?$site_info['recommend_classname']:''); ?>"><p class="help-block">APP直播广场推荐分类名称</p>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="1">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>

					<!-- 登录开关 -->
                    <div class="tab-pane" id="B">
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">登录方式</label>
                            <div class="col-md-6 col-sm-10">
                                
									   
									   
								<?php 
									$qq='qq';
									$wx='wx';
                                    $ios='ios';
									$sina='sina';
									$facebook='facebook';
									$twitter='twitter';
								 ?>
								<label class="checkbox-inline"><input type="checkbox" value="qq" name="options[login_type][]" <?php if(in_array(($qq), is_array($site_info['login_type'])?$site_info['login_type']:explode(',',$site_info['login_type']))): ?>checked="checked"<?php endif; ?>>QQ</label>
								<label class="checkbox-inline"><input type="checkbox" value="wx" name="options[login_type][]" <?php if(in_array(($wx), is_array($site_info['login_type'])?$site_info['login_type']:explode(',',$site_info['login_type']))): ?>checked="checked"<?php endif; ?>>微信</label>
                                <label class="checkbox-inline"><input type="checkbox" value="ios" name="options[login_type][]" <?php if(in_array(($ios), is_array($site_info['login_type'])?$site_info['login_type']:explode(',',$site_info['login_type']))): ?>checked="checked"<?php endif; ?>>iOS</label>
								<!--<label class="checkbox-inline"><input type="checkbox" value="sina" name="options[login_type][]" <?php if(in_array(($sina), is_array($site_info['login_type'])?$site_info['login_type']:explode(',',$site_info['login_type']))): ?>checked="checked"<?php endif; ?>>新浪微博</label> -->
								<!--<label class="checkbox-inline"><input type="checkbox" value="facebook" name="options[login_type][]" <?php if(in_array(($facebook), is_array($site_info['login_type'])?$site_info['login_type']:explode(',',$site_info['login_type']))): ?>checked="checked"<?php endif; ?>>FaceBook</label>
								<label class="checkbox-inline"><input type="checkbox" value="twitter" name="options[login_type][]" <?php if(in_array(($twitter), is_array($site_info['login_type'])?$site_info['login_type']:explode(',',$site_info['login_type']))): ?>checked="checked"<?php endif; ?>>Twitter</label> -->
   
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">分享方式</label>
                            <div class="col-md-6 col-sm-10">
                                <?php 
									$share_qq='qq';
									$share_qzone='qzone';
									$share_wx='wx';
									$share_wchat='wchat';
									$share_sina='sina';
									$share_facebook='facebook';
									$share_twitter='twitter';
								 ?>
								<label class="checkbox-inline"><input type="checkbox" value="wx" name="options[share_type][]" <?php if(in_array(($share_wx), is_array($site_info['share_type'])?$site_info['share_type']:explode(',',$site_info['share_type']))): ?>checked="checked"<?php endif; ?>>微信</label>
								<label class="checkbox-inline"><input type="checkbox" value="wchat" name="options[share_type][]" <?php if(in_array(($share_wchat), is_array($site_info['share_type'])?$site_info['share_type']:explode(',',$site_info['share_type']))): ?>checked="checked"<?php endif; ?>>微信朋友圈</label>
								<label class="checkbox-inline"><input type="checkbox" value="qzone" name="options[share_type][]" <?php if(in_array(($share_qzone), is_array($site_info['share_type'])?$site_info['share_type']:explode(',',$site_info['share_type']))): ?>checked="checked"<?php endif; ?>>QQ空间</label>
								<label class="checkbox-inline"><input type="checkbox" value="qq" name="options[share_type][]" <?php if(in_array(($share_qq), is_array($site_info['share_type'])?$site_info['share_type']:explode(',',$site_info['share_type']))): ?>checked="checked"<?php endif; ?>>QQ</label>
							<!-- 	<label class="checkbox-inline"><input type="checkbox" value="sina" name="post[share_type][]" <?php if(in_array(($share_sina), is_array($site_info['share_type'])?$site_info['share_type']:explode(',',$site_info['share_type']))): ?>checked="checked"<?php endif; ?>>新浪微博</label> -->
								<!-- <label class="checkbox-inline"><input type="checkbox" value="twitter" name="post[share_type][]" <?php if(in_array(($share_twitter), is_array($site_info['share_type'])?$site_info['share_type']:explode(',',$site_info['share_type']))): ?>checked="checked"<?php endif; ?>>Twitter</label>
								<label class="checkbox-inline"><input type="checkbox" value="facebook" name="post[share_type][]" <?php if(in_array(($share_facebook), is_array($site_info['share_type'])?$site_info['share_type']:explode(',',$site_info['share_type']))): ?>checked="checked"<?php endif; ?>>FaceBook</label> -->
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
					
					<!-- APP版本管理 -->
					
                    <div class="tab-pane" id="C">
                        <div class="form-group">
                            <label for="input-apk_ver" class="col-sm-2 control-label">APK版本号</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-apk_ver" name="options[apk_ver]"
                                       value="<?php echo (isset($site_info['apk_ver']) && ($site_info['apk_ver'] !== '')?$site_info['apk_ver']:''); ?>"><p class="help-block">安卓APP最新的版本号，请勿随意修改。如果该版本号与安卓app内版本号不一致，用户登录时会有系统更新提醒</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-apk_url" class="col-sm-2 control-label">APK下载链接</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-apk_url" name="options[apk_url]"
                                       value="<?php echo (isset($site_info['apk_url']) && ($site_info['apk_url'] !== '')?$site_info['apk_url']:''); ?>"><p class="help-block">安卓最新版APK下载链接</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label  for="input-apk_des" class="col-sm-2 control-label">APk更新说明</label>
                            <div class="col-md-6 col-sm-10">        
								<textarea  class="form-control" name="options[apk_des]"><?php echo (isset($site_info['apk_des']) && ($site_info['apk_des'] !== '')?$site_info['apk_des']:''); ?></textarea><p class="help-block">APk更新说明（200字以内）</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-ipa_ver" class="col-sm-2 control-label">IPA版本号</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-ipa_ver" name="options[ipa_ver]"
                                       value="<?php echo (isset($site_info['ipa_ver']) && ($site_info['ipa_ver'] !== '')?$site_info['ipa_ver']:''); ?>"><p class="help-block">IOS APP最新的版本号，请勿随意修改。如果该版本号与苹果app内版本号不一致，用户登录时会有系统更新提醒</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-ios_shelves" class="col-sm-2 control-label">IPA上架版本号</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-ios_shelves" name="options[ios_shelves]"
                                       value="<?php echo (isset($site_info['ios_shelves']) && ($site_info['ios_shelves'] !== '')?$site_info['ios_shelves']:''); ?>"><p class="help-block">IOS上架审核中版本的版本号(用于上架期间隐藏上架版本部分功能,不要和IPA版本号相同)上架版本号与app内版本号相同时，苹果支付就采用沙盒模式支付，否则采用生产模式支付</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-ipa_url" class="col-sm-2 control-label">IPA下载链接</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-ipa_url" name="options[ipa_url]"
                                       value="<?php echo (isset($site_info['ipa_url']) && ($site_info['ipa_url'] !== '')?$site_info['ipa_url']:''); ?>"><p class="help-block">IOS最新版IPA下载链接</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label  for="input-ipa_des" class="col-sm-2 control-label">IPA更新说明</label>
                            <div class="col-md-6 col-sm-10">        
								<textarea  class="form-control" name="options[ipa_des]"><?php echo (isset($site_info['ipa_des']) && ($site_info['ipa_des'] !== '')?$site_info['ipa_des']:''); ?></textarea><p class="help-block">IPA更新说明（200字以内）</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
					
					<!-- 分享设置 -->
					
                    <div class="tab-pane" id="D">
                        <div class="form-group">
                            <label for="input-app_android" class="col-sm-2 control-label">AndroidAPP下载链接</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-app_android" name="options[app_android]"
                                       value="<?php echo (isset($site_info['app_android']) && ($site_info['app_android'] !== '')?$site_info['app_android']:''); ?>"><p class="help-block">分享用Android APP 下载链接</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-app_ios" class="col-sm-2 control-label">IOSAPP下载链接</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-app_ios" name="options[app_ios]"
                                       value="<?php echo (isset($site_info['app_ios']) && ($site_info['app_ios'] !== '')?$site_info['app_ios']:''); ?>"><p class="help-block">分享用IOS APP 下载链接</p>
                            </div>
                        </div>
						
						
						
						<div class="form-group">
                            <label for="input-video_share_title" class="col-sm-2 control-label">短视频分享标题</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-video_share_title" name="options[video_share_title]"
                                       value="<?php echo (isset($site_info['video_share_title']) && ($site_info['video_share_title'] !== '')?$site_info['video_share_title']:''); ?>">
                                <p class="help-block">{username}代表了用户昵称，分享时，app端会将该变量替换为视频用户的昵称，格式必须固定为{username}；如果不需要显示视频用户的昵称，此处可以不配置{username}</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-video_share_des" class="col-sm-2 control-label">短视频分享话术</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-video_share_des" name="options[video_share_des]"
                                       value="<?php echo (isset($site_info['video_share_des']) && ($site_info['video_share_des'] !== '')?$site_info['video_share_des']:''); ?>">
                                <p class="help-block">如果视频有标题，分享出去的简介就显示视频标题;如果视频没有标题，分享出去的简介就显示该处设置的默认话术</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-agent_share_title" class="col-sm-2 control-label">邀请好友分享标题</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-agent_share_title" name="options[agent_share_title]"
                                       value="<?php echo (isset($site_info['agent_share_title']) && ($site_info['agent_share_title'] !== '')?$site_info['agent_share_title']:''); ?>">
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-agent_share_des" class="col-sm-2 control-label">邀请好友分享话术</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-agent_share_des" name="options[agent_share_des]"
                                       value="<?php echo (isset($site_info['agent_share_des']) && ($site_info['agent_share_des'] !== '')?$site_info['agent_share_des']:''); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-wx_siteurl" class="col-sm-2 control-label">微信推广域名</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-wx_siteurl"
                                       name="options[wx_siteurl]" value="<?php echo (isset($site_info['wx_siteurl']) && ($site_info['wx_siteurl'] !== '')?$site_info['wx_siteurl']:''); ?>">
                                       <p class="help-block">http:// 开头 参数值为用户ID</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-share_title" class="col-sm-2 control-label">直播分享标题</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-share_title" name="options[share_title]"
                                       value="<?php echo (isset($site_info['share_title']) && ($site_info['share_title'] !== '')?$site_info['share_title']:''); ?>">
                                       <p class="help-block">{username}代表了用户昵称，分享时，app端会将该变量替换为直播用户的昵称，格式必须固定为{username}；如果不需要显示直播用户的昵称，此处可以不配置{username}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-share_des" class="col-sm-2 control-label">直播分享话术</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-share_des" name="options[share_des]"
                                       value="<?php echo (isset($site_info['share_des']) && ($site_info['share_des'] !== '')?$site_info['share_des']:''); ?>">
                                       <p class="help-block">如果直播有标题，分享出去的简介就显示直播标题；如果直播没有标题，分享出去的简介就显示该处设置的默认话术</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 美颜/萌颜设置 -->
                    
                    <div class="tab-pane" id="E">
						<div class="form-group">
                            <label for="input-sprout_appid" class="col-sm-2 control-label">萌颜Appid-Andriod</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-sprout_appid" name="options[sprout_appid]"
                                       value="<?php echo (isset($site_info['sprout_appid']) && ($site_info['sprout_appid'] !== '')?$site_info['sprout_appid']:''); ?>"><p class="help-block">留空 表示使用默认美颜</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-sprout_key" class="col-sm-2 control-label">萌颜授权码-Andriod</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-sprout_key" name="options[sprout_key]"
                                       value="<?php echo (isset($site_info['sprout_key']) && ($site_info['sprout_key'] !== '')?$site_info['sprout_key']:''); ?>"><p class="help-block">留空 表示使用默认美颜</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-sprout_appid_ios" class="col-sm-2 control-label">萌颜Appid-IOS</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-sprout_appid_ios" name="options[sprout_appid_ios]"
                                       value="<?php echo (isset($site_info['sprout_appid_ios']) && ($site_info['sprout_appid_ios'] !== '')?$site_info['sprout_appid_ios']:''); ?>"><p class="help-block">留空 表示使用默认美颜</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-sprout_key_ios" class="col-sm-2 control-label">萌颜授权码-IOS</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-sprout_key_ios" name="options[sprout_key_ios]"
                                       value="<?php echo (isset($site_info['sprout_key_ios']) && ($site_info['sprout_key_ios'] !== '')?$site_info['sprout_key_ios']:''); ?>"><p class="help-block">留空 表示使用默认美颜</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-brightness" class="col-sm-2 control-label">美颜--亮度</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-brightness" name="options[brightness]"
                                       value="<?php echo (isset($site_info['brightness']) && ($site_info['brightness'] !== '')?$site_info['brightness']:''); ?>">
                                <p class="help-block">0-100 整数</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-skin_whiting" class="col-sm-2 control-label">美颜--美白</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-skin_whiting" name="options[skin_whiting]"
                                       value="<?php echo (isset($site_info['skin_whiting']) && ($site_info['skin_whiting'] !== '')?$site_info['skin_whiting']:''); ?>">
                                <p class="help-block">0-9 整数</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-skin_smooth" class="col-sm-2 control-label">美颜--磨皮</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-skin_smooth" name="options[skin_smooth]"
                                       value="<?php echo (isset($site_info['skin_smooth']) && ($site_info['skin_smooth'] !== '')?$site_info['skin_smooth']:''); ?>">
                                <p class="help-block">0-9 整数</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-skin_tenderness" class="col-sm-2 control-label">美颜--红润</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-skin_tenderness" name="options[skin_tenderness]"
                                       value="<?php echo (isset($site_info['skin_tenderness']) && ($site_info['skin_tenderness'] !== '')?$site_info['skin_tenderness']:''); ?>">

                                <p class="help-block">0-9 整数</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-eye_brow" class="col-sm-2 control-label">美型--眉毛</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-eye_brow" name="options[eye_brow]"
                                       value="<?php echo (isset($site_info['eye_brow']) && ($site_info['eye_brow'] !== '')?$site_info['eye_brow']:''); ?>">
                                <p class="help-block">0-100 整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-big_eye" class="col-sm-2 control-label">美型--大眼</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-big_eye" name="options[big_eye]"
                                       value="<?php echo (isset($site_info['big_eye']) && ($site_info['big_eye'] !== '')?$site_info['big_eye']:''); ?>">
                                <p class="help-block">0-100 整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-eye_length" class="col-sm-2 control-label">美型--眼距</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-eye_length" name="options[eye_length]"
                                       value="<?php echo (isset($site_info['eye_length']) && ($site_info['eye_length'] !== '')?$site_info['eye_length']:''); ?>">
                                <p class="help-block">0-100 整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-eye_corner" class="col-sm-2 control-label">美型--眼角</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-eye_corner" name="options[eye_corner]"
                                       value="<?php echo (isset($site_info['eye_corner']) && ($site_info['eye_corner'] !== '')?$site_info['eye_corner']:''); ?>">
                                <p class="help-block">0-100 整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-eye_alat" class="col-sm-2 control-label">美型--开眼角</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-eye_alat" name="options[eye_alat]"
                                       value="<?php echo (isset($site_info['eye_alat']) && ($site_info['eye_alat'] !== '')?$site_info['eye_alat']:''); ?>">
                                <p class="help-block">0-100 整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-face_lift" class="col-sm-2 control-label">美型--廋脸</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-face_lift" name="options[face_lift]"
                                       value="<?php echo (isset($site_info['face_lift']) && ($site_info['face_lift'] !== '')?$site_info['face_lift']:''); ?>">
                                <p class="help-block">0-100 整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-face_shave" class="col-sm-2 control-label">美型--削脸</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-face_shave" name="options[face_shave]"
                                       value="<?php echo (isset($site_info['face_shave']) && ($site_info['face_shave'] !== '')?$site_info['face_shave']:''); ?>">
                                <p class="help-block">0-100 整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-mouse_lift" class="col-sm-2 control-label">美型--嘴型</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-mouse_lift" name="options[mouse_lift]"
                                       value="<?php echo (isset($site_info['mouse_lift']) && ($site_info['mouse_lift'] !== '')?$site_info['mouse_lift']:''); ?>">
                                <p class="help-block">0-100 整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-nose_lift" class="col-sm-2 control-label">美型--瘦鼻</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-nose_lift" name="options[nose_lift]"
                                       value="<?php echo (isset($site_info['nose_lift']) && ($site_info['nose_lift'] !== '')?$site_info['nose_lift']:''); ?>">
                                <p class="help-block">0-100 整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-chin_lift" class="col-sm-2 control-label">美型--下巴</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-chin_lift" name="options[chin_lift]"
                                       value="<?php echo (isset($site_info['chin_lift']) && ($site_info['chin_lift'] !== '')?$site_info['chin_lift']:''); ?>">
                                <p class="help-block">0-100 整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-forehead_lift" class="col-sm-2 control-label">美型--额头</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-forehead_lift" name="options[forehead_lift]"
                                       value="<?php echo (isset($site_info['forehead_lift']) && ($site_info['forehead_lift'] !== '')?$site_info['forehead_lift']:''); ?>">
                                <p class="help-block">0-100 整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-forehead_lift" class="col-sm-2 control-label">美型--长鼻</label>
                            <div class="col-md-6 col-sm-10">
                                 <input type="text" class="form-control" id="input-lengthen_noseLift" name="options[lengthen_noseLift]"
                                       value="<?php echo (isset($site_info['lengthen_noseLift']) && ($site_info['lengthen_noseLift'] !== '')?$site_info['lengthen_noseLift']:''); ?>">
                                <p class="help-block">0-100 整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="F">
                        

                        <div class="form-group">
                            <label for="input-login_alert_title" class="col-sm-2 control-label"><span
                                    class="form-required"></span>弹框标题</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-login_alert_title" name="options[login_alert_title]" value="<?php echo (isset($site_info['login_alert_title']) && ($site_info['login_alert_title'] !== '')?$site_info['login_alert_title']:''); ?>">
                            </div> 
                        </div>
                        
                        <div class="form-group">
                            <label for="input-login_alert_content" class="col-sm-2 control-label">弹框内容</label>
                            <div class="col-md-6 col-sm-10">
                                <textarea class="form-control" id="input-login_alert_content" name="options[login_alert_content]" ><?php echo (isset($site_info['login_alert_content']) && ($site_info['login_alert_content'] !== '')?$site_info['login_alert_content']:''); ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-login_clause_title" class="col-sm-2 control-label"><span
                                    class="form-required"></span>APP登录界面底部协议标题</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-login_clause_title" name="options[login_clause_title]" value="<?php echo (isset($site_info['login_clause_title']) && ($site_info['login_clause_title'] !== '')?$site_info['login_clause_title']:''); ?>">
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="input-login_private_title" class="col-sm-2 control-label"><span
                                    class="form-required"></span>隐私政策名称</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-login_private_title" name="options[login_private_title]" value="<?php echo (isset($site_info['login_private_title']) && ($site_info['login_private_title'] !== '')?$site_info['login_private_title']:''); ?>">
                                <p class="help-block">填写的名称必须与弹框内容和登录界面底部协议标题中填写的名称相符,必须包含书名号《》</p>
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="input-login_private_url" class="col-sm-2 control-label"><span
                                    class="form-required"></span>隐私政策跳转链接</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-login_private_url" name="options[login_private_url]" value="<?php echo (isset($site_info['login_private_url']) && ($site_info['login_private_url'] !== '')?$site_info['login_private_url']:''); ?>">
                                <p class="help-block">本站链接请以/开头，如：/portal/page/index?id=26 外链请以http://或https://开头</p>
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="input-login_service_title" class="col-sm-2 control-label"><span
                                    class="form-required"></span>服务协议名称</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-login_service_title" name="options[login_service_title]" value="<?php echo (isset($site_info['login_service_title']) && ($site_info['login_service_title'] !== '')?$site_info['login_service_title']:''); ?>">
                                <p class="help-block">填写的名称必须与弹框内容和登录界面底部协议标题中填写的名称相符,必须包含书名号《》</p>
                            </div> 


                        </div>

                        <div class="form-group">
                            <label for="input-login_service_url" class="col-sm-2 control-label"><span
                                    class="form-required"></span>服务协议跳转链接</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-login_service_url" name="options[login_service_url]" value="<?php echo (isset($site_info['login_service_url']) && ($site_info['login_service_url'] !== '')?$site_info['login_service_url']:''); ?>">
                                <p class="help-block">本站链接请以/开头，如：/portal/page/index?id=38 外链请以http://或https://开头</p>
                            </div> 
                        </div>


                        

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="1">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="G">
                        <div class="form-group">
                            <label for="input-site_seo_title" class="col-sm-2 control-label"><?php echo lang('WEBSITE_SEO_TITLE'); ?></label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-site_seo_title"
                                       name="options[site_seo_title]" value="<?php echo (isset($site_info['site_seo_title']) && ($site_info['site_seo_title'] !== '')?$site_info['site_seo_title']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-site_seo_keywords" class="col-sm-2 control-label"><?php echo lang('WEBSITE_SEO_KEYWORDS'); ?></label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-site_seo_keywords"
                                       name="options[site_seo_keywords]"
                                       value="<?php echo (isset($site_info['site_seo_keywords']) && ($site_info['site_seo_keywords'] !== '')?$site_info['site_seo_keywords']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-site_seo_description" class="col-sm-2 control-label"><?php echo lang('WEBSITE_SEO_DESCRIPTION'); ?></label>
                            <div class="col-md-6 col-sm-10">
                                <textarea class="form-control" id="input-site_seo_description"
                                          name="options[site_seo_description]"><?php echo (isset($site_info['site_seo_description']) && ($site_info['site_seo_description'] !== '')?$site_info['site_seo_description']:''); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="H">
                        <div class="form-group">
                            <label for="input-cdn_static_root" class="col-sm-2 control-label">静态资源cdn地址</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-cdn_static_root"
                                       name="cdn_settings[cdn_static_root]"
                                       value="<?php echo (isset($cdn_settings['cdn_static_root']) && ($cdn_settings['cdn_static_root'] !== '')?$cdn_settings['cdn_static_root']:''); ?>">
                                <p class="help-block">
                                    不能以/结尾；设置这个地址后，请将ThinkCMF下的静态资源文件放在其下面；<br>
                                    ThinkCMF下的静态资源文件大致包含以下(如果你自定义后，请自行增加)：<br>
                                    themes/admin_simplebootx/public/assets<br>
                                    static<br>
                                    themes/simplebootx/public/assets<br>
                                    例如未设置cdn前：jquery的访问地址是/static/js/jquery.js, <br>
                                    设置cdn是后它的访问地址就是：静态资源cdn地址/static/js/jquery.js
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="0">
                                    <?php echo lang('SAVE'); ?>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>
    </form>

</div>
<script type="text/javascript" src="/static/js/admin.js"></script>
<script type="text/javascript">
	(function(){
		$('.btn-cancel-thumbnail').click(function () {
			$('#thumbnail-preview').attr('src', '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png');
			$('#thumbnail').val('');
		});
		
		$('.btn-cancel-thumbewm').click(function () {
			$('#thumbewm-preview').attr('src', '/themes/admin_simpleboot3/public/assets/images/default-thumbnail.png');
			$('#thumbewm').val('');
		});
		
	})()

</script>
</body>
</html>
