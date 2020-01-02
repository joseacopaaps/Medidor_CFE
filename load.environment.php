<?php

declare(strict_types=1);

/*
 * This file is part of Nubity Laravel Skeleton.
 *
 * (c) The Nubity Development Team <dev@nubity.com>
 *
 * This source file is subject to a proprietary license that is bundled
 * with this source code in the file LICENSE.
 */

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

/**
 * Load any .env file. See /.env.example.
 */
$dotenv = new Dotenv(__DIR__);

try {
  $dotenv->load();
}
catch (InvalidPathException $e) {
  // Do nothing. Production environments rarely use .env files.
}
