<?php
namespace Taikom\Request\Media\RequestParameter;

use Taikom\Request\Media\Type\MediaType;
use Taikom\Request\RequestParameter;

class FileUpload implements RequestParameter
{
    private $media;
    private $fileInfo;

    public function __construct(MediaType $media, \Taikom\Request\Media\FileInfo $fileInfo)
    {
        $this->media = $media;
        $this->fileInfo = $fileInfo;
    }

    public function addToRequest(\Taikom\Request\Request $request, $key)
    {
        $request->client()->setFileUpload($this->media->getPath(), $key);

        $request->addAfterSendEvent(function($response) {
            $this->fileInfo->saveTelegramId($this->media->fetchFileId($response));
        });
    }
}