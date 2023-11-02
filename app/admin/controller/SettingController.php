<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\model\RouteModel;
use cmf\controller\AdminBaseController;

use think\Db;

/**
 * Class SettingController
 * @package app\admin\controller
 * @adminMenuRoot(
 *     'name'   =>'设置',
 *     'action' =>'default',
 *     'parent' =>'',
 *     'display'=> true,
 *     'order'  => 0,
 *     'icon'   =>'cogs',
 *     'remark' =>'系统设置入口'
 * )
 */
class SettingController extends AdminBaseController
{

    /**
     * 网站信息
     * @adminMenu(
     *     'name'   => '网站信息',
     *     'parent' => 'default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 0,
     *     'icon'   => '',
     *     'remark' => '网站信息',
     *     'param'  => ''
     * )
     */
    public function site()
    {
        $content = hook_one('admin_setting_site_view');

        if (!empty($content)) {
            return $content;
        }

        $noNeedDirs     = [".", "..", ".svn", 'fonts'];
        $adminThemesDir = WEB_ROOT . config('template.cmf_admin_theme_path') . config('template.cmf_admin_default_theme') . '/public/assets/themes/';
        $adminStyles    = cmf_scan_dir($adminThemesDir . '*', GLOB_ONLYDIR);
        $adminStyles    = array_diff($adminStyles, $noNeedDirs);
        $cdnSettings    = cmf_get_option('cdn_settings');
        $cmfSettings    = cmf_get_option('cmf_settings');
        $adminSettings  = cmf_get_option('admin_settings');

        $adminThemes = [];
        $themes      = cmf_scan_dir(WEB_ROOT . config('template.cmf_admin_theme_path') . '/*', GLOB_ONLYDIR);

        foreach ($themes as $theme) {
            if (strpos($theme, 'admin_') === 0) {
                array_push($adminThemes, $theme);
            }
        }

        if (APP_DEBUG && false) { // TODO 没确定要不要可以设置默认应用
            $apps = cmf_scan_dir(APP_PATH . '*', GLOB_ONLYDIR);
            $apps = array_diff($apps, $noNeedDirs);
            $this->assign('apps', $apps);
        }

        $this->assign('site_info', cmf_get_option('site_info'));
        $this->assign("admin_styles", $adminStyles);
        $this->assign("templates", []);
        $this->assign("admin_themes", $adminThemes);
        $this->assign("cdn_settings", $cdnSettings);
        $this->assign("admin_settings", $adminSettings);
        $this->assign("cmf_settings", $cmfSettings);

        return $this->fetch();
    }

