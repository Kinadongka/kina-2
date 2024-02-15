<?= $this->session->flashdata('pesan'); ?>

<div class="card">
    <div class="card-header">
        <a href="<?= base_url('stock/add') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Stock</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama Stock</th>
                    <th>Jumlah Stock</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($stock as $ssw) : ?>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $ssw->nama_stock ?></td>
                        <td><?= $ssw->jumlah_stock ?></td>
                        <td><?= $ssw->tanggal_masuk ?></td>
                        <td>
                            <button data-toggle="modal" data-target="#edit<?= $ssw->id_stock ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                            <a href="<?= base_url('stock/delete/' . $ssw->id_stock) ?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
            <style>
                 tr:nth-child(odd) {
            background-color: #51a5ffd5;
            }

                 /* CSS untuk memberi warna pada baris genap */
                tr:nth-child(even) {
                background-color: #fff;
            }

            </style>
        </table>
    </div>
</div>

<!-- Modal edit -->
<?php foreach ($stock as $ssw) : ?>
    <div class="modal fade" id="edit<?= $ssw->id_stock ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('stock/edit/' . $ssw->id_stock) ?>" method="POST">
                        <div class="form-group">
                            <label>Nama Stock</label>
                            <input type="text" name="nama_stock" class="form-control" value="<?= $ssw->nama_stock ?>">
                            <?= form_error('nama_stock', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Stock</label>
                            <input type="text" name="jumlah_stock" class="form-control"  value="<?= $ssw->jumlah_stock ?>" >
                            <?= form_error('jumlah_stock', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input type="text" name="tanggal_masuk" class="form-control"  value="<?= $ssw->tanggal_masuk ?>" >
                            <?= form_error('', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                            <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
