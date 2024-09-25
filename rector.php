<?php

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/src',
    ])
    ->withPhpSets()
    ->withPhpPolyfill()
    ->withPreparedSets(deadCode: true, strictBooleans: true);