    /**
     * 网站信息设置提交
     * @adminMenu(
     *     'name'   => '网站信息设置提交',
     *     'parent' => 'site',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '网站信息设置提交',
     *     'param'  => ''
     * )
     */
    public function sitePost()
    {
        if ($this->request->isPost()) {
            $result = $this->validate($this->request->param(), 'SettingSite');
			
            if ($result !== true) {
                $this->error($result);
            }

            $oldconfig=cmf_get_option('site_info');

            $options = $this->request->param('options/a');

            $login_type=isset($options['login_type'])?$options['login_type']:'';
            $share_type=isset($options['share_type'])?$options['share_type']:'';

            $options['login_type']='';
            $options['share_type']='';

            if($login_type){
                $options['login_type']=implode(',',$login_type);
            }

            if($share_type){
                $options['share_type']=implode(',',$share_type);
            }

            $brightness=$options['brightness'];
            if(!is_numeric($brightness) || $brightness<0 || $brightness>100 || floor($brightness)!=$brightness || strpos($brightness, '.')>0){
                $this->error("美颜--亮度请设置0-100之间的整数");
            }

            $skin_whiting=$options['skin_whiting'];
            if(!is_numeric($skin_whiting) || $skin_whiting<0 || $skin_whiting>9 || floor($skin_whiting)!=$skin_whiting || strpos($skin_whiting, '.')>0){
                $this->error("美颜--美白请设置0-9之间的整数");
            }

            $skin_smooth=$options['skin_smooth'];
            if(!is_numeric($skin_smooth) || $skin_smooth<0 || $skin_smooth>9 || floor($skin_smooth)!=$skin_smooth || strpos($skin_smooth, '.')>0){
                $this->error("美颜--磨皮请设置0-9之间的整数");
            }

            $skin_tenderness=$options['skin_tenderness'];
            if(!is_numeric($skin_tenderness) || $skin_tenderness<0 || $skin_tenderness>9 || floor($skin_tenderness)!=$skin_tenderness || strpos($skin_tenderness, '.')>0){
                $this->error("美颜--红润请设置0-9之间的整数");
            }

            $eye_brow=$options['eye_brow'];
            if(!is_numeric($eye_brow) || $eye_brow<0 || $eye_brow>100 || floor($eye_brow)!=$eye_brow || strpos($eye_brow, '.')>0){
                $this->error("美型--眉毛请设置0-100之间的整数");
            }

            $big_eye=$options['big_eye'];
            if(!is_numeric($big_eye) || $big_eye<0 || $big_eye>100 || floor($big_eye)!=$big_eye || strpos($big_eye, '.')>0){
                $this->error("美型--大眼请设置0-100之间的整数");
            }

            $eye_length=$options['eye_length'];
            if(!is_numeric($eye_length) || $eye_length<0 || $eye_length>100 || floor($eye_length)!=$eye_length || strpos($eye_length, '.')>0){
                $this->error("美型--眼距请设置0-100之间的整数");
            }

            $eye_corner=$options['eye_corner'];
            if(!is_numeric($eye_corner) || $eye_corner<0 || $eye_corner>100 || floor($eye_corner)!=$eye_corner || strpos($eye_corner, '.')>0){
                $this->error("美型--眼角请设置0-100之间的整数");
            }

            $eye_alat=$options['eye_alat'];
            if(!is_numeric($eye_alat) || $eye_alat<0 || $eye_alat>100 || floor($eye_alat)!=$eye_alat || strpos($eye_alat, '.')>0){
                $this->error("美型--开眼角请设置0-100之间的整数");
            }

            $face_lift=$options['face_lift'];
            if(!is_numeric($face_lift) || $face_lift<0 || $face_lift>100 || floor($face_lift)!=$face_lift || strpos($face_lift, '.')>0){
                $this->error("美型--瘦脸请设置0-100之间的整数");
            }

            $face_shave=$options['face_shave'];
            if(!is_numeric($face_shave) || $face_shave<0 || $face_shave>100 || floor($face_shave)!=$face_shave || strpos($face_shave, '.')>0){
                $this->error("美型--削脸请设置0-100之间的整数");
            }

            $mouse_lift=$options['mouse_lift'];
            if(!is_numeric($mouse_lift) || $mouse_lift<0 || $mouse_lift>100 || floor($mouse_lift)!=$mouse_lift || strpos($mouse_lift, '.')>0){
                $this->error("美型--嘴型请设置0-100之间的整数");
            }

            $nose_lift=$options['nose_lift'];
            if(!is_numeric($nose_lift) || $nose_lift<0 || $nose_lift>100 || floor($nose_lift)!=$nose_lift || strpos($nose_lift, '.')>0){
                $this->error("美型--瘦鼻请设置0-100之间的整数");
            }

            $chin_lift=$options['chin_lift'];
            if(!is_numeric($chin_lift) || $chin_lift<0 || $chin_lift>100 || floor($chin_lift)!=$chin_lift || strpos($chin_lift, '.')>0){
                $this->error("美型--下巴请设置0-100之间的整数");
            }

            $forehead_lift=$options['forehead_lift'];
            if(!is_numeric($forehead_lift) || $forehead_lift<0 || $forehead_lift>100 || floor($forehead_lift)!=$forehead_lift || strpos($forehead_lift, '.')>0){
                $this->error("美型--额头请设置0-100之间的整数");
            }

            $lengthen_noseLift=$options['lengthen_noseLift'];
            if(!is_numeric($lengthen_noseLift) || $lengthen_noseLift<0 || $lengthen_noseLift>100 || floor($lengthen_noseLift)!=$lengthen_noseLift || strpos($lengthen_noseLift, '.')>0){
                $this->error("美型--长鼻请设置0-100之间的整数");
            }

            cmf_set_option('site_info', $options);

            $action="修改网站配置";

            if($options['company_name'] !=$oldconfig['company_name']){
                $action.='公司名称由 '.$oldconfig['company_name'].'改为'.$options['company_name'].' ;';
            }

            if($options['company_desc'] !=$oldconfig['company_desc']){
                $action.='公司简介 ;';
            }

            if($options['app_name'] !=$oldconfig['app_name']){
                $action.='APP名称由 '.$oldconfig['app_name'].'改为'.$options['app_name'].' ;';
            }

            if($options['sitename'] !=$oldconfig['sitename']){
                $action.='网站标题由 '.$oldconfig['sitename'].'改为'.$options['sitename'].' ;';
            }

            if($options['site'] !=$oldconfig['site']){
                $action.='网站域名由 '.$oldconfig['site'].'改为'.$options['site'].' ;';
            }

            if($options['name_coin'] !=$oldconfig['name_coin']){
                $action.='钻石名称由 '.$oldconfig['name_coin'].'改为'.$options['name_coin'].' ;';
            }

            if($options['name_votes'] !=$oldconfig['name_votes']){
                $action.='金币名称由 '.$oldconfig['name_votes'].'改为'.$options['name_votes'].' ;';
            }

            if($options['copyright'] !=$oldconfig['copyright']){
                $action.='版权信息由 '.$oldconfig['copyright'].'改为'.$options['copyright'].' ;';
            }
            
            if($options['qq'] !=$oldconfig['qq']){
                $action.='客服QQ由 '.$oldconfig['qq'].'改为'.$options['qq'].' ;';
            }

            if($options['mobile'] !=$oldconfig['mobile']){
                $action.='客服电话由 '.$oldconfig['mobile'].'改为'.$options['mobile'].' ;';
            }

            if($options['watermark'] !=$oldconfig['watermark']){
                $action.='水印图片由 '.$oldconfig['watermark'].'改为'.$options['watermark'].' ;';
            }
            
            if($options['qr_url'] !=$oldconfig['qr_url']){
                $action.='安卓下载二维码由 '.$oldconfig['qr_url'].'改为'.$options['qr_url'].' ;';
            }

            if($options['qr_url_ios'] !=$oldconfig['qr_url_ios']){
                $action.='iOS下载二维码由 '.$oldconfig['qr_url_ios'].'改为'.$options['qr_url_ios'].' ;';
            }

            if($options['login_type'] !=$oldconfig['login_type']){
                $action.='登录方式由 '.$oldconfig['login_type'].'改为'.$options['login_type'].' ;';
            }
            
            if($options['share_type'] !=$oldconfig['share_type']){
                $action.='分享方式由 '.$oldconfig['share_type'].'改为'.$options['share_type'].' ;';
            }
            
            if($options['apk_ver'] !=$oldconfig['apk_ver']){
                $action.='APK版本号由 '.$oldconfig['apk_ver'].'改为'.$options['apk_ver'].' ;';
            }

            if($options['apk_url'] !=$oldconfig['apk_url']){
                $action.='APK下载链接由 '.$oldconfig['apk_url'].'改为'.$options['apk_url'].' ;';
            }

            if($options['apk_des'] !=$oldconfig['apk_des']){
                $action.='APK更新说明由 '.$oldconfig['apk_des'].'改为'.$options['apk_des'].' ;';
            }

            if($options['ipa_ver'] !=$oldconfig['ipa_ver']){
                $action.='IPA版本号由 '.$oldconfig['ipa_ver'].'改为'.$options['ipa_ver'].' ;';
            }

            if($options['ios_shelves'] !=$oldconfig['ios_shelves']){
                $action.='IPA上架版本号由 '.$oldconfig['ios_shelves'].'改为'.$options['ios_shelves'].' ;';
            }

            if($options['ipa_url'] !=$oldconfig['ipa_url']){
                $action.='IPA下载链接由 '.$oldconfig['ipa_url'].'改为'.$options['ipa_url'].' ;';
            }

            if($options['ipa_des'] !=$oldconfig['ipa_des']){
                $action.='IPA更新说明由 '.$oldconfig['ipa_des'].'改为'.$options['ipa_des'].' ;';
            }

            if($options['app_android'] !=$oldconfig['app_android']){
                $action.='AndroidAPP下载链接由 '.$oldconfig['app_android'].'改为'.$options['app_android'].' ;';
            }

            if($options['app_ios'] !=$oldconfig['app_ios']){
                $action.='IOSAPP下载链接由 '.$oldconfig['app_ios'].'改为'.$options['app_ios'].' ;';
            }

            if($options['video_share_title'] !=$oldconfig['video_share_title']){
                $action.='短视频分享标题由 '.$oldconfig['video_share_title'].'改为'.$options['video_share_title'].' ;';
            }

            if($options['video_share_des'] !=$oldconfig['video_share_des']){
                $action.='短视频分享话术由 '.$oldconfig['video_share_des'].'改为'.$options['video_share_des'].' ;';
            }

            if($options['agent_share_title'] !=$oldconfig['agent_share_title']){
                $action.='邀请好友分享标题由 '.$oldconfig['agent_share_title'].'改为'.$options['agent_share_title'].' ;';
            }

            if($options['agent_share_des'] !=$oldconfig['agent_share_des']){
                $action.='邀请好友分享话术由 '.$oldconfig['agent_share_des'].'改为'.$options['agent_share_des'].' ;';
            }

            if($options['wx_siteurl'] !=$oldconfig['wx_siteurl']){
                $action.='微信推广域名由 '.$oldconfig['wx_siteurl'].'改为'.$options['wx_siteurl'].' ;';
            }

            if($options['share_title'] !=$oldconfig['share_title']){
                $action.='直播分享标题由 '.$oldconfig['share_title'].'改为'.$options['share_title'].' ;';
            }

            if($options['share_des'] !=$oldconfig['share_des']){
                $action.='直播分享话术由 '.$oldconfig['share_des'].'改为'.$options['share_des'].' ;';
            }

            if($options['sprout_key'] !=$oldconfig['sprout_key']){
                $action.='萌颜授权码Android由 '.$oldconfig['sprout_key'].'改为'.$options['sprout_key'].' ;';
            }

            if($options['sprout_key_ios'] !=$oldconfig['sprout_key_ios']){
                $action.='萌颜授权码iOS由 '.$oldconfig['sprout_key_ios'].'改为'.$options['sprout_key_ios'].' ;';
            }

            if($options['brightness'] !=$oldconfig['brightness']){
                $action.='美颜--亮度由 '.$oldconfig['brightness'].'改为'.$options['brightness'].' ;';
            }

            if($options['skin_whiting'] !=$oldconfig['skin_whiting']){
                $action.='美颜--美白由 '.$oldconfig['skin_whiting'].'改为'.$options['skin_whiting'].' ;';
            }
            
            if($options['skin_smooth'] !=$oldconfig['skin_smooth']){
                $action.='美颜--磨皮由 '.$oldconfig['skin_smooth'].'改为'.$options['skin_smooth'].' ;';
            }

            if($options['skin_tenderness'] !=$oldconfig['skin_tenderness']){
                $action.='美颜--红润由 '.$oldconfig['skin_tenderness'].'改为'.$options['skin_tenderness'].' ;';
            }

            if($options['eye_brow'] !=$oldconfig['eye_brow']){
                $action.='美颜--眉毛由 '.$oldconfig['eye_brow'].'改为'.$options['eye_brow'].' ;';
            }

            if($options['big_eye'] !=$oldconfig['big_eye']){
                $action.='美颜--大眼由 '.$oldconfig['big_eye'].'改为'.$options['big_eye'].' ;';
            }

            if($options['eye_length'] !=$oldconfig['eye_length']){
                $action.='美颜--眼距由 '.$oldconfig['eye_length'].'改为'.$options['eye_length'].' ;';
            }

            if($options['eye_corner'] !=$oldconfig['eye_corner']){
                $action.='美颜--眼角由 '.$oldconfig['eye_corner'].'改为'.$options['eye_corner'].' ;';
            }

            if($options['eye_alat'] !=$oldconfig['eye_alat']){
                $action.='美颜--开眼角由 '.$oldconfig['eye_alat'].'改为'.$options['eye_alat'].' ;';
            }

            if($options['face_lift'] !=$oldconfig['face_lift']){
                $action.='美颜--瘦脸由 '.$oldconfig['face_lift'].'改为'.$options['face_lift'].' ;';
            }

            if($options['face_shave'] !=$oldconfig['face_shave']){
                $action.='美颜--削脸由 '.$oldconfig['face_shave'].'改为'.$options['face_shave'].' ;';
            }

            if($options['mouse_lift'] !=$oldconfig['mouse_lift']){
                $action.='美颜--嘴型由 '.$oldconfig['mouse_lift'].'改为'.$options['mouse_lift'].' ;';
            }

            if($options['nose_lift'] !=$oldconfig['nose_lift']){
                $action.='美颜--瘦鼻由 '.$oldconfig['nose_lift'].'改为'.$options['nose_lift'].' ;';
            }

            if($options['chin_lift'] !=$oldconfig['chin_lift']){
                $action.='美颜--下巴由 '.$oldconfig['chin_lift'].'改为'.$options['chin_lift'].' ;';
            }

            if($options['forehead_lift'] !=$oldconfig['forehead_lift']){
                $action.='美颜--额头由 '.$oldconfig['forehead_lift'].'改为'.$options['forehead_lift'].' ;';
            }

            if($options['lengthen_noseLift'] !=$oldconfig['lengthen_noseLift']){
                $action.='美颜--长鼻由 '.$oldconfig['lengthen_noseLift'].'改为'.$options['lengthen_noseLift'].' ;';
            }

            if($options['login_alert_title'] !=$oldconfig['login_alert_title']){
                $action.='弹框标题由 '.$oldconfig['login_alert_title'].'改为'.$options['login_alert_title'].' ;';
            }

            if($options['login_alert_content'] !=$oldconfig['login_alert_content']){
                $action.='弹框内容 ;';
            }

            if($options['login_clause_title'] !=$oldconfig['login_clause_title']){
                $action.='APP登录界面底部协议标题由 '.$oldconfig['login_clause_title'].'改为'.$options['login_clause_title'].' ;';
            }

            if($options['login_private_title'] !=$oldconfig['login_private_title']){
                $action.='隐私政策名称由 '.$oldconfig['login_private_title'].'改为'.$options['login_private_title'].' ;';
            }

            if($options['login_private_url'] !=$oldconfig['login_private_url']){
                $action.='隐私政策跳转链接由 '.$oldconfig['login_private_url'].'改为'.$options['login_private_url'].' ;';
            }

            if($options['login_service_title'] !=$oldconfig['login_service_title']){
                $action.='服务协议名称由 '.$oldconfig['login_service_title'].'改为'.$options['login_service_title'].' ;';
            }

            if($options['login_service_url'] !=$oldconfig['login_service_url']){
                $action.='服务协议跳转链接由 '.$oldconfig['login_service_url'].'改为'.$options['login_service_url'].' ;';
            }
            

            if($action!='修改网站配置'){
                setAdminLog($action);
            }
			

            $cmfSettings = $this->request->param('cmf_settings/a');

            $bannedUsernames                 = preg_replace("/[^0-9A-Za-z_\\x{4e00}-\\x{9fa5}-]/u", ",", $cmfSettings['banned_usernames']);
            $cmfSettings['banned_usernames'] = $bannedUsernames;
            cmf_set_option('cmf_settings', $cmfSettings);

            $cdnSettings = $this->request->param('cdn_settings/a');
            cmf_set_option('cdn_settings', $cdnSettings);

            $adminSettings = $this->request->param('admin_settings/a');

            $routeModel = new RouteModel();
            if (!empty($adminSettings['admin_password'])) {
                $routeModel->setRoute($adminSettings['admin_password'] . '$', 'admin/Index/index', [], 2, 5000);
            } else {
                $routeModel->deleteRoute('admin/Index/index', []);
            }

            $routeModel->getRoutes(true);

            if (!empty($adminSettings['admin_theme'])) {
                $result = cmf_set_dynamic_config([
                    'template' => [
                        'cmf_admin_default_theme' => $adminSettings['admin_theme']
                    ]
                ]);

                if ($result === false) {
                    $this->error('配置写入失败!');
                }
            }

            cmf_set_option('admin_settings', $adminSettings);

            $config= Db::name("option")
                    ->where("option_name='site_info'")
                    ->value("option_value");
            $config=json_decode($config,true);
            setcaches("getConfigPub",$config);
			
			$this->resetcache('getConfigPub',$options);
            $this->success("保存成功！", '');

        }
    }

