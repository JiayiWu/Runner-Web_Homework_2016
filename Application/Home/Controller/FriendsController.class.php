<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/29
 * Time: 下午3:58
 */

namespace Home\Controller;


use Think\Controller;
use Home\Model\MomentsModel as mm;
class FriendsController extends Controller
{
    public function momentsList(){
        $mm = new mm();
        $this->ajaxReturn($mm->getMomenmts(),"JSON");
    }

    public function momentsAdd(){
        $mm = new mm();
        $this->ajaxReturn($mm->momentsAdd(),"JSON");
    }

    public function momentsDelete(){
        $mm = new mm();
        $this->ajaxReturn($mm->momentsDelete(),"JSON");
    }
}