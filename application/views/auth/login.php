<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/template') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets/template') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/template') ?>/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <h1>
    Selamat datang
  </h1>
  <div class="login-box" id="login-box">
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Login ke Akun</p>
        <?= $this->session->flashdata('message'); ?>

        <form action="<?= base_url('auth') ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Email" name="email" id="email"
              value="<?= set_value('email'); ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password"
              value="<?= set_value('password'); ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="captcha">Captcha</label>
            <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Enter Captcha" required>
            <p><?php echo $captcha; ?></p>
          </div>
          <button type="submit" class="btn btn-primary btn-block" id="login_button">Login</button>
        </form>

        <div class="row">
          <div class="col-8">
            <!-- Tambahkan checkbox remember me jika diperlukan -->
          </div>
          <!-- /.col -->
          <div class="col-4">
          </div>
          <!-- /.col -->
        </div>

        <p class="mb-1">
          <a href="<?= base_url('auth/lupa_password') ?>">Lupa password?</a>
        </p>
        <p class="mb-0">
          <a href="<?= base_url('auth/registration') ?>" class="text-center">Register akun baru</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url('assets/template') ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('assets/template') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/template') ?>/dist/js/adminlte.min.js"></script>
</body>

</html>
