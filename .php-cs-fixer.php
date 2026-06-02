<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude(['vendor', 'storage', 'bootstrap/cache', 'node_modules', 'galaxy']);

return (new PhpCsFixer\Config())
    ->setUsingCache(false)
    ->setRules([
        '@PSR2' => true, // Laravel style.
    ])
    ->setFinder($finder);
