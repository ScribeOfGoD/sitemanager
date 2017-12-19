<?php

namespace YeTii\SiteManager;

class Hosts
{
    const ERROR_UNABLE_TO_ADD = 'Unable to add the specified vhost.';
    const ERROR_UNABLE_TO_REMOVE = 'Unable to remove the specified vhost.';

    public static function get(string $n1 = null)
    {
        return !is_null($n1) ?
            <<<TXT
127.0.0.1       {$n1}.local

TXT
            : '';
    }
}
