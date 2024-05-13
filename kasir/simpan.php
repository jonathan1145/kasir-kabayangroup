<?php
// Pastikan file koneksi.php sudah benar
include 'koneksi.php';

// Periksa apakah semua data yang diperlukan sudah ada
if(isset($_POST['kode']) && isset($_POST['nama']) && isset($_POST['jumlah']) && isset($_POST['harga'])) {
    // Ambil nilai dari form
    $kode = $_POST['kode'];
    $nama = $_POST['nama_produk'];
    $tipe = $_POST['tipe_produk'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];

    // Prepared statement untuk mencegah SQL Injection
    $stmt = $koneksi->prepare("INSERT INTO db_barang (kode, nama_produk, tipe_produk, jumlah, harga) VALUES (?, ?, ?, ?, ?)");
    // Bind parameter ke statement
    $stmt->bind_param("ssii", $kode, $nama, $jumlah, $harga);

    // Eksekusi statement
    $stmt->execute();

    // Tutup statement
    $stmt->close();

    // Redirect ke halaman index setelah berhasil memasukkan data
    header("location: index.php");
    exit(); // Pastikan tidak ada output sebelum header
} else {
    // Jika ada data yang kurang, tampilkan pesan error atau lakukan penanganan sesuai kebutuhan
    echo "Data tidak lengkap.";
}
?>
