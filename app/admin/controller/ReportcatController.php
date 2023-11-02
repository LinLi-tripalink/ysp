<?php

/**
 * 直播间举报类型
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;


class ReportcatController extends AdminbaseController {

	//列表
    public function index(){
		$lists=Db::name("user_live_report_classify")
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
	public function add(){

		return $this->fetch();
	}


	/*分类添加提交*/
	public function add_post(){

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
			
			
			$isexit=Db::name("user_live_report_classify")
				->where("title='{$title}'")
				->find();	
			if($isexit){
				$this->error('该分类已存在');
			}
			
			$data['title']=$title;
			$data['orderno']=$orderno;
			$data['addtime']=time();
			
			$result=Db::name("user_live_report_classify")->insert($data);

			if($result){
				$this->success('添加成功','admin/Reportcat/index',3);
			}else{
				$this->error('添加失败');
			}
		}

	}

	//分类排序
    public function listorderset() { 

		$ids = $this->request->param('listorders');
        foreach ($ids as $key => $r) {
            $data['orderno'] = $r;
            Db::name("user_live_report_classify")
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
	public function del(){

		$id = $this->request->param('id');
		if($id){
			$result=Db::name("user_live_report_classify")
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
	public function edit(){
		$id = $this->request->param('id');
		if($id){
			$info=Db::name("user_live_report_classify")
				->where("id={$id}")
				->find();

			$this->assign("info",$info);
		}else{
			$this->error('数据传入失败！');
		}
		
		return $this->fetch();
	}

	/*分类编辑提交*/
	public function edit_post(){

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
		
			$isexit=Db::name("user_live_report_classify")
				->where("id!={$id} and title='{$title}'")
				->find();
			if($isexit){
				$this->error('该分类已存在');
			}
			
			$data["updatetime"]=time();

			unset($data['id']);
			
			$result=Db::name("user_live_report_classify")->where("id={$id}")->update($data);
			
			
			if($result!==false){
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}

	}
	

    
}
