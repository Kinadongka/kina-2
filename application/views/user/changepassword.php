<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Page Title</title>

  <!-- Add your head content here, such as stylesheets and other meta tags -->
</head>
<body>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-4">
          <div class="col-sm-8">
            <!-- Content header can go here -->
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8">
            <h2>HELLO</h2>

            <?php
            // Tampilkan pesan peringatan jika ada
            if ($this->session->flashdata('password_message')) {
              '<div class="alert alert-success" role="alert">' . $this->session->flashdata('password_message') . '</div>';
            }
            ?>

            <form action="<?= base_url('user/changepassword'); ?>" method="post">
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Picture</label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-3">
                      <img src="<?= base_url('assets/Profile/') . $user['image'] ?>" class="img-thumbnail">
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="current_password" class="col-sm-2 col-form-label">Current Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="current_password" name="current_password">
                  <?= form_error('current_password', '<div class="text-small text-danger">', '</div>'); ?>
                </div>
              </div>

              <div class="form-group row">
                <label for="new_password1" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="new_password1" name="new_password1">
                  <?= form_error('new_password1', '<div class="text-small text-danger">', '</div>'); ?>
                </div>
              </div>

              <div class="form-group row">
                <label for="new_password2" class="col-sm-2 col-form-label">Repeat Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="new_password2" name="new_password2">
                  <?= form_error('new_password2', '<div class="text-small text-danger">', '</div>'); ?>
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary">Change Password</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>

  </div>

</body>
</html>
