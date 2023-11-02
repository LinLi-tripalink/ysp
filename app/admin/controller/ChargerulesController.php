<?php

/**
 * 钻石充值记录
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;


class ChargerulesController extends AdminbaseController {

	//列表
    public function index(){

		$lists=Db::name("charge_rules")
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
			$configpub=getConfigPub();

			$name=trim($data['name']);
			$money=$data['money'];
			$orderno=$data['orderno'];
			$coin=$data['coin'];
			$coin_ios=$data['coin_ios'];
			$product_id=$data['product_id'];
			$give=$data['give'];
			$coin_paypal=$data['coin_paypal'];

			if($name==""){
				$this->error("请填写充值规则名称");
			}

			if(!$money){
                $this->error("请填写价格");
            }

            if(!is_numeric($money)){
                $this->error("价格必须为数字");
            }

            if($money<=0||$money>99999999){
                $this->error("价格在0.01-99999999之间");
            }

            $data['money']=round($money,2);


			if(!is_numeric($orderno)){
				$this->error("排序号请填写数字");
			}

			if($orderno<0){
				$this->error("排序号必须大于0");
			}
			
			if(!$coin){
                $this->error("请填写".$configpub['name_coin']);
            }

            if(!is_numeric($coin)){
                $this->error($configpub['name_coin']."必须为数字");
            }

            if($coin<1||$coin>99999999){
                $this->error($configpub['name_coin']."在1-99999999之间");
            }

            if(floor($coin)!=$coin){
                $this->error($configpub['name_coin']."必须为整数");
            }

            if(!$coin_ios){
                $this->error("请填写苹果支付".$configpub['name_coin']);
            }

            if(!is_numeric($coin_ios)){
                $this->error("苹果支付".$configpub['name_coin']."必须为数字");
            }

            if($coin_ios<1||$coin_ios>99999999){
                $this->error("苹果支付".$configpub['name_coin']."在1-99999999之间");
            }

            if(floor($coin_ios)!=$coin_ios){
                $this->error("苹果支付".$configpub['name_coin']."必须为整数");
            }

            if($product_id==''){
                $this->error("苹果项目ID不能为空");
            }

			if($give==''){
               $this->error("赠送".$configpub['name_coin']."不能为空"); 
            }

            if(!is_numeric($give)){
                $this->error("赠送".$configpub['name_coin']."必须为数字"); 
            }

            if($give<0||$give>99999999){
                $this->error("赠送".$configpub['name_coin']."在0-99999999之间"); 
            }

            if(floor($give)!=$give){
                $this->error("赠送".$configpub['name_coin']."必须为整数"); 
            }

            if($coin_paypal==''){
               $this->error("paypal支付".$configpub['name_coin']."不能为空");
            }

            if(!is_numeric($coin_paypal)){
                $this->error("paypal支付".$configpub['name_coin']."必须为数字");
            }

            if($coin_paypal<1||$coin_paypal>99999999){
                $this->error("paypal支付".$configpub['name_coin']."在1-99999999之间");
            }

            if(floor($coin_paypal)!=$coin_paypal){
                $this->error("paypal支付".$configpub['name_coin']."必须为整数");
            }
			
			$isexit=Db::name("charge_rules")
				->where("name='{$name}'")
				->find();	
			if($isexit){
				$this->error('该规则名称已存在');
			}
			
			$data['name']=$name;
			$data['addtime']=time();
			
			$result=Db::name("charge_rules")->insert($data);

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
			$result=Db::name("charge_rules")
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
			$info=Db::name("charge_rules")
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
			$configpub=getConfigPub();
			
			$id=$data["id"];
			$name=$data["name"];
			$money=$data['money'];
			$orderno=$data["orderno"];
			$coin=$data['coin'];
			$product_id=$data['product_id'];
			$give=$data['give'];
            $coin_paypal=$data['coin_paypal'];
            $coin_ios=$data['coin_ios'];

			if(!trim($name)){
				$this->error('分类标题不能为空');
			}

			$isexit=Db::name("charge_rules")
				->where("id!={$id} and name='{$name}'")
				->find();
			if($isexit){
				$this->error('该名称已存在');
			}

			if(!$money){
                $this->error("请填写价格");
            }

            if(!is_numeric($money)){
                $this->error("价格必须为数字");
            }

            if($money<=0||$money>99999999){
                $this->error("价格在0.01-99999999之间");
            }

            $data['money']=round($money,2);

			if(!is_numeric($orderno)){
				$this->error("排序号请填写数字");
			}

			if($orderno<0){
				$this->error("排序号必须大于0");
			}

			if(!$coin){
                $this->error("请填写".$configpub['name_coin']);
            }

            if(!is_numeric($coin)){
                $this->error($configpub['name_coin']."必须为数字");
            }

            if($coin<1||$coin>99999999){
                $this->error($configpub['name_coin']."在1-99999999之间");
            }

            if(floor($coin)!=$coin){
                $this->error($configpub['name_coin']."必须为整数");
            }

            if($product_id==''){
                $this->error("苹果项目ID不能为空");
            }

            if($give==''){
               $this->error("赠送".$configpub['name_coin']."不能为空"); 
            }

            if(!is_numeric($give)){
                $this->error("赠送".$configpub['name_coin']."必须为数字"); 
            }

            if($give<0||$give>99999999){
                $this->error("赠送".$configpub['name_coin']."在0-99999999之间"); 
            }

            if(floor($give)!=$give){
                $this->error("赠送".$configpub['name_coin']."必须为整数"); 
            }

            if(!$coin_ios){
                $this->error("请填写苹果支付".$configpub['name_coin']);
            }

            if(!is_numeric($coin_ios)){
                $this->error("苹果支付".$configpub['name_coin']."必须为数字");
            }

            if($coin_ios<1||$coin_ios>99999999){
                $this->error("苹果支付".$configpub['name_coin']."在1-99999999之间");
            }

            if(floor($coin_ios)!=$coin_ios){
                $this->error("苹果支付".$configpub['name_coin']."必须为整数");
            }

            if($coin_paypal==''){
               $this->error("paypal支付".$configpub['name_coin']."不能为空");
            }

            if(!is_numeric($coin_paypal)){
                $this->error("paypal支付".$configpub['name_coin']."必须为数字");
            }

            if($coin_paypal<1||$coin_paypal>99999999){
                $this->error("paypal支付".$configpub['name_coin']."在1-99999999之间");
            }

            if(floor($coin_paypal)!=$coin_paypal){
                $this->error("paypal支付".$configpub['name_coin']."必须为整数");
            }
		
			
			
			$result=Db::name("charge_rules")
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
            Db::name("charge_rules")->where(array('id' => $key))->update($data);
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
		$key='getChargeRules';
        $rules= Db::name("charge_rules")
            ->field('id,coin,coin_ios,money,product_id,give,coin_paypal')
            ->order('orderno asc')
            ->select();
        setcaches($key,$rules);
        return 1;
	}
	

}
