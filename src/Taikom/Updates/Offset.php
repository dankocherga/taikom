<?php
namespace Taikom\Updates;

class Offset
{
    private $file;

    public function __construct()
    {
        $this->file = 'var/taikom.offset';
    }

    public function update($updateId)
    {
        file_put_contents($this->file, $updateId);
    }

    public function get()
    {
        if (!file_exists($this->file)) {
            return null;
        }

        return (int) file_get_contents($this->file) + 1;
    }
}