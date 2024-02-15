<form action="<?= base_url('Harga/buat') ?>" method="POST">
    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="text" name="harga" id="harga" class="form-control" required>
        <?= form_error('harga', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="harga">Jenis bahan</label>
        <input type="text" name="jenis_bahan" id="jenis_bahan" class="form-control" required>
        <?= form_error('jenis_bahan', '<div class="text-small text-danger">', '</div>'); ?>
    </div>

    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
</form>
