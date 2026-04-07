<?php

$config = PhpCsFixer\Config::create()
    //->setRiskyAllowed(true) TODO Activate? Not sure what it does.
    ->setUsingCache(false)
    ->setRules([
        '@PSR2' => true, // Laravel style.
    ])
;

return $config;
