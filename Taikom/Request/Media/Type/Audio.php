<?php
namespace Taikom\Request\Media\Type;


class Audio implements MediaType
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function fetchFileId(array $teleResponse)
    {
        return isset($teleResponse['result']['audio']) ? $teleResponse['result']['audio']['file_id'] : null;
    }

    public function getPath()
    {
        return 'media/' . $this->path;
    }
}