    /**
     * 密码修改
     * @adminMenu(
     *     'name'   => '密码修改',
     *     'parent' => 'default',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '密码修改',
     *     'param'  => ''
     * )
     */
    public function password()
    {
        return $this->fetch();
    }

    /**
     * 密码修改提交
     * @adminMenu(
     *     'name'   => '密码修改提交',
     *     'parent' => 'password',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '密码修改提交',
     *     'param'  => ''
     * )
     */
    public function passwordPost()
    {
        if ($this->request->isPost()) {

            $data = $this->request->param();
            if (empty($data['old_password'])) {
                $this->error("原始密码不能为空！");
            }
            if (empty($data['password'])) {
                $this->error("新密码不能为空！");
            }

            $userId = cmf_get_current_admin_id();

            $admin = Db::name('user')->where("id", $userId)->find();

            $oldPassword = $data['old_password'];
            $password    = $data['password'];
            $rePassword  = $data['re_password'];

            if (cmf_compare_password($oldPassword, $admin['user_pass'])) {
                if ($password == $rePassword) {

                    if (cmf_compare_password($password, $admin['user_pass'])) {
                        $this->error("新密码不能和原始密码相同！");
                    } else {
                        Db::name('user')->where('id', $userId)->update(['user_pass' => cmf_password($password)]);
                        $this->success("密码修改成功！");
                    }
                } else {
                    $this->error("密码输入不一致！");
                }

            } else {
                $this->error("原始密码不正确！");
            }
        }
    }

