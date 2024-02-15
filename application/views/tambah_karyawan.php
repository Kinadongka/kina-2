<form action="<?= base_url('karyawan/tambah_aksi') ?>" method="POST">
	<div class="form-group">
		<label>Nama Karyawan</label>
		<input type="text" name="nama_karyawan" class="form-control">
		<?= form_error('nama_karyawan', '<div class="text-small text-danger">', '</div>'); ?>
	</div>
	<div class="form-group">
		<label>Nomor Telp</label>
		<input type="text" name="nomor_telp" class="form-control">
		<?= form_error('nomor_telp', '<div class="text-small text-danger">', '</div>'); ?>
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<input type="text" name="alamat" class="form-control">
		<?= form_error('alamat', '<div class="text-small text-danger">', '</div>'); ?>
	</div>
	
	<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
	<button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
</form>
