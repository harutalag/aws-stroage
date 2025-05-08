<?php
Yii::$container->set(\Market\Product::class, function ($container, $params, $config) {
    return new \Market\Product(
        $container->get(\Market\FileStorageRepository::class),
        $container->get(\Market\AwsS3StorageAdapter::class)
    );
});
