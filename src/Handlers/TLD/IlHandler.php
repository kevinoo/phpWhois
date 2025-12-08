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

class IlHandler extends AbstractHandler
{
    public function parse(array $data_str, string $query): array
    {
        $r = [
            //            'regrinfo' => [],
            'regyinfo' => [
                'referrer' => 'https://www.isoc.org.il/',
                'registrar' => 'ISOC-IL',
            ],
            'rawdata' => $data_str['rawdata'],
        ];

        $translate = [
            'fax-no' => 'fax',
            'e-mail' => 'email',
            'nic-hdl' => 'handle',
            'person' => 'name',
            'personname' => 'name',
            'address' => 'address',
        ];

        $contacts = [
            'registrant' => 'owner',
            'admin-c' => 'admin',
            'tech-c' => 'tech',
            'billing-c' => 'billing',
            'zone-c' => 'zone',
        ];

        array_splice($data_str['rawdata'], 16, 1);
        array_splice($data_str['rawdata'], 18, 1);

        $reg = static::generic_parser_a($data_str['rawdata'], $translate, $contacts, 'domain', 'Ymd');

        if ($reg['disclaimer']) {
            unset($reg['disclaimer']);
        }

        if (isset($reg['domain']['remarks'])) {
            unset($reg['domain']['remarks']);
        }

        if (isset($reg['domain']['descr:'])) {
            foreach ($reg['domain']['descr:'] as $key => $val) {
                $v = trim(substr(strstr($val, ':'), 1));
                if (false !== strpos($val, '[organization]:')) {
                    $reg['owner']['organization'] = $v;

                    continue;
                }
                if (false !== strpos($val, '[phone]:')) {
                    $reg['owner']['phone'] = $v;

                    continue;
                }
                if (false !== strpos($val, '[fax-no]:')) {
                    $reg['owner']['fax'] = $v;

                    continue;
                }
                if (false !== strpos($val, '[e-mail]:')) {
                    $reg['owner']['email'] = $v;

                    continue;
                }

                $reg['owner']['address'][$key] = $v;
            }

            unset($reg['domain']['descr:']);
        }

        $r['regrinfo'] = $reg;

        return $r;
    }
}
