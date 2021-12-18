<?php

namespace src;

use src\Interfaces\Savable;

class Saver implements Savable
{
    public function save(string $imagePath): bool
    {
        return true;
    }
}
