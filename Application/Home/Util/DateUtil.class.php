<?php

/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/12/1
 * Time: 上午10:19
 */
namespace Home\Util;
class DateUtil
{
    private static $_instance = null;
    //私有构造函数，防止外界实例化对象
    private function __construct() {
    }
    //私有克隆函数，防止外办克隆对象
    private function __clone() {
    }
    //静态方法，单例统一访问入口
    static public function getInstance() {
        if (is_null ( self::$_instance ) || isset ( self::$_instance )) {
            self::$_instance = new self ();
        }
        return self::$_instance;
    }
    public function convert($result) {
        for ($i = 0 ;$i<count($result);$i++){
            $result[$i]['date'] = date('Y-m-d H:i',$result[$i]['date']) ;
        }
        return $result;
    }

}