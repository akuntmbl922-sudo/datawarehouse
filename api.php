<?php
header('Content-Type: application/json; charset=utf-8');

// Mengambil request URI, misal: /api.php/dim_jabatan
$uri = $_SERVER['REQUEST_URI'];

// Memastikan kita hanya mengambil bagian setelah 'api.php/'
$parts = explode('/api.php/', $uri);
$endpoint = isset($parts[1]) ? trim($parts[1], '/') : '';

$allowed_endpoints = [
    'dim_jabatan',
    'dim_kabupaten_kota',
    'dim_lama_dapat_kerja',
    'dim_sekolah',
    'dim_prodi'
];

if (in_array($endpoint, $allowed_endpoints)) {
    $filename = $endpoint . '.json';
    
    if (file_exists($filename)) {
        echo file_get_contents($filename);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'File data tidak ditemukan']);
    }
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Endpoint tidak valid', 'received' => $endpoint]);
}
?>
