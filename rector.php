<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $config): void {
    $config->paths([
        __DIR__.'/app',
        __DIR__.'/database',
    ]);

    $config->sets([
        SetList::TYPE_DECLARATION,
        SetList::DEAD_CODE,
    ]);

    $config->parallel();
};
