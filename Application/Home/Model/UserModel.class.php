<?php

/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/2
 * Time: 下午7:54
 */
namespace Home\Model;
use Think\Model;
use Home\Config\MessageInfo;
class UserModel extends Model
{
    protected $tablePrefix = '';

    // 定义自动完成


    public function add(){
        $User = M('User');
// 根据表单提交的POST数据创建数据对象
         $User->create();
        $result1 =   $User->add();
        if($result1 == true){
            $tem = new MessageInfo(true,null,'登录成功');
            return $tem;
        }else{
            $tem = new MessageInfo(false,null,$User->getError());
            return $tem;
        }

    }

    public function login(){
        $User = M('User');
// 根据表单提交的POST数据创建数据对象
        $data = I('post.');
        $result = $User->where('username="'.$data['userName'].'"'.'AND password="'.$data['password'].'"')->find();
        if($result != null){
            $findUser = $User->data();
            session('user',$findUser);
            return new MessageInfo(true,$findUser,'登录成功');
        }else if ($result == null){
            return new MessageInfo(false,null,'账号不存在或密码错误,请重新输入!');
        }else{
            return new MessageInfo(false,null,'非法输入!');
        }
    }
}