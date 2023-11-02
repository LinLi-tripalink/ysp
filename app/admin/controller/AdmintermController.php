<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Tuolaji <479923197@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;

class AdminTermController extends AdminBaseController{
	

	
	// 后台文章分类列表
    public function index(){
		$list=Db::name('terms')
            ->where('parentid=0')
			->order("listorder ASC,id DESC")
            ->paginate(10);
     
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        // 渲染模板输出
		return $this->fetch();
	}
	
	//文章分类添加
	public function add(){
		$parentid = input('id');
        if(!$parentid){
            $parentid=0;
        }
        
        $this->assign('parentid', $parentid);
		
		return $this->fetch();
	}
	
	public function add_post(){
		$data = input('post.');
		if($data['name']==''){
			$this->error('分类名称不能为空!');
		}
		$add=Db::name('terms')->insertGetId($data);
		if($add){
       
            
			$this->success('添加成功!');
		}else{
			$this->error('添加失败!');
		}
	}
	
	
	//文章分类编辑
	public function edit(){
		$id = input('param.id');
		if($id){
			$info=Db::name('terms')->where('id',$id)->find();
			$this->assign('info',$info);
		}else{
			$this->error('数据传入失败!');
		}
		
		return $this->fetch();
	}
	
	public function edit_post(){
		$data = input('post.');
		if($data['name']==''){
			$this->error('分类名称不能为空!');
		}
		$save=Db::name('terms')->where('id',$data['id'])->update($data);
		if($save!==false){
			$this->success('保存成功!');
		}else{
			$this->error('保存失败!');
		}
	}
	
	
	// 文章分类删除
	public function del(){
        $id = input('param.id');
        if($id){
            $result=Db::name('terms')->delete($id);				
			if($result){
				//删除分类下的文章
				//Db::name('posts')->where('id',$id)->delete();
				
				$this->success('删除成功');
			 }else{
				$this->error('删除失败');
			 }			
        }else{				
            $this->error('数据传入失败！');
        }								  			
    }	
	
	
	
	// 文章分类排序
	public function listorder(){
		$listorders = input('listorders');
		
		
		foreach ($listorders as $key => $r) {
			$data=array();
            $data['listorder'] = $r;
            Db::name('terms')->where(['id'=>$key])->update($data);
        }
		$status = true;
		if ($status) {
			$this->success("排序更新成功！");
		} else {
			$this->error("排序更新失败！");
		}

	}
	
	
}