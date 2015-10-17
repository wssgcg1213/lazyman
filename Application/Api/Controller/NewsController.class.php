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
    protected $NewsModel;

    public function _initialize() {
        $this->NewsModel = D('News');
    }

    /**
     * 暴露的接口 news 新闻
     */
    public function index () {
        $page = I('get.page', 0, 'int');
        $data = $this->NewsModel->getHeadNews($page * 15);

        $ret = array(
            "status" => 200,
            "info" => "success",
            "page" => $page,
            "data" => $data
        );

        $this->ajaxReturn( $ret );
    }

    public function h5News() {
        $docid = I('get.docid');
        if (!$docid ) return die('empty docid');
        $news = $this->NewsModel->getNewsInfoByDocid($docid);
        $this->assign('news', $news);
        $this->display();
    }
}