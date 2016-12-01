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

    public function basicInfoHome(){
        $um = new um();


        $this->ajaxReturn($um->basicInfoHome(),"JSON");
    }

    public function messageReceive(){
        $um = new um();


        $this->ajaxReturn($um->userMessageReceiver(),"JSON");
    }

    public function modifyBasicinfo(){
        $um = new um();


        $this->ajaxReturn($um->modifyBasicinfo(),"JSON");
    }

    public function modifyPassword(){
        $um = new um();


        $this->ajaxReturn($um->modifyPassword(),"JSON");
    }

    public function sportinfo(){
        $um = new um();


        $this->ajaxReturn($um->sport_info(),"JSON");
    }

    public function logout(){
        $um = new um();


        $this->ajaxReturn($um->logout(),"JSON");
    }

}