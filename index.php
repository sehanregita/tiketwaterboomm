
<?php
$harga_anak = 15000;
$harga_dewasa = 25000;

$nama = "";
$anak = 0;
$dewasa = 0;
$total = 0;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $anak = filter_var($_POST["anak"] ?? "", FILTER_VALIDATE_INT);
    $dewasa = filter_var($_POST["dewasa"] ?? "", FILTER_VALIDATE_INT);

    if ($nama == "" || $anak === false || $dewasa === false ||
        $anak < 0 || $dewasa < 0 || ($anak + $dewasa) == 0) {
        $error = "Mohon isi data dengan benar!";
    } else {
        $total = ($anak * $harga_anak) + ($dewasa * $harga_dewasa);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tiket Kolam Renang</title>

<style>
* {
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #00c6ff, #0072ff);
    margin: 0;
    padding: 25px 15px;
    min-height: 100vh;
}

.container {
    max-width: 430px;
    margin: 30px auto;
    background: white;
    padding: 28px;
    border-radius: 18px;
    box-shadow: 0 8px 25px #003b6f40;
}

.header {
    text-align: center;
    margin-bottom: 25px;
}

.header .icon {
    font-size: 48px;
}

h1 {
    color: #0077b6;
    font-size: 24px;
    margin-bottom: 8px;
}

.header p {
    color: #666;
    font-size: 14px;
}

.harga {
    background: #eaf8ff;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 20px;
    color: #005f8f;
    line-height: 1.8;
}

label {
    display: block;
    margin: 15px 0 7px;
    font-weight: bold;
    color: #333;
}

input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
}

input:focus {
    outline: 2px solid #00a6e8;
    border-color: transparent;
}

button {
    width: 100%;
    margin-top: 22px;
    padding: 13px;
    background: #0077b6;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background: #005f8f;
}

.struk {
    margin-top: 25px;
    padding: 18px;
    background: #eafff3;
    border: 1px solid #b4ebce;
    border-radius: 10px;
    line-height: 1.9;
    overflow-wrap: anywhere;
}

.total {
    color: #00804a;
    font-size: 20px;
    font-weight: bold;
}

.error {
    background: #ffe8e8;
    color: #b00020;
    padding: 12px;
    border-radius: 8px;
}

.footer {
    text-align: center;
    margin-top: 20px;
    color: #777;
    font-size: 12px;
}
</style>
</head>

<body>
<div class="container">

    <div class="header">
        <div class="icon">🏊</div>
        <h1>Tiket Kolam Renang</h1>
        <p>Pesan tiket berenang dengan mudah!</p>
    </div>

    <div class="harga">
        <strong>Daftar Harga Tiket</strong><br>
        👦 Anak-anak: Rp15.000<br>
        🧑 Dewasa: Rp25.000
    </div>

    <?php if ($error != ""): ?>
        <p class="error">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Nama Pembeli</label>
        <input type="text" name="nama"
            placeholder="Masukkan nama kamu"
            value="<?= htmlspecialchars($nama) ?>" required>

        <label>Jumlah Tiket Anak-anak</label>
        <input type="number" name="anak"
            min="0" max="100"
            value="<?= htmlspecialchars((string)($anak === false ? 0 : $anak)) ?>"
            required>

        <label>Jumlah Tiket Dewasa</label>
        <input type="number" name="dewasa"
            min="0" max="100"
            value="<?= htmlspecialchars((string)($dewasa === false ? 0 : $dewasa)) ?>"
            required>

        <button type="submit">🎟️ Beli Tiket</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $error == ""): ?>
    <div class="struk">
        <h3>✅ Struk Pembelian</h3>
        Nama: <?= htmlspecialchars($nama) ?><br>
        Tiket anak-anak: <?= $anak ?> × Rp15.000<br>
        Tiket dewasa: <?= $dewasa ?> × Rp25.000<br>
        Total tiket: <?= $anak + $dewasa ?><br>
        <hr>
        <div class="total">
            Total: Rp<?= number_format($total, 0, ',', '.') ?>
        </div>
        <p>Terima kasih telah membeli tiket!</p>
    </div>
    <?php endif; ?>

    <div class="footer">
        Aplikasi Tiket Kolam Renang &copy; 2026
    </div>

</div>
</body>
</html>
