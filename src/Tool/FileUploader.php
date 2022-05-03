<?php

namespace App\Tool;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    /**
     * @var SluggerInterface
     */
    private $slugger;
    /**
     * @var $targetDirectory
     */
    private $targetDirectory;

    public function __construct($targetDirectory, SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * Function for upload image
     *
     * @param UploadedFile $file
     * @return void
     */
    public function upload(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
        try {
            $file->move(
                $this->getTargetDirectory(),
                $newFilename
            );
        } catch (FileException $e) {
        }
        return $newFilename;
    }

    /**
     * Function get directory image in config/services.yaml
     *
     * @return void
     */
    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}