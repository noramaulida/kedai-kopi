<?php
    // Jika ingin membatasi akses hanya untuk user yang sudah login
    include("auth_session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran - Santaisore Coffee Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Halaman Pembayaran</h2>
        <div class="card p-4">
            <p>Terima kasih telah berbelanja di Santaisore Coffee Shop!</p>
            <p>Silakan lakukan pembayaran sesuai pesanan Anda.</p>
            <hr>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Ambil data dari form
                $nama = htmlspecialchars($_POST['nama']);
                $metode = htmlspecialchars($_POST['metode']);
                $catatan = htmlspecialchars($_POST['catatan']);

                // Simulasi data pesanan (bisa diganti dengan data dari database)
                $items = [
                    ['nama' => 'Kopi Latte', 'qty' => 2, 'harga' => 25000],
                    ['nama' => 'Roti Bakar', 'qty' => 1, 'harga' => 15000],
                ];
                $total = 0;
                foreach ($items as $item) {
                    $total += $item['qty'] * $item['harga'];
                }
                ?>
                <div id="invoice-area">
                    <h4 class="mb-3">Invoice Pembayaran</h4>
                    <p><strong>Nama:</strong> <?= $nama ?></p>
                    <p><strong>Metode Pembayaran:</strong> <?= ucfirst($metode) ?></p>
                    <?php if (!empty($catatan)): ?>
                        <p><strong>Catatan:</strong> <?= $catatan ?></p>
                    <?php endif; ?>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= $item['nama'] ?></td>
                                <td><?= $item['qty'] ?></td>
                                <td>Rp<?= number_format($item['harga'], 0, ',', '.') ?></td>
                                <td>Rp<?= number_format($item['qty'] * $item['harga'], 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan="3" class="text-end">Total</th>
                                <th>Rp<?= number_format($total, 0, ',', '.') ?></th>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-success" onclick="window.print()">Print Invoice</button>
                    <a href="pembayaran.php" class="btn btn-warning ms-2">Kembali</a>
                </div>
                <?php
            } else {
            ?>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="metode" class="form-label">Metode Pembayaran</label>
                                <select class="form-select" id="metode" name="metode" required>
                                    <option value="">Pilih Metode</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="cod">Bayar di Tempat</option>
                                    <option value="dana">DANA</option>
                                    <option value="qris">QRIS</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan (Opsional)</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="2"></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning">Bayar Sekarang</button>
                            <a href="index.php" class="btn btn-warning ms-2">Kembali</a>
                        </form>
            <?php
            }
            ?>
            <hr>
            <div>
                <h5>Pembayaran Digital:</h5>
                <a href="https://link.dana.id/minta/your-dana-link" target="_blank" class="btn btn-warning mb-2">Bayar via DANA</a>
                <br>
                <a href="../assets/images/qris.jpg" target="_blank" class="btn btn-warning mb-2">Bayar via QRIS</a>
                <br>
                <img src="../assets/images/qris.jpg" alt="QRIS" style="max-width:150px;">
            </div>
        </div>
    </div>
</body>
</html>