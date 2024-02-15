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
</head>
<body>
  
  <h5>Role : <?= $role['role']; ?></h5> 
  
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Menu</th>
      <th scope="col">Access</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; ?>
    <?php foreach ($menu as $m) : ?>
      <tr>
        <th scope="row"><?= $i; ?></th>
        <td><?= $m['menu']; ?></td>
        <td>
          <!-- checbox -->
		  <div class="form-check">
		  <input class="form-check-input" type="checkbox"
		  <?= check_access($role['id'], $m['id']); ?> 
		  data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>" > 
		</div>
        </td>
      </tr>

      <?php $i++; ?>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
