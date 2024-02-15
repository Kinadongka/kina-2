<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Your Title</title>
  <!-- Add Bootstrap CSS link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <!-- Add Font Awesome CSS link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script>
    // Check if flashdata success is set, and show a corresponding alert
    <?php if($this->session->flashdata('success')): ?>
        alert('<?= $this->session->flashdata('success') ?>');
    <?php endif; ?>
  </script>
</head>
<body>

<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newRoleModal">
  <i class="fas fa-plus"></i> Tambah Role Baru
</a>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; ?>
    <?php foreach ($role as $r) : ?>
      <tr>
        <th scope="row"><?= $i; ?></th>
        <td><?= $r['role']; ?></td>
        <td>
          <button data-toggle="modal" data-target="#editModal<?= $r['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>Edit</button>
		  <a href="<?= base_url('admin/roleaccess/' . $r['id']) ?>" class="btn btn-warning btn-sm" onclick="return confirm('Apakah Anda yakin melakukan ini?')">
            <i class="fas fa-lock"></i> Access
          <a href="<?= base_url('admin/delete_role/' . $r['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?')">
            <i class="fas fa-trash"></i>Hapus
          </a>
        </td>
      </tr>

      <!-- Modal edit -->
      <div class="modal fade" id="editModal<?= $r['id']; ?>" tabindex="-1" aria-labelledby="editLabel<?= $r['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="editLabel<?= $r['id']; ?>">Edit Role</h1>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= base_url('admin/edit_role/' . $r['id']) ?>" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <label>Nama Role</label>
                  <input type="text" name="edited_role" class="form-control" value="<?= $r['role'] ?>">
                  <?= form_error('edited_role', '<div class="text-small text-danger">', '</div>'); ?>
                </div>
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

<!-- Modal tambah role -->
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newRoleModalLabel">Tambah Role Baru</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/role') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="role">Role Name</label>
            <input type="text" class="form-control" id="role" name="role" placeholder="Role name" required>
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
