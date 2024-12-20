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
 *
 * @link http://phpwhois.pw
 * @copyright Copyright (C)1999,2005 easyDNS Technologies Inc. & Mark Jeftovic
 * @copyright Maintained by David Saez
 * @copyright Copyright (c) 2014 Dmitry Lukashin
 */

if (!defined('__ARIN_HANDLER__')) {
    define('__ARIN_HANDLER__', 1);
}

require_once 'whois.parser.php';

class arin_handler
{
	// FIXME. This is a temporary fix :-(
	public $deepWhois = false;

    function parse($data_str, $query)
    {
        $items = array(
            'OrgName:' => 'owner.organization',
            'CustName:' => 'owner.organization',
            'OrgId:' => 'owner.handle',
            'Address:' => 'owner.address.street.',
            'City:' => 'owner.address.city',
            'StateProv:' => 'owner.address.state',
            'PostalCode:' => 'owner.address.pcode',
            'Country:' => 'owner.address.country',
            'NetRange:' => 'network.inetnum',
            'NetName:' => 'network.name',
            'NetHandle:' => 'network.handle',
            'NetType:' => 'network.status',
            'NameServer:' => 'network.nserver.',
            'Comment:' => 'network.desc.',
            'RegDate:' => 'network.created',
            'Updated:' => 'network.changed',
            'ASHandle:' => 'network.handle',
            'ASName:' => 'network.name',
            'TechHandle:' => 'tech.handle',
            'TechName:' => 'tech.name',
            'TechPhone:' => 'tech.phone',
            'TechEmail:' => 'tech.email',
            'OrgAbuseName:' => 'abuse.name',
            'OrgAbuseHandle:' => 'abuse.handle',
            'OrgAbusePhone:' => 'abuse.phone',
            'OrgAbuseEmail:' => 'abuse.email.',
            'ReferralServer:' => 'rwhois'
        );

        $r = generic_parser_b($data_str, $items, 'ymd', false, true);

        if (@isset($r['abuse']['email'])) {
            $r['abuse']['email'] = implode(',', $r['abuse']['email']);
        }

        return array('regrinfo' => $r);
    }
}
