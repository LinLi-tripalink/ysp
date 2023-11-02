<?php

/**
 * 引导图
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class GuideController extends AdminBaseController{


    public function set(){
		$this->assign('config', cmf_get_option('guide'));
    	return $this->fetch();
    }
    
    public function set_post(){
		 if($this->request->isPost()){
            $options = $this->request->param('post/a');
            cmf_set_option('guide', $options);
            $this->success("保存成功！", '');
        }
    }
    
	//列表
    public function index(){
        $config = cmf_get_option('guide');
		
        $type=$config['type'];
        $map['type']=$type;
        
    	$guide=Db::name("guide");
    	$lists = $guide
            ->where($map)
            ->order("orderno asc, id desc")
            ->paginate(20);
			
		
		$page = $lists->render();
        $this->assign("page", $page);
		
    	$this->assign('lists', $lists);
    	$this->assign('type', $type);
    	return $this->fetch();
    }
	
	//添加
    public function add(){
        $config = cmf_get_option('guide');
        
        $type=$config['type'];


        if($type==1){
            $map['type']=$type;
        
            $guide=Db::name("guide");
            $count=$guide->where($map)->count();

            if($count>=1){
                $this->error("引导页视频只能存在一个");
            }
        }
        
        $this->assign('type', $type);
        
        return $this->fetch();				
    }
    
    public function add_post(){
       if ($this->request->isPost()) {
			$data = $this->request->param();
			$type=$data['type'];


			if($type==1){

				$count=Db::name("guide")->where("type=1")->count();
				if($count>=1){
					$this->error("引导页视频只能存在一个");
				}

				if($_FILES){

					$files["file"]=$_FILES["file"];
					$type='video';

					$uploadSetting = cmf_get_upload_setting();
		            $extensions=$uploadSetting['file_types']['video']['extensions'];
		            $allow=explode(",",$extensions);

		            if (!get_file_suffix($files['file']['name'],$allow)){
	                    $this->error("请上传正确格式的视频文件或检查上传设置中视频文件设置的文件类型");
	                }

					$rs=adminUploadFiles($files,$type);

					if($rs['code']!=0){

						$this->error($rs['msg']);
					}

					$data['thumb']=$rs['filepath'];

				}else{

					$this->error("请上传视频");
				}
			}
			
			if(!$data['thumb']){
				$this->error("请上传图片");
			}
			
			unset($data['file']);
			$data['addtime']=time();
			$data['uptime']=time();
          
             
			$result=Db::name("guide")->insert($data); 
			if($result){
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
        }			
    }
	
	//删除
	public function del(){
		$id = $this->request->param('id');
        if($id){
            $result=Db::name("guide")->delete($id);				
			if($result){
				$this->success('删除成功', '');
			}else{
				$this->error('删除失败');
			}			
        }else{				
            $this->error('数据传入失败！');
        }								  
        return $this->fetch();				
    }

	//编辑
    public function edit(){
        $id = $this->request->param('id');
        if($id){
            $data=Db::name("guide")->find($id);
            $this->assign('data', $data);						
        }else{				
            $this->error('数据传入失败！');
        }
		
        return $this->fetch();				
    }
    
    public function edit_post(){

		if ($this->request->isPost()) {
			$data = $this->request->param();
			
			$type=$data['type'];

			if($type==1){

				if($_FILES){

					$files["file"]=$_FILES["file"];
					$type='video';

					$uploadSetting = cmf_get_upload_setting();
		            $extensions=$uploadSetting['file_types']['video']['extensions'];
		            $allow=explode(",",$extensions);

		            if (!get_file_suffix($files['file']['name'],$allow)){
	                    $this->error("请上传正确格式的视频文件或检查上传设置中视频文件设置的文件类型");
	                }

					$rs=adminUploadFiles($files,$type);
					if($rs['code']!=0){
						$this->error($rs['msg']);
					}
					$data['thumb']=$rs['filepath'];
					
					
				}else{
					$this->error("请上传视频");
				}
			}
			if(!$data['thumb']){
				$this->error("请上传图片");
			}
			unset($data['file']);
			
			$data['uptime']=time();
			$result=Db::name("guide")->update($data); 
			if($result){
				$this->success('编辑成功');
			}else{
				$this->error('编辑失败');
			}
        }	
    }

    //排序
    public function listsorders() { 
		$ids = $this->request->param('listsorders');
        foreach ($ids as $key => $r) {
            $data['orderno'] = $r;
            Db::name("guide")
				->where(array('id' => $key))
				->update($data);
        }
				
        $status = true;
        if($status){
            $this->success("排序更新成功！", '');
        }else{
            $this->error("排序更新失败！");
        }
    }	
	
        

}
