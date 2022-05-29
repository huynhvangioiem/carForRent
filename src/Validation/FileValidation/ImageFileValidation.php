<?php

namespace Tlait\CarForRent\Validation\FileValidation;

class ImageFileValidation extends AbstractFileValidation
{
    public function checkFileFormat(string $targetPath): string
    {
        $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));

        if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
            return "Sorry, only JPG, JPEG, PNG files are allowed.";
        }
        return "";
    }

    public function checkActualImage(): string
    {
        if (getimagesize($this->file["tmp_name"]) === false) {
            return "File is not an image!";
        }
        return "";
    }
}
