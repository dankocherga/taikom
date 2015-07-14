<?php
namespace Taikom\Command\CommandFactory;

use Zend\Log\Logger;

interface CommandFactoryInterface
{
    public static function create($command, Logger $log);
}