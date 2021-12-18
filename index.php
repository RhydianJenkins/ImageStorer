<?php

use src\Main;
use src\Saver;
use src\Validator;

spl_autoload_register(function ($class) {
    $baseDir = './src/';
    $file = $baseDir . $class . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

$main = new Main(new Saver(), new Validator());
$main->saveImage('/tmp/image.jpg');
