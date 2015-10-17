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
        return $this->wrap($this->NewsModel->getHeadNews($page * 15), $page);
    }
    public function headline () {
        return $this->index();
    }
    public function entertain () {
        $page = I('get.page', 0, 'int');
        return $this->wrap($this->NewsModel->getEntertainNews($page * 15), $page);
    }
    public function social () {
        $page = I('get.page', 0, 'int');
        return $this->wrap($this->NewsModel->getSocialNews($page * 15), $page);
    }
    public function tech () {
        $page = I('get.page', 0, 'int');
        return $this->wrap($this->NewsModel->getTechNews($page * 15), $page);
    }

    /**
     * 获取资讯版块热门数据
     */
    public function hotMessage () {
        $data = array();
        $newsModel = M('news');
        $data[] = $newsModel->where('type="headline"')->order('ts desc')->find();
        $data[] = $newsModel->where('type="social"')->order('ts desc')->find();
        $data[] = $newsModel->where('type="entertain"')->order('ts desc')->find();
        $data[] = $newsModel->where('type="tech"')->order('ts desc')->find();
        $ret = array(
            "status" => 200,
            "info" => "success",
            "data" => $data
        );

        return $this->ajaxReturn( $ret );
    }

    public function h5News() {
        $docid = I('get.docid');
        if (!$docid ) return die('empty docid');
        $news = $this->NewsModel->getNewsInfoByDocid($docid);
        $this->assign('news', $news);
        $this->display();
    }

    private function wrap($data, $page) {
        $ret = array(
            "status" => 200,
            "info" => "success",
            "page" => $page,
            "data" => $data
        );

        return $this->ajaxReturn( $ret );
    }


}