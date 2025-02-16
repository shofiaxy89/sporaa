<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="<?= base_url('dashboard') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="<?= base_url('prodi') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Data Prodi
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Kelola Pendaftar
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= base_url('/') ?>">Semua Pendaftar</a>
                        <a class="nav-link" href="<?= base_url('/') ?>">Pendaftar Lolos</a>
                        <a class="nav-link" href="<?= base_url('/') ?>">Pendaftar Tidak Lolos</a>
                        <a class="nav-link" href="<?= base_url('/') ?>">Merk</a>
                    </nav>
                </div>
                <a class="nav-link" href="<?= base_url('/') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Kelola Pendaftaran
                </a>
                <a class="nav-link" href="<?= base_url('divisi') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Data Divisi
                </a>
                <a class="nav-link" href="<?= base_url('/') ?>">
                    Logout
                </a>
            </div>
        </div>
    </nav>
</div>