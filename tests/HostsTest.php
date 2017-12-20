<?php

namespace YeTii\SiteManager;

use PHPUnit\Framework\TestCase;

class HostsTest extends TestCase
{
    const TEST_VH_STRING = '127.0.0.1       test.local
';

    public function testCanGetHostsString()
    {
        $result = Hosts::get('test');

        $this->assertEquals(self::TEST_VH_STRING, $result);
    }

    public function testCanGetHostsStringWithNoValue()
    {
        $result = Hosts::get();

        $this->assertEquals('', $result);
    }
}
