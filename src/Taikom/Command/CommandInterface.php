<?php
namespace Taikom\Command;

interface CommandInterface
{
    public function exec(\Taikom\Message $message, \Taikom\Request\RequestFactory $requestFactory);
}