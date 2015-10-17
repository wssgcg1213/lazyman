<?php

/**
 * Created by PhpStorm.
 * User: Liuchenling
 * Date: 15/10/16
 * Time: 20:05
 */

namespace Api\Model;
use Think\Model;

class NewsModel extends Model {
    protected $tableName = 'news';
    protected $_types = array(
        "headline" => "T1295501906343",
        "tech" => "T1295507084100",
        "entertain" => "T1295506658957",
        "social" => "T1295505301714"
    );

    /*
     * 获取头条新闻
     */
    public function getHeadNews ($start = 0, $length = 15) {
        $_end = (int)$start + (int)$length;
        return $this->_getNewsByType("headline", $start, $_end);
    }

    /*
     * 获取娱乐新闻
     */
    public function getEntertainNews ($start = 0, $length = 15) {
        $_end = (int)$start + (int)$length;
        return $this->_getNewsByType("entertain", $start, $_end);
    }

    /*
    * 获取科技新闻
    */
    public function getTechNews ($start = 0, $length = 15) {
        $_end = (int)$start + (int)$length;
        return $this->_getNewsByType("tech", $start, $_end);
    }

    /*
    * 获取社会新闻
    */
    public function getSocialNews ($start = 0, $length = 15) {
        $_end = (int)$start + (int)$length;
        return $this->_getNewsByType("social", $start, $_end);
    }

    private function _getNewsByType ($type, $start, $end) {
        $_listId = $this->_types[$type];
        $url = "http://c.m.163.com/nc/article/list/$_listId/$start-$end.html";
        $newsString = $this->curl($url);
        if ( !$newsString ) {return '';}
        $newsRaw = json_decode($newsString, true);
        $news = array();

        foreach ($newsRaw[$_listId] as $_news) {
            if ($_news['template'] == 'manual') continue;

            $news[] = array(
                "title" => $_news['title'],
                "content" => $_news['digest'],
                "ts" => strtotime($_news['ptime']),
                "imgUrl" => $_news['imgsrc'],
                "docid" => $_news['docid'],
                "h5Url" => U("News/h5News?docid=".$_news['docid']),
                "type" => "$type"
            );
        }
        //formatted $news

        if (!empty($news[0]) && $this->getFirstNewsTs() !== $news[0]['ts']) {
            $this->saveHeadNews($news);//保存到数据库
        }
        return $news;
    }

    private function curl($url, $timeout = 30) {
        $context = stream_context_create ( array (
            'http' => array (
                'timeout' => $timeout
            )
        ) ); // 超时时间，单位为秒
        return file_get_contents ( $url, 0, $context );
    }

    private function saveHeadNews () {
        //todo save to mysql
    }

    private function getFirstNewsTs() {

    }

    public function getNewsInfoByDocid($docid) {
        $news = array();
        if ( !$docid ) {
            return $news;
        }

        $newsRaw = json_decode($this->curl("http://c.m.163.com/nc/article/$docid/full.html"), true)[$docid];
        return $newsRaw;
    }
}