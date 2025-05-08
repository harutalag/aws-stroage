<?php
namespace Market;

use AwsS3\Client\AwsStorageInterface;

class AwsS3StorageAdapter implements ImageStorageInterface
{
    private AwsStorageInterface $awsClient;

    public function __construct(AwsStorageInterface $awsClient)
    {
        $this->awsClient = $awsClient;
    }

    public function fileExists(string $fileName): bool
    {
        try {
            $this->awsClient->getUrl($fileName);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getUrl(string $fileName): ?string
    {
        try {
            return (string) $this->awsClient->getUrl($fileName);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function deleteFile(string $fileName): void
    {
        // Добавить реализацию при необходимости
        throw new \RuntimeException('Not implemented');
    }

    public function saveFile(string $fileName): void
    {
        // Добавить реализацию при необходимости
        throw new \RuntimeException('Not implemented');
    }
}
