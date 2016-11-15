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


var_dump($cookie);
var_dump(curl_html('https://www.shiyanlou.com/courses/63/labs/291/document', $userAgent, $cookie));
