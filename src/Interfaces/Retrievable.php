<?php

namespace App\Interfaces;

interface Retrievable
{
    /**
     * @return mixed
     */
    public function retrieve(string $imagePath): string;
}
