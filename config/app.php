<?php

/**
 * We need to return the original config.
 *
 * The galaxy/config/app.php is not loaded at this point!
 */
$originalConfig = require __DIR__.'/../galaxy/config/app.php';

/**
 * Adjust config here. Or overwrite completely, and drop the above require?
 **/

// Return the config.
return $originalConfig;
