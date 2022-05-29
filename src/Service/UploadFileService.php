<?php

namespace Tlait\CarForRent\Service;

use Tlait\CarForRent\Validation\FileValidation\FileValidator;

class UploadFileService
{
    private FileValidator $fileValidator;

    /**
     * @param FileValidator $fileValidator
     */
    public function __construct(FileValidator $fileValidator)
    {
        $this->fileValidator = $fileValidator;
    }

    public function handleUpload(array $file, string $targetDir, string $typeFile, int $expectedSize)
    {
        $targetPath = $targetDir . basename($file['name']);

        $error = $this->fileValidator->Valiadte($file, $targetPath, $typeFile, $expectedSize);

        if ($error) {
            return $error;
        }
        if ($this->uploadFile($file, $targetPath)) {
            return "";
        }
        return "upload file is failed!";
    }

    /**
     * @param array $file
     * @param string $targetPath
     * @return bool
     */
    private function uploadFile(array $file, string $targetPath)
    {
        return move_uploaded_file($file["tmp_name"], $targetPath);
    }
}
