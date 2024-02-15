<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Your Title</title>
  <!-- Add Bootstrap CSS link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script>
    // Check if flashdata success is set, and show a corresponding alert
    <?php if($this->session->flashdata('success')): ?>
        alert('<?= $this->session->flashdata('success') ?>');
    <?php endif; ?>
  </script>
</head>
<body>

<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newMenuModal">
  <i class="fas fa-plus"></i> Tambah Menu Baru
</a>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Menu</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; ?>
    <?php foreach ($menu as $m) : ?>
      <tr>
        <th scope="row"><?= $i; ?></th>
        <td><?= $m['menu']; ?></td>
        <td>
          <!-- Add data-toggle and data-target attributes -->
          <button data-toggle="modal" data-target="#editModal<?= $i; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>Edit</button>
          <a href="<?= site_url('menu/delete/' . url_title($m['menu'])) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?')">
            <i class="fas fa-trash"></i>Hapus
          </a>
        </td>
      </tr>

      <!-- Modal edit -->
      <div class="modal fade" id="editModal<?= $i; ?>" tabindex="-1" aria-labelledby="editLabel<?= $i; ?>" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="editLabel<?= $i; ?>">Edit Menu</h1>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('menu/edit/' . $m['id']) ?>" method="post">
              <div class="modal-body">
                 <div class="form-group">
					<label>Nama Menu</label>
                       <input type="text" name="edited_menu" class="form-control" value="<?= $m['menu'] ?>">
                       <?= form_error('edited_menu', '<div class="text-small text-danger">', '</div>'); ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php $i++; ?>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newMenuModalLabel">Tambah Menu Baru</h1>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('menu'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="menu">Menu Name</label>
            <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name" required>
            <!-- Display custom error message -->
            <div class="invalid-feedback">Please enter a menu name.</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
