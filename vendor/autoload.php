<?php
/**
 * Created by PhpStorm.
 * User: alex1rap
 * Date: 03.06.2017
 * Time: 22:57
 */

spl_autoload_register(
    function ($class) {
        $alias_array = include __DIR__ . '/aliases.php';
        $alias_real_length = 0;
        $class_file_alias = $_SERVER['DOCUMENT_ROOT'];
        foreach ($alias_array as $alias => $value) {
            $alias_length = strlen($alias);
            $class_alias = substr($class, 0, $alias_length);
            if ($class_alias == $alias) {
                $alias_real_length = $alias_length;
                $class_file_alias = $value;
            }
        }
        $class_namespace_path = substr($class, $alias_real_length);
        $class_file = $class_file_alias . str_replace('\\', '/', $class_namespace_path) . '.php';
        if (file_exists($class_file)) {
            require_once $class_file;
        } else {
            if (preg_match("/^app\\\controllers\\\(?<controller>(.*))$/i", $class, $matches)) {
            } else {
                echo "Class file of {$class} not found in {$class_file}\r\n";
            }
        }
    }
);