<?PHP
/**
 *  +--------------------------------------------------------------
 *  | Copyright (c) 2016 DZLZH All rights reserved.
 *  +--------------------------------------------------------------
 *  | Author: DZLZH <dzlzh@null.net>
 *  +--------------------------------------------------------------
 *  | Filename: config.example.php
 *  +--------------------------------------------------------------
 *  | Last modified: 2016-11-15 20:58
 *  +--------------------------------------------------------------
 *  | Description: 
 *  +--------------------------------------------------------------
 */

require_once 'function.php';

$userAgent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.87 Safari/537.36';

$url = array(
    'root'    => 'https://www.shiyanlou.com',
    'login'   => 'https://www.shiyanlou.com/login',
    'courses' => 'https://www.shiyanlou.com/courses/?course_type=all',
);


$loginParam = array(
    'login'      => '',
    'password'   => '',
);

$coursesParam = array(
    //标签
    'tag'  => 'php',

    //类别
    //free    免费
    //limited 限免
    //member  会员
    'fee' => 'free',

    //排序
    //latest  最新
    //hotest  最热
    'order' => 'latest',

    //页码
    // 'page'  => '1',
);

$tag = array(
    'Python',
    'C/C++',
    'Linux',
    'Web',
    'PHP',
    'Java',
    '信息安全',
    'NodeJS',
    'Android',
    'GO',
    '计算机专业课',
    'Spark',
    'Hadoop',
    'HTML5',
    'Scala',
    'SQL',
    'Ruby',
    'R',
    '网络',
    'Git',
    'NoSQL',
    '算法',
    'Docker',
    'Swift',
    '汇编',
    'Windows',
);
