<?php

class Domain_User {

	public function getBaseInfo($userId) {
			$rs = array();

			$model = new Model_User();
			$rs = $model->getBaseInfo($userId);

			return $rs;
	}
	
	public function checkName($uid,$name) {
			$rs = array();

			$model = new Model_User();
			$rs = $model->checkName($uid,$name);

			return $rs;
	}
	
	public function userUpdate($uid,$fields) {
			$rs = array();

			$model = new Model_User();
			$rs = $model->userUpdate($uid,$fields);

			return $rs;
	}
	
	
	public function getChargeRules() {
			$rs = array();

			$model = new Model_User();
			$rs = $model->getChargeRules();

			return $rs;
	}

	
	public function setAttent($uid,$touid) {
			$rs = array();

			$model = new Model_User();
			$rs = $model->setAttent($uid,$touid);

			return $rs;
	}
	
	public function setBlack($uid,$touid) {
			$rs = array();

			$model = new Model_User();
			$rs = $model->setBlack($uid,$touid);

			return $rs;
	}
	
	public function getFollowsList($uid,$touid,$p,$key) {
			$rs = array();

			$model = new Model_User();
			$rs = $model->getFollowsList($uid,$touid,$p,$key);

			return $rs;
	}
	
	public function getFansList($uid,$touid,$p) {
			$rs = array();

			$model = new Model_User();
			$rs = $model->getFansList($uid,$touid,$p);

			return $rs;
	}

	public function getBlackList($uid,$touid,$p) {
			$rs = array();

			$model = new Model_User();
			$rs = $model->getBlackList($uid,$touid,$p);

			return $rs;
	}

	
	public function getUserHome($uid,$touid) {
		$rs = array();

		$model = new Model_User();
		$rs = $model->getUserHome($uid,$touid);
		return $rs;
	}			
	
	public function checkMobile($uid,$mobile) {
        $rs = array();
                
        $model = new Model_User();
        $rs = $model->checkMobile($uid,$mobile);

        return $rs;
    }

    public function getLikeVideos($uid,$touid,$p){
    	$rs = array();
                
        $model = new Model_User();
        $rs = $model->getLikeVideos($uid,$touid,$p);

        return $rs;
    }

    public function getCollectionVideos($uid,$touid,$p){
    	$rs = array();
                
        $model = new Model_User();
        $rs = $model->getCollectionVideos($uid,$touid,$p);

        return $rs;
    }

    public function getBalance($uid) {
    	
		$rs = array();

		$model = new Model_User();
		$rs = $model->getBalance($uid);

		return $rs;
	}

	public function getVipRules() {
		$rs = array();

		$model = new Model_User();
		$rs = $model->getVipRules();

		return $rs;
	}

	public function checkLiveVipStatus($uid) {
		$rs = array();

		$model = new Model_User();
		$rs = $model->checkLiveVipStatus($uid);

		return $rs;
	}
	
	public function seeDailyTasks($uid){
		$rs = array();

		$model = new Model_User();
		$rs = $model->seeDailyTasks($uid);

		return $rs;
	}

	public function receiveTaskReward($uid,$taskid){
		$rs = array();

		$model = new Model_User();
		$rs = $model->receiveTaskReward($uid,$taskid);

		return $rs;
	}

	public function setBeautyParams($uid,$params){
		$rs = array();

		$model = new Model_User();
		$rs = $model->setBeautyParams($uid,$params);

		return $rs;
	}

	public function getBeautyParams($uid){
		$rs = array();

		$model = new Model_User();
		$rs = $model->getBeautyParams($uid);

		return $rs;
	}
	
	//用户申请店铺余额提现
	public function setShopCash($data){
		$rs = array();

		$model = new Model_User();
		$rs = $model->setShopCash($data);

		return $rs;
	}
	//判断用户是否第一次关注对方
	public function isFirstAttent($uid,$touid){
		$rs = array();

		$model = new Model_User();
		$rs = $model->isFirstAttent($uid,$touid);

		return $rs;
	}

	public function BraintreeCallback($uid,$orderno,$ordertype,$nonce,$money){
		$rs = array();

		$model = new Model_User();
		$rs = $model->BraintreeCallback($uid,$orderno,$ordertype,$nonce,$money);

		return $rs;
	}

	public function LoginBonus($uid){
		$rs = array();
		$model = new Model_User();
		$rs = $model->LoginBonus($uid);
		return $rs;
	}

	public function getLoginBonus($uid){
		$rs = array();
		$model = new Model_User();
		$rs = $model->getLoginBonus($uid);
		return $rs;

	}

	public function setAdvertiser($data){
		$rs = array();
		$model = new Model_User();
		$rs = $model->setAdvertiser($data);
		return $rs;
	}

	public function getAdvertiserInfo($uid){
		$rs = array();
		$model = new Model_User();
		$rs = $model->getAdvertiserInfo($uid);
		return $rs;
	}

	public function isUserAdvertiser($uid){
		$rs = array();
		$model = new Model_User();
		$rs = $model->isUserAdvertiser($uid);
		return $rs;
	}

	public function updateBgImg($uid,$img){
		$rs = array();
		$model = new Model_User();
		$rs = $model->updateBgImg($uid,$img);
		return $rs;
	}
	
	
	public function checkTeenagers($uid){
		$rs = array();
		$model = new Model_User();
		$res = $model->checkTeenagers($uid);
		$time=time();
		
		$rs['ispwd']='0';
		$rs['isstate']='0';
		$rs['duration']='10'; //定时请求描述
		if($res){
			$rs['ispwd']='1';
			$rs['isstate']=$res['state'];
		}
		
		//是否可以使用
		$rs['useinfo']=$model->useTeenagers($uid); 

		
		$rs['prompt']="为呵护未成年人健康成长,特别推出青少年模式，该模式下部分功能无法正常使用。请监护人主动选择，并设置监护密码。";
		
		$rs['lists'][]=array('id'=>'1','name'=>'开启青少年模式,需先设置独立密码','thumb'=>get_upload_path("/static/app/teenagers/t1.png"));
		$rs['lists'][]=array('id'=>'2','name'=>'无法进行充值.打赏等操作','thumb'=>get_upload_path("/static/app/teenagers/t2.png"));
		$rs['lists'][]=array('id'=>'3','name'=>'自动开启时间锁，每天使用时长不超过40分钟，每日晚22时至次日午6时期间无法使用','thumb'=>get_upload_path("/static/app/teenagers/t3.png"));
		
		return $rs;
	}
	
	
	public function setTeenagers($uid,$type,$pwd,$newpwd='',$newspwd=''){
		$rs = array();
		$model = new Model_User();
		$rs = $model->setTeenagers($uid,$type,$pwd,$newpwd,$newspwd);
		return $rs;
	}
	
	public function reduceTeenagers($uid,$duration){
		$rs = array();
		$model = new Model_User();
		$rs = $model->reduceTeenagers($uid,$duration);
		return $rs;
	}

}
