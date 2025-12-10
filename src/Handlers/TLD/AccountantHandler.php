<?php

/**
 * @copyright Copyright (c) 2025 Kevin Lucich
 */

namespace phpWhois\Handlers\TLD;

use phpWhois\Handlers\AbstractHandler;

class AccountantHandler extends AbstractHandler
{
    public function parse(array $data_str, string $query): array
    {
        return [
            'regrinfo' => static::generic_parser_b($data_str['rawdata']),
            'regyinfo' => $this->parseRegistryInfo($data_str['rawdata']) ?? [],
            'rawdata' => $data_str['rawdata'],
        ];
    }
}
