<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Pending</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            background: linear-gradient(135deg, #f9d423, #ff4e50);
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
            width: 100%;
            max-width: 420px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,.2);
        }
        .icon {
            font-size: 60px;
            color: #f39c12;
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
            background: #f39c12;
            color: #fff;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover {
            background: #e67e22;
        }
    </style>
</head>
<body>
<div class="card">
    <div class="icon">⏳</div>
    <h2>Pembayaran Pending</h2>
    <p>Pembayaran Anda belum selesai.  
       Silakan lanjutkan pembayaran untuk menyelesaikan pesanan.</p>

    <a href="{{ url('/') }}">Kembali ke Beranda</a>
</div>
</body>
</html>
