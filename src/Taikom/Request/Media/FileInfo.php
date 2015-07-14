<?php

namespace Taikom\Request\Media;


class FileInfo
{
    private $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function getTelegramId()
    {
        if (file_exists($this->idFile())) {
            return file_get_contents($this->idFile());
        }
        return null;
    }

    public function saveTelegramId($id)
    {
        return file_put_contents($this->idFile(), $id);
    }

    private function idFile()
    {
        return
            'var/' .
            preg_replace('/\W/', '_', $this->filePath) . '.id';
    }
}