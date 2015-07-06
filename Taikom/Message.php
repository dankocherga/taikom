<?php
namespace Taikom;


class Message
{
    private $teleMessage;

    public function __construct(array $teleMessage)
    {
        $this->teleMessage = $teleMessage;
    }

    public function getChatId()
    {
        return $this->teleMessage['chat']['id'];
    }

    public function getText()
    {
        if (isset($this->teleMessage['text'])) {
            return $this->teleMessage['text'];
        }
        return null;
    }
}