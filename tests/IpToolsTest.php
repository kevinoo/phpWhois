<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use phpWhois\IpTools;

/**
 * @internal
 * @coversNothing
 */
class IpToolsTest extends TestCase
{
    /**
     * @dataProvider validIpsProvider
     * @param mixed $ip
     */
    public function testValidIp($ip)
    {
        $ipTools = new IpTools();
        $this->assertTrue($ipTools->validIp($ip));
    }

    public function validIpsProvider()
    {
        return [
            ['123.123.123.123'],
            ['1a80:1f45::ebb:12'],
        ];
    }

    /**
     * @dataProvider invalidIpsProvider
     * @param mixed $ip
     */
    public function testInvalidIp($ip)
    {
        $ipTools = new IpTools();
        $this->assertFalse($ipTools->validIp($ip));
    }

    public function invalidIpsProvider()
    {
        return [
            [''],
            ['169.254.255.200'],
            ['172.17.255.100'],
            ['123.a15.255.100'],
            ['fd80::1'],
            ['fc80:19c::1'],
            ['1a80:1f45::ebm:12'],
            ['[1a80:1f45::ebb:12]'],
        ];
    }
}
