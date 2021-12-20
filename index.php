<?php

require __DIR__ . '/vendor/autoload.php';

const TMP_DIR = __DIR__ . '/tmp';
const SUCCESS = 0;
const FAIL = 1;

use src\Main;
use src\Saver;
use src\Validator;

// Validate CLI arguments
$usage = 'Usage: TODO' . PHP_EOL;
$cliValid = validateCLI();
if (!$cliValid) {
    echo $usage;
    exit(1);
}

$main = new Main(new Saver(), new Validator());
$success = true;

if (isset($cliValid['s'])) {
    $success = $main->saveImage(TMP_DIR, $cliValid['f'], 'Hello World');
    exit($success ? SUCCESS : FAIL);
}

if (isset($cliValid['l'])) {
    $result = $main->fetchImage(TMP_DIR . '/' . $cliValid['f']);
    echo $result . PHP_EOL;
    exit(SUCCESS);
}

if (isset($cliValid['d'])) {
    $success = $main->deleteImage(TMP_DIR, $cliValid['f']);
    exit($success ? SUCCESS : FAIL);
}

exit(FAIL);

/**
 * Validates the CLI arguments, and returns true if they are valid.
 *
 * PHP 8+ would allow return type to be bool|array :(
 */
function validateCLI()
{
    $options = getopt('s::d::l::f:');
    if (!isset($options['f'])) {
        return false;
    }

    // must either have s, d, or l (save, delete, load) options
    if (!isset($options['s']) && !isset($options['d']) && !isset($options['l'])) {
        return false;
    }

    // check that there are the correct number of arguments
    if (count($options) != 2) {
        return false;
    }

    return $options;
}
