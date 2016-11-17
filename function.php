<?PHP
/**
 *  +--------------------------------------------------------------
 *  | Copyright (c) 2016 DZLZH All rights reserved.
 *  +--------------------------------------------------------------
 *  | Author: DZLZH <dzlzh@null.net>
 *  +--------------------------------------------------------------
 *  | Filename: function.php
 *  +--------------------------------------------------------------
 *  | Last modified: 2016-11-15 20:57
 *  +--------------------------------------------------------------
 *  | Description: 
 *  +--------------------------------------------------------------
 */


function curl_html($url, $userAgent = null, $cookie = null, $param = null, $file = null, $header = 0)
{
    for ($i = 0; $i < 3; $i++) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if($userAgent != null) {
            curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
        }
        if($param != null) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
        }
        if($cookie != null) {
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        }
        if ($file != null) {
            $fp = fopen($file, 'w');
            curl_setopt($curl, CURLOPT_FILE, $fp);
        }
        $data = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        $httpCodeIsMatched = preg_match('/4\d{2}|5\d{2}/', $info['http_code']);
        if (!$httpCodeIsMatched) {
            return $data;
        }
        usleep(1000000 * $i);
    }
    $error = 'Error::http_code:' . $info['http_code'] . ';url:' . $info['url'];
    if (is_array($param)) {
        $error .= ';param:' . '(' . serialize($param) . ')';
    }
    return $error;
}

//递归创建目录
function mk_dir($path)
{
    if (is_dir($path)) {
        return true;
    }
    return is_dir(dirname($path)) || mk_dir(dirname($path)) ? mkdir($path) : false;
}

