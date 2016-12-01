<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/28
 * Time: 下午8:02
 */

namespace Home\Model;


use Think\Model;
use Home\Config\MessageInfo;
class DataModel extends Model
{


    public  function dataDeal(){
        $json = I('post.data');

//转移json
        $arr = json_decode(html_entity_decode($json),true);
        $first = true;
       foreach ($arr as $data){
           // first match
           if ($first){
               $first = false;
              if(null == $this->findDevice($data)){
                  $store['deviceid'] = $data['deviceid'];
                  $store['security'] = $data['securityid'];
                  $store['userid'] = $data['userid'];
                   M('device')->data($store)->add();
              }else if ($this->findPropertyMatch($data) == null)
                  return new MessageInfo(false,null,'1020:Authentication failure');

           }

           $time = strtotime($data['date']);

           // init data_sleep;
           $data_sleep['sleephour'] = $data['sleep_hour'];
           $data_sleep['ds'] = $data['sleep_percent'][0];
           $data_sleep['ss'] = $data['sleep_percent'][1];
           $data_sleep['aw'] = $data['sleep_percent'][2];
           $data_sleep['date'] = $time;
           $data_sleep['userid'] = $data['userid'];

           //init data_body
           $data_body['weight'] = $data['weight'];
           $data_body['bf'] = $data['bfr'];
           $data_body['date'] = $time;
           $data_body['userid'] = $data['userid'];

           //init data_sport
           $data_sport['running_percent'] = $data['sport_percent'][0];
           $data_sport['swimming_percent'] = $data['sport_percent'][1];
           $data_sport['cycling_percent'] = $data['sport_percent'][2];
           $data_sport['walking_percent'] = $data['sport_percent'][3];
           $data_sport['sitting_percent'] = $data['sport_percent'][4];
           $data_sport['calorie'] = $data['calorie'];
           $data_sport['walkmile'] = $data['walkmile'];
           $data_sport['date'] = $time;
           $data_sport['userid'] = $data['userid'];

           if(!($this->insertSleep_data($data_sleep) && $this->insertBody_data($data_body) && $this->insertSport_data($data_sport)))
               return new MessageInfo(false,null,'1020:Data error in form');


       }
        return new MessageInfo(true,true,'1060:Data synchronization success');
    }


    private function insertSleep_data($data_sleep){
        $sleep_data = M('sleep_data');
         return $sleep_data->data($data_sleep)->add();

    }

    private function insertBody_data($data_body){
        $sleep_data = M('body_data');
        return $sleep_data->data($data_body)->add();

    }

    private function insertSport_data($data_sport){
        $sleep_data = M('sport_data');
        return $sleep_data->data($data_sport)->add();

    }

    private function findDevice($data){
        $Device = M('device');
        return $Device->where('deviceid="'.$data['deviceid'].'"')->find();
    }

    private  function  findPropertyMatch($data){
        $Device = M('device');
        return $Device->where('deviceid="'.$data['deviceid'].'"'.' AND security="'.$data['securityid'].'"'.'AND userid="'.$data['userid'].'"')->find();
    }
}