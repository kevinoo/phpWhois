<?php

/**
 * @copyright Copyright (c) 2020 Joshua Smith
 * @license   See LICENSE file
 */

namespace Tests\Handlers;

use DMS\PHPUnitExtensions\ArraySubset\Assert;
use phpWhois\Handlers\TLD\BrHandler;

/**
 * BrHandlerTest.
 *
 * @internal
 * @coversNothing
 */
class BrHandlerTest extends AbstractHandler
{
    /**
     * @var BrHandler
     */
    protected $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new BrHandler();
        $this->handler->deepWhois = false;
    }

    /**
     * @test
     */
    public function parseRegistroDotBr()
    {
        $query = 'registro.br';

        $fixture = $this->loadFixture($query);
        $data = [
            'rawdata' => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain' => [
                'name' => 'registro.br',
                'changed' => '2018-04-02',
                'created' => '1999-02-21',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }
}
