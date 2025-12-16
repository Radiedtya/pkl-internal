{{-- ======================================== FILE:
resources/views/tentang.blade.php FUNGSI: Halaman tentang toko online
======================================== --}}

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    {{-- ↑ Encoding karakter --}}

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- ↑ Responsive untuk mobile --}}

    <title>Tentang Kami</title>

    <style>
      body {
        font-family: system-ui, -apple-system, sans-serif;
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
      }
      h1 {
        color: #4f46e5; /* Warna indigo */
      }
      .link-detail-kategori a {
        display: inline-block;
        margin-right: 15px;
        margin-top: 10px;
        text-decoration: none;
        color: #2563eb; /* Warna biru */
      }
    </style>
  </head>
  <body>
    <h1>~Tentang Toko Online Olahraga~</h1>
    <p>Selamat datang di toko online kami.</p>
    <p>Dibuat dengan ❤️ menggunakan Laravel.</p>

    {{-- ================================================ BLADE SYNTAX: {{ }}
    ================================================ Kurung kurawal ganda
    digunakan untuk menampilkan data PHP Data otomatis di-escape untuk mencegah
    XSS attack ================================================ --}}
    <p>Waktu saat ini: {{ now()->format('l, d M Y, H:i:s') }}</p>
    {{-- ↑ now() = Fungsi Laravel untuk waktu sekarang ↑ ->format() = Format
    tanggal sesuai pattern ↑ d M Y, H:i:s = 11 Dec 2024, 14:30:00 --}}

    <a href="/">&laquo; Kembali ke Home</a>
    {{-- ↑ Link biasa ke halaman utama --}}
    <hr>
    <div class="link-detail-kategori">
        <a href="{{ route('kategori.detail', ['nama' => 'eletronik']) }}">Lihat Kategori Eletronik</a>
        <a href="{{ route('produk.detail', ['id' => 1]) }}">Lihat Produk 1</a>
        <a href="{{ route('produk.detail', ['id' => 2]) }}">Lihat Produk 2</a>
        {{-- ↑ Link ke halaman detail produk dengan ID 1 dan 2 --}}
    </div>
  </body>
</html>