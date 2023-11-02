<?php

/**
 * 广告位
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;



class AdvertController extends AdminbaseController {

	/*广告列表*/
    public function index(){

		
		$p = $this->request->param('p');
		if(!$p){
			$p=1;
		}
		$lists = Db::name('user_video')
            ->where(function (Query $query) {
				$data = $this->request->param();
				$query->where('is_ad', '1');
				$query->where('isdel', '0');

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
   
	//添加广告
	public function add(){
		//获取广告用户
		$adLists=Db::name("user")
			->field("id,user_nicename")
			->where("user_status=1 and user_type=2 and is_ad=1")
			->select();

		$this->assign("adLists",$adLists);
		
		return $this->fetch();				
	}

	public function add_post(){
		if($this->request->isPost()) {
			$data = $this->request->param();	

			$video=Db::name("user_video");
			$data['addtime']=time();
			$data['ad_endtime']=strtotime($data["ad_endtime"]);
			$data['is_ad']=1;
			$data['status']=1;
			$data['ad_url']=html_entity_decode($data["ad_url"]);//将html实体转换为字符
			
			
			
			$owner_uid=$data['owner_uid'];
			if($owner_uid==""||!is_numeric($owner_uid)){
				$this->error("请填写视频所有者id");
				return;
			}

			//判断用户是否存在
			$ownerInfo=Db::name("user")
				->where("user_type=2 and id={$owner_uid} and is_ad=1")
				->find();
			if(!$ownerInfo){
				$this->error("广告发布者不存在");
				return;
			}
			
			$data['uid']=$owner_uid;
			
		


			$url=$data['href'];
			$title=$data['title'];
			$thumb=$data['thumb'];

			if($title==""){
				$this->error("请填写广告标题");
			}
			if($thumb==""){
				$this->error("请上传广告封面");
			}

			$data['thumb_s']=$thumb;

			$uploadSetting = cmf_get_upload_setting();
            $extensions=$uploadSetting['file_types']['video']['extensions'];
            $allow=explode(",",$extensions);
			
			if($url!=""){
				//判断链接地址的正确性
                if(strpos($url,'http')===false){
                    $this->error("请填写正确的视频地址");
                }
                $video_type=substr(strrchr($url, '.'), 1);


                if(!in_array(strtolower($video_type), $allow)){
                	$this->error("请填写正确后缀的视频地址");
                }

				$data['href']=$url;
				$data['href_w']=$url;
              
			}else{
				
				//获取后台上传配置
				$configpri=getConfigPri();
				$show_val=$configpri['show_val'];
				$data['show_val']=$show_val;


				if(!$_FILES["file"]){
                    $this->error("请上传视频");
                }
                
                $files["file"]=$_FILES["file"];
                $type='video';

                if (!get_file_suffix($files['file']['name'],$allow)){
                    $this->error("请上传正确格式的视频文件或检查上传设置中视频文件设置的文件类型");
                }
                
                $rs=adminUploadFiles($files,$type);
                if($rs['code']!=0){
                    $this->error($rs['msg']);
                }
                
				
				$data['href']=$rs['filepath'];
				$data['href_w']=$rs['filepath'];

			}
			
			unset($data['file']);
			unset($data['video_upload_type']);
			unset($data['owner_uid']);

			$result=$video->insert($data);

			if($result){
				$this->success('添加成功',url('Advert/index'),3);
			}else{
				$this->error('添加失败');
			}
		}			
	}
	
	
	//编辑视频
	public function edit(){
		
		$data = $this->request->param();
		$id=intval($data['id']);
		$from=$data["from"];
		if($id){
			$video=Db::name("user_video")->where("id={$id}")->find();
			
			$userinfo=getUserInfo($video['uid']);
			if(!$userinfo){
				$userinfo=array(
					'user_nicename'=>'已删除'
				);
			}
			
			$video['userinfo']=$userinfo;
            $video['thumb']=get_upload_path($video['thumb']);
            $video['href']=get_upload_path($video['href']);
            $video['href_w']=get_upload_path($video['href_w']);
            if($video['ad_endtime'] == 0){
				$video['ad_endtime']='';
			}else{
				$ad_endtime=(int)$video['ad_endtime'];
				$video['ad_endtime']=date('Y-m-d',$ad_endtime);
				
			}
			$this->assign('video', $video);						
		}else{				
			$this->error('数据传入失败！');
		}
		$this->assign("from",$from);
		return $this->fetch();				
	}

	
	public function edit_post(){
		if($this->request->isPost()) {
			
			
			$data = $this->request->param();

			$video=Db::name("user_video");

			

			$id=$data['id'];
			$title=$data['title'];
			$thumb=$data['thumb'];
			$type=$data['video_upload_type'];
			$url=$data['href_e'];
			$status=$data['status'];

			$data['ad_endtime']=strtotime($data["ad_endtime"]);
			$data['ad_url']=html_entity_decode($data["ad_url"]);//将html实体转换为字符

			if($thumb==""){
				$this->error("请上传视频封面");
				return;
			}
			
			$data['thumb_s']=$thumb;

			if($type!=''){

				$uploadSetting = cmf_get_upload_setting();
	            $extensions=$uploadSetting['file_types']['video']['extensions'];
	            $allow=explode(",",$extensions);

				if($type==0){ //视频链接型式
					if($url==''){
						$this->error("请填写视频链接地址");
					}

					//判断链接地址的正确性
					if(strpos($url,'http')!==false||strpos($url,'https')!==false){

						$video_type=substr(strrchr($url, '.'), 1);

						if(!in_array(strtolower($video_type), $allow)){
		                	$this->error("请填写正确后缀的视频地址");
		                }

						$data['href']=$url;
						$data['href_w']=$url;
					}else{
						$this->error("请填写正确的视频地址");
					}


				}else if($type==1){ //文件上传型式


					if(!$_FILES["file"]){
                        $this->error("请上传视频");
                    }
                    
                    $files["file"]=$_FILES["file"];
                    $type='video';

                    if (!get_file_suffix($files['file']['name'],$allow)){
	                    $this->error("请上传正确格式的视频文件或检查上传设置中视频文件设置的文件类型");
	                }
                    
                    $rs=adminUploadFiles($files,$type);
                    if($rs['code']!=0){
                        $this->error($rs['msg']);
                    }
                    
                    $data['href']=$rs['filepath'];
					$data['href_w']=$rs['filepath'];
				}
			}
			
			unset($data['file']);
			unset($data['href_e']);
			unset($data['video_upload_type']);
			unset($data['owner_uid']);
			unset($data['ckplayer_playerzmblbkjP']);

			$result=$video->update($data);
			if($result!==false){
				$this->success('修改成功');
			 }else{
				$this->error('修改失败');
			 }
		}			
	}
	

    //设置下架
    public function setXiajia(){
    	$res=array("code"=>0,"msg"=>"下架成功","info"=>array());
		$data = $this->request->param();
		
		
    	$id=$data['id'];
    	$reason=$data["reason"];
    	if(!$id){
    		$res['code']=1001;
    		$res['msg']="请确认视频信息";
    		echo json_encode($res);
    		exit;
    	}

    	//判断此视频是否存在
    	$videoInfo=Db::name("user_video")->where("id={$id}")->find();
    	if(!$videoInfo){
    		$res['code']=1001;
    		$res['msg']="请确认视频信息";
    		echo json_encode($res);
    		exit;
    	}

    	//更新视频状态
    	$data=array("isdel"=>1,"xiajia_reason"=>$reason);

    	$result=Db::name("user_video")->where("id={$id}")->update($data);

    	if($result!==false){

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

    		

    		echo json_encode($res);
    		exit;
    	}else{
    		$res['code']=1002;
    		$res['msg']="下架失败";
    		echo json_encode($res);
    		exit;
    	}
    	
    }

    /*下架视频列表*/
    public  function lowervideo(){

		$p = $this->request->param('p');
		if(!$p){
			$p=1;
		}
		$lists = Db::name('user_video')
            ->where(function (Query $query) {
				$data = $this->request->param();
				$query->where('is_ad', '1');
				$query->where('isdel', '1');

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
    	return $this->fetch();
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


    /*视频上架*/
    public function set_shangjia(){
    	$id = $this->request->param('id');
    	if(!$id){
    		$this->error("视频信息加载失败");
    	}

    	//获取视频信息
    	$info=Db::name("user_video")->where("id={$id}")->find();
    	if(!$info){
    		$this->error("视频信息加载失败");
    	}

    	$data=array(
    		'xiajia_reason'=>'',
    		'isdel'=>0
    	);
    	$result=Db::name("user_video")->where("id={$id}")->update($data);
    	if($result!==false){
    		//将视频喜欢列表的状态更改
    		Db::name("user_video_like")->where("videoid={$id}")->setField('status',1);

    		//将点赞信息列表里的状态修改
    		Db::name("praise_messages")->where("videoid={$id}")->setField('status',1);

    		//将评论@信息列表的状态更改
    		Db::name("user_video_comments_at_messages")->where("videoid={$id}")->setField('status',1);
    		//将评论信息列表的状态更改
    		Db::name("user_video_comments_messages")->where("videoid={$id}")->setField('status',1);

    		$this->success("上架成功");
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

    //排序
    public function listsorders() { 
        $ids = $_POST['listorders'];
		$ids = $this->request->param('listorders');
        foreach ($ids as $key => $r) {
            $data['orderno'] = $r;
            Db::name("user_video")->where(array('id' => $key))->update($data);
        }
				
        $status = true;
        if ($status) {

            $this->success("权重更新成功！");
        } else {
            $this->error("权重更新失败！");
        }
    }
}
