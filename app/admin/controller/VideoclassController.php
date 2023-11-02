<?php

/**
 * 短视频分类
 */
namespace app\admin\controller;
use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;



class VideoclassController extends AdminbaseController {

	/*视频分类列表*/
    public function index(){
		

    	$video_model=Db::name("user_video_class");
		
    	$lists = $video_model
    		->where(function(Query $query){
    			$data = $this->request->param();

    			$keyword=isset($data['keyword']) ? $data['keyword']: '';

    			if(!empty($keyword)){
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
    	$this->assign("page", $page);
    	return $this->fetch();
    }


    //排序
    public function listordersset() { 
		
        $ids=$this->request->param('listorders');
        foreach ($ids as $key => $r) {
            $data['orderno'] = $r;
            Db::name("user_video_class")->where(array('id' => $key))->update($data);
        }
				
        $status = true;
        if ($status) {
        	$this->resetCache();
            $this->success("排序更新成功！");
        } else {
            $this->error("排序更新失败！");
        }
    }

    public function resetCache(){
        $key='getVideoClass';
        $rules= Db::name("user_video_class")
            ->field('id,title')
            ->where("status=1")
            ->order('orderno asc')
            ->select();
        setcaches($key,$rules);
        return 1;
    }

    public function del(){

		$id=$this->request->param('id',0,'intval');
		if($id){
			$result=Db::name("user_video_class")->where(["id"=>$id])->delete();
				if($result){
                    $this->resetCache();

                    //将视频列表属于该分类下的视频分类取消
                    Db::name("user_video")->where("classid={$id}")->update(array("classid"=>0));

                    $this->success('删除成功');
				 }else{
                    $this->error('删除失败');
				 }						
		}else{				
			$this->error('数据传入失败！');
		}								  
		return $this->fetch();
										  			
	}

	public function add(){

		return $this->fetch();				
	}

	public function add_post(){
		if($this->request->isPost()){

			$data=$this->request->param();			

			$data['addtime']=time();
			
			
			$title=$data['title'];

			if($title==""){
				$this->error("请填写分类标题");
			}

			//判断标题是否存在
			$info=Db::name("user_video_class")->where("title='{$title}'")->find();
			if($info){
				$this->error("分类标题已经存在");
			}

            
			$result=Db::name("user_video_class")->insert($data);

			if($result){
				$this->resetCache();
				$this->success('添加成功','Admin/Videoclass/index');
			}else{
				$this->error('添加失败');
			}
		}			
	}

	public function edit(){
		$id=$this->request->param('id',0,'intval');

		if($id){
			$info=Db::name("user_video_class")->where("id={$id}")->find();
			$this->assign('info', $info);						
		}else{				
			$this->error('数据传入失败！');
		}

		return $this->fetch();				
	}

	public function edit_post(){
		if($this->request->isPost()){

			$data=$this->request->param();

			$id=$data['id'];
			$title=trim($data['title']);
			

			if($title==""){
				$this->error("请填写视频标题");
			}

			$data['title']=$title;

			//判断名称是否存在
			$info=Db::name("user_video_class")->where("id !={$id} and title='{$title}'")->find();
			if($info){
				$this->error("视频分类标题已经存在");
			}
			
			$result=Db::name("user_video_class")->update($data);


			if($result!==false){
				$this->resetCache();
				$this->success('修改成功');
			 }else{
				$this->error('修改失败');
			 }
		}			
	}

		
	/*		


	

	
	
	


	*/
	
    
}
