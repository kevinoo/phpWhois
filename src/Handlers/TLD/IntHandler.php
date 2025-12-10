<?php

/**
 * @license   See LICENSE file
 * @copyright Copyright (C)1999,2005 easyDNS Technologies Inc. & Mark Jeftovic
 * @copyright Maintained by David Saez
 * @copyright Copyright (c) 2014 Dmitry Lukashin
 * @copyright Copyright (c) 2023 Kevin Lucich
 */

namespace phpWhois\Handlers\TLD;

use phpWhois\Handlers\AbstractHandler;
use phpWhois\Handlers\gTLD\IanaHandler;

class IntHandler extends AbstractHandler
{
    public function parse(array $data_str, string $query): array
    {
        return [
            'regrinfo' => (new IanaHandler())->parse($data_str['rawdata'], $query),
            'regyinfo' => [
                'referrer' => 'https://www.iana.org/domains/int',
                'registrar' => 'Internet Assigned Numbers Authority',
            ]
        ];
    }
}
