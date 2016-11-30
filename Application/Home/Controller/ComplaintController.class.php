<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/30
 * Time: 下午9:54
 */

namespace Home\Controller;


use Think\Controller;
use Home\Model\ComplaintModel as cm;

class ComplaintController extends Controller
{
    public function complainGet(){
        $cm = new cm();
        $this->ajaxReturn( $cm->complainGet(),"JSON");

    }

    public function complainCreate(){
        $cm = new cm();
        $this->ajaxReturn( $cm->complainCreate(),"JSON");
    }

    public function complainDelete(){
        $cm = new cm();
        $this->ajaxReturn( $cm->complainDelete(),"JSON");
    }

    public function complaintIgonre(){
        $cm = new cm();
        $this->ajaxReturn( $cm->complaintIgonre(),"JSON");
    }

    public function complaintHistory(){
        $cm = new cm();
        $this->ajaxReturn( $cm->complaintHistory(),"JSON");
    }

    public function complaintRecover(){
        $cm = new cm();
        $this->ajaxReturn( $cm->complaintRecover(),"JSON");
    }
}