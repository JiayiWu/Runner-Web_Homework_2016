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
use Home\Model\FriendsModel as fm;
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

    public function friendList(){
        $fm = new fm();
        $this->ajaxReturn($fm->friendList(),"JSON");
    }

    public function friendFansList(){
        $fm = new fm();
        $this->ajaxReturn($fm->friendFansList(),"JSON");
    }

    public function friendFocus(){
        $fm = new fm();
        $this->ajaxReturn($fm->friendFocus(),"JSON");
    }

    public function friendCancle(){
        $fm = new fm();
        $this->ajaxReturn($fm->friendCancle(),"JSON");
    }

    public function friendSearch(){
        $fm = new fm();
        $this->ajaxReturn($fm->friendSearch(),"JSON");
    }

    public function recommendFriend(){
        $fm = new fm();
        $this->ajaxReturn($fm->recommendFriend(),"JSON");
    }


}