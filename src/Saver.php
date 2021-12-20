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

        if (!is_file($imageName)) {
            return false;
        }

        return !!(file_put_contents($imagePath . '/' . $imageName, $imageData));
    }

    public function load(string $imagePath, string $imageName): string
    {
        if (!is_file($imagePath . '/' . $imageName)) {
            throw new \Exception('File does not exist');
        }

        return file_get_contents($imagePath . '/' . $imageName);
    }

    public function delete(string $imagePath, string $imageName): bool
    {
        return unlink($imagePath . '/' . $imageName);
    }
}
