<?php

/**
 * @copyright Copyright (c) 2020 Joshua Smith
 * @license   See LICENSE file
 */

namespace phpWhois\Handlers;

/**
 * HandlerInterface.
 */
interface HandlerInterface
{
    public function parse(array $data_str, string $query): array;
}
