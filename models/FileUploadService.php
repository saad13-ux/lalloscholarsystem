<?php

class FileUploadService
{
    private int $max_size = 10485760;
    private string $target_directory;
    private array $allowed_types;

    public function setFileTypes(array $types)
    {
        $this->allowed_types = $types;
    }

    public function setMaxSize($max_size)
    {
        $this->max_size = $max_size;
    }

    public function setTargetDirectory(string $target_directory)
    {
        $this->target_directory = $target_directory;
    }

    public function generateUniqueName($filename)
    {
        return time() . '_' . str_replace(" ", "", explode(".", basename($filename))[0]);
    }

    public function isValidFileSize($tmp_name)
    {
        $fileSize = filesize($tmp_name);
        if ($fileSize === 0) {
            return false;
        }

        if ($fileSize > $this->max_size) { // 10 MB (1 byte * 1024 * 1024 * 10 (for 10 MB))
            return false;
        }

        return true;
    }

    public function isAllowedFileType($file_type)
    {
        if (!in_array($file_type, array_keys($this->allowed_types))) {
            return false;
        }
        return true;
    }

    public function getFileType($tmp_file)
    {
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        return finfo_file($fileinfo, $tmp_file);
    }

    public function getFileExtension($mime_type)
    {
        return $this->allowed_types[$mime_type];
    }

    public function moveFileToTargetDirectory($tmp_file, $new_filename, $filetype)
    {
        $extension = $this->allowed_types[$filetype];
        $newFilepath = $this->target_directory . "/" . $new_filename . "." . $extension;

        if (!copy($tmp_file, $newFilepath)) { // Copy the file, returns false if failed
            die("Can't move file.");
        }
        unlink($tmp_file); // Delete the temp file
    }

    public function deleteFile(string $filename, string $extension)
    {
        $file_path = $this->target_directory . "/" . $filename . "." . $extension;
        unlink($file_path);
    }
}
