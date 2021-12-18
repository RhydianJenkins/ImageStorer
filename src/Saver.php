<?php

namespace App;

use App\Interfaces\Savable;

class Saver implements Savable
{
    public function save(string $imagePath): bool
    {
        return true;
    }
}
