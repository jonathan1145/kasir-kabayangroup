<!DOCTYPE html>
<html>
<head>
    <title>Input Barang</title>
    <style>
        body {
            font-family: 'Roboto';
        }
        table {
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>
    <?php
    include 'koneksi.php';

    // Ambil kode barang terbesar dari database dan tambahkan 1
    $query = mysqli_query($koneksi, "SELECT MAX(kode) AS KodeTerbesar FROM db_barang");
    $data = mysqli_fetch_array($query);
    $kodeBarang = $data['KodeTerbesar'];

    $urutan = (int) substr($kodeBarang, 3, 3);
    $urutan++;

    $huruf = "BRG";
    $kodeBarang = $huruf . sprintf("%03s", $urutan);
    ?>

    <h2>Input Barang</h2>

  <form method="POST" action="simpan.php">
    <input type="text" name="nama_produk">
    <input type="text" name="tipe_produk">
	<input type="text" name="jumlah">
	<input type="text" name="harga">
    <button type="submit">Simpan</button>
</form>
    <br>
    <hr>
    <br>

    <table border="1">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $barang = mysqli_query($koneksi,"SELECT * FROM db_barang");
            while($b = mysqli_fetch_array($barang)){
                ?>
                <tr>
                    <td><?php echo $b['kode']; ?></td>
                    <td><?php echo $b['nama_produk']; ?></td>
					<td><?php echo $b['tipe_produk']; ?></td>
                    <td><?php echo $b['jumlah']; ?></td>
                    <td><?php echo "Rp. ".number_format($b['harga'])." ,-"; ?></td>
                </tr>
                <?php 
            }
            ?>
        </tbody>
    </table>
</body>
</html>
