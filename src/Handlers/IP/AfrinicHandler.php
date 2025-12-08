<?php

/**
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2
 * @license
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 * @see http://phpwhois.pw
 * @copyright Copyright (C)1999,2005 easyDNS Technologies Inc. & Mark Jeftovic
 * @copyright Maintained by David Saez
 * @copyright Copyright (c) 2014 Dmitry Lukashin
 */

namespace phpWhois\Handlers\IP;

use phpWhois\Handlers\AbstractHandler;

class AfrinicHandler extends AbstractHandler
{
    public $deepWhois = false;

    public function parse($data_str, $query): array
    {
        $translate = [
            'fax-no' => 'fax',
            'e-mail' => 'email',
            'nic-hdl' => 'handle',
            'person' => 'name',
            'netname' => 'name',
            'organisation' => 'handle',
            'org-name' => 'organization',
            'org-type' => 'type',
        ];

        $contacts = [
            'admin-c' => 'admin',
            'tech-c' => 'tech',
            'org' => 'owner',
        ];

        $r = static::generic_parser_a($data_str, $translate, $contacts, 'network', 'Ymd');

        if (isset($r['network']['descr'])) {
            $r['owner']['organization'] = $r['network']['descr'];
            unset($r['network']['descr']);
        }

        if (isset($r['owner']['remarks']) && is_array($r['owner']['remarks'])) {
            foreach ($r['owner']['remarks'] as $val) {
                $pos = strpos($val, 'rwhois://');

                if ($pos !== false) {
                    $r['rwhois'] = strtok(substr($val, $pos), ' ');
                }
            }
        }

        $r = ['regrinfo' => $r];
        $r['regyinfo']['type'] = 'ip';
        $r['regyinfo']['registrar'] = 'African Network Information Center';

        return $r;
    }
}
