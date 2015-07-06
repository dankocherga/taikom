<?php
namespace Taikom\Request;

use Zend\Http\Client;

class RequestFactory
{
    private $botId;
    private $log;

    public function __construct($botId, \Zend\Log\Logger $log)
    {
        $this->botId = $botId;
        $this->log = $log;
    }

    public function get($endpoint, $params = [], $clientOptions = [])
    {
        $client = $this->client($endpoint, $clientOptions);
        $request = new Request($client, $this->log);

        $this->addRequestParams($request, $client->getRequest()->getQuery(), $params);

        return $request;
    }

    public function post($endpoint, $params = [], $clientOptions = [])
    {
        $client = $this->client($endpoint, $clientOptions);
        $client->setMethod('post');
        $request = new Request($client, $this->log);

        $this->addRequestParams($request, $client->getRequest()->getPost(), $params);

        return $request;
    }

    private function client($endpoint, $clientOptions)
    {
        $client = new Client("https://api.telegram.org/bot{$this->botId}/{$endpoint}", $clientOptions);
        return $client;
    }

    private function addRequestParams($request, $requestParams, $params)
    {
        foreach ($params as $key => $value) {
            if ($value instanceof RequestParameter) {
                $value->addToRequest($request, $key);
            } else {
                $requestParams->set($key, $value);
            }
        }
    }
}