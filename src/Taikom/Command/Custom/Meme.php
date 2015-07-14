<?php
namespace Taikom\Command\Custom;

use Taikom\Command\CommandInterface;
use Taikom\Message;
use Taikom\Request\Media\RequestParameter\ParameterFactory as ParameterFactory;
use Taikom\Request\Media\Type\Audio;
use Taikom\Request\RequestFactory;

class Meme implements CommandInterface
{
    public function exec(Message $message, RequestFactory $requestFactory)
    {
        $requestFactory->post(
            'sendAudio', [
                'chat_id' => $message->getChatId(),
                'audio'   => ParameterFactory::create(new Audio('meme.ogg'))
            ]
        )->send();
    }
}