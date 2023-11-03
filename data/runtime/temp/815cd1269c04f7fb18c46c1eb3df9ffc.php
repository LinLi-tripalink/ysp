<?php /*a:2:{s:85:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/setting/configpri.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
    .cdnhide{
        display: none;
    }
</style>
</head>
<body>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#A" data-toggle="tab">基本设置</a></li>
        <li><a href="#B" data-toggle="tab">登录配置</a></li>
        <li><a href="#C" data-toggle="tab">极光配置</a></li>
        <li><a href="#D" data-toggle="tab">视频推荐列表设置</a></li>
        <li><a href="#E" data-toggle="tab">统计配置</a></li>
        <li><a href="#G" data-toggle="tab">邀请配置</a></li>
        <li><a href="#H" data-toggle="tab">支付配置</a></li>
        <li><a href="#I" data-toggle="tab">提现配置</a></li>
        <li><a href="#J" data-toggle="tab">上热门</a></li>
        <li><a href="#K" data-toggle="tab">VIP设置</a></li>
        <li><a href="#L" data-toggle="tab">短视频观看模式</a></li>
        <li><a href="#M" data-toggle="tab">云存储设置</a></li>
        <li><a href="#N" data-toggle="tab">直播配置</a></li>
        <li><a href="#O" data-toggle="tab">敏感词</a></li>
		<li><a href="#P" data-toggle="tab">每日任务</a></li>
        <li><a href="#Q" data-toggle="tab">店铺/商品配置</a></li>
        <li><a href="#R" data-toggle="tab">物流配置</a></li>
        <li><a href="#S" data-toggle="tab">openinstall配置</a></li>
    </ul>
    <form class="form-horizontal js-ajax-form margin-top-20" role="form" action="<?php echo url('setting/configpriPost'); ?>"
          method="post">
        <fieldset>
            <div class="tabbable">
                <div class="tab-content">
                    <div class="tab-pane active" id="A">						
						
                        

                        <div class="form-group">
                            <label for="input-cache_switch" class="col-sm-2 control-label">缓存开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[cache_switch]" value="0" <?php if($config['cache_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[cache_switch]" value="1" <?php if($config['cache_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                
                            </div>

                        </div>

						<div class="form-group">
                            <label for="input-cache_time" class="col-sm-2 control-label">缓存时间</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-cache_time" name="options[cache_time]" value="<?php echo (isset($config['cache_time']) && ($config['cache_time'] !== '')?$config['cache_time']:''); ?>">  <p class="help-block">网站数据的缓存时间（秒） </p>
                            </div>
                        </div>

						

                        <div class="form-group">
                            <label for="input-auth_islimit" class="col-sm-2 control-label">认证限制</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[auth_islimit]" value="0" <?php if($config['auth_islimit'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[auth_islimit]" value="1" <?php if($config['auth_islimit'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block">在系统中认证限制权限最高，只要认证限制打开,未认证用户就不可以发布视频和开播</p>

                            </div>

                        </div>

                        <div class="form-group">
                            <label for="input-private_letter_switch" class="col-sm-2 control-label">未关注发送消息条数开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[private_letter_switch]" value="0" <?php if($config['private_letter_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[private_letter_switch]" value="1" <?php if($config['private_letter_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>

                            </div>

                        </div>

						
						<div class="form-group">
                            <label for="input-private_letter_nums" class="col-sm-2 control-label">未关注可发送消息条数</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-private_letter_nums" name="options[private_letter_nums]" value="<?php echo (isset($config['private_letter_nums']) && ($config['private_letter_nums'] !== '')?$config['private_letter_nums']:''); ?>">  
                                <p class="help-block">未关注用户可发送消息条数（整数）</p>
                            </div>
                        </div>
						

                        <div class="form-group">
                            <label for="input-video_audit_switch" class="col-sm-2 control-label">视频审核开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[video_audit_switch]" value="0" <?php if($config['video_audit_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[video_audit_switch]" value="1" <?php if($config['video_audit_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block">视频审核开关关闭，极光配置->极光推送开关开启，用户发布视频时，粉丝会收到发布视频的推送消息</p>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="input-video_audit_switch" class="col-sm-2 control-label">系统功能概述</label>
                            <div class="col-md-6 col-sm-10">
                                
                                <p class="help-block">1、系统中认证权限最高，只要认证限制打开,非认证用户不可发布视频、不可开播</p>
                                <p class="help-block">2、用户开播跟用户是否为vip无关，只要用户达到直播配置中的发布视频数和粉丝数就可开播</p>
                                <p class="help-block">3、极光推送开启后，基本设置->视频审核开关关闭，用户发布视频时，粉丝会收到发布视频的推送消息</p>
                                <p class="help-block">4、极光推送开启后，主播开播时，粉丝会收到开播推送信息</p>
                                <p class="help-block">5、vip开关关闭后，即使用户开通了vip功能，所有vip功能权限都无效</p>
                                <p class="help-block">6、vip开关关闭后，用户上传视频要遵循vip设置中的非VIP用户每天可上传视频数</p>
                                <p class="help-block">7、vip开关打开，vip用户可无限上传视频、可上传60秒长视频、可无限免费、不限次数观看视频</p>
                                <p class="help-block">8、vip开关打开，非vip用户观看视频时要遵循视频观看模式设置</p>
                                <p class="help-block">9、观看模式为次数限制模式时，游客也要遵从后台配置的次数，当天达到次数就无法观看</p>
                                <p class="help-block">10、观看模式为内容限制模式时，游客提示登录，非vip用户需要付费观看，一次付费永久观看</p>
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
					
					<!-- 登录配置 -->
					
                    <div class="tab-pane" id="B">
					
						<div class="form-group">
                            <label for="input-reg_reward" class="col-sm-2 control-label">注册奖励</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-reg_reward"
                                       name="options[reg_reward]" value="<?php echo (isset($config['reg_reward']) && ($config['reg_reward'] !== '')?$config['reg_reward']:''); ?>">
                                       <p class="help-block">新用户注册奖励（整数）</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-bonus_switch" class="col-sm-2 control-label">签到奖励开关</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[bonus_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['bonus_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-login_qq_appid" class="col-sm-2 control-label">QQ互联移动应用APPID</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-login_qq_appid" name="options[login_qq_appid]" value="<?php echo (isset($config['login_qq_appid']) && ($config['login_qq_appid'] !== '')?$config['login_qq_appid']:''); ?>">
                                <p class="help-block">QQ互联==》应用管理==》移动应用==》APPID</p>
                            </div>
                        </div>
					   
                       <div class="form-group">
                            <label for="input-login_wx_appid" class="col-sm-2 control-label">微信公众平台Appid</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-login_wx_appid" name="options[login_wx_appid]" value="<?php echo (isset($config['login_wx_appid']) && ($config['login_wx_appid'] !== '')?$config['login_wx_appid']:''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-login_wx_appsecret" class="col-sm-2 control-label">微信公众平台AppSecret</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-login_wx_appsecret" name="options[login_wx_appsecret]" value="<?php echo (isset($config['login_wx_appsecret']) && ($config['login_wx_appsecret'] !== '')?$config['login_wx_appsecret']:''); ?>"> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-sendcode_switch" class="col-sm-2 control-label">短信验证码开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[sendcode_switch]" value="0" <?php if($config['sendcode_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[sendcode_switch]" value="1" <?php if($config['sendcode_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block">短信验证码开关,关闭后不再发送真实验证码，采用默认验证码123456</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-code_switch" class="col-sm-2 control-label">短信接口平台</label>
                            <div class="col-md-6 col-sm-10" id="cdn">
                                <label class="radio-inline"><input type="radio" value="1" name="options[code_switch]" <?php if(in_array(($config['code_switch']), explode(',',"1"))): ?>checked="checked"<?php endif; ?>>阿里云</label>
                                <label class="radio-inline"><input type="radio" value="2" name="options[code_switch]" <?php if(in_array(($config['code_switch']), explode(',',"2"))): ?>checked="checked"<?php endif; ?>>容联云</label>
                                
                               
                            </div>
                        </div>
                        <div class="cdn_bd <?php if($config['code_switch'] != '1'): ?>cdnhide<?php endif; ?>" id="code_switch_1">
                            <div class="form-group">
                                <label for="input-aly_keyid" class="col-sm-2 control-label">阿里云AccessKey ID</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-aly_keyid" name="options[aly_keyid]" value="<?php echo (isset($config['aly_keyid']) && ($config['aly_keyid'] !== '')?$config['aly_keyid']:''); ?>">
                                    <p class="help-block">阿里云控制台==》云通信-》短信服务==》 AccessKey ID </p>
                                </div>
                            </div>

                            <div class="form-group">                            
                                <label for="input-aly_secret" class="col-sm-2 control-label">阿里云AccessKey Secret</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-aly_secret" name="options[aly_secret]" value="<?php echo (isset($config['aly_secret']) && ($config['aly_secret'] !== '')?$config['aly_secret']:''); ?>">
                                    <p class="help-block">阿里云控制台==》云通信-》短信服务==》 AccessKey Secret </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-aly_sendcode_type" class="col-sm-2 control-label">阿里云短信发送区域</label>
                                <div class="col-md-6 col-sm-10">
                                    <label class="radio-inline"><input type="radio" name="options[aly_sendcode_type]" value="1" <?php if($config['aly_sendcode_type'] == '1'): ?>checked<?php endif; ?>>中国大陆</label>
                                    <label class="radio-inline"><input type="radio" name="options[aly_sendcode_type]" value="2" <?php if($config['aly_sendcode_type'] == '2'): ?>checked<?php endif; ?> >港澳台/国际</label>
                                    <label class="radio-inline"><input type="radio" name="options[aly_sendcode_type]" value="3" <?php if($config['aly_sendcode_type'] == '3'): ?>checked<?php endif; ?> >全球</label>
                                    <p class="help-block">如果选择全球，国内、国际/港澳台等信息都需要配置</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-aly_signName" class="col-sm-2 control-label">国内短信签名</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-aly_signName" name="options[aly_signName]" value="<?php echo (isset($config['aly_signName']) && ($config['aly_signName'] !== '')?$config['aly_signName']:''); ?>">
                                    <p class="help-block">阿里云控制台==》云通信==》短信服务==》国内消息==》签名管理 </p>
                                </div>
                            </div>

                            <div class="form-group">                            
                                <label for="input-aly_templateCode" class="col-sm-2 control-label">国内短信模板ID</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-aly_templateCode" name="options[aly_templateCode]" value="<?php echo (isset($config['aly_templateCode']) && ($config['aly_templateCode'] !== '')?$config['aly_templateCode']:''); ?>">
                                    <p class="help-block">阿里云控制台==》云通信==》短信服务==》国内消息==》 短信模板ID </p> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-aly_hw_signName" class="col-sm-2 control-label">国际/港澳台短信签名</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-aly_hw_signName" name="options[aly_hw_signName]" value="<?php echo (isset($config['aly_hw_signName']) && ($config['aly_hw_signName'] !== '')?$config['aly_hw_signName']:''); ?>">  阿里云控制台==》云通信-》短信服务==》国际/港澳台消息==》 短信签名
                                </div>
                            </div>

                            <div class="form-group">                            
                                <label for="input-aly_hw_templateCode" class="col-sm-2 control-label">国际/港澳台短信模板ID</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-aly_hw_templateCode" name="options[aly_hw_templateCode]" value="<?php echo (isset($config['aly_hw_templateCode']) && ($config['aly_hw_templateCode'] !== '')?$config['aly_hw_templateCode']:''); ?>">  阿里云控制台==》云通信-》短信服务==》国际/港澳台消息==》 短信模板ID 
                                </div>
                            </div>
                        
                        </div>
                        <div class="cdn_bd <?php if($config['code_switch'] != '2'): ?>cdnhide<?php endif; ?>" id="code_switch_2">
                            <div class="form-group">
                                <label for="input-ccp_sid" class="col-sm-2 control-label">容联云ACCOUNT SID</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-ccp_sid" name="options[ccp_sid]" value="<?php echo (isset($config['ccp_sid']) && ($config['ccp_sid'] !== '')?$config['ccp_sid']:''); ?>">  
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="input-ccp_token" class="col-sm-2 control-label">容联云AUTH TOKEN</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-ccp_token" name="options[ccp_token]" value="<?php echo (isset($config['ccp_token']) && ($config['ccp_token'] !== '')?$config['ccp_token']:''); ?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="input-ccp_appid" class="col-sm-2 control-label">容联云应用APPID</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-ccp_appid" name="options[ccp_appid]" value="<?php echo (isset($config['ccp_appid']) && ($config['ccp_appid'] !== '')?$config['ccp_appid']:''); ?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="input-ccp_tempid" class="col-sm-2 control-label">容联云短信模板ID</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-ccp_tempid" name="options[ccp_tempid]" value="<?php echo (isset($config['ccp_tempid']) && ($config['ccp_tempid'] !== '')?$config['ccp_tempid']:''); ?>">
                                </div>
                            </div>
                        </div>

                        
						
                        <div class="form-group">
                            <label for="input-iplimit_switch" class="col-sm-2 control-label">短信验证码IP限制开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[iplimit_switch]" value="0" <?php if($config['iplimit_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[iplimit_switch]" value="1" <?php if($config['iplimit_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block">短信验证码IP限制开关</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-iplimit_times" class="col-sm-2 control-label">短信验证码IP限制次数</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-iplimit_times" name="options[iplimit_times]" value="<?php echo (isset($config['iplimit_times']) && ($config['iplimit_times'] !== '')?$config['iplimit_times']:''); ?>">  <p class="help-block">同一IP每天可以发送验证码的最大次数</p>
                            </div>
                        </div>
						
                        <div class="form-group">
                            <label for="input-same_device_ip_regnums" class="col-sm-2 control-label">同设备同ip可注册用户数</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-same_device_ip_regnums" name="options[same_device_ip_regnums]" value="<?php echo (isset($config['same_device_ip_regnums']) && ($config['same_device_ip_regnums'] !== '')?$config['same_device_ip_regnums']:''); ?>">  <p class="help-block">同一设备同一IP下最多可注册用户数，0表示不限制</p>
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
					
					
					<!-- 极光配置 -->
                    <div class="tab-pane" id="C">

                        <div class="form-group">
                            <label for="input-jpush_switch" class="col-sm-2 control-label">极光推送开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[jpush_switch]" value="0" <?php if($config['jpush_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[jpush_switch]" value="1" <?php if($config['jpush_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block">极光推送开启后，基本设置->视频审核开关关闭，用户发布视频时，粉丝会收到发布视频的推送消息</p>
                                <p class="help-block">极光推送开启后，主播开播时，粉丝会收到开播推送信息</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-jpush_sandbox" class="col-sm-2 control-label">极光推送模式</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[jpush_sandbox]" value="0" <?php if($config['jpush_sandbox'] == '0'): ?>checked<?php endif; ?>>开发</label>
                                <label class="radio-inline"><input type="radio" name="options[jpush_sandbox]" value="1" <?php if($config['jpush_sandbox'] == '1'): ?>checked<?php endif; ?> >生产</label>
                            </div>
                        </div>
                        
						<div class="form-group">
                            <label for="input-jpush_key" class="col-sm-2 control-label">极光APP_KEY</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-jpush_key" name="options[jpush_key]" value="<?php echo (isset($config['jpush_key']) && ($config['jpush_key'] !== '')?$config['jpush_key']:''); ?>">  
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-jpush_secret" class="col-sm-2 control-label">极光master_secret</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-jpush_secret" name="options[jpush_secret]" value="<?php echo (isset($config['jpush_secret']) && ($config['jpush_secret'] !== '')?$config['jpush_secret']:''); ?>">  
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
					
					<!-- 推荐列表设置 -->
                    <div class="tab-pane" id="D">
                        
                        <div class="form-group">
                            <label for="input-video_showtype" class="col-sm-2 control-label">推荐视频显示方式</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[video_showtype]" value="0" <?php if($config['video_showtype'] == '0'): ?>checked<?php endif; ?>>随机</label>
                                <label class="radio-inline"><input type="radio" name="options[video_showtype]" value="1" <?php if($config['video_showtype'] == '1'): ?>checked<?php endif; ?> >按曝光值</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-ad_video_switch" class="col-sm-2 control-label">后台上传的广告视频开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[ad_video_switch]" value="0" <?php if($config['ad_video_switch'] == '0'): ?>checked<?php endif; ?>>关</label>
                                <label class="radio-inline"><input type="radio" name="options[ad_video_switch]" value="1" <?php if($config['ad_video_switch'] == '1'): ?>checked<?php endif; ?> >开</label>
                                <p class="help-block">打开时，在首页推荐视频列表上会出现后台上传的广告视频</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-ad_video_loop" class="col-sm-2 control-label">APP首页 后台广告视频是否轮循展示</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[ad_video_loop]" value="0" <?php if($config['ad_video_loop'] == '0'): ?>checked<?php endif; ?>>否</label>
                                <label class="radio-inline"><input type="radio" name="options[ad_video_loop]" value="1" <?php if($config['ad_video_loop'] == '1'): ?>checked<?php endif; ?> >是</label>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-video_ad_num" class="col-sm-2 control-label">APP滑动几个视频出现后台上传的广告视频</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-video_ad_num" name="options[video_ad_num]" value="<?php echo (isset($config['video_ad_num']) && ($config['video_ad_num'] !== '')?$config['video_ad_num']:''); ?>" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');">  <p class="help-block">请从1,2,4,5,10,20中选择一个填写</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-comment_weight" class="col-sm-2 control-label">评论权重值</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-comment_weight" name="options[comment_weight]" value="<?php echo (isset($config['comment_weight']) && ($config['comment_weight'] !== '')?$config['comment_weight']:''); ?>">  <p class="help-block">用于视频推荐，请填写正整数</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-like_weight" class="col-sm-2 control-label">点赞权重值</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-like_weight" name="options[like_weight]" value="<?php echo (isset($config['like_weight']) && ($config['like_weight'] !== '')?$config['like_weight']:''); ?>">  <p class="help-block">用于视频推荐，请填写正整数</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-share_weight" class="col-sm-2 control-label">分享权重值</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-share_weight" name="options[share_weight]" value="<?php echo (isset($config['share_weight']) && ($config['share_weight'] !== '')?$config['share_weight']:''); ?>">  <p class="help-block">用于视频推荐，请填写正整数</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-show_val" class="col-sm-2 control-label">初始曝光值</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-show_val" name="options[show_val]" value="<?php echo (isset($config['show_val']) && ($config['show_val'] !== '')?$config['show_val']:''); ?>" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"> <p class="help-block">请填写正整数，用于视频推荐</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-hour_minus_val" class="col-sm-2 control-label">每小时扣除曝光值</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-hour_minus_val" name="options[hour_minus_val]" value="<?php echo (isset($config['hour_minus_val']) && ($config['hour_minus_val'] !== '')?$config['hour_minus_val']:''); ?>" onkeyup="this.value=this.value.replace(/[^0-9-]+/,'');"> <p class="help-block">请填写正整数，用于视频推荐</p>
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
					
					<!-- 统计配置 -->
                    <div class="tab-pane" id="E">
                        <div class="form-group">
                            <label for="input-video_showtype" class="col-sm-2 control-label">友盟OpenApi-apiKey</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-um_apikey" name="options[um_apikey]" value="<?php echo (isset($config['um_apikey']) && ($config['um_apikey'] !== '')?$config['um_apikey']:''); ?>">  
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-video_showtype" class="col-sm-2 control-label">友盟OpenApi-apiSecurity</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-um_apisecurity" name="options[um_apisecurity]" value="<?php echo (isset($config['um_apisecurity']) && ($config['um_apisecurity'] !== '')?$config['um_apisecurity']:''); ?>">  
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-video_showtype" class="col-sm-2 control-label">友盟Android应用-appkey</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-um_appkey_android" name="options[um_appkey_android]" value="<?php echo (isset($config['um_appkey_android']) && ($config['um_appkey_android'] !== '')?$config['um_appkey_android']:''); ?>">  
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-video_showtype" class="col-sm-2 control-label">友盟IOS应用-appkey</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-um_appkey_ios" name="options[um_appkey_ios]" value="<?php echo (isset($config['um_appkey_ios']) && ($config['um_appkey_ios'] !== '')?$config['um_appkey_ios']:''); ?>">  
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
					
					
					<!-- 邀请配置 -->
                    <div class="tab-pane" id="G">

                        <div class="form-group">
                            <label for="input-agent_switch" class="col-sm-2 control-label">邀请开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[agent_switch]" value="0" <?php if($config['agent_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[agent_switch]" value="1" <?php if($config['agent_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-agent_must" class="col-sm-2 control-label">邀请码必填</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[agent_must]" value="0" <?php if($config['agent_must'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[agent_must]" value="1" <?php if($config['agent_must'] == '1'): ?>checked<?php endif; ?> >开启</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-video_showtype" class="col-sm-2 control-label">每邀请一个新人的奖励</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-agent_reward" name="options[agent_reward]" value="<?php echo (isset($config['agent_reward']) && ($config['agent_reward'] !== '')?$config['agent_reward']:''); ?>"><?php echo $name_votes; ?>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-video_showtype" class="col-sm-2 control-label">每天观看的视频时长</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-agent_v_l" name="options[agent_v_l]" value="<?php echo (isset($config['agent_v_l']) && ($config['agent_v_l'] !== '')?$config['agent_v_l']:''); ?>">分钟
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-video_showtype" class="col-sm-2 control-label">每天观看的规定视频时长的奖励</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-agent_v_a" name="options[agent_v_a]" value="<?php echo (isset($config['agent_v_a']) && ($config['agent_v_a'] !== '')?$config['agent_v_a']:''); ?>"><?php echo $name_votes; ?>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-video_showtype" class="col-sm-2 control-label">用户获取观看视频奖励时，上级用户获取的奖励</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-agent_a" name="options[agent_a]" value="<?php echo (isset($config['agent_a']) && ($config['agent_a'] !== '')?$config['agent_a']:''); ?>"><?php echo $name_votes; ?>
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
					
					<!-- 支付管理 -->
                    <div class="tab-pane" id="H">

						<div class="form-group">
                            <label for="input-aliapp_partner" class="col-sm-2 control-label">支付宝合作者身份ID</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-aliapp_partner" name="options[aliapp_partner]" value="<?php echo (isset($config['aliapp_partner']) && ($config['aliapp_partner'] !== '')?$config['aliapp_partner']:''); ?>">
                                <p class="help-block">支付宝合作者身份ID</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-aliapp_seller_id" class="col-sm-2 control-label">支付宝帐号</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-aliapp_seller_id" name="options[aliapp_seller_id]" value="<?php echo (isset($config['aliapp_seller_id']) && ($config['aliapp_seller_id'] !== '')?$config['aliapp_seller_id']:''); ?>">
                                <p class="help-block">支付宝登录账号</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="aliapp_key_android" class="col-sm-2 control-label">支付宝安卓密钥</label>
                            <div class="col-md-6 col-sm-10">
                                <textarea class="form-control" name="options[aliapp_key_android]"  id="aliapp_key_android"><?php echo (isset($config['aliapp_key_android']) && ($config['aliapp_key_android'] !== '')?$config['aliapp_key_android']:''); ?></textarea>
                                <p class="help-block">支付宝安卓密钥pkcs8版本</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aliapp_key_ios" class="col-sm-2 control-label">支付宝iOS密钥</label>
                            <div class="col-md-6 col-sm-10">
                                <textarea class="form-control" name="options[aliapp_key_ios]"  id="aliapp_key_ios"><?php echo (isset($config['aliapp_key_ios']) && ($config['aliapp_key_ios'] !== '')?$config['aliapp_key_ios']:''); ?></textarea>
                                <p class="help-block">支付宝iOS密钥pkcs8版本</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-aliapp_check" class="col-sm-2 control-label" style="font-weight: normal;padding-top: 0;">-------------------------------</label>
                            <div class="col-md-6 col-sm-10">
                                -------------------------------------------------------------------------------------------------------------------------------------
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-wx_appid" class="col-sm-2 control-label">微信开放平台移动应用AppID</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-wx_appid" name="options[wx_appid]" value="<?php echo (isset($config['wx_appid']) && ($config['wx_appid'] !== '')?$config['wx_appid']:''); ?>">
                                <p class="help-block">微信开放平台移动应用AppID</p>
                            </div>
                        </div>

						<div class="form-group">
                            <label for="input-wx_appsecret" class="col-sm-2 control-label">微信开放平台移动应用appsecret</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-wx_appsecret" name="options[wx_appsecret]" value="<?php echo (isset($config['wx_appsecret']) && ($config['wx_appsecret'] !== '')?$config['wx_appsecret']:''); ?>">
                                <p class="help-block">微信开放平台移动应用appsecret</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-wx_mchid" class="col-sm-2 control-label">微信商户号mchid</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-wx_mchid" name="options[wx_mchid]" value="<?php echo (isset($config['wx_mchid']) && ($config['wx_mchid'] !== '')?$config['wx_mchid']:''); ?>">
                                <p class="help-block">微信商户号mchid（微信开放平台移动应用 对应的微信商户 商户号mchid）</p>
                            </div>
                        </div>
						
						
						<div class="form-group">
                            <label for="input-wx_key" class="col-sm-2 control-label">微信密钥key</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-wx_key" name="options[wx_key]" value="<?php echo (isset($config['wx_key']) && ($config['wx_key'] !== '')?$config['wx_key']:''); ?>">
                                <p class="help-block">微信密钥key（微信开放平台移动应用 对应的微信商户 密钥key）</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-aliapp_check" class="col-sm-2 control-label" style="font-weight: normal;padding-top: 0;">-------------------------------</label>
                            <div class="col-md-6 col-sm-10">
                                -------------------------------------------------------------------------------------------------------------------------------------
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-braintree_paypal_environment" class="col-sm-2 control-label">Braintree-Paypal商户类型</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[braintree_paypal_environment]">
                                    <option value="0">沙盒</option>
                                    <?php if(isset($config['braintree_paypal_environment'])): ?>
                                        <option value="1" <?php if($config['braintree_paypal_environment'] == '1'): ?>selected<?php endif; ?>>生产</option>
                                    <?php endif; ?>
                                    
                                </select>
                                <p class="help-block">Braintree集成Paypal支付的商户类型，沙盒环境仅供测试使用</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-braintree_merchantid_sandbox" class="col-sm-2 control-label">Braintree MerchantID(沙盒)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-braintree_merchantid_sandbox" name="options[braintree_merchantid_sandbox]" value="<?php echo (isset($config['braintree_merchantid_sandbox']) && ($config['braintree_merchantid_sandbox'] !== '')?$config['braintree_merchantid_sandbox']:''); ?>">
                                <p class="help-block">https://sandbox.braintreegateway.com登录后-->右上角齿轮设置图标-->Processing-->导航栏API-->Keys-->Merchant ID</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-braintree_publickey_sandbox" class="col-sm-2 control-label">Braintree 公钥(沙盒)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-braintree_publickey_sandbox" name="options[braintree_publickey_sandbox]" value="<?php echo (isset($config['braintree_publickey_sandbox']) && ($config['braintree_publickey_sandbox'] !== '')?$config['braintree_publickey_sandbox']:''); ?>">
                                <p class="help-block">https://sandbox.braintreegateway.com登录后-->右上角齿轮设置图标-->Processing-->导航栏API-->Keys-->API Keys-->Public Key</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-braintree_privatekey_sandbox" class="col-sm-2 control-label">Braintree私钥(沙盒)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-braintree_privatekey_sandbox" name="options[braintree_privatekey_sandbox]" value="<?php echo (isset($config['braintree_privatekey_sandbox']) && ($config['braintree_privatekey_sandbox'] !== '')?$config['braintree_privatekey_sandbox']:''); ?>">
                                <p class="help-block">https://sandbox.braintreegateway.com登录后-->右上角齿轮设置图标-->Processing-->导航栏API-->Keys-->API Keys-->Private Key</p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="input-braintree_merchantid_product" class="col-sm-2 control-label">Braintree MerchantID(生产)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-braintree_merchantid_product" name="options[braintree_merchantid_product]" value="<?php echo (isset($config['braintree_merchantid_product']) && ($config['braintree_merchantid_product'] !== '')?$config['braintree_merchantid_product']:''); ?>">
                                <p class="help-block">https://www.braintreegateway.com登录后-->右上角齿轮设置图标-->Processing-->导航栏API-->Keys-->Merchant ID</p>
                            </div>
                            
                        </div>


                        <div class="form-group">
                            <label for="input-braintree_publickey_product" class="col-sm-2 control-label">Braintree 公钥(生产)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-braintree_publickey_product" name="options[braintree_publickey_product]" value="<?php echo (isset($config['braintree_publickey_product']) && ($config['braintree_publickey_product'] !== '')?$config['braintree_publickey_product']:''); ?>">
                                <p class="help-block">https://www.braintreegateway.com登录后-->右上角齿轮设置图标-->Processing-->导航栏API-->Keys-->API Keys-->Public Key</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-braintree_privatekey_product" class="col-sm-2 control-label">Braintree私钥(生产)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-braintree_privatekey_product" name="options[braintree_privatekey_product]" value="<?php echo (isset($config['braintree_privatekey_product']) && ($config['braintree_privatekey_product'] !== '')?$config['braintree_privatekey_product']:''); ?>">
                                <p class="help-block">https://www.braintreegateway.com登录后-->右上角齿轮设置图标-->Processing-->导航栏API-->Keys-->API Keys-->Private Key</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-aliapp_check" class="col-sm-2 control-label" style="font-weight: normal;padding-top: 0;">-------------------------------</label>
                            <div class="col-md-6 col-sm-10">
                                -------------------------------------------------------------------------------------------------------------------------------------
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-aliapp_switch" class="col-sm-2 control-label"><?php echo $name_coin; ?>充值 支付宝支付开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[aliapp_switch]" value="0" <?php if($config['aliapp_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[aliapp_switch]" value="1" <?php if($config['aliapp_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block"><?php echo $name_coin; ?>充值 支付宝支付是否开启</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-ios_switch" class="col-sm-2 control-label"><?php echo $name_coin; ?>充值 苹果支付开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[ios_switch]" value="0" <?php if($config['ios_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[ios_switch]" value="1" <?php if($config['ios_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block"><?php echo $name_coin; ?>充值 苹果支付是否开启</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-wx_switch" class="col-sm-2 control-label"><?php echo $name_coin; ?>充值 微信支付开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[wx_switch]" value="0" <?php if($config['wx_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[wx_switch]" value="1" <?php if($config['wx_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block"><?php echo $name_coin; ?>充值 微信支付是否开启</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-braintree_paypal_switch" class="col-sm-2 control-label"><?php echo $name_coin; ?>充值Braintree-Paypal支付开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[braintree_paypal_switch]" value="0" <?php if($config['braintree_paypal_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[braintree_paypal_switch]" value="1" <?php if($config['braintree_paypal_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block"><?php echo $name_coin; ?>充值 Braintree-Paypal支付是否开启</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-aliapp_check" class="col-sm-2 control-label" style="font-weight: normal;padding-top: 0;">-------------------------------</label>
                            <div class="col-md-6 col-sm-10">
                                -------------------------------------------------------------------------------------------------------------------------------------
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-vip_aliapp_switch" class="col-sm-2 control-label">vip充值 支付宝支付开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[vip_aliapp_switch]" value="0" <?php if($config['vip_aliapp_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[vip_aliapp_switch]" value="1" <?php if($config['vip_aliapp_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block">vip充值 支付宝支付是否开启</p>
                            </div>
                        </div>

                        <!-- 忽略vip苹果支付<div class="form-group">
                            <label for="input-vip_ios_switch" class="col-sm-2 control-label">vip充值 苹果支付开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[vip_ios_switch]" value="0" <?php if($config['vip_ios_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[vip_ios_switch]" value="1" <?php if($config['vip_ios_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block">vip充值 苹果支付是否开启</p>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="input-vip_wx_switch" class="col-sm-2 control-label">vip充值 微信支付开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[vip_wx_switch]" value="0" <?php if($config['vip_wx_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[vip_wx_switch]" value="1" <?php if($config['vip_wx_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block">vip充值 微信支付是否开启</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-vip_coin_switch" class="col-sm-2 control-label">vip充值 余额支付开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[vip_coin_switch]" value="0" <?php if($config['vip_coin_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[vip_coin_switch]" value="1" <?php if($config['vip_coin_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block">vip充值 余额支付是否开启</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-vip_braintree_paypal_switch" class="col-sm-2 control-label">vip充值 Braintree-Paypal支付开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[vip_braintree_paypal_switch]" value="0" <?php if($config['vip_braintree_paypal_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[vip_braintree_paypal_switch]" value="1" <?php if($config['vip_braintree_paypal_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block">vip充值 Braintree-Paypal支付是否开启</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-aliapp_check" class="col-sm-2 control-label" style="font-weight: normal;padding-top: 0;">-------------------------------</label>
                            <div class="col-md-6 col-sm-10">
                                -------------------------------------------------------------------------------------------------------------------------------------
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-shop_aliapp_switch" class="col-sm-2 control-label">店铺支付宝支付开关</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[shop_aliapp_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['shop_aliapp_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-shop_wx_switch" class="col-sm-2 control-label">店铺微信支付开关</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[shop_wx_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['shop_wx_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-shop_balance_switch" class="col-sm-2 control-label">店铺余额支付开关</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[shop_balance_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['shop_balance_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-shop_braintree_paypal_switch" class="col-sm-2 control-label">店铺 Braintree-Paypal支付开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[shop_braintree_paypal_switch]" value="0" <?php if($config['shop_braintree_paypal_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[shop_braintree_paypal_switch]" value="1" <?php if($config['shop_braintree_paypal_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block">店铺 Braintree-Paypal支付是否开启</p>
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
					
					<!-- 提现配置 -->
                    <div class="tab-pane" id="I">
                        
						<div class="form-group">
                            <label for="input-cash_rate" class="col-sm-2 control-label">提现比例</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-cash_rate" name="options[cash_rate]" value="<?php echo (isset($config['cash_rate']) && ($config['cash_rate'] !== '')?$config['cash_rate']:''); ?>"> <p class="help-block">提现一元人民币需要的<?php echo $name_votes; ?>数<span style="color: #F00;">(请设置大于等于1的整数)</span></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-cash_take" class="col-sm-2 control-label">提现抽成(元)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-cash_take" name="options[cash_take]" value="<?php echo (isset($config['cash_take']) && ($config['cash_take'] !== '')?$config['cash_take']:''); ?>">
                                <p class="help-block">(%-整数)百分比<br/>说明: 当提现比例设置为100<?php echo $name_votes; ?>等于1元时,提现抽成比例设置为10%,那么用户提现1000<?php echo $name_votes; ?>时,通过提现比例转换为10元,平台在从10元的基础上抽成10%,用户最终提现到账金额为9元</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-cash_min" class="col-sm-2 control-label">提现最低额度（元）</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-cash_min" name="options[cash_min]" value="<?php echo (isset($config['cash_min']) && ($config['cash_min'] !== '')?$config['cash_min']:''); ?>">  
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-cash_start" class="col-sm-2 control-label">每月提现期限</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-cash_start" name="options[cash_start]" value="<?php echo (isset($config['cash_start']) && ($config['cash_start'] !== '')?$config['cash_start']:''); ?>" style="width:100px;display:inline-block;"> - 
                                <input type="text" class="form-control" id="input-cash_end" name="options[cash_end]" value="<?php echo (isset($config['cash_end']) && ($config['cash_end'] !== '')?$config['cash_end']:''); ?>" style="width:100px;display:inline-block;">
                                <p class="help-block">每月提现期限，不在时间段无法提现</p> 
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-cash_max_times" class="col-sm-2 control-label">每月提现次数</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-cash_max_times" name="options[cash_max_times]" value="<?php echo (isset($config['cash_max_times']) && ($config['cash_max_times'] !== '')?$config['cash_max_times']:''); ?>">
                                <p class="help-block">每月可提现最大次数，0表示不限制</p>
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
					
					<!-- 上热门 -->
                    <div class="tab-pane" id="J">
                        
						<div class="form-group">
                            <label for="input-popular_interval" class="col-sm-2 control-label">上热门视频添加间隔</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-popular_interval" name="options[popular_interval]" value="<?php echo (isset($config['popular_interval']) && ($config['popular_interval'] !== '')?$config['popular_interval']:''); ?>"> 
                                <p class="help-block">请从1,2,4,5,10,20中选择一个填写</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="input-popular_base" class="col-sm-2 control-label">热门基数</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-popular_base" name="options[popular_base]" value="<?php echo (isset($config['popular_base']) && ($config['popular_base'] !== '')?$config['popular_base']:''); ?>">
                                <p class="help-block">1云币一小时提升的播放量(整数)</p>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="popular_tips" class="col-sm-2 control-label">提示内容</label>
                            <div class="col-md-6 col-sm-10">
                                <textarea class="form-control" name="options[popular_tips]"  id="popular_tips"><?php echo (isset($config['popular_tips']) && ($config['popular_tips'] !== '')?$config['popular_tips']:''); ?></textarea><p class="help-block">最多200字</p>
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

                    <!-- VIP设置 -->
                    <div class="tab-pane" id="K">
                        
                        <div class="form-group">
                            <label for="input-vip_switch" class="col-sm-2 control-label">vip开关</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[vip_switch]" value="0" <?php if($config['vip_switch'] == '0'): ?>checked<?php endif; ?>>关闭</label>
                                <label class="radio-inline"><input type="radio" name="options[vip_switch]" value="1" <?php if($config['vip_switch'] == '1'): ?>checked<?php endif; ?> >开启</label>
                                <p class="help-block">vip 关闭后，站点所有与vip相关信息都不展示</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-nonvip_upload_nums" class="col-sm-2 control-label">非VIP用户每天可上传视频数</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-nonvip_upload_nums" name="options[nonvip_upload_nums]" value="<?php echo (isset($config['nonvip_upload_nums']) && ($config['nonvip_upload_nums'] !== '')?$config['nonvip_upload_nums']:''); ?>">
                                <p class="help-block">非VIP用户每天可上传视频数,0表示不限制(整数)</p>
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
					
					<!-- 短视频观看模式 -->
                    <div class="tab-pane" id="L">

                        <div class="form-group">
                            <label for="input-watch_video_type" class="col-sm-2 control-label">短视频观看模式</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[watch_video_type]" value="0" <?php if($config['watch_video_type'] == '0'): ?>checked<?php endif; ?>>次数限制模式</label>
                                <label class="radio-inline"><input type="radio" name="options[watch_video_type]" value="1" <?php if($config['watch_video_type'] == '1'): ?>checked<?php endif; ?> >内容限制模式</label>
                                <p class="help-block">次数限制模式开启时，免费观看视频数发挥作用。内容限制模式开启时 视频发布者可设置视频的收费价格，非vip用户观看收费视频需要付费，一次付费永久观看。在vip开关打开的情况下，vip用户无论何种模式可免费观看)</p>
                            </div>
                        </div>
                        
						<div class="form-group">
                            <label for="input-nonvip_watch_nums" class="col-sm-2 control-label">免费观看视频数</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-nonvip_watch_nums" name="options[nonvip_watch_nums]" value="<?php echo (isset($config['nonvip_watch_nums']) && ($config['nonvip_watch_nums'] !== '')?$config['nonvip_watch_nums']:''); ?>">
                                <p class="help-block">非vip用户或游客每天可免费观看视频数,0表示不限制(整数)</p>
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
					
					
					<!-- 云存储设置 -->
                    <div class="tab-pane" id="M">
                        
						<div class="form-group">
							<label for="input-sex" class="col-sm-2 control-label">选择存储方式</label>
							<div class="col-md-6 col-sm-10" id="cloudtype">
								
								<label class="radio-inline"><input type="radio" name="options[cloudtype]" value="1" <?php if($config['cloudtype'] == '1'): ?>checked="checked"<?php endif; ?>>七牛云存储</label>
								<label class="radio-inline"><input type="radio" name="options[cloudtype]" value="2" <?php if($config['cloudtype'] == '2'): ?>checked="checked"<?php endif; ?>>腾讯云存储</label>
                                <label class="radio-inline"><input type="radio" name="options[cloudtype]" value="3" <?php if($config['cloudtype'] == '3'): ?>checked="checked"<?php endif; ?>>亚马逊存储</label>
							</div>
						</div>
						
						<div id="cloudtype_1" class="cloudtype_hide <?php if($config['cloudtype'] != '1'): ?>hide<?php endif; ?>">

                            <div class="form-group">
                                <label for="input-qiniu_accesskey" class="col-sm-2 control-label">注意：</label>
                                <div class="col-md-6 col-sm-10">
                                    <p class="help-block">1、在七牛云创建存储空间 选择存储区域【非华东】后，在 PhalApi/Appapi/Api/Video.php/getCosInfo方法/qiniuInfo/qiniu_zone 要进行相应存储区域的替换【代码中有备注】,否则app上传失败</p>
                                    <p class="help-block">2、在七牛云创建存储空间 选择存储区域【非华东】后，在 PhalApi/Library/Qiniu/qiniu/conf.php/QINIU_UP_HOST 要进行相应服务端上传域名的替换【代码中有备注】,否则app在修改头像等会提示上传失败</p>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="input-qiniu_zone" class="col-sm-2 control-label">七牛云存储区域</label>
                                <div class="col-md-6 col-sm-10" id="qiniu_zone">
                                    
                                    <label class="radio-inline"><input type="radio" name="options[qiniu_zone]" value="z0" <?php if($config['qiniu_zone'] == 'z0'): ?>checked="checked"<?php endif; ?>>华东</label>
                                    <label class="radio-inline"><input type="radio" name="options[qiniu_zone]" value="z1" <?php if($config['qiniu_zone'] == 'z1'): ?>checked="checked"<?php endif; ?>>华北</label>
                                    <label class="radio-inline"><input type="radio" name="options[qiniu_zone]" value="z2" <?php if($config['qiniu_zone'] == 'z2'): ?>checked="checked"<?php endif; ?>>华南</label>
                                    <label class="radio-inline"><input type="radio" name="options[qiniu_zone]" value="na0" <?php if($config['qiniu_zone'] == 'na0'): ?>checked="checked"<?php endif; ?>>北美</label>
                                    <label class="radio-inline"><input type="radio" name="options[qiniu_zone]" value="as0" <?php if($config['qiniu_zone'] == 'as0'): ?>checked="checked"<?php endif; ?>>东南亚</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-qiniu_protocol" class="col-sm-2 control-label">七牛存储域名协议</label>
                                <div class="col-md-6 col-sm-10" id="qiniu_protocol">
                                    
                                    <label class="radio-inline"><input type="radio" name="options[qiniu_protocol]" value="http" <?php if($config['qiniu_protocol'] == 'http'): ?>checked="checked"<?php endif; ?>>http</label>
                                    <label class="radio-inline"><input type="radio" name="options[qiniu_protocol]" value="https" <?php if($config['qiniu_protocol'] == 'https'): ?>checked="checked"<?php endif; ?>>https</label>
                                    
                                </div>
                            </div>
						
							<div class="form-group">
								<label for="input-qiniu_accesskey" class="col-sm-2 control-label">七牛云存储accessKey</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-qiniu_accesskey" name="options[qiniu_accesskey]" value="<?php echo (isset($config['qiniu_accesskey']) && ($config['qiniu_accesskey'] !== '')?$config['qiniu_accesskey']:''); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="input-qiniu_secretkey" class="col-sm-2 control-label">七牛云存储secretKey</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-qiniu_secretkey" name="options[qiniu_secretkey]" value="<?php echo (isset($config['qiniu_secretkey']) && ($config['qiniu_secretkey'] !== '')?$config['qiniu_secretkey']:''); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="input-qiniu_bucket" class="col-sm-2 control-label">七牛云存储bucket</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-qiniu_bucket" name="options[qiniu_bucket]" value="<?php echo (isset($config['qiniu_bucket']) && ($config['qiniu_bucket'] !== '')?$config['qiniu_bucket']:''); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="input-qiniu_domain" class="col-sm-2 control-label">七牛云存储空间域名</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-qiniu_domain" name="options[qiniu_domain]" value="<?php echo (isset($config['qiniu_domain']) && ($config['qiniu_domain'] !== '')?$config['qiniu_domain']:''); ?>"><p class="help-block">不带http://或https://，不要以/结尾；如qiniudemo.yunbaozhibo.com</p>
								</div>
							</div>
							
						
						</div>
						
						
						<div id="cloudtype_2" class="cloudtype_hide <?php if($config['cloudtype'] != '2'): ?>hide<?php endif; ?>" >

                            <div class="form-group">
                                <label for="input-tx_private_signature" class="col-sm-2 control-label">是否开启私有读签名验证</label>
                                <div class="col-md-6 col-sm-10" id="tx_private_signature">
                                    
                                    <label class="radio-inline"><input type="radio" name="options[tx_private_signature]" value="0" <?php if($config['tx_private_signature'] == '0'): ?>checked="checked"<?php endif; ?>>关闭</label>
                                    <label class="radio-inline"><input type="radio" name="options[tx_private_signature]" value="1" <?php if($config['tx_private_signature'] == '1'): ?>checked="checked"<?php endif; ?>>开启</label>
                                    <p class="help-block">保证腾讯云后台 https://cloud.tencent.com ->对象存储->存储桶->权限管理 中设置为私有读写时开启</p>
                                </div>
                            </div>
						
							<div class="form-group">
								<label for="input-txcloud_appid" class="col-sm-2 control-label">腾讯云存储appid</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-txcloud_appid" name="options[txcloud_appid]" value="<?php echo (isset($config['txcloud_appid']) && ($config['txcloud_appid'] !== '')?$config['txcloud_appid']:''); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="input-txcloud_secret_id" class="col-sm-2 control-label">腾讯云存储secret_id</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-txcloud_secret_id" name="options[txcloud_secret_id]" value="<?php echo (isset($config['txcloud_secret_id']) && ($config['txcloud_secret_id'] !== '')?$config['txcloud_secret_id']:''); ?>">
                                    <p class="help-block">/public/txcloud_server/sts.php文件中也要进行相关参数配置，同时该文件中header头配置信息需要将跨域域名127.0.0.1修改为该站点域名</p>
								</div>
							</div>
							<div class="form-group">
								<label for="input-txcloud_secret_key" class="col-sm-2 control-label">腾讯云存储secret_key</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-txcloud_secret_key" name="options[txcloud_secret_key]" value="<?php echo (isset($config['txcloud_secret_key']) && ($config['txcloud_secret_key'] !== '')?$config['txcloud_secret_key']:''); ?>">
                                    <p class="help-block">/public/txcloud_server/sts.php文件中也要进行相关参数配置，且腾讯云后台 对象存储-->存储桶名称-->配置管理-->安全管理-->跨域访问CORS设置-->添加规则--></p>
                                    <p class="help-block">1:来源Origin 填写站点域名，多域名时换行即可</p>
                                    <p class="help-block">2:Expose-Headers 默认填写Etag</p>
                                    <p class="help-block">3:超时Max-Age 填写1800</p>
								</div>
							</div>
							<div class="form-group">
								<label for="input-txcloud_region" class="col-sm-2 control-label">腾讯云存储region</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-txcloud_region" name="options[txcloud_region]" value="<?php echo (isset($config['txcloud_region']) && ($config['txcloud_region'] !== '')?$config['txcloud_region']:''); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="input-txcloud_bucket" class="col-sm-2 control-label">腾讯云存储bucket</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-txcloud_bucket" name="options[txcloud_bucket]" value="<?php echo (isset($config['txcloud_bucket']) && ($config['txcloud_bucket'] !== '')?$config['txcloud_bucket']:''); ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label for="input-tx_domain_url" class="col-sm-2 control-label">腾讯云存储空间url地址</label>
								<div class="col-md-6 col-sm-10">
									<input type="text" class="form-control" id="input-tx_domain_url" name="options[tx_domain_url]" value="<?php echo (isset($config['tx_domain_url']) && ($config['tx_domain_url'] !== '')?$config['tx_domain_url']:''); ?>">
									<p class="help-block">以http://或https://开头，以/结尾；如https://dspceshi-1255549201.cos.ap-shanghai.myqcloud.com/ 如果存储桶->域名管理->加速域名或源站域名配置的话，请填写对应域名，若没配置，请填写文件地址的url</p>
								</div>
							</div>
						
						</div>
						
						<div id="cloudtype_3" class="cloudtype_hide <?php if($config['cloudtype'] != '3'): ?>hide<?php endif; ?>" >
                            <div class="form-group">
                                <label for="input-aws_bucket" class="col-sm-2 control-label">亚马逊存储Bucket</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-aws_bucket" name="options[aws_bucket]" value="<?php echo (isset($config['aws_bucket']) && ($config['aws_bucket'] !== '')?$config['aws_bucket']:''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-aws_region" class="col-sm-2 control-label">亚马逊存储region</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-aws_region" name="options[aws_region]" value="<?php echo (isset($config['aws_region']) && ($config['aws_region'] !== '')?$config['aws_region']:''); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-aws_hosturl" class="col-sm-2 control-label">亚马逊存储域名</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-aws_hosturl" name="options[aws_hosturl]" value="<?php echo (isset($config['aws_hosturl']) && ($config['aws_hosturl'] !== '')?$config['aws_hosturl']:''); ?>">
                                    <p class="help-block">以https://开头，以/结尾</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-aws_identitypoolid" class="col-sm-2 control-label">亚马逊角色标识</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-aws_identitypoolid" name="options[aws_identitypoolid]" value="<?php echo (isset($config['aws_identitypoolid']) && ($config['aws_identitypoolid'] !== '')?$config['aws_identitypoolid']:''); ?>">APP端专用
                                </div>
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
					
					<!-- 直播配置 -->
                    <div class="tab-pane" id="N">

                        <div class="form-group">
                            <label for="input-live_videos" class="col-sm-2 control-label">进行直播需发布视频达到数量</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-live_videos" name="options[live_videos]" value="<?php echo (isset($config['live_videos']) && ($config['live_videos'] !== '')?$config['live_videos']:''); ?>">
                                <p class="help-block">发布视频(审核通过且未下架)达到该数量可进行直播,0表示不限制(整数)</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-live_fans" class="col-sm-2 control-label">进行直播需达到粉丝数量</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-live_fans" name="options[live_fans]" value="<?php echo (isset($config['live_fans']) && ($config['live_fans'] !== '')?$config['live_fans']:''); ?>">
                                <p class="help-block">粉丝达到该数量可进行直播,0表示不限制(整数)</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-cdn_switch" class="col-sm-2 control-label">直播推拉流</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[cdn_switch]" value="1" <?php if($config['cdn_switch'] == '1'): ?>checked<?php endif; ?>>腾讯云</label>
                               
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-tx_appid" class="col-sm-2 control-label">直播appid</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-tx_appid" name="options[tx_appid]" value="<?php echo (isset($config['tx_appid']) && ($config['tx_appid'] !== '')?$config['tx_appid']:''); ?>">
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-tx_bizid" class="col-sm-2 control-label">直播bizid</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-tx_bizid" name="options[tx_bizid]" value="<?php echo (isset($config['tx_bizid']) && ($config['tx_bizid'] !== '')?$config['tx_bizid']:''); ?>">
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-tx_push_key" class="col-sm-2 control-label">直播推流防盗链Key</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-tx_push_key" name="options[tx_push_key]" value="<?php echo (isset($config['tx_push_key']) && ($config['tx_push_key'] !== '')?$config['tx_push_key']:''); ?>">
                                
                            </div>
                        </div>
						
						<div class="form-group">
							<label for="input-tx_acc_key" class="col-sm-2 control-label">直播低延迟Key</label>
							<div class="col-md-6 col-sm-10">
								<input type="text" class="form-control" id="input-tx_acc_key" name="options[tx_acc_key]" value="<?php echo (isset($config['tx_acc_key']) && ($config['tx_acc_key'] !== '')?$config['tx_acc_key']:''); ?>">
								<p class="help-block">一般是 直播推流防盗链Key</p>
							</div>
						</div>

                        <div class="form-group">
                            <label for="input-tx_api_key" class="col-sm-2 control-label">直播API鉴权key</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-tx_api_key" name="options[tx_api_key]" value="<?php echo (isset($config['tx_api_key']) && ($config['tx_api_key'] !== '')?$config['tx_api_key']:''); ?>">
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-tx_push" class="col-sm-2 control-label">直播推流域名</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-tx_push" name="options[tx_push]" value="<?php echo (isset($config['tx_push']) && ($config['tx_push'] !== '')?$config['tx_push']:''); ?>">
                             <p class="help-block">不带 http:// ,最后无 /</p>   
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-tx_pull" class="col-sm-2 control-label">直播播流域名</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-tx_pull" name="options[tx_pull]" value="<?php echo (isset($config['tx_pull']) && ($config['tx_pull'] !== '')?$config['tx_pull']:''); ?>">
                             <p class="help-block">不带 http:// ,最后无 /</p>   
                            </div>
                        </div>
						
						<div class="form-group">
                                <label for="input-live_txcloud_secret_id" class="col-sm-2 control-label">腾讯云Api密钥SecretId</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-live_txcloud_secret_id" name="options[live_txcloud_secret_id]" value="<?php echo (isset($config['live_txcloud_secret_id']) && ($config['live_txcloud_secret_id'] !== '')?$config['live_txcloud_secret_id']:''); ?>">
                                    <p class="help-block">腾讯云连麦混流时身份验证，只在直播+连麦模式时才需要配置，获取方式：腾讯云后台-->用户登录账号下拉菜单-->访问管理-->访问密钥-->API密钥管理</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-live_txcloud_secret_key" class="col-sm-2 control-label">腾讯云Api密钥SecretKey</label>
                                <div class="col-md-6 col-sm-10">
                                    <input type="text" class="form-control" id="input-live_txcloud_secret_key" name="options[live_txcloud_secret_key]" value="<?php echo (isset($config['live_txcloud_secret_key']) && ($config['live_txcloud_secret_key'] !== '')?$config['live_txcloud_secret_key']:''); ?>">
                                    <p class="help-block">腾讯云连麦混流时身份验证，只在直播+连麦模式时才需要配置，获取方式：腾讯云后台-->用户登录账号下拉菜单-->访问管理-->访问密钥-->API密钥管理</p>
                                    
                                </div>
                            </div>

                        <div class="form-group">
                            <label for="input-userlist_time" class="col-sm-2 control-label">用户列表请求间隔</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-userlist_time" name="options[userlist_time]" value="<?php echo (isset($config['userlist_time']) && ($config['userlist_time'] !== '')?$config['userlist_time']:''); ?>">
                             <p class="help-block">秒  直播间用户列表刷新间隔时间</p>   
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-chatserver" class="col-sm-2 control-label">聊天服务器带端口</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-chatserver" name="options[chatserver]" value="<?php echo (isset($config['chatserver']) && ($config['chatserver'] !== '')?$config['chatserver']:''); ?>">
                             <p class="help-block">格式：http://域名(:端口) 或者 http://IP(:端口)</p>   
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
					
					<!-- 敏感词 -->
                    <div class="tab-pane" id="O">

                        <div class="form-group">
                            <label for="input-watch_video_type" class="col-sm-2 control-label">关键词<p class="help-block">多词间用英文,分隔 如：敏感词1,敏感词2,敏感词3</p></label>
                            
                            <div class="col-md-6 col-sm-10">
                                <textarea type="text" class="form-control" id="input-sensitive_words" name="options[sensitive_words]" style="height: 400px;"><?php echo (isset($config['sensitive_words']) && ($config['sensitive_words'] !== '')?$config['sensitive_words']:''); ?></textarea>
                                <p class="help-block">用于视频标题、视频评论、用户昵称、个性签名、直播标题、私信等。</p>
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
					
					
					<!-- 每日任务 -->
					<div class="tab-pane" id="P">
                        
                        <div class="form-group">
                            <label for="input-watch_live_term" class="col-sm-2 control-label">观看直播</label>
                            <div class="col-md-6 col-sm-10"><br />
                                条件(分钟)：<input type="text" class="form-control" id="input-watch_live_term" name="options[watch_live_term]" value="<?php echo (isset($config['watch_live_term']) && ($config['watch_live_term'] !== '')?$config['watch_live_term']:'0'); ?>"><br />
                                奖励(钻石)：<input type="text" class="form-control" id="input-watch_live_coin" name="options[watch_live_coin]" value="<?php echo (isset($config['watch_live_coin']) && ($config['watch_live_coin'] !== '')?$config['watch_live_coin']:'0'); ?>">
								
								<p class="help-block">注：切记!填写的条件和奖励一定要填写整数;例: 当用户观看直播时长达到X分钟时奖励X钻石</p>
                            </div>
							
                        </div>
                       
						
						 <div class="form-group">
                            <label for="input-watch_video_term" class="col-sm-2 control-label">观看视频</label>
                            <div class="col-md-6 col-sm-10"><br />
                                条件(分钟)：<input type="text" class="form-control" id="input-watch_video_term" name="options[watch_video_term]" value="<?php echo (isset($config['watch_video_term']) && ($config['watch_video_term'] !== '')?$config['watch_video_term']:'0'); ?>"><br />
                                奖励(钻石)：<input type="text" class="form-control" id="input-watch_video_coin" name="options[watch_video_coin]" value="<?php echo (isset($config['watch_video_coin']) && ($config['watch_video_coin'] !== '')?$config['watch_video_coin']:'0'); ?>">
								<p class="help-block">注：切记!填写的条件和奖励一定要填写整数;例: 当用户观看视频时长达到X分钟时奖励X钻石</p>
                            </div>
							
                        </div>
						
						<div class="form-group">
                            <label for="input-open_live_term" class="col-sm-2 control-label">直播奖励</label>
                            <div class="col-md-6 col-sm-10"><br />
                                条件(小时)：<input type="text" class="form-control" id="input-open_live_term" name="options[open_live_term]" value="<?php echo (isset($config['open_live_term']) && ($config['open_live_term'] !== '')?$config['open_live_term']:'0'); ?>"><br />
                                奖励(钻石)：<input type="text" class="form-control" id="input-open_live_coin" name="options[open_live_coin]" value="<?php echo (isset($config['open_live_coin']) && ($config['open_live_coin'] !== '')?$config['open_live_coin']:'0'); ?>">
								<p class="help-block">注：切记!填写的条件和奖励一定要填写整数;例: 当主播每天开播满足X小时可获得奖励X钻石</p>
                            </div>
							
                        </div>
						
						
						<div class="form-group">
                            <label for="input-award_live_term" class="col-sm-2 control-label">打赏奖励</label>
                            <div class="col-md-6 col-sm-10"><br />
                                条件(钻石)：<input type="text" class="form-control" id="input-award_live_term" name="options[award_live_term]" value="<?php echo (isset($config['award_live_term']) && ($config['award_live_term'] !== '')?$config['award_live_term']:'0'); ?>"><br />
                                奖励(钻石)：<input type="text" class="form-control" id="input-award_live_coin" name="options[award_live_coin]" value="<?php echo (isset($config['award_live_coin']) && ($config['award_live_coin'] !== '')?$config['award_live_coin']:'0'); ?>">
								<p class="help-block">注：切记!填写的条件和奖励一定要填写整数;例: 当用户打赏主播超过X钻石，奖励X钻石</p>
                            </div>
							
                        </div>
						
						<div class="form-group">
                            <label for="input-share_live_term" class="col-sm-2 control-label">分享奖励</label>
                            <div class="col-md-6 col-sm-10"><br />
                                条件(次)：<input type="text" class="form-control" id="input-share_live_term" name="options[share_live_term]" value="<?php echo (isset($config['share_live_term']) && ($config['share_live_term'] !== '')?$config['share_live_term']:'0'); ?>"><br />
                                奖励(钻石)：<input type="text" class="form-control" id="input-share_live_coin" name="options[share_live_coin]" value="<?php echo (isset($config['share_live_coin']) && ($config['share_live_coin'] !== '')?$config['share_live_coin']:'0'); ?>">
								<p class="help-block">注：切记!填写的条件和奖励一定要填写整数;例:用户每日分享直播间X次可获得奖励X钻石</p>
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
					
                    <!-- 店铺/商品配置 -->
                    <div class="tab-pane" id="Q">

                        <div class="form-group">
                            <label for="input-shop_system_name" class="col-sm-2 control-label">系统店铺名称</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-shop_system_name" name="options[shop_system_name]" value="<?php echo (isset($config['shop_system_name']) && ($config['shop_system_name'] !== '')?$config['shop_system_name']:''); ?>">
                                <p class="help-block">用于用户店铺顶部标题显示</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-shop_bond" class="col-sm-2 control-label">申请店铺需要的保证金(<?php echo $name_coin; ?>)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-shop_bond" name="options[shop_bond]" value="<?php echo (isset($config['shop_bond']) && ($config['shop_bond'] !== '')?$config['shop_bond']:''); ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-show_switch" class="col-sm-2 control-label">店铺审核</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[show_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['show_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-show_switch" class="col-sm-2 control-label">店铺经营类目审核</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[show_category_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['show_category_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-shoporder_percent" class="col-sm-2 control-label">店铺订单默认抽成比例</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-shoporder_percent" name="options[shoporder_percent]" value="<?php echo (isset($config['shoporder_percent']) && ($config['shoporder_percent'] !== '')?$config['shoporder_percent']:'0'); ?>">%
                                <p class="help-block">0-100之间的整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-goods_switch" class="col-sm-2 control-label">商品审核</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[goods_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['goods_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-shop_certificate_desc" class="col-sm-2 control-label">店铺资质说明</label>
                            <div class="col-md-6 col-sm-10">
                                <textarea class="form-control" id="input-shop_certificate_desc" name="options[shop_certificate_desc]" ><?php echo (isset($config['shop_certificate_desc']) && ($config['shop_certificate_desc'] !== '')?$config['shop_certificate_desc']:''); ?></textarea>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-shop_payment_time" class="col-sm-2 control-label">店铺付款失效时间(分钟)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-shop_payment_time" name="options[shop_payment_time]" value="<?php echo (isset($config['shop_payment_time']) && ($config['shop_payment_time'] !== '')?$config['shop_payment_time']:'0'); ?>">
                                <p class="help-block">大于0的整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-shop_shipment_time" class="col-sm-2 control-label">店铺发货失效时间(天)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-shop_shipment_time" name="options[shop_shipment_time]" value="<?php echo (isset($config['shop_shipment_time']) && ($config['shop_shipment_time'] !== '')?$config['shop_shipment_time']:'0'); ?>">
                                <p class="help-block">大于0的整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-shop_receive_time" class="col-sm-2 control-label">店铺自动确认收货时间(天)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-shop_receive_time" name="options[shop_receive_time]" value="<?php echo (isset($config['shop_receive_time']) && ($config['shop_receive_time'] !== '')?$config['shop_receive_time']:'0'); ?>">
                                <p class="help-block">大于0的整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-shop_refund_time" class="col-sm-2 control-label">买家发起退款,卖家不做处理自动退款时间(天)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-shop_refund_time" name="options[shop_refund_time]" value="<?php echo (isset($config['shop_refund_time']) && ($config['shop_refund_time'] !== '')?$config['shop_refund_time']:'0'); ?>">
                                <p class="help-block">大于0的整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-shop_refund_finish_time" class="col-sm-2 control-label">卖家拒绝买家退款后,买家不做任何操作,订单自动进入退款前状态的时间(天)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-shop_refund_finish_time" name="options[shop_refund_finish_time]" value="<?php echo (isset($config['shop_refund_finish_time']) && ($config['shop_refund_finish_time'] !== '')?$config['shop_refund_finish_time']:'0'); ?>">
                                <p class="help-block">大于0的整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-shop_receive_refund_time" class="col-sm-2 control-label">订单确认收货后,支持退货退款的时间限制(天)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-shop_receive_refund_time" name="options[shop_receive_refund_time]" value="<?php echo (isset($config['shop_receive_refund_time']) && ($config['shop_receive_refund_time'] !== '')?$config['shop_receive_refund_time']:'0'); ?>">
                                <p class="help-block">大于0的整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-shop_settlement_time" class="col-sm-2 control-label">订单确认收货后,货款自动打到卖家的时间(天)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-shop_settlement_time" name="options[shop_settlement_time]" value="<?php echo (isset($config['shop_settlement_time']) && ($config['shop_settlement_time'] !== '')?$config['shop_settlement_time']:'0'); ?>">
                                <p class="help-block">大于0的整数</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-balance_cash_min" class="col-sm-2 control-label">余额提现最低额度（元）</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-balance_cash_min" name="options[balance_cash_min]" value="<?php echo (isset($config['balance_cash_min']) && ($config['balance_cash_min'] !== '')?$config['balance_cash_min']:''); ?>">
                                <p class="help-block">可提现的最小额度，低于该额度无法提现</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-balance_cash_start" class="col-sm-2 control-label">每月提现期限</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-balance_cash_start" name="options[balance_cash_start]" value="<?php echo (isset($config['balance_cash_start']) && ($config['balance_cash_start'] !== '')?$config['balance_cash_start']:''); ?>" style="width:100px;display:inline-block;"> - 
                                <input type="text" class="form-control" id="input-balance_cash_end" name="options[balance_cash_end]" value="<?php echo (isset($config['balance_cash_end']) && ($config['balance_cash_end'] !== '')?$config['balance_cash_end']:''); ?>" style="width:100px;display:inline-block;">
                                <p class="help-block">每月提现期限，不在时间段无法提现 </p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-balance_cash_max_times" class="col-sm-2 control-label">每月提现次数</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-balance_cash_max_times" name="options[balance_cash_max_times]" value="<?php echo (isset($config['balance_cash_max_times']) && ($config['balance_cash_max_times'] !== '')?$config['balance_cash_max_times']:''); ?>">
                                <p class="help-block">每月可提现最大次数，0表示不限制</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-shoporder_percent" class="col-sm-2 control-label">店铺机制说明</label>
                            <div class="col-md-6 col-sm-10">
                                <p class="help-block">1:用户下单后<?php echo (isset($config['shop_payment_time']) && ($config['shop_payment_time'] !== '')?$config['shop_payment_time']:'0'); ?>分钟不付款，系统自动将订单关闭</p>
                                <p class="help-block">2:买家付款成功后，卖家超过<?php echo (isset($config['shop_shipment_time']) && ($config['shop_shipment_time'] !== '')?$config['shop_shipment_time']:'0'); ?>天未发货，系统自动关闭,商品所花费金额退还到买家账户余额中</p>
                                <p class="help-block">3:商家发货后，买家超过<?php echo (isset($config['shop_receive_time']) && ($config['shop_receive_time'] !== '')?$config['shop_receive_time']:'0'); ?>天未确认收货，系统自动确认收货，商品所花费金额自动转到卖家账户余额中</p>
                                <p class="help-block">4:买家发起退款后,卖家超过<?php echo (isset($config['shop_refund_time']) && ($config['shop_refund_time'] !== '')?$config['shop_refund_time']:'0'); ?>天未做处理，系统自动退款，商品所花费金额自动转到买家账户余额中</p>
                                <p class="help-block">5:卖家拒绝买家退款后,买家不做任何操作,超过<?php echo (isset($config['shop_refund_finish_time']) && ($config['shop_refund_finish_time'] !== '')?$config['shop_refund_finish_time']:'0'); ?>天退款处理 系统自动完成，订单自动进入退款前状态</p>
                                <p class="help-block">6:买家确认收货后,<?php echo (isset($config['shop_receive_refund_time']) && ($config['shop_receive_refund_time'] !== '')?$config['shop_receive_refund_time']:'0'); ?>天内可以发起退货退款</p>
                                <p class="help-block">7:买家确认收货后,超过<?php echo (isset($config['shop_settlement_time']) && ($config['shop_settlement_time'] !== '')?$config['shop_settlement_time']:'0'); ?>天系统自动结算，将货款转给卖家</p>
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
                    <!-- 物流配置 -->
                    <div class="tab-pane" id="R">
                        
                        <div class="form-group">
                            <label for="input-express_type" class="col-sm-2 control-label">物流模式</label>
                            <div class="col-md-6 col-sm-10">
                                <label class="radio-inline"><input type="radio" name="options[express_type]" value="0" <?php if($config['express_type'] == '0'): ?>checked<?php endif; ?> >开发版</label>
                                <label class="radio-inline"><input type="radio" name="options[express_type]" value="1" <?php if($config['express_type'] == '1'): ?>checked<?php endif; ?> >正式版</label>
                                <p class="help-block">开发版仅适用于程序调试,每天查询最多500次,且只支持申通、圆通、百世、天天</p>
                                <p class="help-block">正式运营后,请购买三方套餐,将正式版电商EBusinessID和AppKey填写,并且将此处的物流模式切换为正式版；<a href="http://www.kdniao.com" target="_blank">立即购买</a></p>

                            </div>

                        </div>

                        <div class="form-group">
                            <label for="input-express_id_dev" class="col-sm-2 control-label">用户ID（开发版）</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-express_id_dev" name="options[express_id_dev]" value="<?php echo (isset($config['express_id_dev']) && ($config['express_id_dev'] !== '')?$config['express_id_dev']:''); ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-express_appkey_dev" class="col-sm-2 control-label">Api Key（开发版）</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-express_appkey_dev" name="options[express_appkey_dev]" value="<?php echo (isset($config['express_appkey_dev']) && ($config['express_appkey_dev'] !== '')?$config['express_appkey_dev']:''); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-express_id" class="col-sm-2 control-label">用户ID (正式版)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-express_id" name="options[express_id]" value="<?php echo (isset($config['express_id']) && ($config['express_id'] !== '')?$config['express_id']:''); ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-express_appkey" class="col-sm-2 control-label">Api Key (正式版)</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-express_appkey" name="options[express_appkey]" value="<?php echo (isset($config['express_appkey']) && ($config['express_appkey'] !== '')?$config['express_appkey']:''); ?>">
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

                    <!-- openinstall配置 -->
                    <div class="tab-pane" id="S">
                        
                        <div class="form-group">
                            <label for="input-openinstall_switch" class="col-sm-2 control-label">openinstall开关</label>
                            <div class="col-md-6 col-sm-10">
                                <select class="form-control" name="options[openinstall_switch]">
                                    <option value="0">关闭</option>
                                    <option value="1" <?php if($config['openinstall_switch'] == '1'): ?>selected<?php endif; ?>>开启</option>
                                </select>
                                <p class="help-block">该功能打开时，用户下载APP，注册账号后，会自动建立上下级邀请关系</p>
                                <p class="help-block">该功能关闭后，用户下载APP后，需要通过填写邀请码的方式建立上下级邀请关系</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-openinstall_appkey" class="col-sm-2 control-label">openinstall AppKey</label>
                            <div class="col-md-6 col-sm-10">
                                <input type="text" class="form-control" id="input-openinstall_appkey" name="options[openinstall_appkey]" value="<?php echo (isset($config['openinstall_appkey']) && ($config['openinstall_appkey'] !== '')?$config['openinstall_appkey']:''); ?>">
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
 <script>
	(function(){
		$("#cloudtype label.radio-inline").on('click',function(){
			var v=$("input",this).val();
	
			
			$(".cloudtype_hide").addClass('hide');
			
			$("#cloudtype_"+v).removeClass('hide');
		
		})

       $("#cdn label").on('click',function(){
            var v_d=$("input",this).attr('disabled');
            if(v_d=='disabled'){
                return !1;
            }
            var v=$("input",this).val();
            var b=$("#code_switch_"+v);
            $(".cdn_bd").hide();
            b.show();
        })
	})()
	</script>
</body>
</html>
