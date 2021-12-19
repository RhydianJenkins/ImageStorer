<?php

require __DIR__ . '/vendor/autoload.php';

use src\Main;
use src\Saver;
use src\Validator;

$main = new Main(new Saver(), new Validator());
$main->saveImage('/tmp/image.jpg');
