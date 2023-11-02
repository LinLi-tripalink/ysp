<?php

class Domain_Home {

	public function search($uid,$key,$city,$p) {
        $rs = array();

        $model = new Model_Home();
        $rs = $model->search($uid,$key,$city,$p);;
				
        return $rs;
    }
	


    public function videoSearch($uid,$key,$lng,$lat,$city,$p){
        $rs = array();

        $model = new Model_Home();
        $rs = $model->videoSearch($uid,$key,$lng,$lat,$city,$p);
                
        return $rs;
    }

    public function getWeekShowLists(){
        $rs = array();

        $model = new Model_Home();
        $rs = $model->getWeekShowLists();
                
        return $rs;
    }
	
}
