<?php

/**
 * vip充值记录
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class VipchargeController extends AdminbaseController {
    protected function getStatus($k=''){
        $status=array(
            '0'=>'未支付',
            '1'=>'已完成',
        );
        if($k===''){
            return $status;
        }
        
        return isset($status[$k]) ? $status[$k]: '';
    }
    
    protected function getTypes($k=''){
        $type=array(
            '1'=>'支付宝',
            '2'=>'微信',
            '3'=>'苹果支付',
            '4'=>'余额',
            '5'=>'微信小程序',
            '6'=>'paypal',
            '7'=>'braintree_paypal',
        );
        if($k===''){
            return $type;
        }
        
        return isset($type[$k]) ? $type[$k]: '';
    }
    
    protected function getAmbient($k=''){
        $ambient=array(
            "1"=>array(
                '0'=>'App',
                '1'=>'PC',
            ),
            "2"=>array(
                '0'=>'App',
                '1'=>'公众号',
                '2'=>'PC',
            ),
            "3"=>array(
                '0'=>'沙盒',
                '1'=>'生产',
            ),
            "4"=>array(
                '0'=>'App',
                '1'=>'PC',
            ),
            "5"=>array(
                '0'=>'沙盒',
                '1'=>'生产',
            ),
            "6"=>array(
                '0'=>'沙盒',
                '1'=>'生产',
            ),
            "7"=>array(
                '0'=>'沙盒',
                '1'=>'生产',
            ),
        );
        
        if($k===''){
            return $ambient;
        }
        
        return isset($ambient[$k]) ? $ambient[$k]: '';
    }
    
    function index(){
        $data = $this->request->param();
        $map=[];
        
        $start_time=isset($data['start_time']) ? $data['start_time']: '';
        $end_time=isset($data['end_time']) ? $data['end_time']: '';
        
        if($start_time!=""){
           $map[]=['addtime','>=',strtotime($start_time)];
        }

        if($end_time!=""){
           $map[]=['addtime','<=',strtotime($end_time) + 60*60*24];
        }
        
        $status=isset($data['status']) ? $data['status']: '';
        if($status!=''){
            $map[]=['status','=',$status];
        }
        
        $uid=isset($data['uid']) ? $data['uid']: '';
        if($uid!=''){
            
            $map[]=['uid','=',$uid];
            
        }
        
        $keyword=isset($data['keyword']) ? $data['keyword']: '';
        if($keyword!=''){
            $map[]=['orderno|trade_no','like','%'.$keyword.'%'];
        }
        
        
        $lists = Db::name("user_vip_charge")
            ->where($map)
			->order("id desc")
			->paginate(20);
        
        $lists->each(function($v,$k){
			$v['userinfo']=getUserInfo($v['uid']);
            return $v;           
        });
        
        $lists->appends($data);
        $page = $lists->render();

    	$this->assign('lists', $lists);

    	$this->assign("page", $page);
        
        $this->assign('status', $this->getStatus());
        $this->assign('type', $this->getTypes());
        $this->assign('ambient', $this->getAmbient());
    	
        $moneysum = Db::name("user_vip_charge")
            ->where($map)
			->sum('money');
        if(!$moneysum){
            $moneysum=0;
        }

    	$this->assign('moneysum', $moneysum);

        $configpub=getConfigPub();
        $this->assign('name_coin', $configpub['name_coin']);
        
    	return $this->fetch();
    }
    
    function setPay(){
        $id = $this->request->param('id', 0, 'intval');
        if($id){
            $result=Db::name("user_vip_charge")->where(["id"=>$id,"status"=>0])->find();				
            if($result){

                $now=time();
                
                /* 更新会员vip到期时间 */
                $vipinfo=getUserVipInfo($result['touid']);
                $days=$result['days']*24*60*60;

                if($vipinfo['isvip']==0){ //用户不是vip

                    $endtime=$now+$days;

                }else{

                    $endtime=Db::name("user")->where("id='{$result['touid']}'")->value("vip_endtime");
                    $endtime=$endtime+$days;

                }

                Db::name("user")->where("id='{$result['touid']}'")->update(array("vip_endtime"=>$endtime));

                /* 更新 订单状态 */
                Db::name("user_vip_charge")->where("id='{$result['id']}'")->update(array("status"=>1));

                $this->success('操作成功');
             }else{
                $this->error('数据传入失败！');
             }			
        }else{				
            $this->error('数据传入失败！');
        }								          
    }
    
    
    function del(){
        $id = $this->request->param('id', 0, 'intval');
        
        $rs = Db::name('user_vip_charge')->where("id={$id}")->delete();
        if(!$rs){
            $this->error("删除失败！");
        }
                    
        $this->success("删除成功！");
        							  			
    }

    function export(){
    
        $data = $this->request->param();
        $map=[];
        
        $start_time=isset($data['start_time']) ? $data['start_time']: '';
        $end_time=isset($data['end_time']) ? $data['end_time']: '';
        
        if($start_time!=""){
           $map[]=['addtime','>=',strtotime($start_time)];
        }

        if($end_time!=""){
           $map[]=['addtime','<=',strtotime($end_time) + 60*60*24];
        }
        
        $status=isset($data['status']) ? $data['status']: '';
        if($status!=''){
            $map[]=['status','=',$status];
        }
        
        $keyword=isset($data['keyword']) ? $data['keyword']: '';
        if($keyword!=''){
            $map[]=['uid|orderno|trade_no','like','%'.$keyword.'%'];
        }
        
        
        $xlsName  = "VIP充值记录";

        $xlsData=Db::name("user_vip_charge")
            ->field('id,uid,money,days,orderno,type,trade_no,status,addtime,coin,ambient')
            ->where($map)
            ->order('addtime desc')
			->select()
            ->toArray();
        foreach ($xlsData as $k => $v){

            $userinfo=getUserInfo($v['uid']);
            $xlsData[$k]['user_nicename']= $userinfo['user_nicename']."(".$v['uid'].")";
            $xlsData[$k]['addtime']=date("Y-m-d H:i:s",$v['addtime']); 
            $xlsData[$k]['type']=$this->getTypes($v['type']);
            $xlsData[$k]['status']=$this->getStatus($v['status']);
            $ambient=$this->getAmbient($v['type']);
            $xlsData[$k]['ambient']=$ambient[$v['ambient']];
        }

        
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K');
        $xlsCell  = array(
            array('id','序号'),
            array('user_nicename','会员'),
            array('money','人民币金额'),
            array('coin','消费钻石数'),
            array('days','充值vip天数'),
            array('orderno','商户订单号'),
            array('type','支付类型'),
            array('ambient','支付环境'),
            array('trade_no','第三方支付订单号'),
            array('status','订单状态'),
            array('addtime','提交时间')
        );
        exportExcel($xlsName,$xlsCell,$xlsData,$cellName);
    }

}
