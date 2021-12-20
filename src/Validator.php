<?php

namespace src;

use src\Interfaces\Validatable;

class Validator implements Validatable
{
    public function isValid($imagePath): bool
    {
        return is_file($imagePath);
    }
}
