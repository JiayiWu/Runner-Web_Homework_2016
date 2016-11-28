<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/29
 * Time: 上午7:07
 */

namespace Home\Model;

use Think\Model;
use Home\Config\MessageInfo;
class ViewDataModel extends Model
{
        public function getSportData(){
            $user = session('user');
            if(null == $user){
                return new MessageInfo(false,null,"1320:用户未登陆");
            }

            $sportData = M('sport_data');
            $result = $sportData->where('userid='.$user[id])->select();


            for ( $i = 0;$i<count($result);$i++){
            $result[$i][date] = date("Y-m-d",$result[$i][date]);
            }

            return new MessageInfo(true,$result,"1620:数据获取成功");
        }

        public function getSleepData(){
            $user = session('user');
            if(null == $user){
                return new MessageInfo(false,null,"1320:用户未登陆");
            }

            $sportData = M('sleep_data');
            $result = $sportData->where('userid='.$user[id])->select();


            for ( $i = 0;$i<count($result);$i++){
                $result[$i][date] = date("Y-m-d",$result[$i][date]);
            }

            return new MessageInfo(true,$result,"1620:数据获取成功");
        }

    public function getBodyData(){
        $user = session('user');
        if(null == $user){
            return new MessageInfo(false,null,"1320:用户未登陆");
        }

        $sportData = M('body_data');
        $result = $sportData->where('userid='.$user[id])->select();


        for ( $i = 0;$i<count($result);$i++){
            $result[$i][date] = date("Y-m-d",$result[$i][date]);
        }

        return new MessageInfo(true,$result,"1620:数据获取成功");
    }
}