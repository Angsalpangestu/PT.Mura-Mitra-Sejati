<?php
// Ganti dengan alamat email penerima yang sebenarnya
$receiving_email_address = 'info@muramitrasejati.co.id';

// Memeriksa apakah formulir telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    // Validasi input
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        die('Semua kolom wajib diisi!');
    }

    // Memastikan email valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Alamat email tidak valid!');
    }

    // Menyusun email
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";

    $email_subject = "Contact Form: $subject";
    $email_body = "
        <h2>Contact Request</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Message:</strong></p>
        <p>$message</p>
    ";

    // Mengirim email
    if (mail($receiving_email_address, $email_subject, $email_body, $headers)) {
        echo 'Pesan berhasil dikirim!';
    } else {
        echo 'Gagal mengirim pesan.';
    }
}
?>
