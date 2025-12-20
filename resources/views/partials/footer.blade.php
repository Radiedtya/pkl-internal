{{-- ================================================
     FILE: resources/views/partials/footer.blade.php
     FUNGSI: Footer website
     ================================================ --}}

<footer class="bg-dark text-light pt-5 pb-3 mt-5 position-relative">

    <!-- Accent line -->
    <div class="position-absolute top-0 start-0 w-100" style="height:4px;
         background: linear-gradient(90deg,#0d6efd,#20c997,#ffc107);">
    </div>

    <div class="container">
        <div class="row g-4">

            <!-- Brand -->
            <div class="col-lg-4 col-md-6">
                <h3 class="text-white mb-3 fw-bold">SkolaFit</h3>
                <p class="text-secondary small">
                    SkolaFit Toko online terpercaya dengan berbagai produk berkualitas.
                    Belanja <b>mudah</b>, <b>aman</b>, dan <b>nyaman</b>.
                </p>

                <!-- Social -->
                <div class="d-flex gap-2 mt-3">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <!-- Menu -->
            <div class="col-lg-2 col-md-6">
                <h6 class="text-white mb-3">Menu</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('catalog.index') }}">Katalog Produk</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>

            <!-- Help -->
            <div class="col-lg-2 col-md-6">
                <h6 class="text-white mb-3">Bantuan</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Cara Belanja</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-4 col-md-6">
                <h6 class="text-white mb-3">Kontak</h6>

                <!-- Contact -->
                <ul class="list-unstyled text-secondary small mt-3">
                    <li class="mb-1"><i class="bi bi-geo-alt me-2"></i>Bandung, Indonesia</li>
                    <li class="mb-1"><i class="bi bi-telephone me-2"></i>(022) 123-4567</li>
                    <li><i class="bi bi-envelope me-2"></i>info@skolafit.com</li>
                </ul>
            </div>

        </div>

        <hr class="my-4 border-secondary">

        <div class="row align-items-center small">
            <div class="col-md-6 text-center text-md-start text-secondary">
                &copy; {{ date('Y') }} <b class="text-light">SkolaFit</b>. All rights reserved.
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <img src="{{ asset('assets/skolafit-removebg-preview.png') }}" alt="Payment" height="28">
            </div>
        </div>
    </div>
</footer>

<style>
  .social-icon {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #1f1f1f;
    color: #adb5bd;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .3s ease;
  }

  .social-icon:hover {
    background: #0d6efd;
    color: #fff;
    transform: translateY(-3px);
  }

  .footer-links li {
    margin-bottom: 8px;
  }

  .footer-links a {
    color: #adb5bd;
    text-decoration: none;
    transition: .3s;
  }

  .footer-links a:hover {
    color: #fff;
    padding-left: 6px;
  }
</style>
