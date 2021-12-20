<?php

namespace src;

use src\Interfaces\ImageIO;

/**
 * Update this class to change the implementation of the ImageIO interface.
 */
class Saver implements ImageIO
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

    public function delete(string $imagePath, string $imageName): bool
    {
        return unlink($imagePath . '/' . $imageName);
    }
}
