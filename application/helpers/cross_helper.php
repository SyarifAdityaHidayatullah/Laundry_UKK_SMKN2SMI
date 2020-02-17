<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!function_exists('csrf')) {
    function csrf()
    {
        $ci = get_instance();
        $data = [
            'name' => $ci->security->get_csrf_token_name(),
            'hash' => $ci->security->get_csrf_hash()
        ];
        return $data;
    }
}
