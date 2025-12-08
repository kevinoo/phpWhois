<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use phpWhois\Whois;

/**
 * Created by PhpStorm.
 * User: dreamlex
 * Date: 22.08.16
 * Time: 12:35.
 *
 * @internal
 * @coversNothing
 */
class ip_handlerTest extends TestCase
{
    public function testParseIp()
    {
        $ipHandler = new Whois();
        $result = $ipHandler->lookup('216.58.209.195');
        self::assertTrue(is_array($result));
    }
}
