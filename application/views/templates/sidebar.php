<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <!-- Profile Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i> <?= $user['full_name']; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Options</span>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('user'); ?>" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('auth/logout'); ?>" class="dropdown-item">
              <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-6">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="<?= base_url('assets/template/') ?>dist/img/Ho'olheyak.full.3945641.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $user['full_name']; ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
<!-- ... (kode sebelumnya) ... -->

<!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <?php
        $profile_picture = $user['profile_picture'] ?? null;
        $default_user_picture = base_url('assets/Profile/') . $user['image']; // Gambar profil default untuk pengguna biasa
        $default_admin_picture = base_url('assets/Profile/') . $user['image']; // Gambar profil default untuk admin

        // Tentukan URL gambar profil sesuai dengan peran
        $profile_picture_url = ($user['role_id'] === '1') 
            ? ($profile_picture && file_exists('assets/Profile/' . $profile_picture) ? base_url('assets/Profile/' . $profile_picture) : $default_admin_picture)
            : ($profile_picture && file_exists('assets/Profile/' . $profile_picture) ? base_url('assets/Profile/' . $profile_picture) : $default_user_picture);
        ?>

        <img src="<?= $profile_picture_url ?>" class="img-circle elevation-2" alt="User Image" style="width: 100px; height: 100px;">
    </div>
    <div class="info">
        <a href="#" class="d-block"><?= $user['full_name']; ?></a>
    </div>
</div>

<!-- ... (kode selanjutnya) ... -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <?php
            $role_id = $this->session->userdata('role_id');
            $querymenu = "SELECT user_menu.id, user_menu.menu
              FROM user_menu
              JOIN user_access_menu ON user_menu.id = user_access_menu.menu_id
              WHERE user_access_menu.role_id = $role_id
              ORDER BY user_access_menu.menu_id ASC";

            $menu = $this->db->query($querymenu)->result_array();
            ?>

            <!-- Looping Menu -->
            <?php foreach ($menu as $m) : ?>
              <div class="sidebar-heading">
                <?= $m['menu'] ?>
              </div>

              <!-- Sub menu -->
              <?php
              $menuId = $m['id'];
              $querySubMenu = "SELECT *
                                FROM user_sub_menu
                                JOIN user_menu 
								ON user_sub_menu.menu_id = user_menu.id
                                WHERE user_sub_menu.menu_id = $menuId
                                AND user_sub_menu.is_active = 1
							";

              $submenu = $this->db->query($querySubMenu)->result_array();
              ?>

              <?php foreach ($submenu as $sm) : ?>
                <li class="nav-item">
                  <a href="<?= base_url($sm['url']); ?>" class="nav-link">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['tittle']; ?></span></a>
                </li>
              <?php endforeach; ?>

            <?php endforeach; ?>

            <li class="nav-item">
              <a href="<?= base_url('auth/logout') ?>" class="nav-link">
			  <i class="fas fa-sign-out-alt mr-2"></i>
                <p>Logout</p>
              </a>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"><?= $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
