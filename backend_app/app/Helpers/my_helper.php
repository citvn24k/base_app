<?php
if (!function_exists('ver_asset')) {
    function ver_asset()
    {
        return config('asset.version', date('dm', time()));
    }
}

if (!function_exists('format_date')) {
    function format_date($timestamp)
    {
        return \Carbon\Carbon::parse($timestamp)->format('d/m/Y h:i');
    }
}

if (!function_exists('format_unix_time')) {
    function format_unix_time($unixTime)
    {
        return \Carbon\Carbon::createFromTimestamp($unixTime / 1000)->format('d/m/Y h:i');
    }
}

if (!function_exists('get_controller_name')) {
    function get_controller_name($path)
    {
        return Str::lower(parse_name($path));
    }
}

if (!function_exists('parse_name')) {
    function parse_name($string)
    {
        return str_replace('Controller', '', last(explode('\\', $string)));
    }
}


if (!function_exists('file_get_content_curl')) {
    function file_get_content_curl($url)
    {
        if (!function_exists('curl_init'))
        {
            die('CURL is not installed!');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}

