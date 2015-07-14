<?php
namespace Taikom\Command\CommandFactory;

use Zend\Log\Logger;

class UserCommandFactory implements CommandFactoryInterface
{
    public static function create($command, Logger $log)
    {
        if (preg_match('/^\/([a-z]*)\s*(.*)$/', $command, $matches)) {
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

        return new \Taikom\Command\Null();
    }
}