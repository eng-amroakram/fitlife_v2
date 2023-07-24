<?php

if (!function_exists('input')) {
    function input($type, $name, $id, $icon, $dir = "rtl", $maxlength = "50", $class, $placeholder = "", $defer = true, $lable = "", $validation = "", $disabled = false, $accept = "image/*")
    {
        return [
            "type" => $type,
            "name" => $name,
            "icon" => $icon,
            "dir" => $dir,
            "maxlength" => $maxlength,
            "class" => $class,
            "id" => $id,
            "placeholder" => $placeholder,
            "defer" => $defer,
            "lable" => $lable,
            "validation" => $validation,
            "disabled" => $disabled,
            "accept" => $accept
        ];
    }
}

if (!function_exists('select')) {
    function select($type = "select", $name, $id, $icon, $dir = "", $class, $placeholder = "", $search = false, $options, $multiple = "", $defer = true, $lable = "", $validation = "", $disabled = false)
    {
        return [
            "type" => $type,
            "name" => $name,
            "icon" => $icon,
            "dir" => $dir,
            "class" => $class,
            "placeholder" => $placeholder,
            "search" => $search,
            "id" => $id,
            "options" => $options,
            "multiple" => $multiple,
            "defer" => $defer,
            "lable" => $lable,
            "validation" => $validation,
            "disabled" => $disabled,
        ];
    }
}

if (!function_exists('checkboxes')) {
    function checkboxes($checkboxes)
    {
        $boxes = [];

        foreach ($checkboxes as $title => $names) {
            $boxes[] = [
                "type" => "checkbox",
                "title" => $title,
                "checkboxes" => $names
            ];
        }

        return $boxes;
    }
}
