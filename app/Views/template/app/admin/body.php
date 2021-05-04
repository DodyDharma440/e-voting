<!--Header Component-->
<?= view('template/app/admin/header') ?>

<div id="admin">
    <div class="container-fluid position-relative p-0" style="min-height: 100%">
        <!-- Sidebar -->
        <nav id="sidebarCollapse" class="bg-dark my-sidebar">
            <div class="sidebar-brand text-center">
                <a href="#" class="navbar-brand text-light m-0 pt-2">
                    <img src="<?= base_url('assets/images/logo/logo.png') ?>" class="img-fluid d-none d-md-block" style="max-height: 40px" />
                </a>
            </div>
            <div class="list-group sidebar-menu">
                <div class="title-menu d-none d-md-block">
                    MENU
                    <span class="position-absolute icon-menu-title"><i class="fas fa-caret-square-down"></i></span>
                    <hr class="mb-1 mt-1">
                </div>
                <a href="<?= base_url('/admin/dashboard') ?>" class="list-group-item sidebar-item <?= $active == "dashboard" ? "active" : false; ?>">
                    <div class="icon-sidebar"><i class="fas fa-tachometer-alt"></i></div>
                    <div class="d-none d-md-block pl-4 ml-2 text-sidebar-menu">Dashboard</div>
                </a>
                <a href="<?= base_url('/admin/pemilih') ?>" class="list-group-item sidebar-item <?= $active == "pemilih" ? "active" : false; ?>">
                    <div class="icon-sidebar"><i class="fas fa-users"></i></div>
                    <div class="d-none d-md-block pl-4 ml-2 text-sidebar-menu">Data Pemilih</div>
                </a>
                <a href="<?= base_url('admin/kandidat') ?>" class="list-group-item sidebar-item <?= $active == "kandidat" ? "active" : false; ?>">
                    <div class="icon-sidebar"><i class="fas fa-user-tie"></i></div>
                    <div class="d-none d-md-block pl-4 ml-2 text-sidebar-menu">Kandidat</div>
                </a>
                <a href="<?= base_url('admin/pelaksanaan') ?>" class="list-group-item sidebar-item <?= $active == "pelaksanaan" ? "active" : false; ?>">
                    <div class="icon-sidebar"><i class="fas fa-clock"></i></div>
                    <div class="d-none d-md-block pl-4 ml-2 text-sidebar-menu">Pelaksanaan</div>
                </a>
                <a href="<?= base_url('admin/quick_count') ?>" class="list-group-item sidebar-item <?= $active == "hitung" ? "active" : false; ?>">
                    <div class="icon-sidebar"><i class="fas fa-sort-amount-up-alt"></i></div>
                    <div class="d-none d-md-block pl-4 ml-2 text-sidebar-menu">Quick Count</div>
                </a>
                <div class="title-menu d-none d-md-block">
                    PENGATURAN
                    <span class="position-absolute icon-menu-title"><i class="fas fa-cog"></i></span>
                    <hr class="mb-1 mt-1">
                </div>
                <a href="<?= base_url('admin/edit_profil') ?>" class="list-group-item sidebar-item <?= $active == "edit" ? "active" : false; ?>">
                    <div class="icon-sidebar"><i class="fas fa-user-edit"></i></div>
                    <div class="d-none d-md-block pl-4 ml-2 text-sidebar-menu">Edit Profil</div>
                </a>
                <a href="<?= base_url('/logout') ?>" class="list-group-item sidebar-item">
                    <div class="icon-sidebar text-danger"><i class="fas fa-power-off"></i></div>
                    <div class="d-none d-md-block pl-4 ml-2 text-sidebar-menu">Logout</div>
                </a>
            </div>
        </nav>

        <!--Container-->
        <div class="container-fluid content mr-0 p-0" id="content">
            <!--Navbar-->
            <nav class="navbar navbar-light fixed-top my-navbar" id="myNavbar">
                <button class="toggle-btn-sidebar" id="btnSidebar"><i class="fas fa-bars"></i></button>
                <div class="dropdown">
                    <button class="btn pr-0 btn-profile-navbar" id="menuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="icon-navbar-profile">
                            <i class="fas fa-user-circle"></i>
                            <small class="nama-navbar"><?= session()->nama ?></small>
                            <small class="position-relative" style="top: -6px"><i class="fas fa-sort-down"></i></small>
                        </div>
                    </button>
                    <div class="dropdown-menu right dropdown-profile" aria-labelledby="menuProfile">
                        <a class="dropdown-item pt-2 pb-2" href="<?= base_url('admin/dashboard') ?>">
                            <div class="row">
                                <div class="col-3 p-0 text-center">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                                <div class="col-9 p-0">
                                    Dashboard
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item pt-2 pb-2" href="<?= base_url('admin/edit_profil') ?>">
                            <div class="row">
                                <div class="col-3 p-0 text-center">
                                    <i class="fas fa-user-edit"></i>
                                </div>
                                <div class="col-9 p-0">
                                    Edit Profil
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item pt-2 pb-2" href="<?= base_url('/logout') ?>">
                            <div class="row">
                                <div class="col-3 p-0 text-center">
                                    <i class="fas fa-power-off"></i>
                                </div>
                                <div class="col-9 p-0">
                                    Logout
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </nav>

            <!--Content-->
            <div class="container-fluid pr-3 pl-3 dynamic-page">
                <?= view($content) ?>
            </div>
        </div>

        <!--Footer Component-->
        <?= view('template/app/admin/footer') ?>
    </div>
</div>