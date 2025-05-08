<?php
namespace Market;

interface ImageStorageInterface
{
    public function fileExists(string $fileName): bool;

    public function getUrl(string $fileName): ?string;

    public function deleteFile(string $fileName): void;

    public function saveFile(string $fileName): void;
}
