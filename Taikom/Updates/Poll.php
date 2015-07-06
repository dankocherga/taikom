<?php
namespace Taikom\Updates;

use Taikom\Command\CommandFactory;
use Taikom\Message;
use Taikom\Request\RequestFactory;
use Zend\Config\Config;
use Zend\Log\Logger;

class Poll
{
    private $config;
    private $offset;
    private $log;

    public function __construct(Config $config, Logger $log)
    {
        $this->config = $config;
        $this->offset = new Offset();
        $this->log = $log;
    }

    public function start()
    {
        $this->log->info('Started updates polling');
        while (true) {
            $this->fetchUpdates();
        }
    }

    private function fetchUpdates()
    {
        $requestFactory = new RequestFactory($this->config->get('bot_id'), $this->log);

        $result = $requestFactory
            ->get(
                'getUpdates',
                ['offset' => $this->offset->get(), 'timeout' => $this->config->get('poll_timeout')],
                ['timeout' => $this->config->get('poll_timeout') + 5] // plus 5 seconds to HTTP client timeout
            )->send()['result'];

        foreach ($result as $update) {
            if (isset($update['message'])) {
                $message = new Message($update['message']);
                $command = CommandFactory::factory($message->getText(), $this->log);
                $command->exec($message, $requestFactory);
            }

            $this->offset->update($update['update_id']);
        }
    }
}