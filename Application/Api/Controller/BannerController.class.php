<?php
/**
 * Created by PhpStorm.
 * User: Liuchenling
 * Date: 15/10/17
 * Time: 23:24
 */

namespace Api\Controller;
use Think\Controller;

class BannerController extends Controller{
    public function index () {
        //todo getBanner mocked
        $data = '{
   "status": 200,
   "info": "success",
   "data":
   [
       {
           "img": "http://img04.sogoucdn.com/app/a/100520093/3c28af542f2d49f7-da1566425074a021-2f0a3355a1b990f264835976f5c29c04.jpg",
           "url": "http://img04.sogoucdn.com/app/a/100520093/3c28af542f2d49f7-da1566425074a021-2f0a3355a1b990f264835976f5c29c04.jpg",
       },
       {
           "img": "http://img04.sogoucdn.com/app/a/100520093/3c28af542f2d49f7-da1566425074a021-2f0a3355a1b990f264835976f5c29c04.jpg",
           "url": "http://img04.sogoucdn.com/app/a/100520093/3c28af542f2d49f7-da1566425074a021-2f0a3355a1b990f264835976f5c29c04.jpg",
       }
   ]
}';
        $this->ajaxReturn($data);
    }
}