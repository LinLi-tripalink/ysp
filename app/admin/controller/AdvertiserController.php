<?php

/**
 * 广告主申请
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;



class AdvertiserController extends AdminbaseController {

	protected function getStatus($k=''){
        $status=array(
            '0'=>'待审核',
            '1'=>'通过',
            '-1'=>'拒绝',
        );
        if($k==''){
            return $status;
        }
        return isset($status[$k])?$status[$k]:'';
    }

	/*广告主申请列表*/
    public function index(){

		
		$p = $this->request->param('p');
		if(!$p){
			$p=1;
		}
		$lists = Db::name('user_advertiser')
            ->where(function (Query $query) {
				$data = $this->request->param();

				$keyword=isset($data['keyword']) ? $data['keyword']: '';

                if (!empty($keyword)) {
                    $query->where('username', 'like', "%$keyword%");
                }
             	
             	$keyword1=isset($data['keyword1']) ? $data['keyword1']: '';

                if (!empty($keyword1)) {
                    $query->where('mobile', 'like', "%$keyword1%");
                }

                $keyword2=isset($data['keyword2']) ? $data['keyword2']: '';
				
				if (!empty($keyword2)) {
					$userlist =Db::name("user")->field("id")
						->where("user_nicename like '%".$keyword2."%'")
						->select();
					$strids="";
					foreach($userlist as $ku=>$vu){
						if($strids==""){
							$strids=$vu['id'];
						}else{
							$strids.=",".$vu['id'];
						}
					}					
                    $query->where('uid', 'in', $strids);
                }

            })
            ->order("addtime DESC")
            ->paginate(20);
			
		$lists->each(function($v,$k){
			
			$userinfo=getUserInfo($v['uid']);
			if(!$userinfo){
				$userinfo=array(
					'user_nicename'=>'已删除'
				);
			}
				
			
			$v['userinfo']=$userinfo;
			$v['addtime']=date('Y-m-d H:i:s',$v['addtime']);

			if($v['uptime']>0){
				$v['uptime']=date('Y-m-d H:i:s',$v['uptime']);
			}else{
				$v['uptime']='--';
			}

	
			return $v;
			
		});
		
		//分页-->筛选条件参数
		$data = $this->request->param();
		$lists->appends($data);	
			
			
        // 获取分页显示
        $page = $lists->render();
		
    	$this->assign('lists', $lists);
    	$this->assign("page", $page);
    	$this->assign("p",$p);
    	$this->assign("status", $this->getStatus());
    	return $this->fetch();
    }

    //通过
    public function setpass(){
    	$id = $this->request->param('id');
    	if(!$id){
    		$this->error("视频信息加载失败");
    	}

    	$status=$this->request->param('status');
		$data=array(
    		'uptime'=>time(),
    		'status'=>$status
    	);

    	$result=Db::name("user_advertiser")->where("id={$id}")->update($data);

    	if($result!==false){

    		$this->success("审核成功");
    	}else{
    		$this->error("审核失败");
    	}

    	return $this->fetch();

    }


    //拒绝
    public function setstatus(){
    	$id = $this->request->param('id');
    	if(!$id){
    		$this->error("视频信息加载失败");
    	}

    	$status=$this->request->param('status');
    	$reason=$this->request->param('reason');


    	$data=array(
    		'uptime'=>time(),
    		'status'=>$status,
    		'reason'=>$reason
    	);

    	$result=Db::name("user_advertiser")->where("id={$id}")->update($data);


		$rs=array('code'=>0,'msg'=>'','info'=>array());

		if($result!==false){

			
			$advertiser_info=Db::name("user_advertiser")->where("id={$id}")->find();
			$uid=$advertiser_info['uid'];

			//向系统通知表中写入数据

    		$baseMsg='您于'.date("Y-m-d H:i:s",$advertiser_info['addtime']).'申请的广告主被管理员审核失败';

			if($reason!=''){
				$msg=$baseMsg.',原因：'.$reason;
			}else{
				$msg=$baseMsg;
			}

			$text="广告主审核失败提醒";

			$result1=addSysytemInfo($uid,$text,$msg);

			if($result1!==false){
				
				jMessageIM($text,$uid);
			}

			//将广告视频下架
			Db::name("user_video")->where(['uid'=>$uid,'status'=>1,'is_userad'=>1,'isdel'=>0])->update(['isdel'=>1]);

			$rs['msg']='审核完成';
		}else{
			$rs['code']=1001;
			$rs['msg']='审核失败';
		}

		echo json_encode($rs);
		exit;
    	
    	
    }


}
