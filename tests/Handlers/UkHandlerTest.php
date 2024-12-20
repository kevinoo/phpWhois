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
 *
 * @copyright Copyright (c) 2020 Joshua Smith
 */

namespace Tests\Handlers;

use DMS\PHPUnitExtensions\ArraySubset\Assert;
use phpWhois\Handlers\UkHandler;

/**
 * UkHandlerTest
 */
class UkHandlerTest extends AbstractHandler
{
    /**
     * @var UkHandler $handler
     */
    protected $handler;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->handler            = new UkHandler();
        $this->handler->deepWhois = false;
    }

    /**
     * @return void
     *
     * @test
     */
    public function parseVibrantDigitalFutureDotUk()
    {
        $query = 'vibrantdigitalfuture.uk';

        $fixture = $this->loadFixture($query);
        $data    = [
            "rawdata"  => $fixture,
            "regyinfo" => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain'     => [
				'created' => '2024-10-24',
				'expires' => '2025-10-24',
				'changed' => '2024-11-05',
            ],
            'registered' => 'no',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }

    /**
     * @return void
     *
     * @test
     */
    public function parseGoogleDotCoDotUk()
    {
        $query = 'google.co.uk';

        $fixture = $this->loadFixture($query);
        $data    = [
            "rawdata"  => $fixture,
            "regyinfo" => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain'     => [
                // 'name'    => 'google.co.uk',
                'created' => '1999-02-14',
				'changed' => '2024-01-13',
				'expires' => '2025-02-14',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }

    /**
     * @return void
     *
     * @test
     */
    public function parseOlsnsDotCoDotUk()
    {
        $query = 'olsns.co.uk';

        $fixture = $this->loadFixture($query);
        $data    = [
            "rawdata"  => $fixture,
            "regyinfo" => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain'     => [
                // 'name'    => 'olsns.co.uk',
                'created' => '2001-02-21',
				'changed' => '2024-02-18',
				'expires' => '2025-02-21',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }
}
