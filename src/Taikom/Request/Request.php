<?php
namespace Taikom\Request;

class Request
{
    private $afterSendEvents = [];
    private $log;
    private $httpClient;

    public function __construct(\Zend\Http\Client $httpClient, \Zend\Log\Logger $log)
    {
        $this->httpClient = $httpClient;
        $this->log = $log;
    }

    public function send()
    {
        $this->log->debug($this->httpClient->getRequest());
        $response = $this->httpClient->send();
        $this->log->debug($response);

        $responseData = \Zend\Json\Json::decode($response->getContent(), \Zend\Json\Json::TYPE_ARRAY);

        foreach ($this->afterSendEvents as $event) {
            call_user_func($event, $responseData);
        }
        return $responseData;
    }

    public function addAfterSendEvent(callable $event)
    {
        $this->afterSendEvents[] = $event;
    }

    public function client()
    {
        return $this->httpClient;
    }
}