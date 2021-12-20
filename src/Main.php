<?php

namespace src;

use src\Interfaces\Validatable;
use Psr\Log\LoggerInterface;
use Logger;
use src\Interfaces\ImageIO;

class Main
{
    private LoggerInterface $logger;
    private ImageIO $imageSaver;
    private Validatable $imageValidator;

    public function __construct(
        ImageIO $imageSaver,
        Validatable $imageValidator
    ) {
        $this->logger = new Logger();
        $this->imageSaver = $imageSaver;
        $this->imageValidator = $imageValidator;
    }

    public function saveImage(string $imagePath, string $imageName, string $imageData): bool
    {
        if ($this->imageValidator->isValid($imagePath)) {
            $success = $this->imageSaver->save($imagePath, $imageName, $imageData);

            $success ?
                $this->logger->info('Image saved successfully') :
                $this->logger->error('Image could not be saved');

            return $success;
        }

        $this->logger->warning('Image is not valid');
        return false;
    }

    public function fetchImage(string $imagePath): string
    {
        if ($this->imageValidator->isValid($imagePath)) {
            return $this->imageSaver->load($imagePath);
        }

        $this->logger->warning('Image is not valid');
        return '';
    }

    public function deleteImage(string $imagePath, string $imageName): bool
    {
        if ($this->imageValidator->isValid($imagePath)) {
            $success = $this->imageSaver->delete($imagePath, $imageName);

            $success ?
                $this->logger->info('Image deleted successfully') :
                $this->logger->error('Image could not be deleted');

            return $success;
        }

        $this->logger->warning('Image is not valid');
        return false;
    }
}
