<?php
namespace Taikom\Request\Media\RequestParameter;

use Taikom\Request\Media\FileInfo;
use Taikom\Request\Media\Type\MediaType;

class ParameterFactory
{
    public static function create(MediaType $media)
    {
        $fileInfo = new FileInfo($media->getPath());
        if ($id = $fileInfo->getTelegramId()) {
            return new FileId($id);
        } else {
            return new FileUpload($media, $fileInfo);
        }
    }
}