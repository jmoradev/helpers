<?php

if (!function_exists('convert_lower_underscore')) {
    function convert_lower_underscore($str)
    {
        $under_replace = str_replace('_', ' ', $str);
        $upperstr = ucwords($under_replace);
        $lustr = lcfirst($upperstr);
        return str_replace(' ', '', $lustr);
    }
}

if (!function_exists('convert_upper_to_lower_underscore')) {
    function convert_upper_to_lower_underscore($str)
    {
        $under_replace = preg_replace("([A-Z])", "_$0", $str);
        $str_lower = strtolower($under_replace);
        return preg_match('~^\p{Lu}~u', $str)
            ? preg_replace('(_)', '', $str_lower, 1)
            : $str_lower;
    }
}

if (!function_exists('convert_class_array')) {
    function convert_class_array($object): array
    {
        $methods = get_class_methods($object);
        $methods_filtered = array_filter($methods, function ($item) {
            preg_match('/get/', $item, $matches);
            return !empty($matches);
        });
        return array_reduce($methods_filtered, function ($acumulador, $item) use ($object) {
            $key = str_replace(['get', 'set'], '', $item);
            $acumulador[convert_upper_to_lower_underscore($key)] = $object->$item();
            return $acumulador;
        }, []);
    }
}

if (!function_exists("content_index")) {
    function content_index($collection, $key)
    {
        return array_reduce($collection, function ($carry, $item) use ($key) {
            $carry[] = $item[$key];
            return $carry;
        }, []);
    }
}

if (!function_exists('convert_keys_shortupper')) {
    function convert_keys_shortupper(array $collection): array
    {
        $surrogate = [];
        foreach ($collection as $key => $item) {
            $str_key = convert_lower_underscore($key);
            $surrogate[$str_key] = $item;
        }
        return $surrogate;
    }
}

if (!function_exists('convert_object_properties_array')) {
    function convert_object_properties_array($object)
    {
        $properties = get_object_vars($object);
        $keys = array_keys($properties);
        return array_reduce($keys, function ($carry, $item) use ($object) {
            $carry[convert_upper_to_lower_underscore($item)] = $object->$item;
            return $carry;
        }, []);
    }
}
