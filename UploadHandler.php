<?php

require './models/FileUploadService.php';
require './includes/functions.php';
$max_size = 10485760;
$target_directory = __DIR__ . "/resources/files";

$allowedTypes = [
    'application/pdf' => 'pdf',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx'
];
if (isset($_FILES['myFile'])) {
    try {
        $uploadService = new FileUploadService();
        $uploadService->setMaxSize($max_size);
        $uploadService->setFileTypes($allowedTypes);
        $uploadService->setTargetDirectory($target_directory);

        $tmp_name = $_FILES['myFile']['tmp_name'];
        $file_name = $_FILES['myFile']['name'];
        // 1. Check file size
        if (!$uploadService->isValidFileSize($tmp_name)) {
            $_SESSION['error'] = "File size should not be larger than 10MB.";
            echo "File size should not be larger than 10MB.";
            return;
        }

        // 2. Check file type
        $file_type = $uploadService->getFileType($tmp_name);
        if (!$uploadService->isAllowedFileType($file_type)) {
            $_SESSION['error'] = "File type is not allowed.";
            echo "File type is not allowed.";
            return;
        }

        // 3. Generate unique file name
        $new_filename = $uploadService->generateUniqueName($file_name);

        // 4. Move the file to target directory
        $uploadService->moveFileToTargetDirectory($tmp_name, $new_filename, $file_type);

        echo 'Upload Success';
    } catch (Exception $ex) {
        echo "Internal server error: " . $ex->getMessage();
    }
}
