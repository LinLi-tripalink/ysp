<?php

/**
 * 提现
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;

class FeedbackController extends AdminbaseController {
	
    public function index(){
		$lists = Db::name('feedback')
            ->where(function (Query $query) {

                $data = $this->request->param();
				
				$status=isset($data['status']) ? $data['status']: '';

                if ($status!='') {
                    $query->where('status', $status);
                }


                $start_time=isset($data['start_time']) ? $data['start_time']: '';
                $end_time=isset($data['end_time']) ? $data['end_time']: '';

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
				if(!$userinfo){
					$userinfo=array(
						'user_nicename'=>'已删除'
					);
				}		
				$v['userinfo']= $userinfo;
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
		
	public function setstatus(){
		$id = $this->request->param('id', 0, 'intval');
		if($id){
			$data['status']=1;
			$data['uptime']=time();
			$result=Db::name("feedback")->where("id='{$id}'")->update($data);				
			if($result){
				$this->success('标记成功');
			}else{
				$this->error('标记失败');
			}			
		}else{				
			$this->error('数据传入失败！');
		}								  		
	}		
		
	public function del(){
		$id = $this->request->param('id', 0, 'intval');
		if($id){
			$result=Db::name("feedback")->delete($id);				
			if($result){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}			
		}else{				
			$this->error('数据传入失败！');
		}								  
	}		

		
	public function edit(){
		$id = $this->request->param('id', 0, 'intval');
		if($id){
			$feedback=Db::name("feedback")->find($id);
			
			$userinfo=Db::name("user")
					->field("user_nicename")
					->where("id='$feedback[uid]'")
					->find();
			if(!$userinfo){
				$userinfo=array(
					'user_nicename'=>'已删除'
				);
			}	
			
			$feedback['userinfo']=$userinfo;
			
			$this->assign('feedback', $feedback);						
		}else{				
			$this->error('数据传入失败！');
		}								  
		return $this->fetch();				
	}


	public function edit_post(){		
		if($this->request->isPost()) {
			$data = $this->request->param();
			if($data['status']=='0'){							
				$this->error('未修改状态');			
			}
			$data['uptime']=time();
			$result=Db::name("feedback")->update($data); 
			if($result){
				
				$this->success('修改成功',url('Feedback/index'));
			}else{
				$this->error('修改失败');
			}
		}
	}
    
}
