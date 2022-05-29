<?php

namespace Tlait\CarForRent\Validation\FileValidation;

abstract class AbstractFileValidation
{
    protected $file;

    /**
     * @param $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @param string $targetPath
     * @return string
     */
    public function checkFileExist(string $targetPath)
    {
        if (file_exists($targetPath)) {
            return "Sorry, file already exists!";
        }
        return "";
    }

    /**
     * @param int $expectSize
     * @return string
     */
    public function checkFileSize(int $expectSize)
    {
        if ($this->file['size'] > $expectSize) {
            return "Sorry, your file is too large!";
        }
        return "";
    }

    abstract public function checkFileFormat(string $targetPath);
}
