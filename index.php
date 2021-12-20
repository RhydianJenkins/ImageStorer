<?php

use src\Main;
use src\Saver;
use src\Validator;

require __DIR__ . '/vendor/autoload.php';

const TMP_DIR = __DIR__ . '/tmp';
const SUCCESS = 0;
const FAIL = 1;

// Validate CLI arguments
$cliValid = validateCLI();

$main = new Main(new Saver(), new Validator());

// save image
if (isset($cliValid['s'])) {
    $success = $main->saveImage(TMP_DIR, $cliValid['f'], file_get_contents($cliValid['f']));
    exit($success ? SUCCESS : FAIL);
}

// load image
if (isset($cliValid['l'])) {
    $imageData = $main->fetchImage(TMP_DIR . '/', $cliValid['f']);
    if ($imageData) {
        echo 'TODO: Deal with imageData' . PHP_EOL;
    }
    exit($imageData ? SUCCESS : FAIL);
}

// delete image
if (isset($cliValid['d'])) {
    $success = $main->deleteImage(TMP_DIR, $cliValid['f']);
    exit($success ? SUCCESS : FAIL);
}

exit(FAIL);

/**
 * Validates the CLI arguments, and returns true if they are valid.
 */
function validateCLI(): array
{
    $usage = 'Usage:' . PHP_EOL;
    $usage .= 'To save a file: php index.php -s -f <filename>' . PHP_EOL;
    $usage .= 'To load a file: php index.php -l -f <filename>' . PHP_EOL;
    $usage .= 'To delete a file: php index.php -d -f <filename>' . PHP_EOL;
    $options = getopt('s::d::l::f:');
    if (!isset($options['f'])) {
        echo $usage;
        exit(FAIL);
    }

    // must either have s, d, or l (save, delete, load) options
    if (!isset($options['s']) && !isset($options['d']) && !isset($options['l'])) {
        echo $usage;
        exit(FAIL);
    }

    // check that there are the correct number of arguments
    if (count($options) != 2) {
        echo $usage;
        exit(FAIL);
    }

    return $options;
}
