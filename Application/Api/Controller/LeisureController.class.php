<?php
/**
 * Created by PhpStorm.
 * User: Liuchenling
 * Date: 15/10/18
 * Time: 00:43
 */

namespace Api\Controller;
use Think\Controller;

class LeisureController extends Controller {


    /**
     * 周边美食
     */
    public function food () {
        $data = array();
        $data[] = array(
            "title" => "第三方第三方似懂非懂是",
            "intro" => "大富大贵梵蒂冈梵蒂冈代购费大股东范甘迪发高士大夫第十个是.",
            "imgUrl" => "http://img2.cache.netease.com/3g/2015/10/18/20151018000323fe53f.jpg",
            "h5Url" => "/lazyman/Api/Leisure/h5App/id/0"
        );

        $ret = array(
            "status" => 200,
            "info" => "success",
            "data" => $data
        );
        $this->ajaxReturn($ret);
    }

    public function h5App () {
        $id = I('get.id');
        $info = array(
            "title" => "第三方第三方似懂非懂是",
            "intro" => "大富大贵梵蒂冈梵蒂冈代购费大股东范甘迪发高士大夫第十个是.",
            "imgUrl" => "http://img2.cache.netease.com/3g/2015/10/18/20151018000323fe53f.jpg",
            "h5Url" => "/lazyman/Api/Leisure/h5App/id/0"
        );
        $this->assign('info', $info);
        $this->display();
    }
}