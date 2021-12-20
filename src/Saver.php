<?php

namespace src;

use src\Interfaces\Savable;

class Saver implements Savable
{
    public function save(string $imagePath, string $imageName, string $imageData): bool
    {
        if (!is_dir($imagePath)) {
            mkdir($imagePath, 0755);
        }

        return !!(file_put_contents($imagePath . '/' . $imageName, $imageData));
    }

    public function load(string $imagePath): string
    {
        return file_get_contents($imagePath);
    }
}
