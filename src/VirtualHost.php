<?php

namespace YeTii\SiteManager;

class VirtualHost
{
    const ERROR_UNABLE_TO_ADD = 'Unable to add the specified vhost.';
    const ERROR_UNABLE_TO_REMOVE = 'Unable to remove the specified vhost.';

    public static function get(string $n1 = null, string $n2 = '')
    {
        return !is_null($n1) ?
            <<<TXT
<VirtualHost *:80>
    DocumentRoot "/Applications/MAMP/htdocs/{$n1}/{$n2}"
    ServerName {$n1}.local
    ErrorLog "logs/{$n1}.local-error_log"
    CustomLog "logs/{$n1}.local-access_log" common
</VirtualHost>

TXT
            : '';
    }
}
