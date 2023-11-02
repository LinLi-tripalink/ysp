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

class AdminpostController extends AdminBaseController{
	
	protected function initialize()
    {
        parent::initialize();
        $adminId = cmf_get_current_admin_id(); //获取后台管理员id，可判断是否登录
        if (!empty($adminId)) {
            $this->assign('admin_id', $adminId);
        }
    }
	
	// 后台文章列表
    public function index(){		
		//文章分类
        $terms_list=Db::name('terms')
			->order("listorder ASC,id DESC")
            ->select();
		$this->assign('terms_list', $terms_list);
		
		
		//文章
		$posts=Db::name('posts')
			->where(function (Query $query) {
				$data = $this->request->param();
				
				$query->where('post_type', 0);
				
                if ($data['id']!='') {
                    $query->where('id', $data['id']);
                }
				
				if ($data['termid']!='') {
                    $query->where('termid', $data['termid']);
                }
				
                if (!empty($data['keyword'])) {
                    $keyword = $data['keyword'];
                    $query->where('post_title|post_keywords', 'like', "%$keyword%");
                }
			})
			->order("orderno DESC")
            ->paginate(20);
			
		$posts->each(function($v,$k){
			$userinfo=Db::name("user")
				->field("user_nicename")
				->where("id='$v[post_author]'")
				->find();
				
			if(!$userinfo){
				$userinfo=array(
					'user_nicename'=>'已删除',
				);
			}
				
			$v['userinfo']= $userinfo;
			
			$termsinfo=Db::name("terms")
				->field("name")
				->where("id='$v[termid]'")
				->find();
			if(!$termsinfo){
				$termsinfo=array(
					'name'=>'已删除'
		
				);
			}
			$v['termsinfo']= $termsinfo;
			return $v;
		});

		//分页-->筛选条件参数
		$data = $this->request->param();
		$posts->appends($data);

    	// 获取分页显示
        $page = $posts->render();
	
        $this->assign('posts', $posts);
        $this->assign('page', $page);
	
		$configpub=getConfigPub();
		$this->assign("site",$configpub['site']);
		
        return $this->fetch();
    }
	
	//文章添加
	public function add(){
		
		//文章分类
        $terms_list=Db::name('terms')
			->order("listorder ASC,id DESC")
            ->select();
		$this->assign('terms_list', $terms_list);
		
		return $this->fetch();
	}
	
	public function add_post(){
			$data = input('post.post');
			if(empty($data['termid'])){
				$this->error("请至少选择一个分类！");
			}else if(empty($data['post_title'])){
				$this->error('请输入标题!');
			}
			$data['post_content']=html_entity_decode($data['post_content']);
			$data['post_author']=cmf_get_current_admin_id(); //获取后台管理员id
            
            $path='';
            if($data['termid']!=0){
                $info=Db::name('terms')->where('id',$data['termid'])->value('path');
                $path=$info;
            }
            
            $data['path']=$path;
            $data['post_status']='1';
            
            $data['post_date']=time();
            
            
            
			$add=Db::name('posts')->insert($data);
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
			//文章分类
			$terms_list=Db::name('terms')
				->order("listorder ASC,id DESC")
				->select();
			$this->assign('terms_list', $terms_list);
			
			$info=Db::name('posts')->where('id',$id)->find();
            $info['post_content']=str_replace('../../','/upload/',$info['post_content']);
			$this->assign('info',$info);
		}else{
			$this->error('数据传入失败!');
		}
		
		return $this->fetch();
	}
	
	public function edit_post(){
		$data = input('post.post');
		$data['post_content']=html_entity_decode($data['post_content']);

		if(empty($data['termid'])){
			$this->error("请至少选择一个分类！");
		}else if(empty($data['post_title'])){
			$this->error('请输入标题!');
		}
        
        $path='';
        if($data['termid']!=0){
            $info=Db::name('terms')->where('id',$data['termid'])->value('path');
            $path=$info;
        }
        
        $data['path']=$path;
            
		$save=Db::name('posts')->where('id',$data['id'])->update($data);	
		
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
            $result=Db::name('posts')->delete($id);				
			if($result){
				$this->success('删除成功');
			 }else{
				$this->error('删除失败');
			 }			
        }else{				
            $this->error('数据传入失败！');
        }								  			
    }
	
	
	// 文章批量审核或取消审核
	public function check(){
		$data = input();
		foreach ($data['ids'] as $k => $r) {
			$save=array();
            $save['post_status'] = $data['check'];
            Db::name('posts')->where(['id'=>$r])->update($save);
        }
		$status = true;
		if ($status) {
			$this->success("操作成功！");
		} else {
			$this->error("操作失败！");
		}

	}
	
	// 文章批量置顶或取消置顶
	public function tops(){
		$data = input();
		foreach ($data['ids'] as $k => $r) {
			$save=array();
            $save['istop'] = $data['top'];
            Db::name('posts')->where(['id'=>$r])->update($save);
        }
		$status = true;
		if ($status) {
			$this->success("操作成功！");
		} else {
			$this->error("操作失败！");
		}

	}
	
	// 文章批量删除
	public function deletes(){
		$data = input();
		foreach ($data['ids'] as $k => $r) {
            Db::name('posts')->where(['id'=>$r])->delete();
        }
		$status = true;
		if ($status) {
			$this->success("操作成功！");
		} else {
			$this->error("操作失败！");
		}

	}
	// 文章排序
	public function listordersset() { 
		
     
		$ids=$this->request->param('listordersset');
        foreach ($ids as $key => $r) {
            $data['orderno'] = $r;
            Db::name("posts")
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
	
	
	
}