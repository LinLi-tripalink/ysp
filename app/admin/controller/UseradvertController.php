<?php

/**
 * 用户发布的广告视频
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;



class UseradvertController extends AdminbaseController {

	protected function getStatus($k=''){
        $status=array(
            '0'=>'待审核',
            '1'=>'审核通过',
            '2'=>'拒绝',
        );
        if($k==''){
            return $status;
        }
        return isset($status[$k])?$status[$k]:'';
    }

    protected function getDel($k=''){
        $del=array(
            '0'=>'未下架',
            '1'=>'已下架',
        );
        if($k==''){
            return $del;
        }
        return isset($del[$k])?$del[$k]:'';
    }

	/*广告列表*/
    public function index(){

		
		$p = $this->request->param('p');
		if(!$p){
			$p=1;
		}
		$lists = Db::name('user_video')
            ->where(function (Query $query) {
				$data = $this->request->param();
				$query->where('is_ad', '0');
				$query->where('is_userad', '1');

				$keyword=isset($data['keyword']) ? $data['keyword']: '';

                if (!empty($keyword)) {
                    $query->where('uid|id', 'eq' , $keyword);
                }
             	
             	$keyword1=isset($data['keyword1']) ? $data['keyword1']: '';

                if (!empty($keyword1)) {
                    $query->where('title', 'like', "%$keyword1%");
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
            ->order("orderno desc,addtime DESC")
            ->paginate(20);
			
		$lists->each(function($v,$k){
			if($v['uid']==0){
				$userinfo=array(
					'user_nicename'=>'系统管理员'
				);
			}else{
				$userinfo=getUserInfo($v['uid']);
				if(!$userinfo){
					$userinfo=array(
						'user_nicename'=>'已删除'
					);
				}
				
			}
			$v['userinfo']=$userinfo;
            $v['thumb']=get_upload_path($v['thumb']);
			$ad_endtime='';
			if($v['ad_endtime'] == 0){
				$v['ad_endtime']='---';
			}else{
				$ad_endtime=(int)$v['ad_endtime'];
				$v['ad_endtime']=date('Y-m-d',$ad_endtime);
				
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
    	$this->assign("isdel", $this->getDel());
    	return $this->fetch();
    }

	//删除视频
	public function del(){

		$res=array("code"=>0,"msg"=>"删除成功","info"=>array());
		
		$data = $this->request->param();
		
		$id=$data['id'];
		$reason=$data["reason"];
		
		if(!$id){
			$res['code']=1001;
			$res['msg']='视频信息加载失败';
			echo json_encode($res);
			exit;
		}
		$result=Db::name("user_video")->where("id={$id}")->delete();

		if($result!==false){

			Db::name("user_video_comments_at_messages")->where("videoid={$id}")->delete(); //删除视频评论@信息列表
			Db::name("user_video_comments_messages")->where("videoid={$id}")->delete(); //删除视频评论信息列表
			Db::name("praise_messages")->where("videoid={$id}")->delete(); //删除赞通知列表
			Db::name("user_video_comments")->where("videoid={$id}")->delete();	 //删除视频评论
			Db::name("user_video_like")->where("videoid={$id}")->delete();	 //删除视频喜欢
			Db::name("user_video_report")->where("videoid={$id}")->delete();	 //删除视频举报


			Db::name("user_video_comments_like")->where("videoid={$id}")->delete(); //删除视频评论喜欢


			$res['msg']='广告删除成功';
			echo json_encode($res);
			exit;
		}else{
			$res['code']=1002;
			$res['msg']='广告删除失败';
			echo json_encode($res);
			exit;
		}			
										  			
	}
	//通过/拒绝
	public function setStatus(){
		$rs=array('code'=>0,'msg'=>'','info'=>array());
		$data = $this->request->param();
		$id=$data['id'];
		$status=$data['status'];
		$reason=$data['reason'];

		if(!$id){
			$rs['code']=1001;
			$rs['msg']='信息错误';
			echo json_encode($rs);
			exit;
		}

		$result=Db::name("user_video")->where("id={$id}")->update(array("status"=>$status,'reason'=>$reason));
		if(!$result){
			$rs['code']=1001;
			$rs['msg']='处理失败';
			echo json_encode($rs);
			exit;
		}

		$videoInfo=Db::name("user_video")->where("id={$id}")->find();

		$uid=$videoInfo['uid'];

		$baseMsg='您于'.date("Y-m-d H:i:s",$videoInfo['addtime']).$videoTitle.'广告视频被管理员于'.date("Y-m-d H:i:s",time()).'审核为';

		if($status==1){
			$text="广告视频审核通过提醒";
			$baseMsg.='通过';
		}else{
			$text="广告视频审核失败提醒";
			$baseMsg.='不通过。';
			if($reason!=''){
				$baseMsg.='审核意见:'.$reason;
			}
		}

		$result1=addSysytemInfo($uid,$text,$baseMsg);

		if($result1!==false){

			jMessageIM($text,$uid);

		}

		$rs['msg']='处理成功';
		echo json_encode($rs);
		exit;
	}

	//下架/上架
	public function setDel(){
		$data = $this->request->param();
		$id=$data['id'];
		$isdel=$data['isdel'];

		if(!$id){
			$this->error("信息错误");
		}

		$result=Db::name("user_video")->where("id={$id}")->update(array("isdel"=>$isdel));

		if($result!==false){
			if($isdel==1){

				//将视频喜欢列表的状态更改
	    		Db::name("user_video_like")->where("videoid={$id}")->setField('status',0);

	    		//将点赞信息列表里的状态修改
	    		Db::name("praise_messages")->where("videoid={$id}")->setField('status',0);

	    		//将评论@信息列表的状态更改
	    		Db::name("user_video_comments_at_messages")->where("videoid={$id}")->setField('status',0);

	    		//将评论信息列表的状态更改
	    		Db::name("user_video_comments_messages")->where("videoid={$id}")->setField('status',0);

	    		//更新此视频的举报信息
	    		$data1=array(
	    			'status'=>1,
	    			'uptime'=>time()
	    		);

	    		Db::name("user_video_report")->where("videoid={$id}")->update($data1);
			}

			if($isdel==0){
				//将视频喜欢列表的状态更改
	    		Db::name("user_video_like")->where("videoid={$id}")->setField('status',1);

	    		//将点赞信息列表里的状态修改
	    		Db::name("praise_messages")->where("videoid={$id}")->setField('status',1);

	    		//将评论@信息列表的状态更改
	    		Db::name("user_video_comments_at_messages")->where("videoid={$id}")->setField('status',1);
	    		//将评论信息列表的状态更改
	    		Db::name("user_video_comments_messages")->where("videoid={$id}")->setField('status',1);
			}

			$this->success("操作成功");

		}else{
			$this->error("操作失败");
		}
	}	
	


	
	//观看视频
    public function  video_listen(){
		
		$id = $this->request->param('id');
    	if(!$id||$id==""||!is_numeric($id)){
    		$this->error("加载失败");
    	}else{
    		//获取音乐信息
    		$info=Db::name("user_video")->where("id={$id}")->find();
            $info['thumb']=get_upload_path($info['thumb']);
            $info['href']=get_upload_path($info['href']);
    		$this->assign("info",$info);
    	}

    	return $this->fetch();
    }


    //评论列表
	public function commentlists(){
		
		$data = $this->request->param();
    	$videoid=$data['videoid'];
		
		$lists = Db::name('user_video_comments')
            ->where("videoid={$videoid}")
            ->order("addtime DESC")
            ->paginate(20);
			
	
		$lists->each(function($v,$k){
		
			$userinfo=getUserInfo($v['uid']);
			if(!$userinfo){
				$userinfo=array(
					'user_nicename'=>'已删除'
				);
			}

			$v['user_nicename']=$userinfo['user_nicename'];
            if($v['voice']){
            	$v['voice']=get_upload_path($v['voice']);
            }
	
			return $v;
			
		});
		
		//分页-->筛选条件参数
		$lists->appends($data);	

        // 获取分页显示
        $page = $lists->render();
		
		
		

    	$this->assign("lists",$lists);
    	$this->assign("page", $page);
		
    	return $this->fetch();

    }

}
