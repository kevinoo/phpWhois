<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use phpWhois\Whois;

/**
 * @internal
 * @coversNothing
 */
class WhoisTest extends TestCase
{
    public function testWhois()
    {
        $whois = new Whois();
        $result = $whois->lookup('google.com');
        $this->assertEquals('yes', $result['regrinfo']['registered']);
    }

    /**
     * @dataProvider domainsProvider
     * @param mixed $type
     * @param mixed $domain
     */
    public function testQtype($type, $domain)
    {
        $whois = new Whois();
        $this->assertEquals($type, $whois->getQueryType($domain));
    }

    public function domainsProvider()
    {
        return [
            [Whois::QTYPE_DOMAIN, 'www.google.com'],
            [Whois::QTYPE_DOMAIN, 'президент.рф'],
            [Whois::QTYPE_IPV4, '212.212.12.12'],
            [Whois::QTYPE_UNKNOWN, '127.0.0.1'],
            [Whois::QTYPE_IPV6, '1a80:1f45::ebb:12'],
            [Whois::QTYPE_UNKNOWN, 'fc80:19c::1'],
            [Whois::QTYPE_AS, 'ABCD_EF-GH:IJK'],
        ];
    }
}
