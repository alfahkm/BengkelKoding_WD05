<?php
// Script reset password admin tanpa menggunakan Facade Laravel

$host = '127.0.0.1';
$db   = 'wdobat';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Hash password '123' yang sudah di-generate menggunakan bcrypt
    $hashedPassword = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // hash dari '123'

    $email = 'admin@gmail.com';

    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->execute([$hashedPassword, $email]);

    if ($stmt->rowCount() > 0) {
        echo "Password admin berhasil direset ke '123'.\n";
    } else {
        echo "User admin dengan email $email tidak ditemukan.\n";
    }
} catch (PDOException $e) {
    echo "Koneksi atau query gagal: " . $e->getMessage() . "\n";
}
?>
