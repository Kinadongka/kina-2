<form action="<?= base_url('stock/create') ?>" method="POST">
    <div class="form-group">
        <label>Nama Stock</label>
        <input type="text" name="nama_stock" class="form-control"> 
        <?= form_error('nama_stock', '<div class="text-small text-danger">', '</div>'); ?> 
    </div>
    <div class="form-group">
        <label>Jumlah Stock</label>
        <input type="text" name="jumlah_stock" class="form-control">    
        <?= form_error('jumlah_stock', '<div class="text-small text-danger">', '</div>'); ?>>
    </div>
    <div class="form-group">
        <label>Tanggal Masuk</label>
        <input type="text" name="tanggal_masuk" class="form-control">    
        <?= form_error('tanggal_masuk', '<div class="text-small text-danger">', '</div>'); ?>>
    </div>

    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
</form>
