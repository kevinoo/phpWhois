<?php

/**
 * @copyright Copyright (c) 2020 Joshua Smith
 * @license   See LICENSE file
 */

namespace Tests\Handlers;

use DMS\PHPUnitExtensions\ArraySubset\Assert;
use phpWhois\Handlers\TLD\AuHandler;

/**
 * AuHandlerTest.
 *
 * @internal
 * @coversNothing
 */
class AuHandlerTest extends AbstractHandler
{
    /**
     * @var AuHandler
     */
    protected $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new AuHandler();
        $this->handler->deepWhois = false;
    }

    /**
     * @test
     */
    public function parseTelstraDotComDotAu()
    {
        $query = 'telstra.com.au';

        $fixture = $this->loadFixture($query);
        $data = [
            'rawdata' => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain' => [
                'name' => 'telstra.com.au',
                'changed' => '2025-05-10',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }
}
