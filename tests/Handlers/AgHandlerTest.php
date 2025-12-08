<?php

/**
 * @license   See LICENSE file
 * @copyright Copyright (c) 2020 Joshua Smith
 */

namespace Tests\Handlers;

use DMS\PHPUnitExtensions\ArraySubset\Assert;
use phpWhois\Handlers\TLD\AgHandler;

/**
 * AgHandlerTest.
 *
 * @internal
 * @coversNothing
 */
class AgHandlerTest extends AbstractHandler
{
    /**
     * @var AgHandler
     */
    protected $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new AgHandler();
        $this->handler->deepWhois = false;
    }

    /**
     * @test
     */
    public function parseNicDotAg()
    {
        $query = 'nic.ag';

        $fixture = $this->loadFixture($query);
        $data = [
            'rawdata' => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain' => [
                'name' => 'nic.ag',
                'changed' => '2025-06-16',
                'created' => '1998-05-02',
                'expires' => '2026-05-02',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }
}
