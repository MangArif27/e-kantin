<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                @include('web.partials._profile')
                <div class="logo-element">
                    EK+
                </div>
            </li>
            <li class="active">
              <a href="/"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-database"></i> <span class="nav-label">Master Data</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="Master-Kode">Master Kode</a></li>
                    <li><a href="Master-Kategori">Master Kategori</a></li>
                    <li><a href="Master-Satuan">Master Satuan</a></li>
                    <li><a href="Master-Suplier">Master Suplier</a></li>
                    <li><a href="Master-Barang">Master Barang</a></li>
                    <li><a href="Master-Pegawai">Master Pegawai</a></li>
                    <li><a href="Master-Konsumen">Master Konsumen</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Transaksi </span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="Penjualan">Penjualan</a></li>
                    <li><a href="Top-Up-Brizzi">Top Up Brizzi</a></li>
                </ul>
            </li>
            <li>
                <a href="mailbox.html"><i class="fa fa-book"></i> <span class="nav-label">Laporan </span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="Laporan-Stok-Barang">Laporan Stok Barang</a></li>
                    <li><a href="Laporan-Penjualan">Laporan Penjualan</a></li>
                    <li><a href="Laporan-Laba">Laporan Laba</a></li>
                </ul>
            </li>
            <li>
                <a href="Pengaturan"><i class="fa fa-gears"></i> <span class="nav-label">Pengaturan </span></a>
            </li>
        </ul>
    </div>
</nav>