    /**
     * 上传限制设置界面
     * @adminMenu(
     *     'name'   => '上传设置',
     *     'parent' => 'default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '上传设置',
     *     'param'  => ''
     * )
     */
    public function upload()
    {
        $uploadSetting = cmf_get_upload_setting();
        $this->assign('upload_setting', $uploadSetting);
        return $this->fetch();
    }

    /**
     * 上传限制设置界面提交
     * @adminMenu(
     *     'name'   => '上传设置提交',
     *     'parent' => 'upload',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '上传设置提交',
     *     'param'  => ''
     * )
     */
    public function uploadPost()
    {
        if ($this->request->isPost()) {
            //TODO 非空验证
            $uploadSetting = $this->request->post();

            cmf_set_option('upload_setting', $uploadSetting);
            $this->success('保存成功！');
        }

    }

    /**
     * 清除缓存
     * @adminMenu(
     *     'name'   => '清除缓存',
     *     'parent' => 'default',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '清除缓存',
     *     'param'  => ''
     * )
     */
    public function clearCache()
    {
        $content = hook_one('admin_setting_clear_cache_view');

        if (!empty($content)) {
            return $content;
        }

        cmf_clear_cache();
        return $this->fetch();
    }
	
	
	
	
	 /**
     * 私密设置
     */
    public function configpri(){

        $siteinfo=cmf_get_option('site_info');
        $name_coin=$siteinfo['name_coin'];
        $name_votes=$siteinfo['name_votes'];
        $this->assign('config', cmf_get_option('configpri'));
        $this->assign("name_coin",$name_coin);
        $this->assign("name_votes",$name_votes);
        return $this->fetch();
    }

