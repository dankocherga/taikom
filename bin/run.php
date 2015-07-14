<?php
chdir(dirname(__DIR__));

require_once 'vendor/autoload.php';

\Zend\Loader\AutoloaderFactory::factory([
    'Zend\Loader\StandardAutoloader' => array(
        'namespaces' => array(
            'Taikom' => 'src/Taikom',
        ),
    )
]);


$config = new \Zend\Config\Config(
    (new \Zend\Config\Reader\Json())->fromFile('etc/taikom.json')
);


$log = new \Zend\Log\Logger();
$logWriter = new \Zend\Log\Writer\Stream('php://output');
if (array_search('--debug', $argv) === false) {
    $logWriter->addFilter(new \Zend\Log\Filter\Priority(\Zend\Log\Logger::INFO));
}
$log->addWriter($logWriter);


if (array_search('--purge', $argv) !== false) {
    $commandFactory = new \Taikom\Command\CommandFactory\PurgeCommandFactory();
} else {
    $commandFactory = new \Taikom\Command\CommandFactory\UserCommandFactory();
}


(new \Taikom\Updates\Poll($config, $log, $commandFactory))->start();