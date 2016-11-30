<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/30
 * Time: 下午3:16
 */

namespace Home\Controller;


use Think\Controller;
use Home\Model\RaceModel as rm;

class RaceController extends Controller
{
        public function raceCreate(){
            $rm = new rm();
            $this->ajaxReturn($rm->raceCreate(),"JSON");
        }

    public function raceModify(){
        $rm = new rm();
        $this->ajaxReturn($rm->raceModify(),"JSON");
    }

    public function raceDelete(){
        $rm = new rm();
        $this->ajaxReturn($rm->raceDelete(),"JSON");
    }

    public function raceJoin(){
        $rm = new rm();
        $this->ajaxReturn($rm->raceJoin(),"JSON");
    }

    public function raceResult(){
        $rm = new rm();
        $this->ajaxReturn($rm->raceResult(),"JSON");
    }

    public function raceList(){
        $rm = new rm();
        $this->ajaxReturn($rm->raceList(),"JSON");
    }
}