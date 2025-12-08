<?php

/**
 * @copyright Copyright (c) 2020 Joshua Smith
 * @license   See LICENSE file
 */

namespace Tests\Handlers;

use DMS\PHPUnitExtensions\ArraySubset\Assert;
use phpWhois\Handlers\TLD\BizHandler;

/**
 * BizHandlerTest.
 *
 * @internal
 * @coversNothing
 */
class BizHandlerTest extends AbstractHandler
{
    /**
     * @var BizHandler
     */
    protected $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new BizHandler();
        $this->handler->deepWhois = false;
    }

    /**
     * @test
     */
    public function parseNeulevelDotBiz()
    {
        $query = 'neulevel.biz';

        $fixture = $this->loadFixture($query);
        $data = [
            'rawdata' => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain' => [
                'name' => 'neulevel.biz',
                'changed' => '2025-10-24',
                'created' => '2001-09-30',
                'expires' => '2025-11-06',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }
}
