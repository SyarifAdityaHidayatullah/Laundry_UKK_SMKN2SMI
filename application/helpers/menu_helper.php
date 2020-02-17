<?php

if (!function_exists('active')) {
    function active($controller)
    {
        $ci = get_instance();
        $class = $ci->router->fetch_class();
        return ($controller == $class) ? 'active' : '';
    }
}
