<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\DeadCode\Set\DeadCodeSetList;
use Rector\Laravel\Set\LaravelSetList;
use Rector\TypeDeclaration\Set\TypeDeclarationSetList;

return static function (RectorConfig $config): void {
    $config->paths([
        __DIR__.'/app',
        __DIR__.'/database',
    ]);

    $config->sets([
        LaravelSetList::LARAVEL_11,
        TypeDeclarationSetList::TYPE_DECLARATION,
        DeadCodeSetList::DEAD_CODE,
    ]);

    $config->parallel();
};
