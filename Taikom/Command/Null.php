<?php
namespace Taikom\Command;

class Null implements CommandInterface
{
    public function exec(\Taikom\Message $message, \Taikom\Request\RequestFactory $requestFactory)
    {
    }
}