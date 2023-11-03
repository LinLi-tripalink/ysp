<?php /*a:2:{s:78:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/admin/main/index.html";i:1668570290;s:75:"/data/wwwroot/bjwz.yyyybbbb.com/themes/admin_simpleboot3/public/header.html";i:1668570290;}*/ ?>
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
<link href="/static/simpleboot/css/index.css" rel="stylesheet" type="text/css">
</head>
<body>
	<style>
		.stay{
			margin-bottom: 10px;
		}
		.stay li{
			border: 1px solid rgb(204 204 204 / 25%);
			padding: 5px 15px;
			border-radius: 28px;
			height: 38px;
			font-size: 14px;
			margin-right: 30px;
			margin-top: 5px;
			float: left;
			background-color: rgb(204 204 204 / 25%);
			color: rgb(0 0 0 / 84%);
			
		}
		.stay li span{
			color: #FEC444;
			font-size: 16px;
		}
		.data{
			width: 110px;
			font-sie: 14px;
			line-height: 1.42857143;
			color: #333333;
			background-color: #fff;
			background-image: none;
			border: 1px solid #ddd;
			border-radius: 4px;
			-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
			box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
			-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
			-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
			transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
		}
				
	
	</style>
    <div class="content">
        <div class="statistics basic">		
            <div class="title">基本指标
                <div class="tips">
                    <img src="/static/simpleboot/images/wenti.png">
                    <div class="tips_bd">
                        网站概况帮助您整体了解网站情况，从用户数量、活跃度、访客等分析维度提供统计数据，以便于了解分析，优化运作方法。
                    </div>
                </div>
                <div class="bd_title">
                    <input type="hidden" class="action" value='1'>
                    <div class="data_select">
                        <input type="text" name="start_time" class="js-bootstrap-date data" value="" autocomplete="off" placeholder="开始时间">-
                        <input type="text" class="js-bootstrap-date data" name="end_time" value=""  autocomplete="off" placeholder="结束时间">
                    </div>
                    <div class="search">
                        查询
                    </div>
                    <div class="export">
                        导出
                    </div>
                </div>
            </div>
            <div class="bd">
                <div class="basic_list clear">
                    <ul>
                        <li class="newusers">
                            <div class="basic_list_n"><span><?php echo $basic_today['newUsers']; ?></span></div>
                            <div class="basic_list_t">新增用户</div>
                        </li>
                        <li class="launches">
                            <div class="basic_list_n"><span><?php echo $basic_today['launches']; ?></span></div>
                            <div class="basic_list_t">启动次数</div>
                        </li>
                        <li class="durations no">
                            <div class="basic_list_n"><span>0</span>分钟</div>
                            <div class="basic_list_t">使用时长</div>
                        </li>
                        <li class="activityusers">
                            <div class="basic_list_n"><span><?php echo $basic_today['activityUsers']; ?></span></div>
                            <div class="basic_list_t">活跃用户</div>
                        </li>
                        
                        <li class="users_total">
                            <div class="basic_list_n"><span><?php echo $users_total; ?></span></div>
                            <div class="basic_list_t">总注册量</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
		
		<div class="statistics basic">
			<div class="title" >待办事项
                <div class="tips">
                    <img src="/static/simpleboot/images/wenti.png">
                    <div class="tips_bd">
                        网站概况帮助您整体了解网站情况，从店铺申请数量、视频待审核数量、用户认证申请数量等分析维度提供统计数据，以便于了解分析，优化运作方法。
                    </div>
                </div>
                
            </div>
			
			<div class="bd">
				<ul class="stay clear">
					<a href="<?php echo url('Shopapply/index'); ?>"><li>店铺待审核数量( <span><?php echo $stayinfo['shopapply_count']; ?></span> )</li></a>
						
					<a href="<?php echo url('video/index'); ?>"><li>视频待审核数量( <span><?php echo $stayinfo['video_count']; ?></span> )</li></a>
					
					<a href="<?php echo url('video/reportlist'); ?>"><li>视频举报数量( <span><?php echo $stayinfo['videorepot_count']; ?></span> )</li></a>
					
					<a href="<?php echo url('livereport/index'); ?>"><li>直播间举报数量( <span><?php echo $stayinfo['livereport_count']; ?></span> )</li></a>

					<a href="<?php echo url('userauth/index'); ?>"><li>用户认证待审核数量( <span><?php echo $stayinfo['auth_count']; ?></span> )</li></a>
					<li class="hide"></li>
				
				</ul>
			</div>
		</div>
		
		
        <div class="statistics w50 mr10 source">
            <div class="title">终端占比
                <div class="tips">
                    <img src="/static/simpleboot/images/wenti.png">
                    <div class="tips_bd">
                        提供网站访客所使用的终端，参考此数据进行网页设计、开发，可更好地提高兼容性，以达到良好的用户交互体验。
                    </div>
                </div>
            </div>
            <div class="bd">
                <div id="echarts_source" style="width:100%;height:300px;"></div>
            </div>
        </div>
        <div class="statistics w50 reg">
            <div class="title">登录渠道
                <div class="tips">
                    <img src="/static/simpleboot/images/wenti.png">
                    <div class="tips_bd">
                        提供访客所使用的登陆接口信息，参考此数据，对终端用户进行比对，开发，以达到良好的用户交互体验。
                    </div>
                </div>
            </div>
            <div class="bd">
                <div id="echarts_reg" style="width:100%;height:300px;"></div>
            </div>
        </div>
        
        <div class="statistics clear source">
            <div class="title">七天数据
                <div class="tips">
                    <img src="/static/simpleboot/images/wenti.png">
                    <div class="tips_bd">
                        站点近7天的数据增量，包括视频数，点赞数，粉丝数的增量走势，参考此数据，对网站运作数据调整优化，以达到良好的用户交互体验。
                    </div>
                </div>
                <div class="bd_title">
                    <input type="hidden" class="action" value='2'>
                    <div class="export">
                        导出
                    </div>
                </div>
            </div>
            <div class="bd">
                <div id="echarts_week" style="width:100%;height:300px;"></div>
            </div>
        </div>
        
        <div class="statistics clear source">
            <div class="title">广告数据
                <div class="tips">
                    <img src="/static/simpleboot/images/wenti.png">
                    <div class="tips_bd">
                        展示每日的视频增减量，以及用户的观看量走势，便于分析数据维度，提供统计数据，以达到良好的用户交互体验。
                    </div>
                </div>
                <div class="bd_title">
                    <input type="hidden" class="action" value='3'>
                    <div class="data_select">
                        <input type="text" name="start_time" class="js-bootstrap-date data" value="" autocomplete="off" placeholder="开始时间">-
                        <input type="text" class="js-bootstrap-date data" name="end_time" value="" autocomplete="off" placeholder="结束时间">
                    </div>
                    <div class="search">
                        查询
                    </div>
                    <div class="export">
                        导出
                    </div>
                </div>
            </div>
            <div class="bd">
                <div id="echarts_ad" style="width:100%;height:300px;"></div>
            </div>
        </div>


        <div class="statistics clear plat">
            <div class="title">平台数据
                <div class="tips">
                    <img src="/static/simpleboot/images/wenti.png">
                    <div class="tips_bd">
                        提供站点运营的总数据，以及近30天的平台活跃增减量数据，以便于了解网站整体运作数据状况，以达到良好的用户交互体验。
                    </div>
                </div>
            </div>
            <div class="bd">
                <ul>
                    <li class="plat_li1">
                        <div class="plat_l">
                        </div>
                        <div class="plat_r">
                            <p class="plat_t">用户粉丝总数</p>
                            <p><?php echo $data_plat['fans']; ?></p>
                        </div>
                    </li>
                    <li class="plat_li2">
                        <div class="plat_l">
                        </div>
                        <div class="plat_r">
                            <p class="plat_t">留言总数</p>
                            <p><?php echo $data_plat['commnets']; ?></p>
                        </div>
                    </li>
                    
                    <li class="plat_li7">
                        <div class="plat_l">
                        </div>
                        <div class="plat_r">
                            <p class="plat_t">视频总数</p>
                            <p><?php echo $data_plat['video_total']; ?></p>
                        </div>
                    </li>
                    <li class=" no" style="border:none;">
                    </li>
                    <li class="plat_li4">
                        <div class="plat_l">
                        </div>
                        <div class="plat_r">
                            <p class="plat_t">近30天点赞数</p>
                            <p><?php echo $data_plat['likes']; ?></p>
                        </div>
                    </li>
                    <!-- <li class="plat_li5">
                        <div class="plat_l">
                        </div>
                        <div class="plat_r">
                            <p class="plat_t">近30天分享数</p>
                            <p><?php echo $data_plat['shares']; ?></p>
                        </div>
                    </li> -->
                    <li class="plat_li6">
                        <div class="plat_l">
                        </div>
                        <div class="plat_r">
                            <p class="plat_t">近30天关注增量</p>
                            <p><?php echo $data_plat['attents']; ?></p>
                        </div>
                    </li>
                    <li class="plat_li3">
                        <div class="plat_l">
                        </div>
                        <div class="plat_r">
                            <p class="plat_t">近30天发布视频</p>
                            <p><?php echo $data_plat['release']; ?></p>
                        </div>
                    </li>
                    <!-- <li class="plat_li8 no">
                        <div class="plat_l">
                        </div>
                        <div class="plat_r">
                            <p class="plat_t">近30天视频增量</p>
                            <p><?php echo $data_plat['video_add']; ?></p>
                        </div>
                    </li> -->
                    <li class="plat_li9 no">
                        <div class="plat_l">
                        </div>
                        <div class="plat_r">
                            <p class="plat_t">近30天留言数</p>
                            <p><?php echo $data_plat['commnets_30']; ?></p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>


    </div>
	<script src="/static/js/admin.js"></script>
	<script src="/static/echarts/echarts.common.min.js"></script>
    <script type="text/javascript">
        var users_total='<?php echo $users_total; ?>';
        var data_source=<?php echo $data_sourcej; ?>;
        var data_type=<?php echo $data_typej; ?>;
        var data_week=<?php echo $data_weekj; ?>;
        var data_ad=<?php echo $data_adj; ?>;
    </script>
    <script src="/static/simpleboot/admin_index.js"></script>
</body>
</html>