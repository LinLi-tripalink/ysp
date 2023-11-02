<?php

/**
 * 禁播列表
 */
namespace app\admin\controller;
use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;

class LivebanController extends AdminbaseController {
    function index(){
		
		$data = $this->request->param();
		$start_time=isset($data['start_time']) ? $data['start_time']: '';


        $lists = Db::name('user_live_ban')
            ->where(function (Query $query) {
                $data = $this->request->param();
                
                $start_time=isset($data['start_time']) ? $data['start_time']: '';
                $end_time=isset($data['end_time']) ? $data['end_time']: '';

                if (!empty($start_time)) {
                    $query->where('addtime', 'gt' , strtotime($start_time.' 00:00:00'));
                }

                if (!empty($end_time)) {
                    $query->where('addtime', 'lt' ,strtotime($end_time.' 23:59:59'));
                }
                
                if (!empty($start_time) && !empty($end_time)) {
                    $query->where('addtime', 'between' , [strtotime($start_time.' 00:00:00'),strtotime($end_time.' 23:59:59')]);
                }

                $keyword=isset($data['keyword']) ? $data['keyword']: '';
                
                if (!empty($keyword)) {
                    $query->where('uid', 'like', "%$keyword%");
                }
            })
            ->order("addtime DESC")
            ->paginate(20);

		
        $lists->each(function($v,$k){
			
			
			$liveinfo=getUserInfo($v['uid']);
			if($v['superid']!=0){
				$superinfo=getUserInfo($v['superid']);
			}else{
				$superinfo['id']='0';
				$superinfo['user_nicename']='平台';
			}
			$v['liveinfo']= $liveinfo;
			$v['superinfo']= $superinfo;
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
		
	public function del(){

        $id=$this->request->param('id',0,'intval');
        if($id){
            $result=Db::name("user_live_ban")->where(["uid"=>$id])->delete();				
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
