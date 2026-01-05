<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Gagal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            background: linear-gradient(135deg, #cb2d3e, #ef473a);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background: #fff;
            padding: 2.5rem;
            border-radius: 16px;
            max-width: 420px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,.2);
        }
        .icon {
            font-size: 60px;
            color: #e74c3c;
            margin-bottom: 1rem;
        }
        h2 {
            margin-bottom: .5rem;
        }
        p {
            color: #666;
            margin-bottom: 1.5rem;
        }
        a {
            display: inline-block;
            padding: 12px 20px;
            background: #e74c3c;
            color: #fff;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
<div class="card">
    <div class="icon">❌</div>
    <h2>Pembayaran Gagal</h2>
    <p>Maaf, terjadi kesalahan saat proses pembayaran.  
       Silakan coba kembali.</p>

    <a href="{{ url('/cart') }}">Kembali ke Keranjang</a>
</div>
</body>
</html>
