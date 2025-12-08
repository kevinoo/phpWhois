<?php

/**
 * @copyright Copyright (c) 2020 Joshua Smith
 * @license   See LICENSE file
 */

namespace Tests\Handlers;

use DMS\PHPUnitExtensions\ArraySubset\Assert;
use phpWhois\Handlers\TLD\KiwiHandler;

/**
 * KiwiHandlerTest.
 *
 * @internal
 * @coversNothing
 */
class KiwiHandlerTest extends AbstractHandler
{
    /**
     * @var KiwiHandler
     */
    protected $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new KiwiHandler();
        $this->handler->deepWhois = false;
    }

    /**
     * @test
     */
    public function parseHelloDotKiwi()
    {
        $query = 'hello.kiwi';

        $fixture = $this->loadFixture($query);
        $data = [
            'rawdata' => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain' => [
                'name' => 'hello.kiwi',
                'created' => '2014-02-06',
                'changed' => '2023-09-11',
                'expires' => '2026-10-31',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('regyinfo', $actual);
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }

    /**
     * @test
     */
    public function parseGoogleDotKiwi()
    {
        $query = 'google.kiwi';

        $fixture = $this->loadFixture($query);
        $data = [
            'rawdata' => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain' => [
                'name' => 'google.kiwi',
                'changed' => '2025-02-26',
                'created' => '2014-03-25',
                'expires' => '2026-03-25',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('regyinfo', $actual);
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }
}
