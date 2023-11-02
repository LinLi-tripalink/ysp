<?php

/**
 * 背景音乐管理
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;

class MusicController extends AdminbaseController {	
	/*分类列表*/
	public function classify(){

		$lists = Db::name('user_music_classify')
            ->where(function (Query $query) {

                $data = $this->request->param();
  				$keyword=isset($data['keyword']) ? $data['keyword']: '';
                if (!empty($keyword)) {
                    $query->where('title', 'like', "%$keyword%");
                }

            })
            ->order("orderno,addtime DESC")
            ->paginate(20);

		$lists->each(function($v,$k){
			
			$v['img_url']=get_upload_path($v['img_url']);
	
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

	/*分类添加*/
	public function classify_add(){

		return $this->fetch();
	}

	/*分类添加提交*/
	public function classify_add_post(){

		if($this->request->isPost()) {
			
			$data = $this->request->param();
			$classify=Db::name("user_music_classify");
			
			$title=trim($data['title']);
			$url=$data['img_url'];
			$orderno=$data['orderno'];

			if($title==""){
				$this->error("请填写分类名称");
			}

			if($url==""){
				$this->error("请上传分类图标");
			}

			if(!is_numeric($orderno)){
				$this->error("排序号请填写数字");
			}

			if($orderno<0){
				$this->error("排序号必须大于0");
			}
			
			
			$isexit=$classify
				->where("title='{$title}'")
				->find();	
			if($isexit){
				$this->error('该分类已存在');
			}
			
			$data['title']=$title;
			$data['orderno']=$orderno;
			$data['img_url']=$url;
			$data['addtime']=time();
			
			$result=$classify->insert($data);

			if($result){
				$this->success('添加成功','admin/Music/classify',3);
			}else{
				$this->error('添加失败');
			}
		}


	}

	/*分类删除*/
	public function classify_del(){
		$id = $this->request->param('id');
		if($id){
			$result=Db::name("user_music_classify")->where("id={$id}")->update(array("isdel"=>1));				
			if($result){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}			
		}else{				
			$this->error('数据传入失败！');
		}
	}

	/*分类取消删除*/
	public function classify_canceldel(){

		$id = $this->request->param('id');
		if($id){
			$result=Db::name("user_music_classify")->where("id={$id}")->update(array("isdel"=>0));				
			if($result){
				$this->success('取消成功');
			}else{
				$this->error('取消失败');
			}			
		}else{				
			$this->error('数据传入失败！');
		}
	}

	/*分类编辑*/
	public function classify_edit(){
	
		
		$id = $this->request->param('id');
		if($id){
			$info=Db::name("user_music_classify")->where("id={$id}")->find();

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
			$url=$data['img_url'];
			$orderno=$data["orderno"];

			if(!trim($title)){
				$this->error('分类标题不能为空');
			}
			
			if($url==""){
				$this->error("请上传分类图标");
			}


			if(!is_numeric($orderno)){
				$this->error("排序号请填写数字");
			}

			if($orderno<0){
				$this->error("排序号必须大于0");
			}
		
			$isexit=Db::name("user_music_classify")
				->where("id!={$id} and title='{$title}'")
				->find();
			if($isexit){
				$this->error('该分类已存在');
			}

			
			$result=Db::name("user_music_classify")
				->update($data);
				
			
			if($result!==false){
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}

	}
	
	//分类排序
    public function classify_listorders(){
		$ids = $this->request->param('listorders');
        foreach ($ids as $key => $r) {
            $data['orderno'] = $r;
            Db::name("user_music_classify")->where(array('id' => $key))->update($data);
        }
				
        $status = true;
        if ($status) {
            $this->success("排序更新成功！");
        } else {
            $this->error("排序更新失败！");
        }
    }


	/*背景音乐*/
    public function index(){


		$lists = Db::name('user_music')
            ->where(function (Query $query) {

                $data = $this->request->param();
				$classify_id=isset($data['classify_id']) ? $data['classify_id']: '';
				if (!empty($classify_id)) {
                    $query->where('classify_id', $classify_id);
                }
				$upload_type=isset($data['upload_type']) ? $data['upload_type']: '';
				if (!empty($upload_type)) {
                    $query->where('upload_type', $upload_type);
                }
  				$keyword=isset($data['keyword']) ? $data['keyword']: '';
                if (!empty($keyword)) {
                    $query->where('title', 'like', "%$keyword%");
                }

            })
            ->order("use_nums DESC")
            ->paginate(20);

		$lists->each(function($v,$k){
			$v['img_url']=get_upload_path($v['img_url']);
            $v['file_url']=get_upload_path($v['file_url']);
			$classify_title=Db::name("user_music_classify")->where("id={$v['classify_id']}")->find();
			
			$v['classify_title']=$classify_title['title'];
			$userinfo=Db::name("user")
				->field("user_nicename")
				->where("id='$v[uploader]'")
				->find();
			if(!$userinfo){
				$userinfo=['user_nicename'=>'用户不存在'];
			}
			$v['uploader_nicename']=$userinfo['user_nicename'];

			return $v;
			
		});
			
		
		//分页-->筛选条件参数
		$data = $this->request->param();
		$lists->appends($data);	
			
        // 获取分页显示
        $page = $lists->render();
		
		//分类列表
		$classify=Db::name("user_music_classify")
			->order("orderno")
			->select();

    	$this->assign('lists', $lists);
    	$this->assign('classify', $classify);
    	$this->assign("page", $page);
    	
    	return $this->fetch();
    }

    /*背景音乐添加*/
    public function music_add(){
		
    	$classify=Db::name("user_music_classify")
			->order("orderno")
			->select();
			
    	$this->assign('classify', $classify);
		
    	return $this->fetch();
    }

    /*背景音乐添加保存*/
    public function music_add_post(){
    	if($this->request->isPost()) {
			
			$data = $this->request->param();
			
   
			$data['addtime']=time();
			$data['upload_type']=1;
			$data['uploader']=get_current_admin_id(); //当前管理员id
			
			
			$img_url=$data['img_url'];
			$title=$data['title'];
			$author=$data['author'];
			$length=$data['length'];
			$use_nums=$data['use_nums'];

			if($title==""){
				$this->error("请填写音乐名称");
			}

			// 判断该音乐是否存在
			$isexist=Db::name("user_music")
				->where(["title"=>$title])
				->find();

			if($isexist){
				$this->error("该音乐已经存在");
			}

			if($author==""){
				$this->error("请填写演唱者");
			}

			if($img_url==""){
				$this->error("请上传音乐封面");
			}

			if($length==""){
				$this->error("请填写音乐时长");
			}

			if(!strpos($length,":")){
				$this->error("请按照格式填写音乐时长");
			}

			if(!is_numeric($use_nums)||$use_nums<0){
				$this->error("使用次数请写正整数");
			}

			$files["file"]=$_FILES["file"];
            $type='mp3';

            $uploadSetting = cmf_get_upload_setting();
            $extensions=$uploadSetting['file_types']['audio']['extensions'];
            $allow=explode(",",$extensions);

            if (!get_file_suffix($files['file']['name'],$allow)){
                $this->error("请上传正确格式的音频文件或检查上传设置中音频设置的文件类型");
            }
            
            $rs=adminUploadFiles($files,$type);
            if($rs['code']!=0){
                $this->error($rs['msg']);
            }


			$data['file_url']=$rs['filepath'];
			
			unset($data['file']);

			$result=Db::name("user_music")->insert($data);

			if($result){
				$this->success('添加成功','admin/music/music_add',3);
			}else{
				$this->error('添加失败');
			}

    	}

    }



    /*音乐试听*/
    public function music_listen(){
		
		$id = $this->request->param('id');
    	if(!$id||$id==""||!is_numeric($id)){
    		$this->error("加载失败");
    	}else{
    		//获取音乐信息
    		$info=Db::name("user_music")->where("id={$id}")->find();
    		$this->assign("info",$info);
    	}

    	return $this->fetch();
    }

    /*音乐删除*/
    public function music_del(){
    	$id = $this->request->param('id');
    	if(!$id||$id==""||!is_numeric($id)){
    		$this->error("操作失败");
    	}else{
    		$count=Db::name("user_video")->where("music_id={$id}")->count();
    		if($count>0){
    			$result=Db::name("user_music")->where("id={$id}")->update(array("isdel"=>1));
    		}else{
    			$result=Db::name("user_music")->where("id={$id}")->delete();
    		}				
			if($result){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
    	}
    }


    /*取消删除*/
    public function music_canceldel(){
    	$id = $this->request->param('id');
    	if(!$id||$id==""||!is_numeric($id)){
    		$this->error("操作失败");
    	}else{
    		$result=Db::name("user_music")->where("id={$id}")->update(array("isdel"=>0));				
			if($result){
				$this->success('取消成功');
			}else{
				$this->error('取消失败');
			}
    	}
    }

    /*音乐编辑*/
    public function music_edit(){

    	$id = $this->request->param('id');
		
    	if($id==""){
    		$this->error("操作失败");
    	}else{

    		$music=Db::name("user_music");
    		$info=$music->where("id={$id}")->find();
    		$this->assign("info",$info);

    		$classify=Db::name("user_music_classify")->order("orderno")->select();
    		$this->assign("classify",$classify);
    	}
    	return $this->fetch();
    }


    public function music_edit_post(){

    	if($this->request->isPost()) {
			
			$data = $this->request->param();

    		$music=Db::name("user_music");
			$data['updatetime']=time();
			
			

			$id=$data['id'];
			$img_url=$data['img_url'];
			$title=$data['title'];
			$author=$data['author'];
			$length=$data['length'];
			$use_nums=$data['use_nums'];
	

			if($title==""){
				$this->error("请填写音乐名称");
			}

			//判断该音乐是否存在
			$isexist=Db::name("user_music")
				->where([['title','=',$title],['id','<>',$id]])
				->find();

			if($isexist){
				$this->error("该音乐已经存在");
			}

			if($author==""){
				$this->error("请填写演唱者");
			}

			if($img_url==""){
				$this->error("请上传音乐封面");
			}

			if($length==""){
				$this->error("请填写音乐时长");
			}

			if(!strpos($length,":")){
				$this->error("请按照格式填写音乐时长");
			}

			if(!is_numeric($use_nums)||$use_nums<0){
				$this->error("使用次数请写正整数");
			}


			if($_FILES){
                $files["file"]=$_FILES["file"];
				$type='mp3';

				$uploadSetting = cmf_get_upload_setting();
	            $extensions=$uploadSetting['file_types']['audio']['extensions'];
	            $allow=explode(",",$extensions);

	            if (!get_file_suffix($files['file']['name'],$allow)){
	                $this->error("请上传正确格式的音频文件或检查上传设置中音频设置的文件类型");
	            }

				$rs=adminUploadFiles($files,$type);
                if($rs['code']!=0){
                    $this->error($rs['msg']);
                }
                $data['file_url']=$rs['filepath'];
				
			}

			unset($data['file']);
			
			$result=$music->update($data);

			if($result!==false){
				  $this->success('修改成功');
			 }else{
				  $this->error('修改失败');
			 }

    	}

    }


	

}
