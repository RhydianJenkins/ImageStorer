<?php

namespace App;

use App\Interfaces\Validatable;

class Validator implements Validatable
{
    public function isValid($imagePath): bool
    {
        return true;
    }
}
