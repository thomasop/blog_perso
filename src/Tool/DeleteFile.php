<?php

namespace App\Tool;

class DeleteFile
{
    /**
     * Function for delete picture in directory
     *
     * @param string $name
     * @return void
     */
    public function delete($name): void
    {
        $filename = "../public/uploads/avatar/";
        if (file_exists($filename . $name)) {
            unlink($filename . $name);
        }
    }
}