    /**
     * 私密设置提交
     */
    public function configpriPost(){
        
        if ($this->request->isPost()) {

            
            
            $options = $this->request->param('options');

            $oldconfigpri=cmf_get_option('configpri');
            
            $login_type=$_POST['login_type'];
            $share_type=$_POST['share_type'];
            
            $options['login_type']='';
            $options['share_type']='';
            
            if($login_type){
                $options['login_type']=implode(',',$login_type);
            }
            
            if($share_type){
                $options['share_type']=implode(',',$share_type);
            }


            $cash_rate=$options['cash_rate'];
            if(!is_numeric($cash_rate)){
                $this->error("提现配置中的提现比例必须为数字");
            }

            if($cash_rate<0){
                $this->error("提现配置中的提现比例不能为负数");
            }

            if(floor($cash_rate)!=$cash_rate){
                $this->error("提现配置中的提现比例不能为小数");
            }

            $cash_take=$options['cash_take'];
            if(!is_numeric($cash_take)){
                $this->error("提现配置中的提现抽成必须为数字");
            }

            if($cash_take<0){
                $this->error("提现配置中的提现抽成不能为负数");
            }

            if(floor($cash_take)!=$cash_take){
                $this->error("提现配置中的提现抽成不能为小数");
            }

            $cash_min=$options['cash_min'];
            if(!is_numeric($cash_min)){
                $this->error("提现配置中的提现最低额度必须为数字");
            }
            if($cash_min<0){
                $this->error("提现配置中的提现比例不能为负数");
            }
            $cash_start=$options['cash_start'];
            $cash_end=$options['cash_end'];

            if(!is_numeric($cash_start)){
                $this->error("提现配置中的每月提现期限开始日期必须为数字");
            }
            if($cash_start<1){
                $this->error("提现配置中的每月提现期限开始日期必须为大于0的整数");
            }
            if(floor($cash_start)!=$cash_start){
                $this->error("提现配置中的每月提现期限开始日期必须为大于0的整数");
            }

            if(!is_numeric($cash_end)){
                $this->error("提现配置中的每月提现期限结束日期必须为数字");
            }
            if($cash_end<1){
                $this->error("提现配置中的每月提现期限结束日期必须为大于0的整数");
            }
            if(floor($cash_end)!=$cash_end){
                $this->error("提现配置中的每月提现期限结束日期必须为大于0的整数");
            }
            if($cash_end<$cash_start){
                $this->error("提现配置中的每月提现期限结束日期必须大于开始日期");
            }

            $cash_max_times=$options['cash_max_times'];
            if(!is_numeric($cash_max_times)){
                $this->error("提现配置中的每月提现次数必须为数字");
            }
            if($cash_max_times<0){
                $this->error("提现配置中的每月提现次数必须为大于等于0的整数");
            }
            if(floor($cash_max_times)!=$cash_max_times){
                $this->error("提现配置中的每月提现次数必须为大于等于0的整数");
            }

            cmf_set_option('configpri', $options);

            $config= Db::name("option")
                    ->where("option_name='configpri'")
                    ->value("option_value");
            $config=json_decode($config,true);
            setcaches("getConfigPri",$config);

            $this->resetcache('getConfigPri',$options);

            $action="修改私密配置";

            if($options['cache_switch'] !=$oldconfigpri['cache_switch']){
                $cache_switch=$options['cache_switch']?'开':'关';
                $action.='缓存开关 '.$cache_switch.';';
            }

            if($options['cache_time'] !=$oldconfigpri['cache_time']){
                $action.='缓存时间由 '.$oldconfigpri['cache_time'].'改为'.$options['cache_time'].' ;';
            }

            if($options['auth_islimit'] !=$oldconfigpri['auth_islimit']){
                $auth_islimit=$options['auth_islimit']?'开':'关';
                $action.='认证限制 '.$auth_islimit.';';
            }

            if($options['private_letter_switch'] !=$oldconfigpri['private_letter_switch']){
                $private_letter_switch=$options['private_letter_switch']?'开':'关';
                $action.='未关注发送消息条数开关 '.$private_letter_switch.';';
            }

            if($options['private_letter_nums'] !=$oldconfigpri['private_letter_nums']){
                $action.='未关注可发送消息条数由 '.$oldconfigpri['private_letter_nums'].'改为'.$options['private_letter_nums'].' ;';
            }
            if($options['video_audit_switch'] !=$oldconfigpri['video_audit_switch']){
                $video_audit_switch=$options['video_audit_switch']?'开':'关';
                $action.='视频审核开关 '.$video_audit_switch.';';
            }

            if($options['login_wx_appid'] !=$oldconfigpri['login_wx_appid']){
                $action.='微信公众平台Appid由 '.$oldconfigpri['login_wx_appid'].'改为'.$options['login_wx_appid'].' ;';
            }

            if($options['login_wx_appsecret'] !=$oldconfigpri['login_wx_appsecret']){
                $action.='微信公众平台AppSecret由 '.$oldconfigpri['login_wx_appsecret'].'改为'.$options['login_wx_appsecret'].' ;';
            }

            if($options['sendcode_switch'] !=$oldconfigpri['sendcode_switch']){
                $sendcode_switch=$options['sendcode_switch']?'开':'关';
                $action.='短信验证码开关 '.$sendcode_switch.';';
            }

            if($options['code_switch'] !=$oldconfigpri['code_switch']){
                $code_switch=$options['code_switch']==1?'阿里云':'容联云';
                $action.='短信接口平台 '.$code_switch.';';
            }
            
            if($options['ccp_sid'] !=$oldconfigpri['ccp_sid']){
                $action.='容联云ACCOUNT SID由 '.$oldconfigpri['ccp_sid'].'改为'.$options['ccp_sid'].' ;';
            }

            if($options['ccp_token'] !=$oldconfigpri['ccp_token']){
                $action.='容联云ACCOUNT TOKEN由 '.$oldconfigpri['ccp_token'].'改为'.$options['ccp_token'].' ;';
            }

            if($options['ccp_appid'] !=$oldconfigpri['ccp_appid']){
                $action.='容联云应用APPID由 '.$oldconfigpri['ccp_appid'].'改为'.$options['ccp_appid'].' ;';
            }

            if($options['ccp_tempid'] !=$oldconfigpri['ccp_tempid']){
                $action.='容联云短信模板ID由 '.$oldconfigpri['ccp_tempid'].'改为'.$options['ccp_tempid'].' ;';
            }

            if($options['aly_keyid'] !=$oldconfigpri['aly_keyid']){
                $action.='阿里云AccessKey ID由 '.$oldconfigpri['aly_keyid'].'改为'.$options['aly_keyid'].' ;';
            }

            if($options['aly_secret'] !=$oldconfigpri['aly_secret']){
                $action.='阿里云AccessKey Secret由 '.$oldconfigpri['aly_secret'].'改为'.$options['aly_secret'].' ;';
            }

            if($options['aly_signName'] !=$oldconfigpri['aly_signName']){
                $action.='阿里云短信签名由 '.$oldconfigpri['aly_signName'].'改为'.$options['aly_signName'].' ;';
            }

            if($options['aly_templateCode'] !=$oldconfigpri['aly_templateCode']){
                $action.='阿里云短信模板ID由 '.$oldconfigpri['aly_templateCode'].'改为'.$options['aly_templateCode'].' ;';
            }
            

            if($options['iplimit_switch'] !=$oldconfigpri['iplimit_switch']){
                $iplimit_switch=$options['iplimit_switch']?'开':'关';
                $action.='短信验证码IP限制开关 '.$iplimit_switch.';';
            }
            
            if($options['iplimit_times'] !=$oldconfigpri['iplimit_times']){
                $action.='短信验证码IP限制次数由 '.$oldconfigpri['iplimit_times'].'改为'.$options['iplimit_times'].' ;';
            }
            
            if($options['same_device_ip_regnums'] !=$oldconfigpri['same_device_ip_regnums']){
                $action.='同设备同ip可注册用户数由 '.$oldconfigpri['same_device_ip_regnums'].'改为'.$options['same_device_ip_regnums'].' ;';
            }
            
            if($options['jpush_switch'] !=$oldconfigpri['jpush_switch']){
                $jpush_switch=$options['jpush_switch']?'开':'关';
                $action.='极光推送开关 '.$jpush_switch.';';
            }
            
            if($options['jpush_sandbox'] !=$oldconfigpri['jpush_sandbox']){
                $jpush_sandbox=$options['jpush_sandbox']?'生产':'开发';
                $action.='极光推送模式 '.$jpush_sandbox.';';
            }

            if($options['jpush_key'] !=$oldconfigpri['jpush_key']){
                $action.='极光APP_KEY由 '.$oldconfigpri['jpush_key'].'改为'.$options['jpush_key'].' ;';
            }
            
            if($options['jpush_secret'] !=$oldconfigpri['jpush_secret']){
                $action.='极光master_secret由 '.$oldconfigpri['jpush_secret'].'改为'.$options['jpush_secret'].' ;';
            }
            
            if($options['video_showtype'] !=$oldconfigpri['video_showtype']){
                $video_showtype=$options['video_showtype']?'按曝光值':'随机';
                $action.='推荐视频显示方式 '.$video_showtype.';';
            }
            
            if($options['ad_video_switch'] !=$oldconfigpri['ad_video_switch']){
                $ad_video_switch=$options['ad_video_switch']?'开':'关';
                $action.='广告视频开关 '.$ad_video_switch.';';
            }
            
            if($options['ad_video_loop'] !=$oldconfigpri['ad_video_loop']){
                $ad_video_loop=$options['ad_video_loop']?'开':'关';
                $action.='广告是否轮循展示 '.$ad_video_loop.';';
            }

            if($options['video_ad_num'] !=$oldconfigpri['video_ad_num']){
                $action.='滑动几个视频出现广告由 '.$oldconfigpri['video_ad_num'].'改为'.$options['video_ad_num'].' ;';
            }
            
            if($options['comment_weight'] !=$oldconfigpri['comment_weight']){
                $action.='评论权重值由 '.$oldconfigpri['comment_weight'].'改为'.$options['comment_weight'].' ;';
            }
            
            if($options['like_weight'] !=$oldconfigpri['like_weight']){
                $action.='点赞权重值由 '.$oldconfigpri['like_weight'].'改为'.$options['like_weight'].' ;';
            }

            if($options['share_weight'] !=$oldconfigpri['share_weight']){
                $action.='分享权重值由 '.$oldconfigpri['share_weight'].'改为'.$options['share_weight'].' ;';
            }
            
            if($options['show_val'] !=$oldconfigpri['show_val']){
                $action.='初始曝光值由 '.$oldconfigpri['show_val'].'改为'.$options['show_val'].' ;';
            }
            
            if($options['hour_minus_val'] !=$oldconfigpri['hour_minus_val']){
                $action.='每小时扣除曝光值由 '.$oldconfigpri['hour_minus_val'].'改为'.$options['hour_minus_val'].' ;';
            }

            if($options['um_apikey'] !=$oldconfigpri['um_apikey']){
                $action.='友盟OpenApi-apiKey由 '.$oldconfigpri['um_apikey'].'改为'.$options['um_apikey'].' ;';
            }

            if($options['um_apisecurity'] !=$oldconfigpri['um_apisecurity']){
                $action.='友盟OpenApi-apiSecurity由 '.$oldconfigpri['um_apisecurity'].'改为'.$options['um_apisecurity'].' ;';
            }

            if($options['um_appkey_android'] !=$oldconfigpri['um_appkey_android']){
                $action.='友盟Android应用-appkey由 '.$oldconfigpri['um_appkey_android'].'改为'.$options['um_appkey_android'].' ;';
            }

            if($options['um_appkey_ios'] !=$oldconfigpri['um_appkey_ios']){
                $action.='友盟IOS应用-appkey由 '.$oldconfigpri['um_appkey_ios'].'改为'.$options['um_appkey_ios'].' ;';
            }
            
            if($options['shop_fans'] !=$oldconfigpri['shop_fans']){
                $action.='申请店铺需要的粉丝数量由 '.$oldconfigpri['shop_fans'].'改为'.$options['shop_fans'].' ;';
            }
            
            if($options['shop_videos'] !=$oldconfigpri['shop_videos']){
                $action.='申请店铺需要的视频数量由 '.$oldconfigpri['shop_videos'].'改为'.$options['shop_videos'].' ;';
            }

            if($options['show_switch'] !=$oldconfigpri['show_switch']){
                $show_switch=$options['show_switch']?'开':'关';
                $action.='店铺审核 '.$show_switch.';';
            }

            if($options['agent_switch'] !=$oldconfigpri['agent_switch']){
                $agent_switch=$options['agent_switch']?'开':'关';
                $action.='邀请开关 '.$agent_switch.';';
            }

            if($options['agent_must'] !=$oldconfigpri['agent_must']){
                $agent_must=$options['agent_must']?'开':'关';
                $action.='邀请码必填 '.$agent_must.';';
            }
            
            if($options['agent_reward'] !=$oldconfigpri['agent_reward']){
                $action.='每邀请一个新人的奖励由 '.$oldconfigpri['agent_reward'].'改为'.$options['agent_reward'].' ;';
            }

            if($options['agent_v_l'] !=$oldconfigpri['agent_v_l']){
                $action.='每天观看的视频时长由 '.$oldconfigpri['agent_v_l'].'改为'.$options['agent_v_l'].' ;';
            }

            if($options['agent_v_a'] !=$oldconfigpri['agent_v_a']){
                $action.='每天观看的规定视频时长的奖励由 '.$oldconfigpri['agent_v_a'].'改为'.$options['agent_v_a'].' ;';
            }

            if($options['agent_a'] !=$oldconfigpri['agent_a']){
                $action.='用户获取观看视频奖励时，上级用户获取的奖励由 '.$oldconfigpri['agent_a'].'改为'.$options['agent_a'].' ;';
            }

            if($options['aliapp_partner'] !=$oldconfigpri['aliapp_partner']){
                $action.='支付宝合作者身份ID由 '.$oldconfigpri['aliapp_partner'].'改为'.$options['aliapp_partner'].' ;';
            }

            if($options['aliapp_seller_id'] !=$oldconfigpri['aliapp_seller_id']){
                $action.='支付宝帐号由 '.$oldconfigpri['aliapp_seller_id'].'改为'.$options['aliapp_seller_id'].' ;';
            }
            
            if($options['aliapp_key'] !=$oldconfigpri['aliapp_key']){
                $action.='支付宝安卓密钥修改 ;';
            }
            
            if($options['aliapp_key_ios'] !=$oldconfigpri['aliapp_key_ios']){
                $action.='支付宝ios密钥修改 ;';
            }

            if($options['wx_appid'] !=$oldconfigpri['wx_appid']){
                 $action.='微信开放平台移动应用AppID由 '.$oldconfigpri['wx_appid'].'改为'.$options['wx_appid'].' ;';
            }
            
            if($options['wx_appsecret'] !=$oldconfigpri['wx_appsecret']){
                 $action.='微信开放平台移动应用appsecret由 '.$oldconfigpri['wx_appsecret'].'改为'.$options['wx_appsecret'].' ;';
            }

            if($options['wx_mchid'] !=$oldconfigpri['wx_mchid']){
                 $action.='微信商户号mchid由 '.$oldconfigpri['wx_mchid'].'改为'.$options['wx_mchid'].' ;';
            }

            if($options['wx_key'] !=$oldconfigpri['wx_key']){
                 $action.='微信密钥key由 '.$oldconfigpri['wx_key'].'改为'.$options['wx_key'].' ;';
            }

            if($options['aliapp_switch'] !=$oldconfigpri['aliapp_switch']){
                $aliapp_switch=$options['aliapp_switch']?'开':'关';
                $action.='支付宝支付开关 '.$aliapp_switch.';';
            }

            if($options['ios_switch'] !=$oldconfigpri['ios_switch']){
                $ios_switch=$options['ios_switch']?'开':'关';
                $action.='苹果支付开关 '.$ios_switch.';';
            }
            
            if($options['ios_switch'] !=$oldconfigpri['ios_switch']){
                $ios_switch=$options['ios_switch']?'开':'关';
                $action.='苹果支付开关 '.$ios_switch.';';
            }

            if($options['wx_switch'] !=$oldconfigpri['wx_switch']){
                $wx_switch=$options['wx_switch']?'开':'关';
                $action.='微信支付开关 '.$wx_switch.';';
            }

            if($options['vip_aliapp_switch'] !=$oldconfigpri['vip_aliapp_switch']){
                $vip_aliapp_switch=$options['vip_aliapp_switch']?'开':'关';
                $action.='vip充值 支付宝支付开关 '.$vip_aliapp_switch.';';
            }

            if($options['vip_wx_switch'] !=$oldconfigpri['vip_wx_switch']){
                $vip_wx_switch=$options['vip_wx_switch']?'开':'关';
                $action.='vip充值 微信支付开关 '.$vip_wx_switch.';';
            }

            if($options['vip_coin_switch'] !=$oldconfigpri['vip_coin_switch']){
                $vip_coin_switch=$options['vip_coin_switch']?'开':'关';
                $action.='vip充值 余额支付开关 '.$vip_coin_switch.';';
            }
            
            if($options['cash_rate'] !=$oldconfigpri['cash_rate']){
                 $action.='提现比例由 '.$oldconfigpri['cash_rate'].'改为'.$options['cash_rate'].' ;';
            }

            if($options['cash_min'] !=$oldconfigpri['cash_min']){
                 $action.='提现最低额度 '.$oldconfigpri['cash_min'].'改为'.$options['cash_min'].' ;';
            }
            
            if($options['popular_interval'] !=$oldconfigpri['popular_interval']){
                 $action.='上热门视频添加间隔 '.$oldconfigpri['popular_interval'].'改为'.$options['popular_interval'].' ;';
            }
            
            if($options['popular_base'] !=$oldconfigpri['popular_base']){
                 $action.='热门基数 '.$oldconfigpri['popular_base'].'改为'.$options['popular_base'].' ;';
            }

            if($options['popular_tips'] !=$oldconfigpri['popular_tips']){
                $action.='上热门提示内容 ;';
            }
            
            if($options['vip_switch'] !=$oldconfigpri['vip_switch']){
                $vip_switch=$options['vip_switch']?'开':'关';
                $action.='vip开关 '.$vip_switch.';';
            }

            if($options['nonvip_upload_nums'] !=$oldconfigpri['nonvip_upload_nums']){
                 $action.='非VIP用户每天可上传视频数 '.$oldconfigpri['nonvip_upload_nums'].'改为'.$options['nonvip_upload_nums'].' ;';
            }
            
            if($options['watch_video_type'] !=$oldconfigpri['watch_video_type']){
                $vip_switch=$options['watch_video_type']?'内容限制模式':'次数限制模式';
                $action.='短视频观看模式 '.$vip_switch.';';
            }

            if($options['nonvip_watch_nums'] !=$oldconfigpri['nonvip_watch_nums']){
                 $action.='免费观看视频数 '.$oldconfigpri['nonvip_watch_nums'].'改为'.$options['nonvip_watch_nums'].' ;';
            }
            
            if($options['cloudtype'] !=$oldconfigpri['cloudtype']){
                $cloudtype=$options['cloudtype']==1?'七牛云存储':'腾讯云存储';
                $action.='云存储 '.$cloudtype.';';
            }
            
            if($options['qiniu_zone'] !=$oldconfigpri['qiniu_zone']){
                $action.='七牛云存储区域 ;';
            }

            if($options['qiniu_protocol'] !=$oldconfigpri['qiniu_protocol']){
                $action.='七牛存储域名协议 ;';
            }
            
            if($options['qiniu_accesskey'] !=$oldconfigpri['qiniu_accesskey']){
                 $action.='七牛云存储accessKey '.$oldconfigpri['qiniu_accesskey'].'改为'.$options['qiniu_accesskey'].' ;';
            }

            if($options['qiniu_secretkey'] !=$oldconfigpri['qiniu_secretkey']){
                 $action.='七牛云存储secretKey '.$oldconfigpri['qiniu_secretkey'].'改为'.$options['qiniu_secretkey'].' ;';
            }

            if($options['qiniu_bucket'] !=$oldconfigpri['qiniu_bucket']){
                 $action.='七牛云存储bucket '.$oldconfigpri['qiniu_bucket'].'改为'.$options['qiniu_bucket'].' ;';
            }

            if($options['qiniu_domain'] !=$oldconfigpri['qiniu_domain']){
                 $action.='七牛云存储空间域名 '.$oldconfigpri['qiniu_domain'].'改为'.$options['qiniu_domain'].' ;';
            }
            
            if($options['tx_private_signature'] !=$oldconfigpri['tx_private_signature']){
                $tx_private_signature=$options['tx_private_signature']?'开':'关';
                $action.='腾讯云存储是否开启私有读签名验证 '.$tx_private_signature.';';
            }

            if($options['txcloud_appid'] !=$oldconfigpri['txcloud_appid']){
                 $action.='腾讯云存储appid '.$oldconfigpri['txcloud_appid'].'改为'.$options['txcloud_appid'].' ;';
            }

            if($options['txcloud_secret_id'] !=$oldconfigpri['txcloud_secret_id']){
                 $action.='腾讯云存储secret_id '.$oldconfigpri['txcloud_secret_id'].'改为'.$options['txcloud_secret_id'].' ;';
            }

            if($options['txcloud_secret_key'] !=$oldconfigpri['txcloud_secret_key']){
                 $action.='腾讯云存储secret_key '.$oldconfigpri['txcloud_secret_key'].'改为'.$options['txcloud_secret_key'].' ;';
            }

            if($options['txcloud_region'] !=$oldconfigpri['txcloud_region']){
                 $action.='腾讯云存储region '.$oldconfigpri['txcloud_region'].'改为'.$options['txcloud_region'].' ;';
            }

            if($options['txcloud_bucket'] !=$oldconfigpri['txcloud_bucket']){
                 $action.='腾讯云存储bucket '.$oldconfigpri['txcloud_bucket'].'改为'.$options['txcloud_bucket'].' ;';
            }
            
            if($options['tx_domain_url'] !=$oldconfigpri['tx_domain_url']){
                 $action.='腾讯云存储空间url地址 '.$oldconfigpri['tx_domain_url'].'改为'.$options['tx_domain_url'].' ;';
            }

            if($options['live_videos'] !=$oldconfigpri['live_videos']){
                 $action.='进行直播需发布视频达到数量 '.$oldconfigpri['live_videos'].'改为'.$options['live_videos'].' ;';
            }

            if($options['live_fans'] !=$oldconfigpri['live_fans']){
                 $action.='进行直播需达到粉丝数量 '.$oldconfigpri['live_fans'].'改为'.$options['live_fans'].' ;';
            }

            if($options['tx_appid'] !=$oldconfigpri['tx_appid']){
                 $action.='腾讯云推拉流appid '.$oldconfigpri['tx_appid'].'改为'.$options['tx_appid'].' ;';
            }

            if($options['tx_bizid'] !=$oldconfigpri['tx_bizid']){
                 $action.='腾讯云推拉流直播bizid '.$oldconfigpri['tx_bizid'].'改为'.$options['tx_bizid'].' ;';
            }

            if($options['tx_push_key'] !=$oldconfigpri['tx_push_key']){
                 $action.='腾讯云推拉流推流防盗链Key '.$oldconfigpri['tx_push_key'].'改为'.$options['tx_push_key'].' ;';
            }
            
            if($options['tx_api_key'] !=$oldconfigpri['tx_api_key']){
                 $action.='腾讯云推拉流直播API鉴权key '.$oldconfigpri['tx_api_key'].'改为'.$options['tx_api_key'].' ;';
            }

            if($options['tx_push'] !=$oldconfigpri['tx_push']){
                 $action.='腾讯云推拉流推流域名 '.$oldconfigpri['tx_push'].'改为'.$options['tx_push'].' ;';
            }

            if($options['tx_pull'] !=$oldconfigpri['tx_pull']){
                 $action.='腾讯云推拉流播流域名 '.$oldconfigpri['tx_pull'].'改为'.$options['tx_pull'].' ;';
            }

            if($options['live_txcloud_secret_id'] !=$oldconfigpri['live_txcloud_secret_id']){
                 $action.='腾讯云推拉流连麦SecretId '.$oldconfigpri['live_txcloud_secret_id'].'改为'.$options['live_txcloud_secret_id'].' ;';
            }

            if($options['live_txcloud_secret_key'] !=$oldconfigpri['live_txcloud_secret_key']){
                 $action.='腾讯云推拉流连麦SecretKey '.$oldconfigpri['live_txcloud_secret_key'].'改为'.$options['live_txcloud_secret_key'].' ;';
            }

            if($options['userlist_time'] !=$oldconfigpri['userlist_time']){
                 $action.='用户列表请求间隔 '.$oldconfigpri['userlist_time'].'改为'.$options['userlist_time'].' ;';
            }

            if($options['chatserver'] !=$oldconfigpri['chatserver']){
                 $action.='聊天服务器地址 '.$oldconfigpri['chatserver'].'改为'.$options['chatserver'].' ;';
            }
            
            if($options['sensitive_words'] !=$oldconfigpri['sensitive_words']){
                 $action.='敏感词 ;';
            }
            

            if($action!="修改私密配置"){
                setAdminLog($action);
            }
            
            $this->success("保存成功！", '');

        }
    }

    protected function resetcache($key='',$info=[]){
        if($key!='' && $info){
            delcache($key);
            hMSet($key,$info);
        }
    }

}