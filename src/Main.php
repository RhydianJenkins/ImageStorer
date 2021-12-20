<?php

namespace src;

use src\Interfaces\Validatable;
use src\Interfaces\ImageIO;
use Psr\Log\LoggerInterface;
use Logger;

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
        if ($this->imageValidator->isValid($imageName)) {
            $success = $this->imageSaver->save($imagePath, $imageName, $imageData);

            $success ?
                $this->logger->info('Image saved successfully') :
                $this->logger->error('Image could not be saved');

            return $success;
        }

        $this->logger->warning('Image is not valid');
        return false;
    }

    public function fetchImage(string $imagePath, string $imageName): string
    {
        if ($this->imageValidator->isValid($imagePath . '/' . $imageName)) {
            return $this->imageSaver->load($imagePath, $imageName);
        }

        $this->logger->warning('Image is not valid');
        return '';
    }

    public function deleteImage(string $imagePath, string $imageName): bool
    {
        if ($this->imageValidator->isValid($imagePath . '/' . $imageName)) {
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
