<?php
require_once 'vendor/autoload.php';

\Zend\Loader\AutoloaderFactory::factory([
    'Zend\Loader\StandardAutoloader' => array(
        'namespaces' => array(
            'Taikom' => __DIR__ . '/Taikom',
        ),
    )
]);

chdir(__DIR__);

$config = new \Zend\Config\Config(
    (new \Zend\Config\Reader\Json())->fromFile('taikom.json')
);

$log = new \Zend\Log\Logger();
$log->addWriter(new Zend\Log\Writer\Stream('php://output'));

if (isset($argv[1]) && $argv[1] == '--purge') {
    $commandFactory = new \Taikom\Command\CommandFactory\PurgeCommandFactory();
} else {
    $commandFactory = new \Taikom\Command\CommandFactory\UserCommandFactory();
}
(new \Taikom\Updates\Poll($config, $log, $commandFactory))->start();
