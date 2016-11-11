<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        redirect('/index.html', 0, '');

    }


    public function test(){
//        echo 'hhh'.'hah';
        $mc = 'hhh111';
        $this->ajaxReturn($mc,"JSON");
    }
    public function hello($name='thinkphp'){
        $this->assign('name',$name);
        $this->display("index");
    }
}