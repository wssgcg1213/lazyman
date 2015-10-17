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
    /*
     * 获取头条新闻
     */
    public function getHeadNews ($start = 0, $length = 15) {
        $_end = (int)$start + (int)$length;
        $headNewsUrl = "http://c.m.163.com/nc/article/headline/T1348647853363/$start-$_end.html";
        $headNewsString = $this->curl($headNewsUrl);
        if ( !$headNewsString ) {return '';}
        $headNewsRaw = json_decode($headNewsString, true);
        $headNews = array();

        foreach ($headNewsRaw['T1348647853363'] as $_news) {
            if ($_news['template'] == 'manual') continue;

            $headNews[] = array(
                "title" => $_news['title'],
                "content" => $_news['digest'],
                "ts" => strtotime($_news['ptime']),
                "imgUrl" => $_news['imgsrc'],
                "docid" => $_news['docid'],
                "h5Url" => U("News/h5News?docid=".$_news['docid'])
            );
        }
        //formatted $headNews

        if (!empty($headNews[0]) && $this->getFirstNewsTs() !== $headNews[0]['ts']) {
            $this->saveHeadNews($headNews);//保存到数据库
        }
        return $headNews;
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