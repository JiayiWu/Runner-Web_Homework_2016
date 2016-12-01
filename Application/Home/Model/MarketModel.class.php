<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/12/1
 * Time: 下午3:38
 */

namespace Home\Model;


use Think\Model;
use Home\Config\MessageInfo;
class MarketModel extends  Model
{
 public function userScore(){
     $user = session('user');
     $userDB = M('user');
     return $userDB->where('id='.$user['id'])->find()['score'];
 }

 public function buy(){
     $user = session('user');
     $userDB = M('user');
     $usertem = $userDB->where('id='.$user['id'])->find();
     $goods = M('market');
     $needScore = $goods->where('id='.I("post.id"))->find()['score'];

     if ($usertem['score']<$needScore)
         return new MessageInfo(false,null,"积分不足,无法兑换");
     $usertem['score']-=$needScore;
     $userDB->where('id='.$user['id'])->save($usertem);
     return new MessageInfo(true,null,"兑换成功");
 }
}