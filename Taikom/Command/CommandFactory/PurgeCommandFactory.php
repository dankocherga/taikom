<?php
namespace Taikom\Command\CommandFactory;

use Zend\Log\Logger;

class PurgeCommandFactory implements CommandFactoryInterface
{
    public static function create($command, Logger $log)
    {
        $log->info("Purge for command: {$command}");
        return new \Taikom\Command\Null();
    }
}