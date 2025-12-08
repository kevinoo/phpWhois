<?php

/**
 * @copyright Copyright (c) 2020 Joshua Smith
 * @license   See LICENSE file
 */

namespace Handlers\TLD;

use DMS\PHPUnitExtensions\ArraySubset\Assert;
use phpWhois\Handlers\TLD\DeHandler;
use Tests\Handlers\AbstractHandler;

/**
 * DeHandlerTest.
 *
 * @internal
 * @coversNothing
 */
class DeHandlerTest extends AbstractHandler
{
    /**
     * @var DeHandler
     */
    protected $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new DeHandler();
        $this->handler->deepWhois = false;
    }

    /**
     * @test
     */
    public function parse4EverDotDe()
    {
        $query = '4ever.de';

        $fixture = $this->loadFixture($query);
        $data = [
            'rawdata' => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain' => [
                'name' => '4ever.de',
                'nserver' => [
                    0 => 'ns1.detebe.org',
                    1 => 'ns2.detebe.org',
                    2 => 'ns.4ever.de 193.200.137.137',
                    3 => 'ns.does.not-exist.de',
                ],
                'status' => 'connect',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }

    /**
     * @test
     */
    public function parseGoogleDotDe()
    {
        $query = 'google.de';

        $fixture = $this->loadFixture($query);
        $data = [
            'rawdata' => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain' => [
                'name' => 'google.de',
                'nserver' => [
                    0 => 'ns1.google.com',
                    1 => 'ns2.google.com',
                    2 => 'ns3.google.com',
                    3 => 'ns4.google.com',
                ],
                'status' => 'connect',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }

    /**
     * @test
     */
    public function parseDenicDotDe()
    {
        $query = 'denic.de';

        $fixture = $this->loadFixture($query);
        $data = [
            'rawdata' => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain' => [
                'name' => 'denic.de',
                'nserver' => [
                    0 => 'ns1.denic.de 77.67.63.106 2001:668:1f:11:0:0:0:106',
                    1 => 'ns2.denic.de 81.91.164.6 2a02:568:0:2:0:0:0:54',
                    2 => 'ns3.denic.de 195.243.137.27 2003:8:14:0:0:0:0:106',
                    3 => 'ns4.denic.net',
                ],
                'status' => 'connect',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }

    /**
     * @test
     */
    public function parseDomainInConnectStatus()
    {
        $query = 'humblebundle.de';

        $fixture = $this->loadFixture($query);
        $data = [
            'rawdata' => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain' => [
                'name' => 'humblebundle.de',
                'nserver' => [
                    0 => 'ns1.redirectdom.com',
                    1 => 'ns2.redirectdom.com',
                ],
                'status' => 'connect',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }

    /**
     * @test
     */
    public function parseDomainInFreeStatus()
    {
        $query = 'a2ba91bff88c6983f6af010c41236206df64001d.de';

        $fixture = $this->loadFixture($query);
        $data = [
            'rawdata' => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain' => [
                'name' => 'a2ba91bff88c6983f6af010c41236206df64001d.de',
            ],
            'registered' => 'no',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }
}
