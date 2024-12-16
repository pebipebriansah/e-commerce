<?php
if (isset($_GET['endpoint'])) {
    $url = 'https://emsifa.github.io/api-wilayah-indonesia/api/' . $_GET['endpoint'];

    // Inisialisasi cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Ikuti pengalihan (jika ada)

    // Eksekusi cURL dan dapatkan respon
    $response = curl_exec($ch);

    // Periksa error cURL
    if(curl_errno($ch)) {
        echo json_encode(['error' => curl_error($ch)]);
    } else {
        // Jika tidak ada error, kembalikan respon sebagai JSON
        header('Content-Type: application/json');
        echo $response;
    }

    // Tutup cURL
    curl_close($ch);
} else {
    echo json_encode(['error' => 'No endpoint specified.']);
}
?>
