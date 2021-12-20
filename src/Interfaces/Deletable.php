<?php

namespace src\Interfaces;

interface Deletable
{
    /**
     * @param string $imagePath The path to the image
     * @return bool true if the image was successfully deleted
     */
    public function delete(string $imagePath, string $imageName): bool;
}
