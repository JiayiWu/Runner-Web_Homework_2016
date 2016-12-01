<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/12/1
 * Time: 下午3:38
 */

namespace Home\Controller;


use Think\Controller;
use Home\Model\MarketModel as mm;
class MarketController extends Controller
{
    public function userScore(){
       $mm = new mm();
        $this->ajaxReturn($mm->userScore(),"JSON");
    }

    public function buy(){
        $mm = new mm();
        $this->ajaxReturn($mm->buy(),"JSON");
    }
}