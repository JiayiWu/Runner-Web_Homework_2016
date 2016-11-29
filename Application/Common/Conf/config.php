<?php
return array(
	//'配置项'=>'配置值'

    'URL_MODEL' => '2',
    'URL_ROUTER_ON'   => true,
    'URL_ROUTE_RULES'=>array(
        'user/add'=>'Home/user/userAdd',
        'user/login'=>'Home/user/login',
        'user/basicinfo'=>'Home/user/userBasicInfo',
         'runner/data/sport'=>'Home/viewdata/getSportData',
        'runner/data/body'=>'Home/viewdata/getBodyData',
        'runner/data/sleep'=>'Home/viewdata/getSleepData',
        'runner/data'=>'Home/data/dataDeal',
        'moments/add'=>'Home/friends/momentsAdd',
        'moments/delete'=>'Home/friends/momentsDelete',
        'moments'=>'Home/friends/getMomenmts',
        'user/acc'=>'index.php/Home/index/index'
    )



);