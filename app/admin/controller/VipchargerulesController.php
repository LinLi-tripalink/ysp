<?php

/**
 * vip充值规则
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;


class VipchargerulesController extends AdminbaseController {

	//列表
    public function index(){
		$lists=Db::name("vip_charge_rules")
            ->where(function (Query $query) {
                

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

	/*添加*/
	public function add(){
		$configPub=getConfigPub();
    	$this->assign("name_coin",$configPub['name_coin']);
		return $this->fetch();
	}


	/*添加提交*/
	public function add_post(){

		if($this->request->isPost()) {
			
			$data = $this->request->param();
			
			$name=trim($data['name']);
			$days=$data['days'];
			$orderno=$data['orderno'];

			if($name==""){
				$this->error("请填写充值规则名称");
			}


			if(!is_numeric($days)){
				$this->error("vip天数请填写数字");
			}

			if($days<0){
				$this->error("vip天数必须大于0");
			}

			if(!is_numeric($orderno)){
				$this->error("排序规则请填写数字");
			}

			if($orderno<0){
				$this->error("排序规则必须大于0");
			}
			
			
			$isexit=Db::name("vip_charge_rules")
				->where("name='{$name}' or days='{$days}'")
				->find();	
			if($isexit){
				$this->error('vip充值规则已经存在');
			}
			
			$data['name']=$name;
			$data['addtime']=time();
			
			$result=Db::name("vip_charge_rules")->insert($data);

			if($result){
				$this->resetcache();
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
		}

	}


    /*删除*/
	public function del(){

		$id = $this->request->param('id');
		if($id){
			$result=Db::name("vip_charge_rules")
				->where("id={$id}")
				->delete();

			if($result){
				$this->resetcache();
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
			$info=Db::name("vip_charge_rules")
				->where("id={$id}")
				->find();
			$configPub=getConfigPub();
    		$this->assign("name_coin",$configPub['name_coin']);
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
			$name=$data["name"];
			$orderno=$data["orderno"];
			$days=$data["days"];

			if(!trim($name)){
				$this->error('分类标题不能为空');
			}

			if(!is_numeric($orderno)){
				$this->error("排序号请填写数字");
			}

			if($orderno<0){
				$this->error("排序号必须大于0");
			}

			if(!is_numeric($days)){
				$this->error("充值天数请填写数字");
			}

			if($days<0){
				$this->error("充值天数必须大于0");
			}
		
			$isexit=Db::name("vip_charge_rules")
				->where("id!={$id} and (name='{$name}' or days='{$days}')")
				->find();
			if($isexit){
				$this->error('vip充值规则已经存在');
			}
			
			$result=Db::name("vip_charge_rules")
				->update($data);
				
			
			if($result!==false){
				$this->resetcache();
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}

	}


	public function listorderset(){
		$ids=$this->request->param('listorders');

        foreach ($ids as $key => $r) {
            $data['orderno'] = $r;
            Db::name("vip_charge_rules")->where(array('id' => $key))->update($data);
        }
                
        $status = true;
        if ($status) {

            $this->resetcache();
            $this->success("排序更新成功！");
        } else {
            $this->error("排序更新失败！");
        }
	}

	public function resetcache(){
		$key='getVipChargeRules';
        $rules= Db::name("vip_charge_rules")
            ->field('id,name,money,days,coin')
            ->order('orderno asc')
            ->select();
        setcaches($key,$rules);
        return 1;
	}
	

}
