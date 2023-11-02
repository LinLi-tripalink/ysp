<?php

/**
 * 举报
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;


class ReportController extends AdminbaseController {

	//列表
    public function classify(){
		$lists=Db::name("user_report_classify")
            ->where(function (Query $query) {
                $data = $this->request->param();
                $keyword=isset($data['keyword']) ? $data['keyword']: '';
                if (!empty($keyword)) {
                    $query->where('title', 'like', "%$keyword%");
                }

            })
            ->order("orderno asc")
            ->paginate(20);
			
			
		//分页-->筛选条件参数
		$data = $this->request->param();
		$lists->appends($data);	

    	 // 获取分页显示
        $page = $lists->render();
		
        $this->assign('lists', $lists);
        $this->assign('page', $page);
		
		
		return $this->fetch();
	}

	/*分类添加*/
	public function classify_add(){

		return $this->fetch();
	}


	/*分类添加提交*/
	public function classify_add_post(){

		if($this->request->isPost()) {
			
			$data = $this->request->param();
			
			$title=trim($data['title']);
			$orderno=$data['orderno'];

			if($title==""){
				$this->error("请填写分类名称");
			}


			if(!is_numeric($orderno)){
				$this->error("排序号请填写数字");
			}

			if($orderno<0){
				$this->error("排序号必须大于0");
			}
			
			
			$isexit=Db::name("user_report_classify")
				->where("title='{$title}'")
				->find();	
			if($isexit){
				$this->error('该分类已存在');
			}
			
			$data['title']=$title;
			$data['orderno']=$orderno;
			$data['addtime']=time();
			
			$result=Db::name("user_report_classify")->insert($data);

			if($result){
				$this->success('添加成功','admin/Report/classify',3);
			}else{
				$this->error('添加失败');
			}
		}

	}

	//分类排序
    public function classify_listorders() { 

		$ids = $this->request->param('listorders');
        foreach ($ids as $key => $r) {
            $data['orderno'] = $r;
            Db::name("user_report_classify")
				->where(array('id' => $key))
				->update($data);
        }
				
        $status = true;
        if ($status) {
            $this->success("排序更新成功！");
        } else {
            $this->error("排序更新失败！");
        }
    }

    /*分类删除*/
	public function classify_del(){

		$id = $this->request->param('id');
		if($id){
			$result=Db::name("user_report_classify")
				->where("id={$id}")
				->delete();				
			if($result){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}			
		}else{				
			$this->error('数据传入失败！');
		}
	}

	/*分类编辑*/
	public function classify_edit(){
		$id = $this->request->param('id');
		if($id){
			$info=Db::name("user_report_classify")
				->where("id={$id}")
				->find();

			$this->assign("classify_info",$info);
		}else{
			$this->error('数据传入失败！');
		}
		
		return $this->fetch();
	}

	/*分类编辑提交*/
	public function classify_edit_post(){

		if($this->request->isPost()) {
			
			$data = $this->request->param();	

			
			$id=$data["id"];
			$title=$data["title"];
			
			$orderno=$data["orderno"];

			if(!trim($title)){
				$this->error('分类标题不能为空');
			}

			if(!is_numeric($orderno)){
				$this->error("排序号请填写数字");
			}

			if($orderno<0){
				$this->error("排序号必须大于0");
			}
		
			$isexit=Db::name("user_report_classify")
				->where("id!={$id} and title='{$title}'")
				->find();
			if($isexit){
				$this->error('该分类已存在');
			}
			
			$data["updatetime"]=time();
			
			$result=Db::name("user_report_classify")
				->update($data);
				
			
			if($result!==false){
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}

	}

    public function index(){
		
		$lists = Db::name('user_report')
            ->where(function (Query $query) {
                $data = $this->request->param();

                $status=isset($data['status']) ? $data['status']: '';
                $start_time=isset($data['start_time']) ? $data['start_time']: '';
                $end_time=isset($data['end_time']) ? $data['end_time']: '';


                if ($status!='') {
                    $query->where('status','eq', intval($status));
                }
                if (!empty($start_time)) {
                    $query->where('addtime', 'gt' , strtotime($start_time));
                }
                if (!empty($end_time)) {
                    $query->where('addtime', 'lt' ,strtotime($end_time));
                }
				
				if (!empty($start_time) && !empty($end_time)) {
                    $query->where('addtime', 'between' , [strtotime($start_time),strtotime($end_time)]);
                }
				$keyword=isset($data['keyword']) ? $data['keyword']: '';
                if (!empty($keyword)) {
                    $query->where('uid', 'like', "%$keyword%");
                }

            })
            ->order("addtime DESC")
            ->paginate(20);
			
		$lists->each(function($v,$k){
			$userinfo=Db::name("user")
				->field("user_nicename")
				->where("id='$v[uid]'")
				->find();
				
			$v['userinfo']= $userinfo;
			
			$userinfo=Db::name("user")
				->field("user_nicename,user_status")
				->where("id='$v[touid]'")
				->find();
			
			$v['touserinfo']= $userinfo;
			
			return $v;
			
		});
			
		//分页-->筛选条件参数
		$data = $this->request->param();
		$lists->appends($data);	
			
        // 获取分页显示
        $page = $lists->render();
		
        $this->assign('lists', $lists);
        $this->assign('page', $page);

    	return $this->fetch();
    }
	
	//标记处理
	public function setstatus(){
		$id = $this->request->param('id');
		if($id){
			 $data['status']=1;
			 $data['uptime']=time();
			 $result=Db::name("user_report")
				->where("id='{$id}'")
				->update($data);
			if($result){

				$reportInfo=Db::name("user_report")
					->where("id={$id}")
					->find();
				
				$reportedUserInfo=Db::name("user")
					->where("id={$reportInfo['touid']}")
					->field("id,user_nicename")
					->find();


				$uid=$reportInfo['uid'];

				$baseMsg='您于'.date("Y-m-d H:i:s",$reportInfo['addtime']).'对'.$reportedUserInfo['user_nicename'].'的举报已被管理员于'.date("Y-m-d H:i:s",time()).'进行处理';

				$text="用户举报处理提醒";

				$result1=addSysytemInfo($uid,$text,$baseMsg);

				if($result1!==false){
					jMessageIM($text,$uid);
				}

				$this->success('标记成功');
			}else{
				$this->error('标记失败');
			}			
		}else{				
			$this->error('数据传入失败！');
		}								  		
	}		
	
	//拉黑用户
	public function ban(){
    	$id = $this->request->param('id');
    	if ($id) {
    		$rst = Db::name("user")
				->where(array("id"=>$id,"user_type"=>2))
				->setField('user_status','0'); 
    		if ($rst!==false) {
				
    			$this->success("会员拉黑成功！");
    		} else {
    			$this->error('会员拉黑失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
	
	//下架视频
    public function ban_video(){
    	$id = $this->request->param('id');
    	if($id){
    		$rst = Db::name("user_video")
				->where(array("uid"=>$id))
				->setField('isdel','1');
    		if ($rst!==false) {
				
    			$this->success("被举报用户所有视频下架成功！");
    		} else {
    			$this->error('视频下架失败！');
    		}
    	}else {
    		$this->error('数据传入失败！');
    	}
    }

	//标记处理+禁用用户+下架视频
    public function ban_all(){
    	$id = $this->request->param('id');
    	if($id){

    		$data['status']=1;
			$data['uptime']=time();
			
			//标记处理
			$result=Db::name("user_report")
				->where("id='{$id}'")
				->update($data);

				
			//获取该举报信息对应的用户
			$info=Db::name("user_report")
				->where("id='{$id}'")
				->find();

			 //用户禁用
    		Db::name("user")
				->where(array("id"=>$info['touid'],"user_type"=>2))
				->setField('user_status','0'); 
				
				
				
    		 //下架视频
    		Db::name("user_video")
				->where(array("uid"=>$info['touid']))
				->setField('isdel','1');
    		
				
    		$this->success("操作成功！");
    		
    	}else {
    		$this->error('数据传入失败！');
    	}
    }
	
	
	
	/*删除举报*/
	public function del(){

		$id = $this->request->param('id');
		if($id){
			$result=Db::name("user_report")
				->where("id={$id}")
				->delete();				
			if($result){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}			
		}else{				
			$this->error('数据传入失败！');
		}
	}
    
}
