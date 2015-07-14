<?php
namespace Taikom\Request\Media\Type;


interface MediaType
{
    public function fetchFileId(array $teleResponse);

    public function getPath();
}