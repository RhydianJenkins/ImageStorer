<?php

require __DIR__ . '/vendor/autoload.php';

const TMP_DIR = __DIR__ . '/tmp';

use src\Main;
use src\Saver;
use src\Validator;

$usage = 'Usage: TODO' . PHP_EOL;
$cliValid = validateCLI();
if (!$cliValid) {
    echo $usage;
    exit(1);
}

$main = new Main(new Saver(), new Validator());

$result = isset($cliValid['s'])
    ? $main->saveImage(TMP_DIR, $cliValid['f'], 'Hello World')
    : $main->fetchImage(TMP_DIR . '/' . $cliValid['f']);

var_dump($result);

exit(0);

/**
 * Validates the CLI arguments, and returns true if they are valid.
 *
 * PHP 8+ would allow return type to be bool|array :(
 */
function validateCLI()
{
    $options = getopt('s::f:');
    if (!isset($options['f'])) {
        return false;
    }
    return $options;
}
