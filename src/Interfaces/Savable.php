<?php

namespace src\Interfaces;

interface Savable
{
    /**
     * @param string $imagePath The path to the image
     * @param string $imageData The image data
     * @return bool true if the image was saved successfully
     */
    public function save(string $imagePath): bool;
}
