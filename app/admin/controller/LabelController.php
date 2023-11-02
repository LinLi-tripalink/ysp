<?php

/**
 * 话题标签
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;


class LabelController extends AdminbaseController {

	//列表
    public function index(){

		$lists = Db::name('label')
            ->where(function (Query $query) {
                $data = $this->request->param();
                $keyword=isset($data['keyword']) ? $data['keyword']: '';
                if (!empty($keyword)) {
                    $query->where('name', 'like', "%$keyword%");
                }
            })
            ->order("orderno asc, id desc")
            ->paginate(20);

		$lists->each(function($v,$k){
			$v['img_url']=get_upload_path($v['img_url']);
			return $v;
		});

        // 获取分页显示
        $page = $lists->render();
		
    	$this->assign('lists', $lists);
    	$this->assign("page", $page);

    	return $this->fetch();
    }
	
	//删除
    public function del(){
        $id=$this->request->param('id');
        if($id){
            $result=Db::name('label')->delete($id);				
                if($result){
					
					//清除视频标签
					Db::name('user_video')->where("labelid={$id}")->update(['labelid'=>0]);
					$this->resetcache($id);
                    $this->success('删除成功');
                 }else{
                    $this->error('删除失败');
                 }			
        }else{				
            $this->error('数据传入失败！');
        }								  
        return $this->fetch();				
    }	
    //排序
    public function listsorders() { 

		$ids=$this->request->param('listsorders');
        foreach ($ids as $key => $r) {
            $data['orderno'] = $r;
            Db::name('label')->where(array('id' => $key))->update($data);
        }
				
        $status = true;
        if ($status) {
            $this->success("排序更新成功！");
        } else {
            $this->error("排序更新失败！");
        }
    }	
    
	
	//添加
    public function add(){ 
        return $this->fetch();				
    }
   
    public function add_post(){
        if($this->request->isPost()) {
			$data=$this->request->param();
			
            $name=$data['name'];
            if($name==''){
                $this->error('请填写名称');
            }
             
           
            $isexist=Db::name('label')
				->where("name='{$name}'")
				->find();
            if($isexist){
                $this->error('已存在相同名称');
            }
            
            if($data['thumb']==''){
                $this->error('请上传封面');
            }
             
            if($data['des']==''){
                $this->error('请填写描述');
            }

            $result=Db::name('label')->insert($data); 
            if($result){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }			
    }		
	
	
	//编辑
    public function edit(){
        $id=$this->request->param('id');
        if($id){
            $data=Db::name('label')->find($id);
            $this->assign('data', $data);						
        }else{				
            $this->error('数据传入失败！');
        }								  
        return $this->fetch();				
    }
    
    public function edit_post(){
		
		 if($this->request->isPost()) {
			$data=$this->request->param();	
            $name=$data['name'];
            if($name==''){
                $this->error('请填写名称');
            }
            
            $isexist=Db::name('label')
				->where("name='{$name}' and id!={$data['id']}")
				->find();
            if($isexist){
                $this->error('已存在相同名称');
            }
            
            if($data['thumb']==''){
                $this->error('请上传封面');
            }
             
            if($data['des']==''){
                $this->error('请填写描述');
            }

            $result=Db::name('label')->update($data); 
            if($result){
				
				$this->resetcache($data['id']);
				
                $this->success('修改成功');
            }else{
                $this->error('修改失败');
            }
        }			
			
    }
	
	
	/*更新缓存*/
	public function resetcache($labelid){
        $key='LabelInfo_'.$labelid;
        $rs=Db::name('label')
            ->field("id,name,des,thumb")
            ->where("id={$labelid}")
            ->find();

        if($rs){
            setcaches($key,$rs);
        }   
        return 1;
    }
        

}
