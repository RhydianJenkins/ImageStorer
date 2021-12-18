<?php

namespace src\Interfaces;

interface Validatable
{
    /**
     * @return bool true if the image is valid
     */
    public function isValid($imagePath): bool;
}
