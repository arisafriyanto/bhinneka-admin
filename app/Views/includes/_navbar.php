<nav class="navbar navbar-expand px-3 border-bottom">
    <button class="btn" id="sidebar-toggle" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse navbar">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                    <!-- <img src="" class="avatar img-fluid rounded" alt=""> -->
                    <i class="fas fa-user" style="font-size: 22px;"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="#" class="dropdown-item">Profile</a>

                    <form action="<?= base_url('logout') ?>" method="post" class="form-inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">

                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>