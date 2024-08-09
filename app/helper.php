<?php

if (!function_exists('generateOTP')) {
    function generateOTP($n){
        $generator = "1357902468";
        $result = '';
        for ($i=1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))),1);
        }
        return $result;
    }
}

if(!function_exists('dosyasil')) {
    function dosyasil($string) {
        if(file_exists($string)) {
            if(!empty($string)) {
                unlink($string);
            }
        }
    }
}

if(!function_exists('strLimit')) {
    function strLimit($text, $limit, $url = null) {
        if($url == null) {
            $end = '...';
        } else {
            $end = '<a class="ml-2" href="' . $url . '">[...]</a>';
        }
        return Str::limit($text, $limit, $end);
    }
}
