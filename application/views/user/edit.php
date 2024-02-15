<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Add your head content here -->
</head>
<body>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- Content header can go here -->
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8">
            HELLO
			<?= form_open_multipart('user/edit'); ?>
			<div class="form-group row">
				<label for="email" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="email" name="email"value="<?= $user['email']; ?>" readonly>
				</div>
			  </div>
			  <div class="form-group row">
				<label for="full_name" class="col-sm-2 col-form-label">Full Name</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="full_name" name="full_name" value="<?= $user['full_name']; ?>" >
				   <?= form_error('full_name', '<div class="text-small text-danger">', '</div>'); ?>
				</div>
			  </div>
			  <div class="form-group row">
				<div class="col-sm-2">Picture</div>
				<div class="col-sm-10">
					<div class="row">
						<div class ="col-sm-3">
						<img src="<?= base_url('assets/Profile/') . $user['image'] ?>" class="img-thumbnail">
					</div>
					<div class="col-sm-9">
					<div class="custom-file">
					  <input type="file" class="custom-file-input" id="image" name="image">
					  <label class="custom-file-label" for="image">Choose file</label>
					</div>
					</div>
          </div>
        </div>
      </div>
	  
	  <div class="form-group row">
		<div class="col-sm-18">
			<button type="submit" class="btn btn-primary">Edit</button>
		</div>	
	  </div>
	  
    </div>
  </div>

</body>
</html>
