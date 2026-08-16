<?php
// Vercel Serverless Router for Hotel Nataraj

$requestUri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Route dynamic pages
if ($requestUri === '/' || $requestUri === '' || $requestUri === '/index' || $requestUri === '/index.php') {
    require __DIR__ . '/../index.php';
} elseif ($requestUri === '/menu' || $requestUri === '/menu.php') {
    require __DIR__ . '/../menu.php';
} elseif ($requestUri === '/about' || $requestUri === '/about.php') {
    require __DIR__ . '/../about.php';
} elseif ($requestUri === '/contact' || $requestUri === '/contact.php') {
    require __DIR__ . '/../contact.php';
} elseif ($requestUri === '/admin' || $requestUri === '/admin.php') {
    require __DIR__ . '/../admin.php';
} elseif (preg_match('/^\/api\/(.*)/', $requestUri, $matches)) {
    $apiFile = __DIR__ . '/' . $matches[1];
    if (file_exists($apiFile) && !is_dir($apiFile)) {
        require $apiFile;
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'API endpoint not found']);
    }
} else {
    // Check if static file requested
    $staticFile = __DIR__ . '/..' . $requestUri;
    if (file_exists($staticFile) && !is_dir($staticFile)) {
        // Let webserver deliver or deliver with appropriate content-type
        $ext = pathinfo($staticFile, PATHINFO_EXTENSION);
        $mimes = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'webm' => 'video/webm',
            'mp4' => 'video/mp4'
        ];
        if (isset($mimes[$ext])) {
            header('Content-Type: ' . $mimes[$ext]);
        }
        readfile($staticFile);
    } else {
        require __DIR__ . '/../index.php';
    }
}
