<?php

/**
 * 直播间举报列表
 */
namespace app\admin\controller;
use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;

class LivereportController extends AdminbaseController {

    function index(){

        $lists = Db::name('user_live_report')
            ->where(function (Query $query) {
                $data = $this->request->param();

                $status=isset($data['status']) ? $data['status']: '';

                if ($status!='') {
                    $query->where('status', 'eq', $status);
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

                if (!empty($data['keyword'])) {
                    $query->where('uid|touid', 'like', "%$keyword%");
                }
            })
            ->order("addtime DESC")
            ->paginate(20);


        $lists->each(function($v,$k){
            $userinfo=getUserInfo($v['uid']);
            $touserinfo=getUserInfo($v['touid']);
            
            $v['userinfo']= $userinfo;
            $v['touserinfo']= $touserinfo;
            
            return $v;
            
        });

        //分页-->筛选条件参数
        $data = $this->request->param();
        $lists->appends($data); 
            
        // 获取分页显示
        $page = $lists->render();
			
    	$this->assign('lists', $lists);
    	$this->assign("page", $page);
    	
    	return $this->fetch();
    }
		
	public function setstatus(){

        $id=$this->request->param('id',0,'intval');
        if($id){
            $data['status']=1;
            $data['updatetime']=time();
            $result=Db::name("user_live_report")->where(["id"=>$id])->update($data);				
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
        $id=$this->request->param('id',0,'intval');
        if($id){
            $result=Db::name("user_live_report")->where(['id'=>$id])->delete();
            if($result){
                $this->success("删除成功");
            }else{
                $this->error("删除失败");
            }
        }else{
            $this->error('数据传入失败！');
        }
    }
    
}
