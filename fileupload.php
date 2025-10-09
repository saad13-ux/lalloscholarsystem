<?php
// require './includes/functions.php';
// // https://dev.to/einlinuus/how-to-upload-files-with-php-correctly-and-securely-1kng
// if (isset($_FILES['myFile'])) {
//     // Check if there is a file
//     if (!isset($_FILES["myFile"])) {
//         die("There is no file to upload.");
//     }

//     // Get file size and type from the actual file
//     $tmp_name = $_FILES['myFile']['tmp_name'];
//     $fileSize = filesize($tmp_name);
//     $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
//     $filetype = finfo_file($fileinfo, $tmp_name);

//     // Check file size
//     if ($fileSize === 0) {
//         die("The file is empty.");
//     }

//     if ($fileSize > 10485760) { // 10 MB (1 byte * 1024 * 1024 * 10 (for 10 MB))
//         die("The file is too large");
//     }

//     // Declare array of allowed file types to be able to append to filename later
//     // Source: https://wiki.selfhtml.org/wiki/MIME-Type/%C3%9Cbersicht
//     $allowedTypes = [
//         'image/png' => 'png',
//         'image/jpeg' => 'jpg',
//         'image/gif' => 'gif',
//         'image/svg+xml' => 'svg',
//         'application/pdf' => 'pdf',
//         'application/vnd.openxmlformats-officedocument. wordprocessingml.document' => 'docx'
//     ];

//     // Check if file type is allowed
//     if (!in_array($filetype, array_keys($allowedTypes))) {
//         die("File not allowed.");
//     }

//     $filename = time() . '_' . str_replace(" ", "", explode(".", basename($_FILES['myFile']['name']))[0]);
//     $extension = $allowedTypes[$filetype];
//     $targetDirectory = __DIR__ . "/resources/images"; // __DIR__ is the directory of the current PHP file

//     $newFilepath = $targetDirectory . "/" . $filename . "." . $extension;


//     if (!copy($tmp_name, $newFilepath)) { // Copy the file, returns false if failed
//         die("Can't move file.");
//     }
//     unlink($tmp_name); // Delete the temp file

//     echo "File uploaded successfully :)";
// }


?>



<form method="post" action="UploadHandler.php" enctype="multipart/form-data">
    <input type="file" name="myFile" />
    <input type="file" name="OtherFile" />
    <input type="file" name="NewFile" />
    <input type="submit" name="upload" value="Upload">
</form>