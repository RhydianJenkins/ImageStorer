<?php

namespace src\Interfaces;

interface Loadable
{
    /**
     * @param string $imagePath The path to the image
     * @return string The image data
     */
    public function load(string $imagePath): string;
}
