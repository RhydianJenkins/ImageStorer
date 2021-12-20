<?php

namespace src\Interfaces;

interface Savable
{
    /**
     * @param string $imagePath The path to the image
     * @param string $imageName The name of the image file (including extension)
     * @param string $imageData The image data to be saved to file
     * @return bool true if the image was saved successfully
     */
    public function save(string $imagePath, string $imageName, string $imageData): bool;
}
