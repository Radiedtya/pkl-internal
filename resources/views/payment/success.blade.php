<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Berhasil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            background: linear-gradient(135deg, #00b09b, #96c93d);
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
            color: #2ecc71;
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
            background: #2ecc71;
            color: #fff;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover {
            background: #27ae60;
        }
    </style>
</head>
<body>
<div class="card">
    <div class="icon">✅</div>
    <h2>Pembayaran Berhasil</h2>
    <p>Terima kasih!  
       Pesanan Anda telah berhasil dibayar.</p>

    <a href="{{ url('/orders') }}">Lihat Pesanan</a>
</div>
</body>
</html>
