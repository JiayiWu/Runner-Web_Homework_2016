<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/2
 * Time: 下午12:00
 */

namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel as um;

class UserController extends Controller
{

    public function userAdd(){
        $um = new um();
        $result = $um->add();
        $this->ajaxReturn($result,"JSON");

    }

    public function login(){
        $um = new um();
        $result = $um->login();
        $this->ajaxReturn($result,"JSON");

    }

    public function userBasicInfo(){
        $um = new um();
        $this->ajaxReturn($um->basicInfo(),"JSON");
    }



}