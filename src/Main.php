<?php

namespace src;

use src\Interfaces\Savable;
use src\Interfaces\Validatable;
use Psr\Log\LoggerInterface;
use Logger;

class Main
{
    private LoggerInterface $logger;
    private Savable $imageSaver;
    private Validatable $imageValidator;

    public function __construct(
        Savable $imageSaver,
        Validatable $imageValidator
    ) {
        $this->logger = new Logger();
        $this->imageSaver = $imageSaver;
        $this->imageValidator = $imageValidator;
    }

    public function saveImage(string $imagePath): bool
    {
        if ($this->imageValidator->isValid($imagePath)) {
            $success = $this->imageSaver->save($imagePath);

            $success ?
                $this->logger->info('Image saved successfully') :
                $this->logger->error('Image could not be saved');

            return $success;
        }

        $this->logger->warning('Image is not valid');
        return false;
    }
}
