<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['files'])) {
        $uploadDir = 'uploads/'; // تأكد من أن هذا هو المجلد الذي ترغب في رفع الملفات إليه
        foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $uploadDir . $fileName;
            move_uploaded_file($tmpName, $targetFilePath);
        }
        echo "تم رفع الملفات بنجاح.";
    }
}
?>
