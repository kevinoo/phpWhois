<?php

/**
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2
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
 * @copyright Copyright (c) 2020 Joshua Smith
 */

namespace Handlers\TLD;

use DMS\PHPUnitExtensions\ArraySubset\Assert;
use phpWhois\Handlers\TLD\CoopHandler;
use Tests\Handlers\AbstractHandler;

/**
 * CoopHandlerTest.
 *
 * @internal
 * @coversNothing
 */
class CoopHandlerTest extends AbstractHandler
{
    /**
     * @var CoopHandler
     */
    protected $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new CoopHandler();
        $this->handler->deepWhois = false;
    }

    /**
     * @test
     * @throws \Exception
     */
    public function parseSmileDotCoop(): void
    {
        $query = 'smile.coop';

        $fixture = $this->loadFixture($query);
        $data = [
            'rawdata' => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain' => [
                'name' => 'smile.coop',
                'handle' => 'D7878757-CNIC',
                'changed' => '2024-12-28',
                'created' => '2001-07-10',
                'expires' => '2026-01-30',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }

    /**
     * @test
     * @throws \Exception
     */
    public function parseNicDotCoop(): void
    {
        $query = 'nic.coop';

        $fixture = $this->loadFixture($query);
        $data = [
            'rawdata' => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain' => [
                'name' => 'nic.coop',
                'handle' => 'DO_59f76c35d72c849fba8b632e12102b0d-COOP',
                'changed' => '2024-02-26',
                'created' => '2022-11-07',
                'expires' => '2032-11-07',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }

    /**
     * @test
     * @throws \Exception
     */
    public function parseDomainsDotCoop(): void
    {
        $query = 'domains.coop';

        $fixture = $this->loadFixture($query);
        $data = [
            'rawdata' => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain' => [
                'name' => 'domains.coop',
                'handle' => 'D7881481-CNIC',
                'changed' => '2024-06-02',
                'created' => '2002-07-09',
                'expires' => '2029-07-09',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }
}
