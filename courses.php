<?PHP
/**
 *  +--------------------------------------------------------------
 *  | Copyright (c) 2016 DZLZH All rights reserved.
 *  +--------------------------------------------------------------
 *  | Author: DZLZH <dzlzh@null.net>
 *  +--------------------------------------------------------------
 *  | Filename: courses.php
 *  +--------------------------------------------------------------
 *  | Last modified: 2016-11-15 20:55
 *  +--------------------------------------------------------------
 *  | Description: 
 *  +--------------------------------------------------------------
 */

require_once 'config.php';

if (!file_exists('cookie')) {
    var_dump(1);
    $login = curl_html($url['login'], $userAgent, null, null, null, 1);
    $cookieIsMatched = preg_match('/Set-Cookie:\s*(.*)/', $login, $matches);
    if ($cookieIsMatched) {
        $cookie = strstr($matches[1], ';', true);
    }

    $csrfTokenIsMatched = preg_match('/csrf_token.*value="([^"]*)"/', $login, $matches);
    if ($csrfTokenIsMatched) {
        $loginParam['csrf_token'] = $matches[1];
    }

    $login = curl_html($url['login'], $userAgent, $cookie, $loginParam, null, 1);
    $cookieIsMatched = preg_match('/Set-Cookie:\s*(.*)/', $login, $matches);
    if ($cookieIsMatched) {
        $cookie .= ';' . strstr($matches[1], ';', true);
    }
    file_put_contents('cookie', $cookie) || exit;
}

$cookie = file_get_contents('cookie');
if ($cookie) {
    //循环类型
    foreach ($tag as $key => $value) {
        // echo $value, "\n";
        //目录
        $coursesParam['tag'] = $value;
        $coursesTagUrl = $url['courses'];
        foreach ($coursesParam as $k => $v) {
            //当前类型URL
            $coursesTagUrl .= '&' . $k . '=' . urlencode($v);
        }
        $page = 1;
        $coursesUrl = array();
        //当前类型全部课程URL
        while(true) {
            $tagUrl = $coursesTagUrl . '&page=' . $page;
            // echo $tagUrl , "\n";
            $tagHtml = curl_html($tagUrl, $userAgent, $cookie);
            $isMatched = preg_match_all('/<a[^(class)]*class="course-box"[^(href)]*href="([^"]+)">/i', $tagHtml, $matches);
            if ($isMatched) {
                $coursesUrl = array_merge_recursive($coursesUrl, $matches[1]);
            } else {
                break;
            }
            $page++;
        }

        foreach ($coursesUrl as $courseUrl) {
            // echo $courseUrl, "\n";
            $courseHtml = curl_html($url['root'] . $courseUrl, $userAgent, $cookie);
            //课程名字
            $isMatched = preg_match('/<h4\s*[^(class)]*class="pull-left[^>]*>\s*<span>([^<]+)<\/span>\s*<\/h4>/i', $courseHtml, $matches);
            if ($isMatched) {
                $courseName = $matches[1];
                $contents[$value][] = $courseName;
            }
            //课程内容URL
            $isMatched = preg_match_all('/\/courses\/\d+\/labs\/\d+\/document/i', $courseHtml, $matches);
            if ($isMatched) {
                //课程内容
                foreach ($matches[0] as $documentUrl) {
                    // echo $documentUrl, "\n";
                    die;
                }
            }
            die;
        }
        die;
    }

}
