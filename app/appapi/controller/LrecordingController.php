<?php
/**
 * 直播记录
 */
namespace app\appapi\controller;

use cmf\controller\HomeBaseController;
use think\Db;
use think\db\Query;

class LrecordingController extends HomebaseController {


    //直播记录
	public function record(){
        
        $data = $this->request->param();

        $uid=checkNull($data['uid']);
        $token=checkNull($data['token']);
        $touid=checkNull($data['touid']);

		if(checkToken($uid,$token)==700){
			$this->assign("reason",'您的登陆状态失效，请重新登陆！');
			return $this->fetch(':error');
			exit;
		}
        
		$userinfo=getUserInfo($touid);
        $list=Db::name("user_liverecord")
			->where("uid={$touid}")
			->order("starttime desc")
			->limit(100)
			->select()
			->toArray();
			
			
		
		foreach($list as $k=>$v){
			
			$v['describe']=date('h:i',$v['starttime']).'-'.date('h:i',$v['endtime']);
			$v['starttime']=date('m月d日',$v['starttime']);
			

            $list[$k]=$v;
		}

        
        $this->assign('uid',$uid);
        $this->assign('token',$token);
        $this->assign('list',$list);
        $this->assign('userinfo',$userinfo);

		return $this->fetch();
        

	}


    

}