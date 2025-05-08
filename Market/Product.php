<?php
namespace Market;

class Product
{
    private ImageStorageInterface $primaryStorage;
    private ImageStorageInterface $s3Storage;

    private array $imageFileNames = []; // список всех изображений

    public function __construct(
        ImageStorageInterface $primaryStorage,
        ImageStorageInterface $s3Storage
    ) {
        $this->primaryStorage = $primaryStorage;
        $this->s3Storage = $s3Storage;
    }

    /**
     * @return string[] список URL изображений (CDN + S3)
     */
    public function getImageUrls(): array
    {
        $urls = [];

        foreach ($this->imageFileNames as $fileName) {
            // приоритет: CDN -> S3
            if ($this->primaryStorage->fileExists($fileName)) {
                $url = $this->primaryStorage->getUrl($fileName);
            } elseif ($this->s3Storage->fileExists($fileName)) {
                $url = $this->s3Storage->getUrl($fileName);
            } else {
                $url = null;
            }

            if ($url !== null) {
                $urls[] = $url;
            }
        }

        return $urls;
    }

    /**
     * Главное изображение (старое поведение)
     */
    public function getImageUrl(): ?string
    {
        return $this->getImageUrls()[0] ?? null;
    }

    public function addImage(string $fileName): void
    {
        if (!in_array($fileName, $this->imageFileNames, true)) {
            $this->imageFileNames[] = $fileName;
        }
    }

    // Можно добавить removeImage(), updateImage(), и т.п. по необходимости
}
