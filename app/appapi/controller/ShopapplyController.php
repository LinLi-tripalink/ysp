<?php

namespace app\appapi\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class ShopapplyController extends HomeBaseController {

  protected function getStatus($k=''){
    $status=array(
        '0'=>'待处理',
        '1'=>'审核成功',
        '2'=>'审核失败',
    );
    if($k==''){
        return $status;
    }
    return isset($status[$k])?$status[$k]:'';
}
    
    function index(){
    	$data = $this->request->param();
        $map=[];

        $map[]=['uid','<>',1];
        
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

    	$lists = Db::name("shop_apply")
                ->where($map)
                ->order("addtime DESC")
                ->paginate(20);
                
        $lists->each(function($v,$k){
			//$v['thumb']=get_upload_path($v['thumb']);
            $v['userinfo']= getUserInfo($v['uid']);
            $v['tel']= m_s($v['uid']);
            $v['cardno']=m_s($v['cardno']);
            $v['phone']=m_s($v['phone']);
            $v['classname']='';

            //获取商家经营类目
            $class_list=Db::name("seller_goods_class")->where("uid={$v['uid']}")->select()->toArray();
            $num=count($class_list);
            foreach ($class_list as $k1 => $v1) {
                $gc_name=Db::name("shop_goods_class")->where("gc_id={$v1['goods_classid']}")->value('gc_name');
                
                $v['classname'].=$gc_name;
                if($num>1&&$k1<($num-1)){
                    $v['classname'].=' | ';
                }
                
            }

           
            return $v;           
        });
                
        $lists->appends($data);
        $page = $lists->render();

        //判断平台店铺是否申请
        $platform_apply=1;
        $platform_info=Db::name("shop_apply")->where("uid=1")->find();
        if(!$platform_info){
        	$platform_apply=0;
        }

    	$this->assign('lists', $lists);

    	$this->assign("page", $page);
        
    	$this->assign("status", $this->getStatus());
    	$this->assign("platform_apply", $platform_apply);
    	
    	return $this->fetch();
    }

}
