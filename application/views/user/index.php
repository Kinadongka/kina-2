<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Page Title</title>

  <!-- Tambahkan stylesheet, script, dan konten head lainnya di sini -->
  <!-- Contoh: -->
  <!-- <link rel="stylesheet" href="path/to/your/style.css"> -->

</head>
<body>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- Konten header dapat ditempatkan di sini -->
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
          </div>
        </div>
        <div class="card mb-3" style="max-width: 540px;">
          <div class="row no-gutters">
            <div class="col-md-4">
              <?php if (!empty($user['image'])): ?>
                <img src="<?= base_url('assets/Profile/') . $user['image']; ?>" class="card-img" alt="Profile Image">
              <?php else: ?>
                <img src="<?= base_url('assets/Profile/') . $user['image']; ?>" class="card-img" alt="Default Profile Image">
              <?php endif; ?>
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Nama : <?= $user['full_name'] ?></h5>
				<br>
				<br>
                <p class="card-text">Email :<?= $user['email'] ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tambahkan script dan konten body lainnya di sini -->
  <!-- Contoh: -->
  <!-- <script src="path/to/your/script.js"></script> -->

</body>
</html>
