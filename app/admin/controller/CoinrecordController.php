<?php

/**
 * 收入记录
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class CoinrecordController extends AdminbaseController {
    

	protected function getType($k=''){
        $type=array(
            'income'=>'收入',
            'expend'=>'支出'
        );
        if($k===''){
            return $type;
        }

        return isset($type[$k]) ? $type[$k] : '';
    }

    protected function getAction($k=''){
        $action=array(
            'sendgift'=>'直播间赠送礼物',
            'buyvip'=>'余额购买VIP',
            'video_sendgift'=>'视频赠送礼物',
            'pop_refund'=>'上热门退还',
            'uppop'=>'上热门',
            'watchvideo'=>'观看视频',
            'yurntable_game'=>'转盘游戏',
            'turntable_wins'=>'转盘中奖',
            'open_guard'=>'开通守护',
            'daily_tasks'=>'每日任务',
            'reg_reward'=>'注册奖励',
            'backpack_sendgift'=>'直播间送背包礼物',
            'signin_reward'=>'签到奖励',
            'shop_deposit'=>'店铺保证金'
        );
        if($k===''){
            return $action;
        }

        return isset($action[$k]) ? $action[$k] : '';
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
        
        
        $uid=isset($data['uid']) ? $data['uid']: '';
        if($uid!=''){
            $map[]=['uid','=',$uid];
        }

        $touid=isset($data['touid']) ? $data['touid']: '';
        if($touid!=''){
            $map[]=['touid','=',$touid];
        }

        $actions=isset($data['actions']) ? $data['actions']: '';
        if($actions!=''){
            $map[]=['action','=',$actions];
        }

        $type=isset($data['type']) ? $data['type']: '';
        if($type!=''){
            $map[]=['type','=',$type];
        }
        
        $lists = Db::name("user_coinrecord")
            ->where($map)
			->order("addtime desc")
			->paginate(20);
        
        $lists->each(function($v,$k){
			$v['userinfo']=getUserInfo($v['uid']);
            $touserinfo=getUserInfo($v['touid']);
            if($v['touid']==0){
            	$touserinfo['user_nicename']='平台';
            }
            $v['touserinfo']=$touserinfo;

            $action=$v['action'];
            if($action=='sendgift'){
            	$giftinfo=Db::name("gift")->field("giftname")->where("id='$v[giftid]'")->find();
            	$v['giftinfo']=$giftinfo;
            }else if($action=='backpack_sendgift'){
                $giftinfo=Db::name("gift")->field("giftname")->where("id='$v[giftid]'")->find();
                $v['giftinfo']=$giftinfo;
            }else if($action=='video_sendgift'){
                $giftinfo=Db::name("gift")->field("giftname")->where("id='$v[giftid]'")->find();
				$v['giftinfo']= $giftinfo;
            }else if($action=='buyvip'){
            	$giftinfo['giftname']='余额购买vip';
				$v['giftinfo']= $giftinfo;
            }else if($action=='uppop'){
				$giftinfo['giftname']='上热门';
				$v['giftinfo']= $giftinfo;
			}else if($action=='pop_refund'){
				$giftinfo['giftname']='上热门退还';
				$v['giftinfo']= $giftinfo;
			}else if($action=='watchvideo'){
				$giftinfo['giftname']='观看视频';
				$v['giftinfo']= $giftinfo;
			}else if($action=='signin_reward'){
                $giftinfo['giftname']='签到奖励';
                $v['giftinfo']= $giftinfo;
            }else if($action=='shop_deposit'){
                $giftinfo['giftname']='店铺保证金';
                $v['giftinfo']= $giftinfo;
            }else{
				$giftinfo['giftname']='未知';
				$v['giftinfo']= $giftinfo;
			}

            return $v;           
        });
        
        $lists->appends($data);
        $page = $lists->render();

    	$this->assign('lists', $lists);

    	$this->assign("page", $page);

        $configpub=getConfigPub();
        $this->assign('name_coin',$configpub['name_coin']?$configpub['name_coin']:'');
        $this->assign("actions",$this->getAction());
        $this->assign("type",$this->getType());
    	return $this->fetch();
    }
	
	
	
	//钻石消费记录
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
        
        
        $uid=isset($data['uid']) ? $data['uid']: '';
        if($uid!=''){
            $map[]=['uid','=',$uid];
        }

        $touid=isset($data['touid']) ? $data['touid']: '';
        if($touid!=''){
            $map[]=['touid','=',$touid];
        }

        $actions=isset($data['actions']) ? $data['actions']: '';
        if($actions!=''){
            $map[]=['action','=',$actions];
        }

        $type=isset($data['type']) ? $data['type']: '';
        if($type!=''){
            $map[]=['type','=',$type];
        }
        
        
        
        
        $xlsName  = "钻石消费记录";
		$lists = Db::name("user_coinrecord")
            ->where($map)
			->order("id desc")
			->select()
            ->toArray();
        
      
		foreach($lists as $k=>$v){
			$userinfo=getUserInfo($v['uid']);
			$v['user_nicename']= $userinfo['user_nicename']."(".$v['uid'].")";
			

            $touserinfo=getUserInfo($v['touid']);
            if($v['touid']==0){
            	$v['touser_nicename']='平台';
            }else{
				$touserinfo=getUserInfo($v['touid']);
				$v['touser_nicename']= $touserinfo['user_nicename']."(".$v['touid'].")";
			}
     

            $action=$v['action'];
            if($action=='sendgift'){
            	$giftinfo=Db::name("gift")->field("giftname")->where("id='$v[giftid]'")->find();
            	$v['giftinfo']=$giftinfo;
            }else if($action=='sendgift'){
                $giftinfo=Db::name("gift")->field("giftname")->where("id='$v[giftid]'")->find();
                $v['giftinfo']=$giftinfo;
            }else if($action=='video_sendgift'){
                $giftinfo=Db::name("gift")->field("giftname")->where("id='$v[giftid]'")->find();
				$v['giftinfo']= $giftinfo;
            }else if($action=='buyvip'){
            	$giftinfo['giftname']='余额购买vip';
				$v['giftinfo']= $giftinfo;
            }else if($action=='uppop'){
				$giftinfo['giftname']='上热门';
				$v['giftinfo']= $giftinfo;
			}else if($action=='pop_refund'){
				$giftinfo['giftname']='上热门退还';
				$v['giftinfo']= $giftinfo;
			}else if($action=='watchvideo'){
				$giftinfo['giftname']='观看视频';
				$v['giftinfo']= $giftinfo;
			}else if($action=='signin_reward'){
                $giftinfo['giftname']='签到奖励';
                $v['giftinfo']= $giftinfo;
            }else if($action=='shop_deposit'){
                $giftinfo['giftname']='店铺保证金';
                $v['giftinfo']= $giftinfo;
            }else{
				$giftinfo['giftname']='未知';
				$v['giftinfo']= $giftinfo;
			}

    
            $v['giftname']= $giftinfo['giftname']."(".$v['giftid'].")";
           
            $v['type']= $this->getType($v['type']);
            $v['action']= $this->getAction($v['action']);
			$v['addtime']=date("Y-m-d H:i:s",$v['addtime']); 
             
            $lists[$k]=$v;     

		}

        
        $cellName = array('A','B','C','D','E','F','G','H','I','J');
        $xlsCell  = array(
            array('id','序号'),
            array('type','收支类型'),
            array('action','收支行为'),
            array('user_nicename','会员 (ID)'),
            array('touser_nicename','主播 (ID)'),
            array('giftname','行为说明 (ID)'),
            array('giftcount','数量'),
            array('totalcoin','总价'),
            array('showid','直播id'),
            array('addtime','时间')
        );
        exportExcel($xlsName,$xlsCell,$lists,$cellName);
    }
     


}
