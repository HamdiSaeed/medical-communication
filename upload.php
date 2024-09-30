<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = 'YOUR_GITHUB_TOKEN'; // استبدل هذا بالتوكن الخاص بك
    $repo = 'YOUR_USERNAME/YOUR_REPO'; // استبدل هذا باسم المستخدم واسم المستودع الخاص بك
    $filePath = $_FILES['file']['name']; // اسم الملف الذي تم رفعه
    $fileContent = base64_encode(file_get_contents($_FILES['file']['tmp_name'])); // محتوى الملف مشفر

    $url = "https://api.github.com/repos/$repo/contents/$filePath";

    $data = [
        'message' => 'Upload file via website',
        'content' => $fileContent,
    ];

    $options = [
        'http' => [
            'header' => [
                "Authorization: token $token",
                "Content-Type: application/json",
                "User-Agent: PHP"
            ],
            'method' => 'PUT',
            'content' => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        echo "Error uploading file.";
    } else {
        echo "File uploaded successfully!";
    }
}
?>
