<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/29
 * Time: 下午2:47
 */

namespace Home\Model;


use Think\Model;
use Home\Config\MessageInfo;
class FriendsModel extends Model
{
    public function friendList(){
        $db = new Model();
        $user = session('user');
        $sql ="select u.id as id,u.nickname as nickname,u.slogan as slogan from (select * from friend_record where ownerid=".$user['id'].") fr join user u on fr.friendid = u.id ";

        $result = $db->query($sql);

        return new MessageInfo(true,$result,"1460:获取好友列表成功");
    }

    public function friendFansList(){
        $db = new Model();
        $user = session('user');
        $sql ="select u.id as id,u.nickname as nickname,u.slogan as slogan from (select * from friend_record where friendid=".$user['id'].") fr join user u on fr.ownerid = u.id ";
        $result = $db->query($sql);
        $var = $this->friendList();
        $obejct = $this->friendList()->object;

        for($i = 0;$i<count($result);$i++){

            $isFocusEachOther = false;

            for ($j = 0;$j<count($obejct);$j++){
                if($result[$i]['id'] == $obejct[$j]['id']){
                    $isFocusEachOther = true;
                    break;
                }
            }
            if( $isFocusEachOther)
                $result[$i]['focusEachOther'] = true;
            else
                $result[$i]['focusEachOther'] = false;



        }

        return new MessageInfo(true,$result,"1460:获取粉丝列表成功");
    }


    public function friendFocus(){
        $user = session('user');
        $db = M('friend_record');
        $friendid = I('post.id');
        $data['ownerid'] = $user['id'];
        $data['friendid'] = $friendid;
        $result = $db->data($data)->add();
        if($result == false)
            return new MessageInfo(false,null,"1420:未找到该用户,关注失败");
        return new MessageInfo(true,$data,"1460:关注成功" );
    }


    public function friendCancle(){
        $user = session('user');
        $db = M('friend_record');
        $friendid = I('post.id');
        $db->where('friendid='.$friendid." AND ownerid=".$user['id'])->delete();
        return new MessageInfo(true,null,"1460:删除成功");
    }

    public function friendSearch(){
        $db = M('user');
        $name = I('post.nickname');
        $result = "\'\%".$name."\%\'";
        $map['nickname'] = array('like',$result);
        $findUser = $db->where($map)->select();
        if(count($findUser) >= 0) {
            return new MessageInfo(true, $findUser, "1460:查找成功");
        }else{
            return new MessageInfo(false,null,"1420:未找到相关用户");
        }
    }


    public function recommendFriend(){
        $db = M('user');
        $name = I('post.nickname');
        $user = session('user');
        $sql ="select * from user where id not in (select friendid from friend_record where ownerid =".$user['id'].")"." AND id <>".$user['id'];
        $result = $db->query($sql);

        if(count($result) >= 0) {
            return new MessageInfo(true, $result, "1460:推荐成功");
        }else{
            return new MessageInfo(false,null,"1420:无相关用户可以推荐");
        }
    }
}