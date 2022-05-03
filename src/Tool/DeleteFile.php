<?php

namespace App\Tool;

class DeleteFile
{
    public function delete($name): void
    {
        $filename = "../public/uploads/avatar/";
        if (file_exists($filename . $name)) {
            unlink($filename . $name);
        }
    }
}
