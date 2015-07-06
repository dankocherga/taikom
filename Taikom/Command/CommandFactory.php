<?php
namespace Taikom\Command;

use Zend\Log\Logger;

class CommandFactory
{
    public static function factory($command, Logger $log)
    {
        if (preg_match('/^\/(.*)\s*(.*)/', $command, $matches)) {
            $commandName = $matches[1];
            $log->notice("Recognized command '{$commandName}'");

            $className = '\Taikom\Command\Custom\\' . ucfirst($commandName);

            if (class_exists($className)) {
                $class = new $className($log);
                if ($class instanceof \Taikom\Command\CommandInterface) {
                    return $class;
                }
            }
        }

        return new Null();
    }
}