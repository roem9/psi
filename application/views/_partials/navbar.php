<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
        <div class="container-xl">
            <ul class="navbar-nav">
            <li class="nav-item dropdown" id="Produk">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg width="24" height="24" class="me-3">
                            <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-building-store" />
                        </svg> 
                    </span>
                    <span class="nav-link-title">
                        Produk
                    </span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" id="produk" href="<?= base_url()?>produk" >
                        List Produk
                    </a>
                    <a class="dropdown-item" id="listVarian" href="<?= base_url()?>produk/varian" >
                        List Varian Produk
                    </a>
                    <a class="dropdown-item" id="arsipVarian" href="<?= base_url()?>produk/arsipvarian" >
                        Arsip Varian Produk
                    </a>
                </div>
            </li>

            <li class="nav-item dropdown" id="Penyetokan">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg width="24" height="24" class="me-3">
                            <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-building-warehouse" />
                        </svg> 
                    </span>
                    <span class="nav-link-title">
                        Penyetokan
                    </span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" id="listPenyetokan" href="<?= base_url()?>penyetokan/list" >
                        List Penyetokan
                    </a>
                    <a class="dropdown-item" id="arsipPenyetokan" href="<?= base_url()?>penyetokan/arsip" >
                        Arsip Penyetokan
                    </a>
                </div>
            </li>

            <li class="nav-item dropdown" id="Closing">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg width="24" height="24" class="me-3">
                            <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-shopping-cart-plus" />
                        </svg> 
                    </span>
                    <span class="nav-link-title">
                        Closing
                    </span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" id="bayarClosing" href="<?= base_url()?>closing/bayar" >
                        Bayar Closing
                    </a>
                    <a class="dropdown-item" id="listClosing" href="<?= base_url()?>closing/list" >
                        List Closing
                    </a>
                    <a class="dropdown-item" id="arsipClosing" href="<?= base_url()?>closing/arsip" >
                        Arsip Closing
                    </a>
                    <a class="dropdown-item" id="pendingPickup" href="<?= base_url()?>closing/pendingpickup" >
                        Pending Pickup
                    </a>
                    <a class="dropdown-item" id="perluPerhatian" href="<?= base_url()?>closing/perluperhatian" >
                        Perlu Perhatian
                    </a>
                </div>
            </li>

            <li class="nav-item" id="pencairan">
                <a class="nav-link btnLoading" href="<?= base_url()?>other/pencairan" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg width="24" height="24" class="me-3">
                            <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-cash" />
                        </svg> 
                    </span>
                    <span class="nav-link-title">
                        Pencairan
                    </span>
                </a>
            </li>

            <li class="nav-item dropdown" id="Closing">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg width="24" height="24" class="me-3">
                            <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-report-analytics" />
                        </svg> 
                    </span>
                    <span class="nav-link-title">
                        Laporan
                    </span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#downloadLaporan" data-bs-toggle="modal" >
                        Download Laporan
                    </a>
                    <a class="dropdown-item" target="_blank" href="<?= base_url()?>closing/view" >
                        View Laporan
                    </a>
                    <a class="dropdown-item" href="#laporanAdvertiser" data-bs-toggle="modal" >
                        Laporan Advertiser
                    </a>
                </div>
            </li>

            <li class="nav-item dropdown" id="Other">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg width="24" height="24" class="me-3">
                            <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-dots" />
                        </svg> 
                    </span>
                    <span class="nav-link-title">
                        Lainnya
                    </span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" id="listCs" href="<?= base_url()?>other/cs" >
                        List CS
                    </a>
                    <a class="dropdown-item" id="listGudang" href="<?= base_url()?>other/gudang" >
                        List Gudang
                    </a>
                    <a class="dropdown-item" id="listGudang" href="<?= base_url()?>other/kpi" >
                        List KPI
                    </a>
                </div>
            </li>
            </ul>
        </div>
        </div>
    </div>
</div>