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

date_default_timezone_set('GMT'); // For logs, etc
$log = new \Zend\Log\Logger();
$log->addWriter(new Zend\Log\Writer\Stream('php://output'));

(new \Taikom\Updates\Poll($config, $log))->start();
