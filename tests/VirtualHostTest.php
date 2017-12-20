<?php

namespace YeTii\SiteManager;

use PHPUnit\Framework\TestCase;

class VirtualHostTest extends TestCase
{
    const TEST_VH_STRING = '<VirtualHost *:80>
    DocumentRoot "/Applications/MAMP/htdocs/test/"
    ServerName test.local
    ErrorLog "logs/test.local-error_log"
    CustomLog "logs/test.local-access_log" common
</VirtualHost>
';

    public function testCanGetVirtualHostString()
    {
        $result = VirtualHost::get('test');

        $this->assertEquals(self::TEST_VH_STRING, $result);
    }

    public function testCanGetVirtualHostStringWithNoValue()
    {
        $result = VirtualHost::get();

        $this->assertEquals('', $result);
    }
}
