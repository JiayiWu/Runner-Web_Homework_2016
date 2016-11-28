<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/28
 * Time: 下午8:01
 */

namespace Home\Controller;


use Think\Controller;
use Home\Model\DataModel as dm;
class DataController extends Controller
{

    public function dataDeal(){
        $dm = new dm();
        $result = $dm->dataDeal();
        $this->ajaxReturn($result,"JSON");
    }

}