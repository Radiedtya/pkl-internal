{{-- ================================================
     FILE: resources/views/partials/footer.blade.php
     FUNGSI: Footer website (Premium Version)
     ================================================ --}}

<footer class="footer-main mt-5 position-relative">

    {{-- Accent Gradient Line --}}
    <div class="footer-accent"></div>

    <div class="container py-5">
        <div class="row g-4">

            {{-- BRAND --}}
            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('assets/skolafit-removebg-preview.png') }}"
                     alt="SkolaFit"
                     height="46"
                     class="mb-3">

                <p class="footer-desc">
                    <b>SkolaFit</b> adalah toko online terpercaya yang menyediakan
                    produk berkualitas tinggi dengan proses belanja
                    <b>mudah</b>, <b>aman</b>, dan <b>nyaman</b>.
                </p>

                {{-- SOCIAL --}}
                <div class="d-flex gap-3 mt-4">
                    <a href="#" class="footer-social"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="footer-social"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="footer-social"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="footer-social"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            {{-- MENU --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="footer-title">Menu</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('catalog.index') }}">Katalog</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>

            {{-- BANTUAN --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="footer-title">Bantuan</h6>
                <ul class="footer-links">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Cara Belanja</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                </ul>
            </div>

            {{-- KONTAK --}}
            <div class="col-lg-4 col-md-6">
                <h6 class="footer-title">Kontak Kami</h6>

                <ul class="footer-contact">
                    <li>
                        <i class="bi bi-geo-alt"></i>
                        Bandung, Indonesia
                    </li>
                    <li>
                        <i class="bi bi-telephone"></i>
                        (022) 123-4567
                    </li>
                    <li>
                        <i class="bi bi-envelope"></i>
                        info@skolafit.com
                    </li>
                </ul>
            </div>

        </div>

        <hr class="footer-divider">

        {{-- BOTTOM --}}
        <div class="row align-items-center small">
            <div class="col-md-6 text-center text-md-start footer-copy">
                © {{ date('Y') }} <b>SkolaFit</b>. All rights reserved.
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <span class="footer-powered">
                    By <a href="https://instagram.com/rdiettyaa" class="text-decoration-none"><i>Ryn</i></a>
                </span>
            </div>
        </div>
    </div>
</footer>

<style>
/* ================================================
   FOOTER STYLE (PREMIUM)
   ================================================ */

.footer-main {
    background: #0f172a;
    color: #c7d2fe;
}

/* Accent Line */
.footer-accent {
    height: 4px;
    width: 100%;
    background: linear-gradient(90deg, #4f46e5, #10b981, #f59e0b);
}

/* Text */
.footer-desc {
    font-size: .9rem;
    line-height: 1.7;
    color: #94a3b8;
}

/* Titles */
.footer-title {
    color: #ffffff;
    font-weight: 600;
    margin-bottom: 1rem;
}

/* Links */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: .6rem;
}

.footer-links a {
    color: #94a3b8;
    text-decoration: none;
    font-size: .9rem;
    transition: all .25s ease;
}

.footer-links a:hover {
    color: #ffffff;
    padding-left: 6px;
}

/* Contact */
.footer-contact {
    list-style: none;
    padding: 0;
    margin: 0;
    font-size: .9rem;
    color: #94a3b8;
}

.footer-contact li {
    display: flex;
    align-items: center;
    gap: .6rem;
    margin-bottom: .6rem;
}

.footer-contact i {
    color: #10b981;
}

/* Social */
.footer-social {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255,255,255,.08);
    color: #c7d2fe;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .3s ease;
}

.footer-social:hover {
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
    color: #ffffff;
    transform: translateY(-4px);
}

/* Divider */
.footer-divider {
    border-color: rgba(255,255,255,.1);
    margin: 2.5rem 0 1.5rem;
}

/* Bottom */
.footer-copy {
    color: #94a3b8;
}

.footer-powered {
    color: #94a3b8;
}
</style>
