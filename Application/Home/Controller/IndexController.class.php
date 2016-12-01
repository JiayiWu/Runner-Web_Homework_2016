<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if(session('user')!=null){
            redirect('/home.html', 0, '');
        }
        redirect('/index.html', 0, '');
      
    }



}