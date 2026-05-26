<?php
// Pengaturan header agar output dibaca sebagai JSON
header('Content-Type: application/json; charset=utf-8');

// Mendapatkan endpoint dari URL (misal: api.php/dim_jabatan)
// PATH_INFO memberikan string setelah nama script, contoh: /dim_jabatan
$endpoint = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'], '/') : '';

// Daftar endpoint yang diizinkan (sesuai nama file JSON Anda)
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
        // Membaca isi file dan langsung mencetaknya
        echo file_get_contents($filename);
    } else {
        // Jika file tidak ditemukan (seharusnya tidak terjadi jika sudah dibuat)
        http_response_code(404);
        echo json_encode(['error' => 'File data tidak ditemukan']);
    }
} else {
    // Jika endpoint tidak valid
    http_response_code(404);
    echo json_encode(['error' => 'Endpoint tidak valid']);
}
?>
