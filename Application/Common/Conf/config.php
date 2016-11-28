<?php
return array(
	//'配置项'=>'配置值'

    'URL_MODEL' => '2',
    'URL_ROUTER_ON'   => true,
    'URL_ROUTE_RULES'=>array(
        'user/add'=>'Home/user/userAdd',
        'user/login'=>'Home/user/login',
         'runner/data/sport'=>'Home/viewdata/getSportData',
        'runner/data/body'=>'Home/viewdata/getBodyData',
        'runner/data/sleep'=>'Home/viewdata/getSleepData',
        'runner/data'=>'Home/data/dataDeal',
        'user/acc'=>'index.php/Home/index/index'
    )



);