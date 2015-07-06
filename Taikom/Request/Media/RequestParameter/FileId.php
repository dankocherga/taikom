<?php
namespace Taikom\Request\Media\RequestParameter;

use Taikom\Request\RequestParameter;

class FileId implements RequestParameter
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function addToRequest(\Taikom\Request\Request $request, $key)
    {
        $request->client()->getRequest()->getPost()->set($key, $this->id);
    }
}