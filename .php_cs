<?php

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        'psr0' => false,
    ])
    ->setUsingCache(false)
;
