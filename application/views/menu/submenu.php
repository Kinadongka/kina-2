<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Your Title</title>
  <!-- Add Bootstrap CSS link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newSubMenuModal">
  <i class="fas fa-plus"></i> Tambah SubMenu Baru
</a>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tittle</th>
      <th scope="col">Menu</th>
      <th scope="col">Url</th>
      <th scope="col">Icon</th>
      <th scope="col">Active</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 1;
    foreach ($subMenu as $sm) :
    ?>
    <tr>
      <th scope="row"><?= $i; ?></th>
      <td><?= $sm['tittle']; ?></td>
      <td><?= $sm['menu']; ?></td>
      <td><?= $sm['url']; ?></td>
      <td><?= $sm['icon']; ?></td>
      <td><?= $sm['is_active']; ?></td>
      <td>
        <!--<button data-toggle="modal" data-target="#editModal<?= $i; ?>" class="btn btn-warning btn-sm">
          <i class="fas fa-edit"></i> Edit
        </button>-->

        <a href="<?= site_url('menu/delete_submenu/' . $sm['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?')">
          <i class="fas fa-trash"></i> Delete
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
          <form action="<?= base_url('menu/edit_submenu/' . $sm['id']) ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label>Title</label>
                <input type="text" name="tittle" class="form-control" value="<?= $sm['tittle'] ?>">
              </div>
              <div class="form-group">
                <label>Menu</label>
                <input type="text" name="menu" class="form-control" value="<?= $sm['menu'] ?>">
              </div>
              <div class="form-group">
                <label>Url</label>
                <input type="text" name="url" class="form-control" value="<?= $sm['url'] ?>">
              </div>
              <div class="form-group">
                <label>Icon</label>
                <input type="text" name="icon" class="form-control" value="<?= $sm['icon'] ?>">
              </div>
              <div class="form-group">
                <label>Active</label>
                <input type="text" name="is_active" class="form-control" value="<?= $sm['is_active'] ?>">
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

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newSubMenuModalLabel">Tambah SubMenu Baru</h1>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('menu/submenu'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="tittle">SubMenu Name</label>
            <input type="text" class="form-control" id="tittle" name="tittle" placeholder="Submenu tittle" required>
          </div>
          <div class="form-group">
            <label for="menu_id">Select Menu</label>
            <select name="menu_id" id="menu_id" class="form-control">
              <option value="">Select Menu</option>
              <?php foreach ($menu as $m) : ?>
                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="url">Url Name</label>
            <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url" required>
          </div>
          <div class="form-group">
            <label for="icon">Icon Name</label>
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon" required>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
              <label class="form-check-label" for="is_active">
                Active?
              </label>
            </div>
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

</body>
</html>
