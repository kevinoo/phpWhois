<?php

namespace Tests\Handlers\TLD;

use DMS\PHPUnitExtensions\ArraySubset\Assert;
use phpWhois\Handlers\TLD\AccountantHandler;
use Tests\Handlers\AbstractHandler;

class AccountantHandlerTest extends AbstractHandler
{
    /**
     * @var AccountantHandler
     */
    protected $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new AccountantHandler();
        $this->handler->deepWhois = false;
    }

    /**
     * @test
     */
    public function nsaveAccountantTest()
    {
        $query = 'nsave.accountant';

        $data = [
            'rawdata' => $this->loadFixture($query),
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data,$query);


        $expected = [
            'domain' => [
                'name' => 'nsave.accountant',
                'created' => '2022-10-12',
                'sponsor' => 'Squarespace Domains II LLC',
            ],
            'owner' => [
                'organization' => 'Masref',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
    }
}
