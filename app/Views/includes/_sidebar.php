<aside id="sidebar" class="js-sidebar">
    <div class="h-100">
        <div class="sidebar-logo">
            <a href="#">Bhinneka Admin</a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                <h6>Menu</h6>
            </li>
            <li class="sidebar-item">
                <a href="/" class="sidebar-link">
                    <i class="fa-solid fa-list pe-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                    aria-expanded="false"><i class="fa-solid fa-book pe-2"></i>
                    Master
                </a>
                <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="<?= base_url('units') ?>" class="sidebar-link">Satuan</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?= base_url('products') ?>" class="sidebar-link">Produk</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="<?= base_url('users') ?>" class="sidebar-link">
                    <i class="fa-solid fa-user pe-2"></i>
                    User
                </a>
                <a href="<?= base_url('transactions') ?>" class="sidebar-link">
                    <i class="fa-solid fa-file-lines pe-2"></i>
                    Transaksi
                </a>
            </li>
        </ul>
    </div>
</aside>