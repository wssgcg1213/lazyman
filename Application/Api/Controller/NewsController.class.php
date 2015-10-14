<?php
/**
 * Created by PhpStorm.
 * User: Liuchenling
 * Date: 15/10/15
 * Time: 00:46
 */

namespace Api\Controller;
use Think\Controller;

class NewsController extends Controller {
    public function index () {
        /**
         * 暴露的接口 news 新闻
         */
        $result = [

        ];
        $this->ajaxReturn( $result );
    }
}